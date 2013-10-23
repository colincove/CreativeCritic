<?php



//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// QUERIES //////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function make_query($con) {
    //do make query
    $query = sprintf($_POST['query']);
    $result = mysql_query($query, $con) or die(mysql_error());
   return $result;
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// VIEW CATAGORY TREE ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function get_subordinates($con) {
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
    
    return $result;
}
function get_tree($con) {
    $query = "SELECT * FROM nested_category ORDER BY category_id;";
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
function get_nested_tree($con) {
    $query = sprintf("SELECT (COUNT(parent.name) - 1) AS depth, 
    CONCAT( REPEAT(' ', COUNT(parent.name) - 1), node.name) AS name,
    CONCAT( REPEAT(' ', COUNT(parent.category_id) - 1), node.category_id) AS category_id
FROM nested_category AS node,
        nested_category AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
GROUP BY node.name
ORDER BY node.lft;");
    $result = mysql_query($query, $con) or die(mysql_error());
    
    return $result;
}
function get_path($con){
	$query = sprintf("SELECT parent.name
FROM nested_category AS node,
        nested_category AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.category_id = %s
ORDER BY node.lft;", 
mysql_real_escape_string($_POST['category_id']));
$result = mysql_query($query, $con) or die(mysql_error());
    
    return $result;
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// EDIT CATAGORY TREE ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

function add_category($con){
$query = sprintf("CALL AddCategory('%s', %s);", 
	mysql_real_escape_string($_POST['category_name']),
mysql_real_escape_string($_POST['category_id']));
$result = mysql_query($query, $con) or die(mysql_error());
  return $result;
}
function add_category_leaf($con){
$query = sprintf("CALL AddCategoryToLeaf('%s', %s);", 
	mysql_real_escape_string($_POST['category_name']),
mysql_real_escape_string($_POST['category_id']));
$result = mysql_query($query, $con) or die(mysql_error());
   return $result;
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// SCORED REVIEWS ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function make_review($con) {
    $query = sprintf("INSERT INTO scored_review (review_text, score, user_id, category_id) 
		VAlUES('%s', '%s', '%s', '%s')", 
		mysql_real_escape_string($_POST['review_text']), 
		mysql_real_escape_string($_POST['score']), 
		mysql_real_escape_string($_POST['user_id']),
		mysql_real_escape_string($_POST['category_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}

function get_reviews($con) {
    $query = sprintf("SELECT * FROM scored_review ORDER BY review_id;");
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
function get_catagory_reviews($con) {
    $query = sprintf("SELECT * FROM scored_review WHERE category_id=%s ORDER BY score",
    	mysql_real_escape_string($_POST['catagory_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// USERS ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function get_users($con) {
    $query = sprintf("SELECT * FROM users ORDER BY user_id;");
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
function insert_user_with_email($con) {
    $query = sprintf("INSERT INTO users (name, email)
		VAlUES('%s', '%s');", 
		mysql_real_escape_string($_POST['name']), 
		mysql_real_escape_string($_POST['email']));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
function insert_user_with_device($con) {
    $query = sprintf("INSERT INTO users (name, device_id)
		VAlUES('%s', '%s');", 
		mysql_real_escape_string($_POST['name']), 
		mysql_real_escape_string($_POST['device_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
function get_user_by_email($con){
    $query = sprintf("SELECT * FROM users WHERE email='%s';",
    	mysql_real_escape_string($_POST['email']));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
function get_user_by_device($con){
$query = sprintf("SELECT * FROM users WHERE device_id='%s';",
    	mysql_real_escape_string($_POST['device_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
?>