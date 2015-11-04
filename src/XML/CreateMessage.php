<?php

// DIDIMO SMS - Web API XML Sample
include "Utils.php";
date_default_timezone_set('Europe/Madrid');

// Service URL
$service_url = 'https://sms.didimo.es/wcf/Service.svc/rest/createmessage';

// User data
$username = 'username@domain.com';
$password = 'password';

// SMS data
$name = 'Test Web API - PHP Client -'.date("Y-m-d H:i:s"); #Optional
$scheduleDate = date("Y-m-d\TH:i:s"); #Optional
$sender = 'sender'; #Optional
$id=Utils::CreateGUID(); #Optional
$isUnicode='false';  #Optional - Values: 'true' or 'false'. Default value: 'false'
$mobile='+34653695688'; #Required
$text='Test API sms.didimo.es, by PHP client '.date("Y-m-d H:i:s").' - '.$id; #Required

// XML data
$xmldata='
<CreateMessageRequest xmlns="https://sms.didimo.es/wcf/CreateMessageRequest">
  <UserName>'.$username.'</UserName>
  <Password>'.$password.'</Password>
  <Id>'.$id.'</Id>
  <Name>'.$name.'</Name>
  <Sender>'.$sender.'</Sender>
  <Text>'.$text.'</Text>
  <Mobile>'.$mobile.'</Mobile>
  <ScheduleDate>'.$scheduleDate.'</ScheduleDate>
  <IsUnicode>'.$isUnicode.'</IsUnicode>
</CreateMessageRequest>
';

// curl data
$headers = array(
    'Content-Type: application/xml; charset=utf-8',
    'Accept: application/xml');
    
$curl = curl_init($service_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $xmldata);

/* For PHP v5.5.18 or earlier */
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

/* For PHP v5.5.19 or later */
//curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);

$curl_response = curl_exec($curl);
$info = curl_getinfo($curl);

// Result
Utils::printr("XML result: \r\n");
$xml = Utils::xmlentities($curl_response); 
Utils::printr($xml);
Utils::printr("\r\n");

Utils::printr("Response result: \r\n");
Utils::printr( $curl_response);
Utils::printr("\r\n");
Utils::printr("---------------------------------------------------------------\r\n");

Utils::printr("Request info: \r\n");
Utils::printr( $info);
Utils::printr("---------------------------------------------------------------\r\n");
Utils::printr("\r\n");

curl_close($curl);

?>

