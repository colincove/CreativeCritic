<html>
<head>
          <link rel='stylesheet' href='style.css' type='text/css' >
      </link>
      <script src='script.js' ></script>
    </head>
    <body class='webservices'>
<?php
$con         = mysql_connect("IAT381ReviewData.db.8574327.hostedresource.com", "IAT381ReviewData", "Drgs4f8sS#");
$db_selected = mysql_select_db('IAT381ReviewData', $con);
require "webservices.php";
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// QUERIES //////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['make_query'])) {

    $result = make_query($con);
    printResult($result);
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// VIEW CATAGORY TREE ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['get_subordinates'])) {
    $result = get_subordinates($con);
    printResult($result);
}
if (isset($_POST['get_tree'])) {
    $result = get_tree($con);
    printResult($result);
}
if (isset($_POST['get_nested_tree'])) {
    $result = get_nested_tree($con);
    
    printNestedResult($result);
}
if(isset($_POST['get_path'])){
$result = get_path($con);
    
    printNestedResult($result);
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// EDIT CATAGORY TREE ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['add_category'])){
$result = add_category($con);
   printResult($result);
}
if(isset($_POST['add_category_leaf'])){
$result = add_category_leaf($con);
   printResult($result);
}
if(isset($_POST['delete_category_leaf'])){
	$result = delete_category_leaf($con);
	printResult($result);
}
if(isset($_POST['delete_category'])){
	$result = delete_category($con);
	printResult($result);
}

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// SCORED REVIEWS ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['make_review'])) {
    $result = make_review($con);
    printResult($result);
}

if (isset($_POST['get_reviews'])) {
    $result = get_reviews($con);
    printResult($result);
}
if (isset($_POST['get_catagory_reviews'])) {
    $result = get_catagory_reviews($con);
    printResult($result);
}
if (isset($_POST['get_avg_score'])) {
    //$result = get_avg_score($con, $_POST['catagory_id']);
    print get_avg_score_int($con, $_POST['catagory_id']);
    //printResult($result);
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// USERS ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['get_users'])) {
    $result = get_users($con);
    printResult($result);
}
if (isset($_POST['insert_user_with_email'])) {
    $result = insert_user_with_email($con);
    printResult($result);
}
if (isset($_POST['insert_user_with_device'])) {
    $result = insert_user_with_device($con);
    printResult($result);
}

if (isset($_POST['get_user_by_email'])) {
    $result = get_user_by_email($con);
    printResult($result);
}
if (isset($_POST['get_user_by_device'])) {
    $result =get_user_by_device($con);
    printResult($result);
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Google /////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['get_google_images'])) {
    $data   = array();
    $data[0]="Halo";
    $data[1] = "5";
    print get_google_images($data);
}
if (isset($_POST['set_google_images'])) {
    printResult(set_google_images($con));
}
if (isset($_POST['clear_google_images'])) {
    printResult(set_google_images($con));
}

if (isset($_POST['has_google_images'])) {
    print  (int) has_google_images($con);
}

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// PRINTING /////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function printResult($result)
{
    if (is_bool($result) == false) {
        if ($nested)
            print("<ul>");
        
        while ($row = mysql_fetch_assoc($result)) {
          printRow($row);
            print "</br>";
        }
        if ($nested)
            print("</ul>");
        print "\r\n";
    }else{
    	print "<h1>Success!</h1> </br>";
    	print $query;
    }
}
//each row should have a 'depth' attribute selected
function printNestedResult($result)
{
    if (is_bool($result) == false) {

            print("<ul>");
        $depth = 0;
        while ($row = mysql_fetch_assoc($result)) {
        	if($depth < $row['depth']){
        		print "<ul>";
        	}
        	if($depth > $row['depth']){
        		print "</ul>";
        	}
        	if($depth==$row['depth']){
				print "<li>";
        	}
        	
            printRow($row);
if($depth==$row['depth']){
				print "</li>";
        	}
            $depth=$row['depth'];
        }
while($depth>0){
	print "</ul>";
	$depth=$depth-1;
}
            print("</ul>");
        print "\r\n";
    }
}
function printRow($row){
     foreach ($row as $cname => $cvalue) {
                print "$cname: ";
                if($cname=='name'){
                    print "<span>";
                }
                print "$cvalue\t";
                 if($cname=='name'){
                    print "</span>";
                }
            }
}
?>

    </body>
</html>