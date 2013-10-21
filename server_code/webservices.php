
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


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// QUERIES //////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['make_query'])) {
    //do make query
    $query = sprintf($_POST['query']);
    
    $result = mysql_query($query, $con) or die(mysql_error());
    
    printResult($result);
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// VIEW CATAGORY TREE ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['get_subordinates'])) {
    $query = sprintf("SELECT node.category_id, node.name, (COUNT(parent.category_id) - (sub_tree.depth + 1)) AS depth
FROM nested_category AS node,
        nested_category AS parent,
        nested_category AS sub_parent,
        (
                SELECT node.category_id, (COUNT(parent.category_id) - 1) AS depth
                FROM nested_category AS node,
                        nested_category AS parent
                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                        AND node.category_id = %s
                GROUP BY node.category_id
                ORDER BY node.lft
        )AS sub_tree
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
        AND sub_parent.category_id = sub_tree.category_id
GROUP BY node.category_id
HAVING depth <= 1
ORDER BY node.lft;
", mysql_real_escape_string($_POST['node_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    
    printResult($result);
}
if (isset($_POST['get_tree'])) {
    $query = "SELECT * FROM nested_category ORDER BY category_id;";
    $result = mysql_query($query, $con) or die(mysql_error());
    printResult($result);
}
if (isset($_POST['get_nested_tree'])) {
    $query = sprintf("SELECT (COUNT(parent.name) - 1) AS depth, 
    CONCAT( REPEAT(' ', COUNT(parent.name) - 1), node.name) AS name,
    CONCAT( REPEAT(' ', COUNT(parent.category_id) - 1), node.category_id) AS category_id
FROM nested_category AS node,
        nested_category AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
GROUP BY node.name
ORDER BY node.lft;");
    $result = mysql_query($query, $con) or die(mysql_error());
    
    printNestedResult($result);
}
if(isset($_POST['get_path'])){
	$query = sprintf("SELECT parent.name
FROM nested_category AS node,
        nested_category AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.category_id = %s
ORDER BY node.lft;", 
mysql_real_escape_string($_POST['category_id']));
$result = mysql_query($query, $con) or die(mysql_error());
    
    printNestedResult($result);
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// EDIT CATAGORY TREE ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['add_category'])){
$query = sprintf("CALL AddCategory('%s', %s);", 
	mysql_real_escape_string($_POST['category_name']),
mysql_real_escape_string($_POST['category_id']));
$result = mysql_query($query, $con) or die(mysql_error());
   printResult($result);
}
if(isset($_POST['add_category_leaf'])){
$query = sprintf("CALL AddCategoryToLeaf('%s', %s);", 
	mysql_real_escape_string($_POST['category_name']),
mysql_real_escape_string($_POST['category_id']));
$result = mysql_query($query, $con) or die(mysql_error());
   printResult($result);
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// SCORED REVIEWS ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['make_review'])) {
    $query = sprintf("INSERT INTO scored_review (review_text, score, user_id, category_id) 
		VAlUES('%s', '%s', '%s', '%s')", 
		mysql_real_escape_string($_POST['review_text']), 
		mysql_real_escape_string($_POST['score']), 
		mysql_real_escape_string($_POST['user_id']),
		mysql_real_escape_string($_POST['category_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    printResult($result);
}

if (isset($_POST['get_reviews'])) {
    $query = sprintf("SELECT * FROM scored_review ORDER BY review_id;");
    $result = mysql_query($query, $con) or die(mysql_error());
    printResult($result);
}
if (isset($_POST['get_catagory_reviews'])) {
    $query = sprintf("SELECT * FROM scored_review WHERE category_id=%s ORDER BY score",
    	mysql_real_escape_string($_POST['catagory_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    printResult($result);
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// USERS ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['get_users'])) {
    $query = sprintf("SELECT * FROM users ORDER BY user_id;");
    $result = mysql_query($query, $con) or die(mysql_error());
    printResult($result);
}
if (isset($_POST['insert_user_with_email'])) {
    $query = sprintf("INSERT INTO users (name, email)
		VAlUES('%s', '%s');", 
		mysql_real_escape_string($_POST['name']), 
		mysql_real_escape_string($_POST['email']));
    $result = mysql_query($query, $con) or die(mysql_error());
    printResult($result);
}
if (isset($_POST['insert_user_with_device'])) {
    $query = sprintf("INSERT INTO users (name, device_id)
		VAlUES('%s', '%s');", 
		mysql_real_escape_string($_POST['name']), 
		mysql_real_escape_string($_POST['device_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    printResult($result);
}

if (isset($_POST['get_user_by_email'])) {
    $query = sprintf("SELECT * FROM users WHERE email='%s';",
    	mysql_real_escape_string($_POST['email']));
    $result = mysql_query($query, $con) or die(mysql_error());
    printResult($result);
}
if (isset($_POST['get_user_by_device'])) {
    $query = sprintf("SELECT * FROM users WHERE device_id='%s';",
    	mysql_real_escape_string($_POST['device_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    printResult($result);
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