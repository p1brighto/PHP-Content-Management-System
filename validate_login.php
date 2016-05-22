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
				$username = $_POST['username'];
		        $password = hash('sha512', $_POST['password']);
		        
		        //connect db
				require_once('db.php');
				
				try{
					//query
					$sql = "SELECT user_id FROM admin WHERE username = :username AND password = :password";
					//execute 
					$cmd = $conn->prepare($sql);
					$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
					$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
					$cmd->execute();
					$result = $cmd->fetchAll();
					
					//check how many users matched the username hashed password
					if (count($result) >= 1) {
					
						//store the user identity before they leave this page
						foreach  ($result as $row) {
							//access the existing session
							session_start();
							
							//store the user_id in the sessin object
							$_SESSION['user_id']=$row['user_id'];
							
							//load the admins page
							header('location:admins.php');
						}
					}
					else {
						echo 'Invalid Login';
					}
					
					//disconnect db	
					$conn = null;
				}
				catch (Exception $e) {
					//email the error details
					mail("plbrighto@gmail.com","Error!!",$e);
					header('location:error.php');
				}
			?>
		</body>
	</html>
<?php 
ob_flush();
?>
