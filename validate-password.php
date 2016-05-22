<?php ob_start();?>
	<!DOCTYPE >
	<html>
		
		<head>
			<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
			<title>Validating.....</title>
		</head>
		
		<body>
			<?php
				//store into input variables
				$user_id= $_POST['user_id'];
				$password=$_POST['password'];
				
				if($password)
				{
					//connect to db using our credentials
					require_once('db.php');
						
						//hash the password
						$password=hash('sha512',$password);
						
						//set up and execute an SQL command 
						$sql="SELECT user_id FROM admin WHERE password=:password AND user_id=:user_id";
						
						//create a command object to fill the parameter vaues
						$cmd = $conn->prepare($sql);	
						$cmd->bindParam(':password',$password,PDO::PARAM_STR, 128);
						$cmd->bindParam(':user_id',$user_id,PDO::PARAM_INT);
						
						//execute command and save values to a varriable
						$cmd->execute();
						$result= $cmd->fetchAll();
						
						if (count($result) > 0) {
							//redirect to register page to edit
							header('location:register.php?user_id='.base64_encode($user_id).'');
						}				
						else{			
						echo 'Password didn\'t match';
						}
					//disconnect db
					$conn=null;
				}
				else
				{
					echo 'Enter the password';
				}
			
			?>
			</body>
	</html>
<?php 
ob_flush();
?>
