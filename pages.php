<?php ob_start();
	
	//auth check
	require_once('auth.php');

	//set tittle and link header
	$title='Pages';
	require_once('header.php');

	try{
		//setup an SQL query
		$sql ="SELECT * FROM page";
		
		//execute the query and store the results in the variable called result
		$cmd=$conn->prepare($sql);
		$cmd->execute();
		$result =$cmd->fetchAll();
	
		//start the table and add the headings BEFORE the loop (only once)
		echo '<div class="container"><h1> Pages</h1><p><a href="new-page.php">Add new page</a></p>';
		echo '<table class="table table-striped"><thead>
		<th>Title</th>&nbsp;&nbsp;<th>Edit</th>&nbsp;<th>Delete</th>
		</thead><tbody>';
		
		//loop through the query result where $result is the dataset & $row is 1 record
		foreach($result as $row){
		
			//display - create a new row and 3 columns for each record
			echo '<tr><td>'.$row['title'] .'</td>
				<td><a href="new-page.php?page_id='.base64_encode($row['page_id']).'">Edit</a></td>
				<td><a href="delete.php?page_id='.base64_encode($row['page_id']).'"onclick="return confirm(\'Are you sure you want to delete?\');">Delete</a></td></tr>';	
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