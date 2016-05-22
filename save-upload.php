<?php ob_start();?>
<!DOCTYPE>
<html>

	<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>File Uploaded</title>
	</head>
	
	<body>
		<?php
			//get the file name
			$name=$_FILES['logo']['name'];
			
			//checks whether the image uploaded or not
			if($name){
			
				//check type
				$type=$_FILES['logo']['type'];
				if($type=="image/jpeg" || $type=="image/png"){
		
					//get the temporary location
					$tmp_name=$_FILES['logo']['tmp_name'];
								
					//move to the "uploads" directory
					move_uploaded_file($tmp_name,"uploads/logo.jpeg");
					
					//connect to db
					require('db.php');
					
					try{					
						//setup an SQL query
						$sql ="UPDATE image SET image_id=:name";
						
						//create a command object to fill the parameter vaues
						$cmd = $conn->prepare($sql);
						$cmd->bindParam(':name',$name,PDO::PARAM_STR,100);
						
						//execute the query 
						$cmd->execute();
		
						//disconnect
						$conn=null;
					}
					catch (exception $e) {
							//email the error details
							mail("plbrighto@gmail.com","Error!!",$e);
							header('location:error.php');
					}
					
					//user is redirected to admin page
					header('location:admins.php');
					}
					
				else{
					echo 'Invalid file type';
				}
			}
			else{
				echo 'No image selected';
			}
		?>
	</body>

</html>
<?php ob_flush();?> 