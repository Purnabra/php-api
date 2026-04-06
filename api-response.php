<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: token,auth-verify');




//PRINT_R($_SERVER);
$server=$_SERVER;

$method=$server['REQUEST_METHOD'];

$page='';
$r=parse_url(substr($_SERVER['REQUEST_URI'],1),PHP_URL_PATH);
$array_page=explode('/',$r);

if($method=='POST')
{
	if(count($array_page)==1 ):
//list($folder,$page)=explode('/',$r);	//print_r($r);
list($page)=explode('/',$r);	//print_r($r);

else:
http_response_code(404);
exit;
endif;
}
else{
	
	if(count($array_page)==2 ):
//list($folder,$page,$request_id)=explode('/',$r);	//print_r($r);
list($page,$request_id)=explode('/',$r);	//print_r($r);

else:
http_response_code(404);

exit;
endif;
	
	
}


if($page!='api')
{

http_response_code(404);
echo json_encode(array('status'=>false,'msg'=>'Wrong Resource Folder'));
exit;
}





if($method=='OPTIONS')
{
echo json_encode(['status'=>'pending','msg'=>'checking']);
exit;



}






if(!array_key_exists('HTTP_TOKEN',$server) || !array_key_exists('HTTP_AUTH_VERIFY',$server) ):
echo json_encode(['status'=>false,'msg'=>'Header is missing!!']);
exit;
endif;


if($server['HTTP_TOKEN']!='token_12'):

echo $server['HTTP_TOKEN'];
echo json_encode(['status'=>false,'msg'=>'Token key doesn\'t match!!']);
exit;
endif;


if($server['HTTP_AUTH_VERIFY']!='POP12RTY'):
echo json_encode(['status'=>false,'msg'=>'Verification key doesn\'t match!!']);
exit;
endif;

$conn=mysqli_connect('phpdatabase.c5a20awowuym.ap-south-1.rds.amazonaws.com','william_database','william_$1234','phpapi') or die('connection failed!!');
// for add the data
if($method=='POST'){

if(empty($_POST)){

echo json_encode(['status'=>false,'msg'=>'Fields are empty!!']);

exit;

}	



$username='PP'.rand(000000,999999);
$email=mysqli_real_escape_string($conn,trim($_POST['email']) ?? '');
$password=mysqli_real_escape_string($conn,trim($_POST['password']) ?? '');
$name=mysqli_real_escape_string($conn,trim($_POST['name']) ?? '');
$date=date('Y-m-d');


$sql="INSERT INTO `pp_call_api`(`username`,`name`,`email`,`password`,`date`) VALUES('".$username."','".$name."','".$email."','".$password."','".$date."')";
	
if(mysqli_query($conn,$sql)){
echo json_encode(['status'=>'Success','msg'=>'Successfully Inserted Into Database!!']);
exit;	
	
	
}
//$username=


}
elseif($method=='PUT'){
$arr=json_decode(file_get_contents('php://input'),true);	
//print_r($arr);
if(empty($arr))
{
echo json_encode(['status'=>false,'msg'=>'Fields are empty!!']);
exit;	
}
$email=$arr['email'] ?? '';
$name=$arr['name'] ?? '';
$password=$arr['password'] ?? '';
if($email=='' || $name=='' ||  $password==''){
echo json_encode(['status'=>false,'msg'=>'All Fields are Mandatory!!']);
exit;	
}
$sql="SELECT * FROM `pp_call_api` WHERE `id`='".$request_id."'";
$res=mysqli_query($conn,$sql);
$numrows=mysqli_num_rows($res);
if($numrows>0)
{
$sqlm="UPDATE `pp_call_api` SET `name`='".$email."',`email`='".$name."',`password`='".$password."' WHERE `id`='".mysqli_real_escape_string($conn,trim($request_id))."'";
$resm=mysqli_query($conn,$sqlm);
if($resm){
echo json_encode(['status'=>true,'msg'=>'Data Updated Successfully!!']);
}
}
else{
echo json_encode(['status'=>false,'msg'=>'No data Found To Update!!']);	
}
}
elseif($method=='GET'){
$sql="SELECT `username`,`name`,`email`,`date`,`password` FROM `pp_call_api` WHERE `id`='".$request_id."'";	
$res=mysqli_query($conn,$sql);
$num=mysqli_num_rows($res);
if($num>0){

	$fetch=mysqli_fetch_assoc($res);
	echo json_encode(['status'=>true,'data'=>$fetch]);
	
}
else{
	
	echo json_encode(['status'=>true,'msg'=>'No data Found!!']);
}


	
	
}





//echo json_encode(array('status'=>true,'msg'=>'success'));
















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