<?php

// DIDIMO SMS - Web API JSON Sample
include "Utils.php";

date_default_timezone_set('Europe/Madrid');

// Service URL
$service_url = 'https://sms.didimo.es/wcf/Service.svc/rest/createsend';

// User data
$username = 'username@domain.com';
$password = 'password';

// Schedule data
$name = 'Test Web API - PHP Client -'.date("Y-m-d H:i:s"); #Optional
$scheduleDate = date("Y-m-d\TH:i:s"); #Optional
$sender = 'sender'; #Optional

# SMS 1 - GSM7 
$id=Utils::CreateGUID(); #Optional
$mobile='+34653695688'; #Required
$text='Test API sms.didimo.es, by PHP client '.date("Y-m-d H:i:s").' - '.$id; #Required
$isUnicode='false';  #Optional - Values: 'true' or 'false'. Default value: 'false' 
$listMessages[] = 
            array(
                'Id' => $id,
                'IsUnicode' => $isUnicode,
                'Mobile' => $mobile,
                'Text' => $text 
                ); #Required
				
# SMS 2 - Unicode
$id=Utils::CreateGUID(); #Optional
$mobile='+34653695842'; #Required
$text='測試API sms.didimo.es，由PHP客戶端 '.date("Y-m-d H:i:s").' - '.$id; #Required
$isUnicode='true';  #Optional - Values: 'true' or 'false'. Default value: 'false'
$listMessages[] = 
            array(
                'Id' => $id,
                'IsUnicode' => $isUnicode,
                'Mobile' => $mobile,
                'Text' => $text 
                ); #Required

// POST Data
$curl_post_data = array( 
            'UserName' => $username,
            'Password' => $password,
			'Name' => $name,
			'ScheduleDate' => $scheduleDate,
			'Sender' => $sender,
			'Messages' => $listMessages
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

