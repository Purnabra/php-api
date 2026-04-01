<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: token');




$page='';
$r=parse_url(substr($_SERVER['REQUEST_URI'],1),PHP_URL_PATH);
$array_page=explode('/',$r);
print_r($array_page);
if(count($array_page)==3 ):
list($folder,$page,$request_id)=explode('/',$r);	//print_r($r);
else:
//echo "hello world";
http_response_code(404);
exit;
endif;


if($page!='api')
{
	
http_response_code(404);
echo json_encode(array('status'=>false,'msg'=>'Wrong Resource Folder'));
exit;
}




$server=$_SERVER;

$method=$server['REQUEST_METHOD'];
if($method=='OPTIONS')
{
	echo json_encode(['status'=>'pending','msg'=>'checking']);
	exit;
	
	
	
}




if($method!='GET')
{
	http_response_code(404);
	echo json_encode(array('status'=>false,'msg'=>'Invalid Request Method!!'));

	exit;
	
	
	
	
}



echo json_encode(array('status'=>true,'msg'=>'success'));
















/*
error_reporting(-1);
mysqli_connect('phpdatabase.c5a20awowuym.ap-south-1.rds.amazonaws.com','william_database','william_$1234','phpapi') or die('disconnected');

echo "hello world";
echo file_get_contents('https://api.ipify.org/');

//print_r($_SERVER);

/*
$page='';
$r=parse_url(substr($_SERVER['REQUEST_URI'],1),PHP_URL_PATH);
$array_page=explode('/',$r);


//print_r($array_page);
if(count($array_page)==2):
list($page,$request_id)=explode('/',$r);	//print_r($r);
exit;
else:
//echo "hello world";
http_response_code(404);
exit;
endif;


if($page!='api')
{
	
http_response_code(404);
exit;
}


//echo "hello world";
$url='https://randomuser.me/api';//api endpoint url
/*$reponse_headers=array();
$header_callback=function($ch1,$header) use(&$reponse_headers){

$parts=explode(":",$header,2);
if(count($parts)<2){

return strlen($header);

}
$reponse_headers[$parts[0]]=trim($parts[1]);

return strlen($header);
};



*/
/*
//header('Content-Type: application/json');
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
*/

?>