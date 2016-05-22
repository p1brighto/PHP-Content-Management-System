<?php ob_start();
	
	//avoid loading of login page again
	session_start();
	
	if($_SESSION['user_id']){
		//user is not reddirected to admin page
		header('location:admins.php');
		//stop the page
		exit();
		}

	//set tittle and link header
	$title='Log In';
	require_once('home-header.php');
?>
	
	<!--login form-->
	<div class="container">
		<h1>Log in</h1>
		<form method="post" action="validate_login.php" class="form-horizontal">
			<div class="form-group">
			    <label for="username" class="col-sm-2">Username:</label>
			    <input name="username" />
			</div>
			<div class="form-group">
			    <label for="password" class="col-sm-2">Password:</label>
			    <input type="password" name="password" />
			</div>
			<div class="col-sm-offset-2">
			    <input type="submit" value="Login" class="btn btn-primary" />
			</div>
		</form>
	</div></br>
	
<?php 
	//link footer
	require_once('footer.php');
ob_flush(); 
?>