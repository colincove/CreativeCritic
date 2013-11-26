<html>
   <head>
      <link rel='stylesheet' href='style.css' type='text/css' >
      </link>
      <script src='script.js' ></script>
   </head>
   <body>
     
   	<div class="form_container">
         <h1>Query</h1>
   		<form id='sql' action='developer_services.php' method='post'>
   			<input type='submit' name='make_query'></input>
   			<textarea form='sql' name='query'></textarea>
   		</form>
   	</div>
       <div class="form_container">
         <h1>View Catagory Tree</h1>
         <form id='get_tree' action='developer_services.php' method='post'>
            <input type='submit' name='get_tree' value='Get Entire Tree'></input>
         </form>
         <form id='get_nested_tree' action='developer_services.php' method='post'>
            <input type='submit' name='get_nested_tree' value='Get Nested Tree'></input>
         </form>
        
          <form id='get_subordinates' action='developer_services.php' method='post'>
            <input type='submit' name='get_subordinates' value='Get Subordinates'></input>
             <input type='text' name='category_id' value='ID'></input>
         </form>
         <form id='get_path' action='developer_services.php' method='post'>
            <input type='submit' name='get_path' value='Get Path'></input>
             <input type='text' name='category_id' value='ID'></input>
         </form>
		 <div class="form_seperator"></div>
		 <h2>App API</h2>
		 <form id='get_subordinates' action='mobile_services.php' method='post'>
            <input type='submit' name='get_subordinates' value='Get Subordinates'></input>
             <input type='text' name='category_id' value='ID'></input>
			 <input type="hidden" name="action" value="get_subordinates"></input>
         </form>
		 <form id='get_path' action='mobile_services.php' method='post'>
            <input type='submit' name='get_path' value='Get Path'></input>
             <input type='text' name='category_id' value='ID'></input>
			 <input type="hidden" name="action" value="get_path"></input>
         </form>
      </div>
        <div class="form_container">
         <h1>Edit Catagory Tree</h1>
         <form id='add_category' action='developer_services.php' method='post'>
            <h3>Add to non-leaf node</h3>
            <input type='submit' name='add_category' value='Add'></input>
            Name:  <input type='text' name='category_name' value='name'></input>
           Insert Into:  <input type='text' name='category_id' value='ID'></input>
         </form>
         <form id='add_category_leaf' action='developer_services.php' method='post'>
            <h3>Add to a leaf node</h3>
            <input type='submit' name='add_category_leaf' value='Add'></input>
            Name:  <input type='text' name='category_name' value='name'></input>
           Insert Into:  <input type='text' name='category_id' value='ID'></input>
         </form>
         <form id='delete_category' action='developer_services.php' method='post'>
            <h3>Delete non-leaf node</h3>
            <input type='submit' name='delete_category' value='Delete'></input>
           Category ID:  <input type='text' name='category_id' value='ID'></input>
         </form>
         <form id='delete_category_leaf' action='developer_services.php' method='post'>
            <h3>Delete a leaf node</h3>
            <input type='submit' name='delete_category_leaf' value='Delete'></input>
            Category ID: <input type='text' name='category_id' value='ID'></input>
         </form>

		 
      </div>
      <div class="form_container">
         <h1>Reviews</h1>
          <form id='get_reviews' action='developer_services.php' method='post'>
            <input type='submit' name='get_reviews' value='Get All Reviews'></input>
         </form>
         <form id='get_catagory_reviews' action='developer_services.php' method='post'>
            <input type='submit' name='get_catagory_reviews' value='Get Catagory Reviews'></input>
            <input type='text' name='catagory_id' value='ID'></input>
         </form>
         <form id='get_avg_score' action='developer_services.php' method='post'>
            <input type='submit' name='get_avg_score' value='Get Catagory Avg'></input>
            <input type='text' name='catagory_id' value='ID'></input>
            <input type="hidden" name="action" value="get_avg_score"></input>
         </form>
          <h3>Insert Review</h3>
         <form id='review' action='developer_services.php' method='post'>
            <input type='submit' name='make_review'></input>
            User ID: <input type='text' name='user_id'></input>
            Catagory ID: <input type='text' name='category_id'></input>
            Score: <input type='text' name='score'></input>
            <textarea form='review' name='review_text'></textarea>
         </form>
		 		 <div class="form_seperator"></div>
		 <h2>App API</h2>
		   <form id='get_catagory_reviews' action='mobile_services.php' method='post'>
            <input type='submit' name='get_catagory_reviews' value='Get Catagory Reviews'></input>
            <input type='text' name='catagory_id' value='ID'></input>
			<input type="hidden" name="action" value="get_catagory_reviews"></input>
         </form>
		           <h3>Insert Review</h3>
         <form id='mobile_review' action='mobile_services.php' method='post'>
            <input type='submit' name='make_review'></input>
            User ID: <input type='text' name='user_id'></input>
            Catagory ID: <input type='text' name='category_id'></input>
            Score: <input type='text' name='score'></input>
            <textarea form='mobile_review' name='review_text'></textarea>
			<input type="hidden" name="action" value="make_review"></input>
         </form>
      </div>
       <div class="form_container">
         <h1>Users</h1>
          <form id='get_users' action='developer_services.php' method='post'>
            <input type='submit' name='get_users' value='Get All Users'></input>
         </form>
         <form id='get_user_by_email' action='developer_services.php' method='post'>
            <input type='submit' name='get_user_by_email' value='Get User by Email'></input>
            <input type='text' name='email' value='Email'></input>
         </form>
           <form id='get_user_by_device' action='developer_services.php' method='post'>
            <input type='submit' name='get_user_by_device' value='Get User by Device'></input>
            <input type='text' name='device_id' value='Device ID'></input>
         </form>
          <h3>Insert Users</h3>
         <form id='insert_user_with_email' action='developer_services.php' method='post'>
            <input type='submit' name='insert_user_with_email'></input>
            User Name: <input type='text' name='name'></input>
            Email: <input type='text' name='email'></input>
         </form>
          <form id='insert_user_with_device' action='developer_services.php' method='post'>
            <input type='submit' name='insert_user_with_device'></input>
            User Name: <input type='text' name='name'></input>
            Device ID: <input type='text' name='device_id'></input>
         </form>
         <div class="form_seperator"></div>
     <h2>App API</h2>
     <form id='get_user_by_email' action='mobile_services.php' method='post'>
            <input type='submit' name='get_user_by_email' value='Get User by Email'></input>
            <input type='text' name='email' value='Email'></input>
            <input type="hidden" name="action" value="get_user_by_email"></input>
         </form>
           <form id='get_user_by_device' action='mobile_services.php' method='post'>
            <input type='submit' name='get_user_by_device' value='Get User by Device'></input>
            <input type='text' name='device_id' value='Device ID'></input>
            <input type="hidden" name="action" value="get_user_by_device"></input>
         </form>
<h3>Insert Users</h3>
         <form id='insert_user_with_email' action='mobile_services.php' method='post'>
            <input type='submit' name='insert_user_with_email'></input>
            User Name: <input type='text' name='name'></input>
            Email: <input type='text' name='email'></input>
            <input type="hidden" name="action" value="insert_user_with_email"></input>
         </form>
          <form id='insert_user_with_device' action='mobile_services.php' method='post'>
            <input type='submit' name='insert_user_with_device'></input>
            User Name: <input type='text' name='name'></input>
            Device ID: <input type='text' name='device_id'></input>
            <input type="hidden" name="action" value="insert_user_with_device"></input>
         </form>
      </div>
   </body>
</html>