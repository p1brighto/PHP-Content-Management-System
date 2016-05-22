<?php ob_start();
		
	//auth check
	require_once('auth.php');
	
	//check if we have an user ID in the querystring
	if(isset($_GET['user_id'])){
		
		//check the url for an id value and store in a variable
		$user_id=base64_decode($_GET['user_id']);
		
		//connect db
		require_once('db.php');
		
		try{
			//setup the SQL DELETE command
			$sql="DELETE FROM admin WHERE user_id=:user_id";
			
			//execute the deletion
			$cmd=$conn->prepare($sql);
			$cmd->bindParam(':user_id',$user_id,PDO::PARAM_INT);
			$cmd->execute();
			
			//disconnect
			$conn=null;
		}
		catch (Exception $e) {
			//email the error details
			mail("plbrighto@gmail.com","Error!!",$e);
			header('location:error.php');
		}
		//redirect to updated admins page
		header('location:admins.php');
	}
	else if(isset($_GET['page_id'])){
		//check the url for an id value and store in a variable
		$page_id=base64_decode($_GET['page_id']);
		
		//connect db
		require_once('db.php');
		
		try{		
			//setup the SQL DELETE command
			$sql="DELETE FROM page WHERE page_id=:page_id";
			
			//execute the deletion
			$cmd=$conn->prepare($sql);
			$cmd->bindParam(':page_id',$page_id,PDO::PARAM_INT);
			$cmd->execute();
			
			//disconnect
			$conn=null;
		}
		catch (Exception $e) {
			//email the error details
			mail("plbrighto@gmail.com","Error!!",$e);
			header('location:error.php');
		}
		//redirect to updated admins page
		header('location:pages.php');	
	}
	
ob_flush();
?>