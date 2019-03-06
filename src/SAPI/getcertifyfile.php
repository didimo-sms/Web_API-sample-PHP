<?php

// DIDIMO SMS - Web API URL Parameters Sample
include "Utils.php";

// Service URL
$service_url = 'https://sms.didimo.es/sapi/sms/certifyfile';

// User data
$username = 'username@domain.com';
$password = 'password';

// SMS data 
$id='1244eaaa-9cbe-434a-a3eb-762fa8be865f'; #Required

// POST Data
$curl_post_data = array( 
            'user' => $username,
            'password' => $password,
			'id' => $id,
            );

$query = http_build_query($curl_post_data);

// If you want to get the file name in "content-disposition" header response set $return_response_header = true
$return_response_header = true;

// Set http_post = true if you want POST method
// Set http_post = false if you want GET method
$http_post = false;

// curl data
$headers = array(
    'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    'Accept: application/json');

$dir = getcwd();

$curl = curl_init($service_url.'?'.$query);

curl_setopt($curl, CURLOPT_POST, $http_post);
if($http_post == true)	
{
	curl_setopt($curl, CURLOPT_POSTFIELDS, $query );
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
}
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
curl_setopt($curl, CURLOPT_HEADER, $return_response_header);
curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt ($curl, CURLOPT_CAINFO, $dir.'\digicert.pem');

curl_setopt($curl, CURLOPT_VERBOSE, true);

$curl_response = curl_exec($curl);
$info = curl_getinfo($curl);
$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

Utils::printr("Response result: \r\n");
Utils::printr( $curl_response);
Utils::printr("\r\n");
Utils::printr("---------------------------------------------------------------\r\n");

Utils::printr("Request info: \r\n");
Utils::printr( $info);
Utils::printr("---------------------------------------------------------------\r\n");
Utils::printr("\r\n");

curl_close($curl);

//Check the http code status
if($http_status == "200")
{
    Utils::printr("Response process: \r\n");
    
    $content;
    $fileName;
    $defualtFilename = "message_".$id.".pdf";
    
    // Check $return_response_header value
    if($return_response_header == true)
    {
        // resource: http://ryansechrest.com/2012/07/send-and-receive-binary-files-using-php-and-curl/
        // Separate the header from the rest of the file
        $response_array = explode("\n\r", $curl_response, 2);
        Utils::printr($response_array);
        // Get the file name
        $fileName = Utils::GetFileNameFromHeadersResponse(explode("\n", $response_array[0]), $defualtFilename);
        
        $content = $response_array[1];
    }
    else
    {
        $content = $curl_response;
        $fileName = $defualtFilename;
    }
    
    Utils::printr ("file name: ".$fileName."\r\n");
    
    // Save Certify file on disk
    $fileDirectory = "C:\\SMSCertifies\\sms.didimo\\"; # Put your directory path
    $fullPath = $fileDirectory.$fileName;
    Utils::printr (" Save File:  \r\n");
    Utils::printr ("----------\r\n");
    
    file_put_contents(trim($fullPath), $content);
    
    Utils::printr ("File saved on: ".$fullPath."\r\n");
    
    Utils::printr ("****************************************************************************************** \n");
}

?>

