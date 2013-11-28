<?php
$con         = mysql_connect("IAT381ReviewData.db.8574327.hostedresource.com", "IAT381ReviewData", "Drgs4f8sS#");
$db_selected = mysql_select_db('IAT381ReviewData', $con);
$failResponse = "{status:0}";
$successResponse = "{status:1}";
require "webservices.php";

switch($_POST['action']){
	case 'get_catagory_reviews':
		api_get_catagory_reviews();
		break;
	case 'get_subordinates':
		api_get_subordinates();
		break;
	case 'get_path':
		api_get_path($con);
		break;
		case 'make_review':
		api_make_review();
		break;
	case 'get_user_by_email':
		api_get_user_by_email();
		break;
	case 'insert_user_with_email':
		api_insert_user_with_email();
		break;
	case 'get_user_by_device':
		api_get_user_by_device();
		break;
	case 'insert_user_with_device':
		api_insert_user_with_device();
		break;
	default:
		print $failResponse;
}

function api_get_subordinates(){
	global $con;
	google_images_check();
	$result = get_subordinates($con);
	//exportResult($result);
	exportCategoryResult($result);
}
function api_get_path(){
	global $con;
	$result = get_path($con);
	exportResult($result);
}
function api_get_catagory_reviews(){
	global $con;
	$result = get_catagory_reviews($con);
	exportResult($result);
}
function api_make_review(){
	global $con;
	global $successResponse;
	$result = make_review($con);
	print $successResponse;
}
function api_get_user_by_email(){
	global $failResponse;
	global $con;
	$result=get_user_by_email($con);
	if(mysql_num_rows($result)>0){
		exportResult($result);
	}else{
		//fail if trying to login and non-existing user from an email. 
		//User should insert name and request that the user be created. 
		print $failResponse;
	}
}
function api_insert_user_with_email(){
	global $con;
	global $failResponse;
	$result=insert_user_with_email($con);
	if($result){
		api_get_user_by_email();
	}else{
		print $failResponse;
	}
}
function api_get_user_by_device(){
	global $con;
	$result=get_user_by_device($con);
	if(mysql_num_rows($result)>0){
		exportResult($result);
	}else{
		//auto create a user from the device code and return the result. 
		insert_user_with_device($con);
		api_get_user_by_device($con);
	}
}
function api_insert_user_with_device(){
	global $failResponse;
	global $con;
	$result=insert_user_with_device($con);
	if($result){
		api_get_user_by_device();
	}else{
		print $failResponse;
	}
}
function exportResult($result){
	$export;
	$rows = array();
	while($r = mysql_fetch_assoc($result)) {
   		 $rows[] = $r;
	}
	$export['status']=1;
	$export['data']=$rows;
	print json_encode($export);
}
function exportCategoryResult($result){
	global $con;
	$export;
	$rows = array();
	$paths =array();
	while($r = mysql_fetch_assoc($result)) {
		$r["avg_score"] = get_avg_score_int($con, $r["category_id"]);
		$decoded=json_decode($r["google_images"]);
		$r["google_images"] = $decoded;
   		 $rows[] = $r;
   		 
	}
	$pathResult=get_path($con);
	while($r = mysql_fetch_assoc($pathResult)) {
   		$paths[] = $r;
	}
	$export['status']=1;
	$export['data']=$rows;
	$export['path'] = $paths;

$jsonResult=json_encode($export);
	print str_replace("\/", "/", $jsonResult);
}
function google_images_check(){
	global $con;
	$google_image_query=array();
	if(has_google_images($con)==False){
		$pathResult = get_path($con);
		while($r = mysql_fetch_assoc($pathResult)) {
			$google_image_query[count($google_image_query)]=$r["name"];
		}
		$_POST['google_images_data'] = get_google_images($google_image_query);
		set_google_images($con);
	}
}
?>