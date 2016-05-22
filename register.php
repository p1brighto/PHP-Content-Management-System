<?php ob_start();

	try{
		//check if we have an user ID in the querystring
		if(isset($_GET['user_id'])){
	
		//auth check
		require_once('auth.php');

		//set tittle and  link header of public website
			$title='Register';
			require_once('header.php');
		
			//if we do, store in a variable
			$user_id=base64_decode($_GET['user_id']);
		
					
			//select all the data for the selected subscriber
			$sql ="SELECT * FROM admin WHERE user_id=:user_id";
			$cmd=$conn->prepare($sql);
			$cmd->bindParam('user_id',$user_id,PDO::PARAM_INT);
			$cmd->execute();
			$result =$cmd->fetchAll();
				
			//store each value from the database into a variable
			foreach($result as $row){
				$first_name=$row['first_name'];
				$last_name=$row['last_name'];
				$phone=$row['phone'];
				$email=$row['email'];
				$username=$row['username'];
			}
		}
		else{
			//set tittle and  link header of control panel
			$title='Register';
			require_once('home-header.php');
		}	
	}
	catch(Exception $e) {
		//email the error details
		mail("plbrighto@gmail.com","Error!!",$e);
		header('location:error.php');
	}
?>
	<!--Registeration Form, values will be automatically filled if it is for edit-->
	<div class="container">
		<?php 
			if($user_id){
				echo '<h1>Edit your profile</h1></br>';
			}
			else{
				echo '<h1>User Registration</h1></br>';
			}
		?>
		<form method="post" action="save-registration.php" class="form-horizontal">
			<div class="form-group">
			    <label for="first_name" class="col-sm-2">First Name:*</label>
			    <input name="first_name" value="<?php echo $first_name;?>"/> 
			</div>
			<div class="form-group">
			    <label for="last_name" class="col-sm-2">Last Name:*</label>
			    <input name="last_name" value="<?php echo $last_name;?>"/> 
			</div>
			<div class="form-group">
			    <label for="phone" class="col-sm-2">Primary Phone:*</label>
			    <input name="phone" type="tel" value="<?php echo $phone;?>"/> 
			</div>
			<div class="form-group">
			    <label for="email" class="col-sm-2">Email:*</label>
			    <input name="email" type="email" value="<?php echo $email;?>"/> 
			</div>

			<div class="form-group">
			    <label for="username" class="col-sm-2">Username:* </label>
			    <input name="username" value="<?php echo $username;?>"/> 
			</div>
			<?php
				if($user_id){
					echo '<div class="form-group">
						    <p style=margin-left:20px;>You can input your old or new password</p>
						  </div> ';
				}
			?>
			<div class="form-group">
				<p style=margin-left:20px>(Password should be of minimum  8 characters)</p> 
			    <label for="password" class="col-sm-2">Password:*</label>
			    <input type="password" name="password" />
			</div>
			<div class="form-group">
			    <label for="confirm" class="col-sm-2">Confirm Password:*</label>
			    <input type="password" name="confirm" /> 
			</div>
			<input type="hidden" name="user_id" value="<?php echo $user_id;?>" />
				<br>
			<input type="submit" value="Save" class="btn btn-primary"/>
		</form></br>
	</div>
	
<?php
//link footer 
require_once('footer.php');
ob_flush(); 
?>