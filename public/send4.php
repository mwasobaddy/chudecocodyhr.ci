<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"flow_id\":\"2021\",\"sender\":\"PRHCHU\",\"mobiles\":\"2250506124644\",\"VAR1\":\"VALUE1\",\"VAR2\":\"VALUE2\"}",
  CURLOPT_HTTPHEADER => array(
    "authkey: 3909AWt7Uff865d8b0ec1",
    "content-type: application/JSON"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}