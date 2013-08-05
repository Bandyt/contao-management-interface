<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package   mi
 * @author    Andreas Koob
 * @license   LGPL
 * @copyright © 2013 Andreas Koob
 */

/**
 * Class mi_outputgenerator
 *
 * @copyright  © 2013 Andreas Koob
 * @author     Andreas Koob
 * @package    mi
 */
class mi_outputgenerator extends Frontend
{
	public function generateErrorData($err_group, $err_code)
	{
		$errmgr = new mi_errormgr();
		$outputdata['result']='error';
		$outputdata['error']=array(
			'err_group'=>$err_group,
			'err_code'=>$err_code,
			'err_description'=>$errmgr->getErrorDescription($err_group,$err_code)
		);
		return $outputdata;
	}
	public function generateXMLOutput($data)
	{
		$return='';
		//Add header information
		$return.='<?xml version="1.0"?>' . "\n";
		$return.='<contao_management_interface api_major="1" api_minor="0" api_revision="0">' . "\n";
		$return.='<request>' . "\n";
		$return.='<module>' . $data['request']['module'] . '</module>' . "\n";
		$return.='<function>' . $data['request']['function'] . '</function>' . "\n";
		$return.='<datetime>' . $data['request']['datetime'] . '</datetime>' . "\n";
		if(is_array($data['request']['parameters']))
		{
			$return.='<parameters>' . "\n";
				foreach($data['request']['parameters'] as $key=>$value)
				{
					$return.='<' . $key . '>' . $value . '</' . $key . '>' . "\n";
				}
			$return.='</parameters>' . "\n";
		}
		$return.='</request>' . "\n";
		switch($data['result'])
		{
			case 'error':
				$return.='<result>error</result>' . "\n";
				$return.='<error>' . "\n";
				$return.='<group>' . $data['error']['err_group'] . '</group>' . "\n";
				$return.='<code>' . $data['error']['err_code'] . '</code>' . "\n";
				$return.='<description>' . $data['error']['err_description'] . '</description>' . "\n";
				if($data['error']['add_information']!='')
				{
					$return.='<additional_information>' . $data['error']['add_information'] . '</additional_information>' . "\n";
				}
				$return.='</error>' . "\n";
				break;
			case 'success':
				$return.='<result>success</result>' . "\n";
				if(is_array($data['success']))
				{
					$return.='<success>' . "\n";
					if($data['success']['message']!=''){$return.='<message>' . $data['success']['message'] . '</message>' . "\n";}
					if($data['success']['datasets_read']!=''){$return.='<datasets_read>' . $data['success']['datasets_read'] . '</datasets_read>' . "\n";}
					if($data['success']['datasets_changed']!=''){$return.='<datasets_changed>' . $data['success']['datasets_changed'] . '</datasets_changed>' . "\n";}
					if($data['success']['datasets_deleted']!=''){$return.='<datasets_deleted>' . $data['success']['datasets_deleted'] . '</datasets_deleted>' . "\n";}
					$return.='</success>' . "\n";
				}
				if(is_array($data['result_sets']))
				{
					$return.='<result_sets>' . "\n";
					$return.=$this->resultsetToXML($data['result_sets'],'');						
					$return.='</result_sets>' . "\n";
				}
				break;
		}
		
		//Add closing tags
		$return.='</contao_management_interface>' . "\n";
				
		return $return;
	}
	public function resultsetToXML($rs, $rs_key)
	{
		$return='';
		
		/*Required field types:
		-String
		-Number
		-Boolean
		-List (Array of e.g. numbers)
		-Collection (Array of objects)
		-Complex (CDATA etc)
		*/

		if(!is_array($rs)){return '';}
		foreach($rs as $key=>$value)
		{
			switch($key)
			{
				case '_strings':
				case '_numbers':
					//WORKING
					foreach($value as $subKey=>$subValue)
					{
						$return.='<' . $subKey . '>' . $subValue . '</' . $subKey . '>' . "\n";
					}
					break;
				case '_complex':
					foreach($value as $subKey=>$subValue)
					{
						$return.='<' . $subKey . '><![CDATA[' . $subValue . ']]></' . $subKey . '>' . "\n";
					}
					break;
				case '_booleans':
					foreach($value as $subKey=>$subValue)
					{
							$return.='<' . $subKey . '>';
							$subValue=='1'? $return.='true' : $return.='false';
							$return.='</' . $subKey . '>' . "\n";
					}
					break;
				case '_lists':
					foreach($value as $subKey=>$subValue)//element
					{
						foreach($subValue as $itemKey=>$itemValue)//0,1,2
						{								
							$return.='<' . $subKey . '>' . $itemValue . '</' . $subKey . '>' . "\n";
						}
					}
					break;
				case '_collections':
					foreach($value as $subKey=>$subValue)//element
					{
						$return.='<' . $subKey . '>' . "\n";
							foreach($subValue as $itemKey=>$itemValue)//0,1,2
							{								
								$return.=$this->resultsetToXML($itemValue, $itemKey);
							}
						$return.='</' . $subKey . '>' . "\n";
					}
					break;
				default:
					if(!is_array($value)){$return.='NO ARRAY: ' . $key . '=>' . $value;break;}
					foreach($value as $subKey=>$subValue)
					{
						$return.='<' . $subKey . '>' . $subValue . '</' . $subKey . '>';
					}		
			}
		}
		
		return $return;
	}
	
	public function generateJSONOutput($data)
	{
		$return='{"apiversion": { "major":"1" , "minor":"0" , "revision":"0" },' . "\n";
		$return.='"request": { "module":"' . $data['request']['module'] . '", "function":"' . $data['request']['function'] . '", "datetime":"' . $data['request']['datetime'] . "\n";
		if(is_array($data['request']['parameters']))
		{
			$return.='"parameters:{' . "\n";
			foreach($data['request']['parameters'] as $key=>$value)
			{
				$return.='"' . $key . '":"' . $value . '"' . "\n";
			}
			$return.='}' . "\n";
		}
		$return.='},' . "\n";
		switch($data['result'])
		{
			case 'error':
				$return.='"result":"error",' . "\n";
				$return.='"error":[' . "\n";
				$return.='"group":"' . $data['error']['err_group'] . '",' . "\n";
				$return.='"code":"' . $data['error']['err_code'] . '",' . "\n";
				$return.='"description":"' . $data['error']['err_description'] . '"';
				if($data['error']['add_information']!='')
				{
					$return.=",\n" . '"additional_information":"' . $data['error']['add_information'] . '"' . "\n";
				}
				$return.=']' . "\n";
				break;
			
			case 'success':
				$return.='"result":"success"';
				if(is_array($data['success']))
				{
					$return.=",\n" . '"success":{' . "\n";
					if($data['success']['message']!=''){$return.='"message":"' . $data['success']['message'] . '"';}
					if($data['success']['datasets_read']!=''){$return.=",\n" . '"datasets_read":"' . $data['success']['datasets_read'] . '"';}
					if($data['success']['datasets_changed']!=''){$return.=",\n" . '"datasets_changed":"' . $data['success']['datasets_changed'] . '"';}
					if($data['success']['datasets_deleted']!=''){$return.=",\n" . '"datasets_deleted":"' . $data['success']['datasets_deleted'] . '"';}
					$return.="\n" . '}';
				}
				if(is_array($data['result_sets']))
				{
					$return.=",\n" . '"result_sets":{' . "\n";
					$return.=$this->resultsetToJSON($data['result_sets'],'');						
					$return.='}' . "\n";
				}
				break;
		}
		
		//Add closing tag
		$return.='}';
		return $return;
	}
	
	public function resultsetToJSON($rs, $rs_key)
	{
		if(!is_array($rs)){return '';}
		$all=0;
		foreach($rs as $key=>$value)
		{
			$all++;
			switch($key)
			{
				case '_strings':
					$i=0;
					foreach($value as $subKey=>$subValue)
					{
						$i++;
						$return.='"' . $subKey . '":"' . $subValue . '"';
						if($i<count($rs['_strings'])){$return.=",";}
					}
					if($all<count($rs)){$return.=",\n";}else{$return.="\n";}
					break;
				case '_numbers':
					$i=0;
					foreach($value as $subKey=>$subValue)
					{
							$i++;
							$return.='"' . $subKey . '":' . $subValue;
							if($i<count($rs['_numbers'])){$return.=",";}
					}
					if($all<count($rs)){$return.=",\n";}else{$return.="\n";}
					break;
				case '_complex': //Complex data will be base64 encoded!
					$i=0;
					foreach($value as $subKey=>$subValue)
					{
							$i++;
							$return.='"' . $subKey . '":' . base64_encode($subValue);
							if($i<count($rs['_numbers'])){$return.=",";}
					}
					if($all<count($rs)){$return.=",\n";}else{$return.="\n";}
					break;
				case '_booleans':
					$i=0;
					foreach($value as $subKey=>$subValue)
					{
						$i++;
						$return.='"' . $subKey . '":';
						$subValue=='1'? $return.='true' : $return.='false';
						if($i<count($rs['_booleans'])){$return.=",";}
					}
					if($all<count($rs)){$return.=",\n";}else{$return.="\n";}
					break;
				case '_lists':
					$i=0;
					foreach($value as $subKey=>$subValue)//element
					{
						$i++;
						$return.='"' . $subKey . '":[' . "\n";
						$j=0;
						foreach($subValue as $itemKey=>$itemValue)//0,1,2
						{
							$j++;
							$return.=$itemValue;
							$j<count($subValue) ? $return.=',' . "\n" : $return.= "\n";
						}
						$return.=']';
						if($i<count($rs['_lists'])){$return.=",";}
					}
					if($all<count($rs)){$return.=",\n";}else{$return.="\n";}
					break;
				case '_collections':
					$i=0;
					foreach($value as $subKey=>$subValue)//element
					{
						$i++;
						$return.='"' . $subKey . '":{' . "\n";
						$j=0;
						foreach($subValue as $itemKey=>$itemValue)//0,1,2
						{	
							$j++;
							$return.=$this->resultsetToJSON($itemValue, $itemKey);
							if($j<count($subValue)){$return.=',';};
						}
						$return.='}';
						if($i<count($value)){$return.=',';}
						if($i<count($rs['_collections'])){$return.=',' . "\n";}
					}
					if($all<count($rs)){$return.=",\n";}else{$return.="\n";}
					break;
				default:
					if(!is_array($value)){$return.='NO ARRAY: ' . $key . '=>' . $value;break;}
					foreach($value as $subKey=>$subValue)
					{
						$return.='"' . $subKey . '":"' . $subValue . '"';
					}
					if($all<count($rs)){$return.=",\n";}else{$return.="\n";}					
			}
		}
		return $return;
	}
	
	public function generateOutput($data,$format)
	{
		switch($format)
		{
			case 'XML':
				$return=$this->generateXMLOutput($data);
				break;
			case 'JSON':
				$return=$this->generateJSONOutput($data);
				break;
		}
		return $return;
	}
}
?>