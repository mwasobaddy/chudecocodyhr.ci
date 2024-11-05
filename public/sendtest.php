<?php


//Your authentication key
$authKey = "3909AWt7Uff865d8b0ec1";

//Multiple mobiles numbers separated by comma
//$mobileNumber = "2250506124644";
//$mobileNumber = "2250758108076";

$mobileNumber = "2250103799030";

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "PRHCHU";

//Your message to send, Add URL encoding here.
$message = urlencode("Test message");

//Define route 
$route = 4;
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="http://api.msg91.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}

curl_close($ch);

echo $output;
?>


