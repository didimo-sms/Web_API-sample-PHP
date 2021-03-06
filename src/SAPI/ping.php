<?php

// DIDIMO SMS - Web API URL Parameters Sample
include "Utils.php";

// Service URL
$service_url = 'https://sms.didimo.es/sapi/ping';

// User data
$username = 'username@domain.com';
$password = 'password';

// POST Data
$curl_post_data = array( 
            'user' => $username,
            'password' => $password,
            );

$query = http_build_query($curl_post_data);

// curl data
$headers = array(
    'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    'Accept: application/json');

$dir = getcwd();

$curl = curl_init($service_url.'?'.$query);

curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $query );
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt ($curl, CURLOPT_CAINFO, $dir.'\digicert.pem');

//curl_setopt($curl, CURLOPT_VERBOSE, true);

$curl_response = curl_exec($curl);
$info = curl_getinfo($curl);

// Result
Utils::printr("Json result: \r\n");
$json = json_decode($curl_response); 
Utils::printr($json);

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

