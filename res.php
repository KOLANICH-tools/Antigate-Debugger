<?
error_reporting(E_ALL);
include_once("../serverdata.inc");
include_once($modulesdir."dBug/dBug.php");

$action=$_REQUEST["action"];
$key=$_REQUEST["key"];
$key=hexdec($key);
$id=$_REQUEST["id"];
$ids=$_REQUEST["ids"];

session_start();
if($action=="clear"){
	session_destroy();
	die("cleared");
}
if(empty($key)||empty($action)||(empty($id)&&empty($ids)) ){
	die("PARAMETER_MISSED");
}
if($key%2)die("ERROR_KEY_DOES_NOT_EXIST");


//new dBug($_SESSION);

function getCaptcha($id,$single=0){
	//print_r($id);
	$id=(int)$id;
	
	if(isset($_SESSION["captchas"][$id])){
	
		if(time()-$_SESSION["captchas"][$id]["timestamp"]>5)return ($single?"OK|":"").$_SESSION["captchas"][$id]["recognized"];
		else return "CAPCHA_NOT_READY";
	}else return "ERROR_NO_SUCH_CAPCHA_ID";
}

$output=array();

switch($action){
	case "get":
		if(isset($ids)){
			$ids=explode(',', $ids);
			//new dBug($ids);
			foreach($ids as $id){
				$output[]=getCaptcha($id);
			}
			echo(implode("|", $output));
		}else{
			echo(getCaptcha($id,1));
			
		}
	break;
}


?>