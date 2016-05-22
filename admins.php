<?php ob_start();

	//auth check
	require_once('auth.php');
	
	//set page title and link header
	$title='Admin';
	require_once('header.php');

  	try{
		//setup an SQL query
		$sql ="SELECT * FROM admin";
		
		//execute the query and store the results in the variable called result
		$cmd=$conn->prepare($sql);
		$cmd->execute();
		$result =$cmd->fetchAll();
	
		//start the table and add the headings BEFORE the loop (only once)
		echo '<div class="container"><h1> Administrators</h1>';
		echo '<table class="table table-striped"><thead>
		<th>Name</th>&nbsp;<th>Username</th>&nbsp;<th>Email</th>&nbsp;<th>Edit</th>&nbsp;<th>Delete</th>
		</thead><tbody>';
		
		//loop through the query result where $result is the dataset & $row is 1 record
		foreach($result as $row){
		
			//display - create a new row and 3 columns for each record
			echo '<tr><td>'.$row['first_name'] .'</td>
				<td>'.$row['username'].'</td>
				<td>'.$row['email'].'</td>
				<td><a href="password.php?user_id='.base64_encode($row['user_id']).'">Edit</a></td>
				<td><a href="delete.php?user_id='.base64_encode($row['user_id']).'"onclick="return confirm(\'Are you sure you want to delete?\');">Delete</a></td></tr>';	
		}
			echo '</tbody></table></div>';
	}
	
	catch (Exception $e) {
		//email the error details
		mail("plbrighto@gmail.com","Error!!",$e);
		header('location:error.php');
	}
	//link footer
	require_once('footer.php');
ob_flush(); 
?>