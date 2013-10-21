
<?php
$con=  mysql_connect("IAT381ReviewData.db.8574327.hostedresource.com","IAT381ReviewData","Drgs4f8sS#");
$db_selected=mysql_select_db ('IAT381ReviewData', $con);



if(isset($_POST['make_query'])){
	//do make query
	$query = sprintf($_POST['query']);

	$result=mysql_query($query, $con) or die(mysql_error());

	printResult($result);
}
if(isset(isset($_POST['get_subordinates']))){
	$query=sprintf("SELECT node.category_id, node.name, (COUNT(parent.category_id) - (sub_tree.depth + 1)) AS depth
FROM nested_category AS node,
        nested_category AS parent,
        nested_categorcy AS sub_parent,
        (
                SELECT node.category_id, (COUNT(parent.category_id) - 1) AS depth
                FROM nested_category AS node,
                        nested_category AS parent
                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                        AND node.category_id = 2
                GROUP BY node.category_id
                ORDER BY node.lft
        )AS sub_tree
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
        AND sub_parent.category_id = sub_tree.category_id
GROUP BY node.category_id
HAVING depth <= 1
ORDER BY node.lft;
");
}
function printResult($result){
	if(is_bool($result)==false){


	while($row = mysql_fetch_assoc($result)){
    foreach($row as $cname => $cvalue){
        print "$cname: $cvalue\t";
        
    }
    print "</br>";
}
    print "\r\n";
}
}
/*$query1 =  sprintf("INSERT INTO levelPlaythroughs (user, loadOut, score, photoId,replay,enemiesKilled, accuracy, gearsCollected, level) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
	mysql_real_escape_string($userId),
	mysql_real_escape_string($loadOut),
	mysql_real_escape_string($score),
	mysql_real_escape_string($photoId),
	mysql_real_escape_string($replay),
	mysql_real_escape_string($enemiesKilled),
	mysql_real_escape_string($accuracy),
	mysql_real_escape_string($gearsCollected),
	mysql_real_escape_string($level));*/

CREATE TABLE users
(
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(40) DEFAULT 'ANON',
        device_id VARCHAR(40) UNIQUE,
        email VARCHAR(40) UNIQUE
);
CREATE TABLE scored_review
(
        review_id INT AUTO_INCREMENT PRIMARY KEY,
        review_text TEXT NOT NULL DEFAULT '',
        date_created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        modified TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
        score INT NOT NULL DEFAULT 100,
        user_id INT NOT NULL, 
        category_id INT NOT NULL,
        CONSTRAINT review_owner FOREIGN KEY (user_id)
        REFERENCES users (user_id),
         CONSTRAINT category_ref FOREIGN KEY (category_id)
        REFERENCES nested_category (category_id)
);

?>


