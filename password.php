<?php ob_start();
	
	//auth check
	require_once('auth.php');

	//set tittle and link header
	$title='Password';
	require_once('header.php');

	//store into input variables
	$user_id= base64_decode($_GET['user_id']);
	
	//check the current password of the admin, that need to be edited
	?>
	<br/><div class="container">
		<form  method="post" action="validate-password.php"> 
			<div class="form-group">
			    <label for="password" class="col-sm-2">Current Password:</label>
			    <input name="password" type="password"> 
			</div>
			<input type="hidden" name="user_id" value="<?php echo $user_id;?>" />	
			<div class="col-sm-offset-2">		
				<input type="submit" value="Submit" class="btn btn-primary"/>
			</div>
		</form>
	</div></br>
	<?php
 	//link footer
	require_once('footer.php');

ob_flush();
?>