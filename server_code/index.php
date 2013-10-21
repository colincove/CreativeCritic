<html>
   <head>
      <link rel='stylesheet' href='style.css' type='text/css' >
      </link>
      <script src='script.js' ></script>
   </head>
   <body>
     
   	<div class="form_container">
         <h1>Query</h1>
   		<form id='sql' action='webservices.php' method='post'>
   			<input type='submit' name='make_query'></input>
   			<textarea form='sql' name='query'></textarea>
   		</form>
   	</div>
       <div class="form_container">
         <h1>View Catagory Tree</h1>
         <form id='get_tree' action='webservices.php' method='post'>
            <input type='submit' name='get_tree' value='Get Entire Tree'></input>
         </form>
         <form id='get_nested_tree' action='webservices.php' method='post'>
            <input type='submit' name='get_nested_tree' value='Get Nested Tree'></input>
         </form>
        
          <form id='get_subordinates' action='webservices.php' method='post'>
            <input type='submit' name='get_subordinates' value='Get Subordinates'></input>
             <input type='text' name='node_id' value='ID'></input>
         </form>
         <form id='get_path' action='webservices.php' method='post'>
            <input type='submit' name='get_path' value='Get Path'></input>
             <input type='text' name='category_id' value='ID'></input>
         </form>
      </div>
        <div class="form_container">
         <h1>Edit Catagory Tree</h1>
         <form id='add_category' action='webservices.php' method='post'>
            <h3>Add to non-leaf node</h3>
            <input type='submit' name='add_category' value='Add'></input>
            Name:  <input type='text' name='category_name' value='name'></input>
           Insert Into:  <input type='text' name='category_id' value='ID'></input>
         </form>
         <form id='add_category_leaf' action='webservices.php' method='post'>
            <h3>Add to a leaf node</h3>
            <input type='submit' name='add_category_leaf' value='Add'></input>
            Name:  <input type='text' name='category_name' value='name'></input>
           Insert Into:  <input type='text' name='category_id' value='ID'></input>
         </form>
         <form id='delete_category' action='webservices.php' method='post'>
            <h3>Delete non-leaf node</h3>
            <input type='submit' name='delete_category' value='Delete' disabled></input>
           Category ID:  <input type='text' name='category_id' value='ID'></input>
         </form>
         <form id='delete_category_leaf' action='webservices.php' method='post'>
            <h3>Delete a leaf node</h3>
            <input type='submit' name='delete_category_leaf' value='Delete' disabled></input>
            Category ID: <input type='text' name='category_name' value='ID'></input>
         </form>
      </div>
      <div class="form_container">
         <h1>Reviews</h1>
          <form id='get_reviews' action='webservices.php' method='post'>
            <input type='submit' name='get_reviews' value='Get All Reviews'></input>
         </form>
         <form id='get_catagory_reviews' action='webservices.php' method='post'>
            <input type='submit' name='get_catagory_reviews' value='Get Catagory Reviews'></input>
            <input type='text' name='catagory_id' value='ID'></input>
         </form>
          <h3>Insert Review</h3>
         <form id='review' action='webservices.php' method='post'>
            <input type='submit' name='make_review'></input>
            User ID: <input type='text' name='user_id'></input>
            Catagory ID: <input type='text' name='category_id'></input>
            Score: <input type='text' name='score'></input>
            <textarea form='review' name='review_text'></textarea>
         </form>
      </div>
       <div class="form_container">
         <h1>Users</h1>
          <form id='get_users' action='webservices.php' method='post'>
            <input type='submit' name='get_users' value='Get All Users'></input>
         </form>
         <form id='get_user_by_email' action='webservices.php' method='post'>
            <input type='submit' name='get_user_by_email' value='Get User by Email'></input>
            <input type='text' name='email' value='Email'></input>
         </form>
           <form id='get_user_by_device' action='webservices.php' method='post'>
            <input type='submit' name='get_user_by_device' value='Get User by Device'></input>
            <input type='text' name='device_id' value='Device ID'></input>
         </form>
          <h3>Insert Users</h3>
         <form id='insert_user_with_email' action='webservices.php' method='post'>
            <input type='submit' name='insert_user_with_email'></input>
            User Name: <input type='text' name='name'></input>
            Email: <input type='text' name='email'></input>
         </form>
          <form id='insert_user_with_device' action='webservices.php' method='post'>
            <input type='submit' name='insert_user_with_device'></input>
            User Name: <input type='text' name='name'></input>
            Device ID: <input type='text' name='device_id'></input>
         </form>
      </div>
   </body>
</html>