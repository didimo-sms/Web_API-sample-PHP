<?php

// DIDIMO SMS - Web API XML Sample
include "Utils.php";

// Service URL
$service_url = 'https://sms.didimo.es/wcf/Service.svc/rest/ping';

// User data
$username = 'username@domain.com';
$password = 'password';

// XML data
$xmldata='
<PingRequest xmlns="https://sms.didimo.es/wcf/PingRequest">
    <UserName>'.$username.'</UserName>
    <Password>'.$password.'</Password>
</PingRequest>
';

// curl data
$headers = array(
    'Content-Type: application/xml; charset=utf-8',
    'Accept: application/xml');
    
$dir = getcwd();

$curl = curl_init($service_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $xmldata);
curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt ($curl, CURLOPT_CAINFO, $dir.'\digicert.pem');

curl_setopt($curl, CURLOPT_VERBOSE, true);

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

