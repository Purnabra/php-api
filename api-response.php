<?php
$r=parse_url(substr($_SERVER['REQUEST_URI'],1),PHP_URL_PATH);
$array_page=explode('/',$r);
if(count($array_page)<=2):
http_response_code(404);
exit;
else:
list($root_folder,$page,$request_id)=explode('/',$r);	//print_r($r);
endif;

if($page!='api' || count($array_page)>3 )
{

http_response_code(404);
exit;

}

$url='https://randomuser.me/api';//api endpoint url
/*$reponse_headers=array();
$header_callback=function($ch1,$header) use(&$reponse_headers){

$parts=explode(":",$header,2);
if(count($parts)<2){

return strlen($header);

}
$reponse_headers[$parts[0]]=trim($parts[1]);

return strlen($header);
};*/



header('Content-Type: application/json');
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




//echo "hello world";
//print_r($path)


?>