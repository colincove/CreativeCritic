<?php
$con         = mysql_connect("IAT381ReviewData.db.8574327.hostedresource.com", "IAT381ReviewData", "Drgs4f8sS#");
$db_selected = mysql_select_db('IAT381ReviewData', $con);
require "webservices.php";

switch($_POST['action']){
	case 'get_catagory_reviews':
		api_get_catagory_reviews($con);
		break;
	case 'get_subordinates':
		api_get_subordinates($con);
		break;
	case 'get_path':
		api_get_path($con);
		break;
		case 'make_review':
		api_make_review($con);
		break;
	default:
		print '{status:0}';
}
function api_get_subordinates($con){
	$result = get_subordinates($con);
	exportResult($result);
}
function api_get_path($con){
	$result = get_path($con);
	exportResult($result);
}
function api_get_catagory_reviews($con){
	$result = get_catagory_reviews($con);
exportResult($result);
}
function api_make_review($con){
$result = make_review($con);
print '{status:1}';
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
?>