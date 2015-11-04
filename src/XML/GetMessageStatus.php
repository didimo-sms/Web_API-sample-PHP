<?php

// DIDIMO SMS - Web API XML Sample
include "Utils.php";

// Service URL
$service_url = 'https://sms.didimo.es/wcf/Service.svc/rest/getmessagestatus';

// User data
$username = 'username@domain.com';
$password = 'password';

// SMS data 
$id='3354c4ad-4bb0-1174-1424-fc6fae3ce04e'; #Required

// XML data
$xmldata='
<GetMessageStatusRequest xmlns="https://sms.didimo.es/wcf/GetMessageStatusRequest">
    <UserName>'.$username.'</UserName>
    <Password>'.$password.'</Password>
    <Id>'.$id.'</Id>
</GetMessageStatusRequest>
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

