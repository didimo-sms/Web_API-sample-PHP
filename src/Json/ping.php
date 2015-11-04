<?php

// DIDIMO SMS - Web API JSON Sample
include "Utils.php";

// Service URL
$service_url = 'https://sms.didimo.es/wcf/Service.svc/rest/ping';

// User data
$username = 'username@domain.com';
$password = 'password';

// POST Data
$curl_post_data = array( 
            'UserName' => $username,
            'Password' => $password,
            );

// Json data
$json_data = json_encode($curl_post_data);

// curl data
$headers = array(
    'Content-Type: application/json; charset=utf-8',
    'Accept: application/json');
    
$curl = curl_init($service_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);

/* For PHP v5.5.18 or earlier */
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

/* For PHP v5.5.19 or later */
//curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);

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

