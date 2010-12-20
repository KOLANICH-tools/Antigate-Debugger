<?
$method=$_REQUEST["method"];
$key=$_REQUEST["key"];
$key=hexdec($key); 
$file=$_FILES["file"];
if(empty($key)||empty($method)||empty($file)){
	die("PARAMETER_MISSED");
}
if($key%2)die("ERROR_KEY_DOES_NOT_EXIST");
session_start();
$id=rand(50, 10024);
$captcha=array();
$captcha["timestamp"]=time();
$captcha["recognized"]=$file['name'];
$_SESSION["captchas"][$id]=$captcha;
echo "OK|$id";
?>