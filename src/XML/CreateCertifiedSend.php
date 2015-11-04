<?php

// DIDIMO SMS - Web API XML Sample
include "Utils.php";

date_default_timezone_set('Europe/Madrid');

// Service URL
$service_url = 'https://sms.didimo.es/wcf/Service.svc/rest/createcertifiedsend';

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
$text='Test API SMS Certificado sms.didimo.es, by PHP client '.date("Y-m-d H:i:s").' - '.$id; #Required
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
$text='測試API SMS Certificado sms.didimo.es，由PHP客戶端 '.date("Y-m-d H:i:s").' - '.$id; #Required
$isUnicode='true';  #Optional - Values: 'true' or 'false'. Default value: 'false'
$listMessages[] = 
            array(
                'Id' => $id,
                'IsUnicode' => $isUnicode,
                'Mobile' => $mobile,
                'Text' => $text 
                ); #Required

// XML data
$xmlMessages = '';
for ($i = 0; $i < count($listMessages); $i++) 
{ 
    $xmlMessages .= '
        <MessageSend xmlns="https://sms.didimo.es/wcf/CreateSendRequest/MessageSend">
          <Id>'.$listMessages[$i]['Id'].'</Id>
          <IsUnicode>'.$listMessages[$i]['IsUnicode'].'</IsUnicode>
          <Mobile>'.$listMessages[$i]['Mobile'].'</Mobile>
          <Text>'.$listMessages[$i]['Text'].'</Text>
        </MessageSend>
      '; 
}

$xmldata='
<CreateSendRequest xmlns="https://sms.didimo.es/wcf/CreateSendRequest">
  <UserName>'.$username.'</UserName>
  <Password>'.$password.'</Password>
  <Name>'.$name.'</Name>
  <ScheduleDate>'.$scheduleDate.'</ScheduleDate>
  <Sender>'.$sender.'</Sender>
  <Messages>'.$xmlMessages.'</Messages>
</CreateSendRequest>
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

