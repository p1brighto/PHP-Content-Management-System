<?php ob_start();
	
	//set page title and link header
	$title='Home';
	require_once('home-header.php');
	
	//check if we have an page ID in the querystring
	if(isset($_GET['page_id'])){
	
		//store into input variables				
		$page_id=$_GET['page_id'];
		
		try{
			$sql="SELECT * FROM page WHERE page_id=:page_id";
			
			//create a command object to fill the parameter vaues and execute command
			$cmd=$conn->prepare($sql);
			$cmd->bindParam('page_id',$page_id,PDO::PARAM_INT);
			$cmd->execute();
			$result=$cmd->fetchAll();
		
			//loop through the query result 
			foreach($result as $row){
				
				//display the values
				echo '<div class="container"><h1>'.$row['title'].'</h1>
					  <p>'.$row['content'].'</p></div>';
			}
		}
		catch (Exception $e) {
			//email the error details
			mail("plbrighto@gmail.com","Error!!",$e);
			header('location:error.php');
		}		
	}
	else
	{ ?>
		<div class="container" style="min-height: 200px; padding-top:70px; padding-bottom:70px">
			<div class="row">
				<div class="col-md-7 col-md-offset-2" style="text-align: center;">
					<h1 style="font-family: georgia; font-weight: bold; color: #1E98AF; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #DDD;">Welcome to Web site Creater</h1>
					<p>This is a custom content mangement system I created on PHP</p>
					<p>You need to be registered to create pages,modify pages, delete pages, manage admins, upload Logo and so on....</p>
					<p>You can Register by clicking <a href="register.php"> here</a>.</p>
				</div>
			</div>
		</div>
	<?php
	}
	//link footer
	require_once('footer.php');
ob_flush(); 
?>
