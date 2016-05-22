<?php  ob_start();?>
	<!DOCTYPE >
	<html>
		<head>
			<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
			<title>Saving.....</title>
		</head>
		
		<body>
			<?php
				
				//store into input variables
				$first_name	= $_POST['first_name'];
				$last_name 	= $_POST['last_name'];				
				$phone 		= $_POST['phone'];
				$email 		= $_POST['email'];				
				$username 	= $_POST['username'];				
				$password 	= $_POST['password'];				
				$confirm 	= $_POST['confirm'];				
				$user_id 	= $_POST['user_id'];				
				$ok=true;
				
				//connect to db using our credentials
				require_once('db.php');
			
				//input validation, checks whether the values are given or not
				if(empty($first_name)){
					echo 'First Name is required<br/>';
					$ok=false;
				}
				if(empty($last_name)){
					echo 'Last Name is required<br/>';
					$ok=false;
				}
				if(empty($phone)){
					echo 'Phone Number is required<br/>';
					$ok=false;
				}
				
				if(empty($email)){
					echo 'Email is required<br/>';
					$ok=false;
				}
				
				try{
					//checks the duplication of email
					if($email){
					
						//checks the duplication of email in new registeration
						if(empty($user_id)){
							$email_sql="SELECT user_id FROM admin WHERE email=:email";
							$cmd = $conn->prepare($email_sql);	
							$cmd->bindParam(':email',$email,PDO::PARAM_STR, 50);
							$cmd->execute();
							$result_email = $cmd->fetchAll();
							if (count($result_email) > 0) {
								$ok=false;
								echo 'Email that you are trying to use is already Registered.</br>';
							}
						}
						
						//checks the duplication of email in edit
						else{
							$email_sql="SELECT user_id FROM admin WHERE email=:email AND user_id!=:user_id";
							$cmd = $conn->prepare($email_sql);	
							$cmd->bindParam(':email',$email,PDO::PARAM_STR, 50);
							$cmd->bindParam(':user_id',$user_id,PDO::PARAM_INT);
							$cmd->execute();
							$result_email = $cmd->fetchAll();
							if (count($result_email) > 0) {
								$ok=false;
								echo 'Email that you are trying to use is already Registered.</br>';
							}
						}	
					}
				}
				catch (exception $e) {
					//email the error details
					mail("plbrighto@gmail.com","Error!!",$e);
					header('location:error.php');
				}
				if(empty($username)){
						echo 'User name is required<br/>';
						$ok=false;
				}
				try{
					//checks the duplication of username
					if($username){
						
						//checks the duplication of username in new registeration
						if(empty($user_id) ){
							$user_sql="SELECT user_id FROM admin WHERE username=:username";
							$cmd = $conn->prepare($user_sql);	
							$cmd->bindParam(':username',$username,PDO::PARAM_STR, 50);
							$cmd->execute();
							$result_user = $cmd->fetchAll();
							if (count($result_user) > 0) {
								$ok=false;
								echo 'Username that you are trying to use is already Registered.</br>';
							}
						}
						
						//checks the duplication of username in edit
						else{
							$user_sql="SELECT user_id FROM admin WHERE username=:username AND user_id!=:user_id";
							$cmd = $conn->prepare($user_sql);	
							$cmd->bindParam(':username',$username,PDO::PARAM_STR, 50);
							$cmd->bindParam(':user_id',$user_id,PDO::PARAM_INT);
							$cmd->execute();
							$result_user = $cmd->fetchAll();
							if (count($result_user) > 0) {
								$ok=false;
								echo 'Username that you are trying to use is already Registered.</br>';
							}
						}

					}
				}
				catch (exception $e) {
					//email the error details
					mail("plbrighto@gmail.com","Error!!",$e);
					header('location:error.php');
				}	
				
				if(empty($password)){
					echo 'Password is required<br/>';
					$ok=false;
				}
				else{
					//checks length of paswword whether its more than 8 or not
					if(strlen($password)<8){
						echo 'Password must be minimum of 8 characters<br/>';
						$ok=false;
					}
					//checks it equal to confim
					else if($confirm != $password){
							echo 'Password must match<br/>';
							$ok=false;						
					}
				}
					
				//if the validation is successful		
				if($ok){
							
					//hash the password
					$password=hash('sha512',$password);
					
					try{
						//set up and execute an SQL INSERT command or update command
						if($user_id){
							$sql="UPDATE admin SET first_name=:first_name,last_name=:last_name,phone=:phone,email=:email,username=:username,password=:password WHERE user_id=:user_id";
						}
						else{
							$sql="INSERT INTO admin(first_name,last_name,phone,email,username,password) VALUES(:first_name,:last_name,:phone,:email,:username,:password)";
						}
						
						//create a command object to fill the parameter vaues
						$cmd = $conn->prepare($sql);
						$cmd->bindParam(':first_name',$first_name,PDO::PARAM_STR,50);
						$cmd->bindParam(':last_name',$last_name,PDO::PARAM_STR,50);
						$cmd->bindParam(':phone',$phone,PDO::PARAM_STR,15);
						$cmd->bindParam(':email',$email,PDO::PARAM_STR,50);
						$cmd->bindParam(':username',$username,PDO::PARAM_STR,50);
						$cmd->bindParam(':password',$password,PDO::PARAM_STR,128);
						
						//add user_id parameter if we are updating
						if($user_id){
							$cmd->bindParam(':user_id',$user_id,PDO::PARAM_INT);
						}
						//execute command
						$cmd->execute();
					}
					
					catch (exception $e) {
						//email the error details
						mail("plbrighto@gmail.com","Error!!",$e);
						header('location:error.php');
					}
					if(empty($user_id)){
						$subjet = "Confirmation mail";
						 
						$message = "Thank you " . $first_name . " " . $last_name . " for Registering in Web site creater.";
						$message .= "This is a confirmation mail.";
					
						//send a  confirmation mail to the user adress
						mail($email, $subject, $message);
						
						//show a message or give login link
						echo '<p>Thank you for Registering in Web site creater.</p>
							  <p>Please check your mail box for the confirmation mail.</p>
							  <p>Click <a href="login.php">here</a> to log in.</p></div>';
					}
					else{
						//redirect to updated admins page
						header('location:admins.php');
					}
				}
	
				//disconnect db
					$conn=null;
			?>
		</body>
	</html>
<?php 
ob_flush();
?>	