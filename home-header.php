<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title><?php $title;?></title>	
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">		
	</head>
	
	<body>
		<!-- Facbok plugin code -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<nav>
			<?php
				try{
					//connect to db
					require_once('db.php');
						
					//get the pages
					$sql ="SELECT * FROM page";
					
					//execute the query and store the results in the variable called result
					$cmd=$conn->prepare($sql);
					$cmd->execute();
					$pages= $cmd->fetchAll();
				}
				catch (Exception $e) {
					//email the error details
					mail("plbrighto@gmail.com","Error!!",$e);
					header('location:error.php');
				}				
				//if the user is authenticated,show the navigation links
				session_start();
				if($_SESSION['user_id']){
			?>
				<ul class="nav nav-tabs">
						
						<li><a class="brand" href="default.php"><img src="uploads/logo.jpeg" title="Logo" width="100" height="60" alt="Logo"></a></li>
						<?php
							foreach($pages as $row){
								echo '<li><a href="default.php?page_id='.$row['page_id'].'">'.$row['title'].'</a></li>';
							}
						?>
						<li><a href="admins.php">Control Panel</a></li>
					<?php
				}
				
				//if the user is not authenticated,show the navigation links
				else{
					?>
					<ul class="nav nav-tabs">
						<?php
							echo '<li><a class="brand" href="default.php"><img src="uploads/logo.jpeg" title="Logo" width="100" height="60"></a></li>';
							foreach($pages as $row){
								echo '<li><a href="default.php?page_id='.$row['page_id'].'">'.$row['title'].'</a></li>';
							}
						?>
						<li><a href="register.php">Register</a></li>
						<li><a href="login.php">Log In</a></li>	
						<li><a href="feedback.php">Feedback</a></li>													
						<?php
					}
						?>
				</ul>
		</nav>			
	