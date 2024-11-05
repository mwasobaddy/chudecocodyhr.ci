<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>

<body>
<?php

 //$mobileNumber = $request->mobile;
 
 $mobileNumber = "+2250576197777";
 
    $OTP = random_int(100000, 999999);
 /*  $pcode = bcrypt($OTP);
  $opttime=  Carbon::now()->addMinutes('15');
$user->update(['password' => $pcode,'user_otp' => $OTP ,'expires_on' => $opttime]);
*/
$API_KEY = '3909AWt7Uff865d8b0ec1';
$SENDER_ID = "PRHCHU";
$ROUTE_NO = 4;
$RESPONSE_TYPE = 'json';
$isError = 0;
$errorMessage = true;
//Your message to send, Adding URL encoding.
$message = urlencode("RH-CHUCocody. Votre OTP est : $OTP. Ce code est valide pour 15 minutes. Veuillez le saisir avant son expiration pour accéder au portail.");
        //Preparing post parameters
$postData = array(
            'authkey' => $API_KEY,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $SENDER_ID,
            'route' => $ROUTE_NO,
            'response' => $RESPONSE_TYPE
        );
$url = "http://world.msg91.com/api/sendhttp.php";

$ch = curl_init();
 //Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      //get response
$output = curl_exec($ch);
//return $output;   
        //Print error if any
if (curl_errno($ch)) {
$isError = true;
$errorMessage = curl_error($ch);
        }
curl_close($ch);


echo 'Votre code OTP a été envoyé sur votre cellulaire, veuillez le saisir pour accéder au portail RH.';

 
 




?>
</body>
</html>