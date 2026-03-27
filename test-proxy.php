<?php

$url='https://sangharileuk.ct.ws';//api endpoint url
$ch=curl_init();
curl_setopt_array($ch,[
CURLOPT_URL=>$url,
CURLOPT_RETURNTRANSFER=>TRUE,
CURLOPT_FOLLOWLOCATION=>TRUE,
CURLOPT_SSL_VERIFYPEER=>FALSE,
//CURLOPT_HEADERFUNCTION=>$header_callback

CURLOPT_HEADER=>false
]);

$result=curl_exec($ch);
echo $result;


curl_close($ch);
?>
