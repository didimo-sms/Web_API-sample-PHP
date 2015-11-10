<?php
	
class Utils
{
	private function Utils(){}
	
	public static function printr($a)
	{
	    ob_start();
	    print_r($a);
	    $t=ob_get_contents();
	    ob_end_clean();
	    echo nl2br(str_replace(" ","&nbsp;",$t));
	}
	
	public static function xmlentities($string) 
	{
	    return str_replace( array("&",      "<",    ">",    "\"",       "'"),
	                        array("&amp;",  "&lt;", "&gt;", "&quot;",   "&apos;")
	                    , $string);
	}
	
	public static function CreateGUID(){
	    if (function_exists('com_create_guid')){
	        return com_create_guid();
	    }else{
	        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	        $charid = strtoupper(md5(uniqid(rand(), true)));
	        $hyphen = chr(45);// "-"
	        $uuid = chr(123)// "{"
	                .substr($charid, 0, 8).$hyphen
	                .substr($charid, 8, 4).$hyphen
	                .substr($charid,12, 4).$hyphen
	                .substr($charid,16, 4).$hyphen
	                .substr($charid,20,12)
	                .chr(125);// "}"
	        return $uuid;
	    }
	}
	
	public static function getValueOfHeaderResponse($header, $propertyName)
	{
		$value = "";
		foreach ($header as $k => $v) 
		{ 
			$array = explode(":", $v);
			if(strtolower($array[0]) == strtolower($propertyName))
			{
				$value = $array[1];
				break;
			}
        }
		
		return $value;
	}
	
	public static function GetFileNameFromHeadersResponse($headersResponse, $defaultValue)
	{
		$filenameHolder = "filename=";
		$result = $defaultValue;
		// get the content-disposition value from header response
		$cdvalue = Utils::getValueOfHeaderResponse($headersResponse, "content-disposition");
		
		$result = str_replace("\"", "", substr($cdvalue, strrpos($cdvalue, $filenameHolder)+strlen($filenameHolder)) );
		
		return $result;
	}
}

?>