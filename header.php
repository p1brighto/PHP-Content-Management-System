<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<title><?php echo $title; ?></title>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		
	</head>
		<body>
			<nav>
			<?php
				//connect to db
					require_once('db.php');
				//if the user is authenticated,show the navigation links
				session_start();
				if($_SESSION['user_id']){
					?>
					<ul class="nav nav-tabs">
						<li><a class="brand" href="index.php"><img src="uploads/logo.jpeg" title="Logo" width="100" height="60" alt="Logo"></a></li>
						<li><a href="admins.php">Admin</a></li>
						<li><a href="pages.php">Pages</a></li>
						<li><a href="logo.php">Logo</a></li>
						<li><a href="index.php" target="_blank">Public Website</a></li>
						<li><a href="logout.php">Log Out</a></li>						
					<?php
				}
				
					?>
				</ul>
			</nav>
	
	

