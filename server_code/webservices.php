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
    $query = sprintf("SELECT node.category_id, node.lft, node.rgt,node.name,node.avg_score, node.google_images, (COUNT(parent.category_id) - (sub_tree.depth + 1)) AS depth
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
", mysql_real_escape_string($_POST['category_id']));
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
    CONCAT( REPEAT(' ', COUNT(parent.name) - 1), node.avg_score) AS avg_score,
    CONCAT( REPEAT(' ', COUNT(parent.category_id) - 1), node.category_id) AS category_id,
    CONCAT( REPEAT(' ', COUNT(parent.lft) - 1), node.lft) AS lft
FROM nested_category AS node,
        nested_category AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
GROUP BY node.name
ORDER BY node.lft;");
    $result = mysql_query($query, $con) or die(mysql_error());
    
    return $result;
}
function get_path($con){
	$query = sprintf("SELECT parent.name, parent.category_id
FROM nested_category AS node,
        nested_category AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.category_id = %s
ORDER BY parent.lft;", 
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
function delete_category($con){
		$query = sprintf("CALL RemoveCategory(%s);", 
	mysql_real_escape_string($_POST['category_id']));
$result = mysql_query($query, $con) or die(mysql_error());
   return $result;
}
function delete_category_leaf($con){
	$query = sprintf("CALL RemoveCategoryLeaf(%s);", 
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
    update_score($con);
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
function update_score($con){
    $query = sprintf("SELECT AVG(score) FROM scored_review WHERE category_id=%s", 
        mysql_real_escape_string($_POST['category_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    $row = mysql_fetch_assoc($result);
    $query = sprintf("UPDATE nested_category SET avg_score=%s WHERE category_id=%s", 
        mysql_real_escape_string($row["AVG(score)"]), 
         mysql_real_escape_string($_POST['category_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
function get_avg_score_int($con, $category_id)
{
    $result = get_avg_score($con, $category_id);
    $row = mysql_fetch_assoc($result);
    return $row["AVG(node.avg_score)"];
}
function get_avg_score($con, $category_id){
    $query  = sprintf("SELECT AVG(node.avg_score)
FROM nested_category AS node,
        nested_category AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND parent.category_id= %s
AND node.rgt = node.lft+1;",
         mysql_real_escape_string($category_id));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// USERS ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

//SELECT google_images FROM nested_category WHERE category_id = 52

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

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Google /////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
function get_google_images($data){
   $url  = "https://ajax.googleapis.com/ajax/services/search/images?" .
           "v=1.0&q=";
    $first=True;
    foreach ($data as $query){
        if($first){
            $first=false;
         $url = $url.urlencode($query);
        }else{
               $url = $url."%20".urlencode($query);
        }
    }
    $url=$url."&userip=INSERT-USER-IP";
    // sendRequest
    // note how referer is set manually
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, "www.covertstudios.ca");
    $body = curl_exec($ch);
    curl_close($ch);

    // now, process the JSON string
    $json = json_decode($body);
    // now have some fun with the results...
    //var_dump($json);
    return $body;
}
function set_google_images($con){
    $query = sprintf("UPDATE nested_category SET google_images ='%s' WHERE category_id=%s",
        mysql_real_escape_string($_POST['google_images_data']),
        mysql_real_escape_string($_POST['category_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
function clear_google_images($con){
    $query = sprintf("UPDATE nested_category SET google_images ='' WHERE category_id=%s",
        mysql_real_escape_string($_POST['category_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    return $result;
}
function has_google_images($con){
      $query = sprintf("SELECT google_images FROM nested_category WHERE category_id=%s",
        mysql_real_escape_string($_POST['category_id']));
    $result = mysql_query($query, $con) or die(mysql_error());
    $data = mysql_fetch_assoc($result);
    if($data["google_images"]==''){
        return False;
    }else{
        return True;
    }

    return $result;
}

?>