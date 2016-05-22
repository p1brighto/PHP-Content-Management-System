<?php  ob_start();?>
	<!DOCTYPE>
	<html>
	
		<head>
			<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
			<title>Saving.....</title>
		</head>
		
		<body>
			<?php
					
					//store into input variables
					$title= $_POST['title'];
					$content= $_POST['content'];				
					$page_id= $_POST['page_id'];
					$ok=true;
				
					//input validation, checks whether the values are given or not
					if(empty($title)){
						echo 'Title is required<br/>';
						$ok=false;
					}
					if(empty($content)){
						echo 'Content is required<br/>';
						$ok=false;
					}
					
					//if the validation is successful		
					if($ok){
							
							//connect to db using our credentials
							require_once('db.php');

							try{
								//set up and execute an SQL INSERT command or update command
								if($page_id){
									$sql="UPDATE page SET title=:title,content=:content WHERE page_id=:page_id";
								}
								else{
									$sql="INSERT INTO page(title,content) VALUES(:title,:content)";
								}
								
								//create a command object to fill the parameter vaues
								$cmd = $conn->prepare($sql);
								$cmd->bindParam(':title',$title,PDO::PARAM_STR,20);
								$cmd->bindParam(':content',$content,PDO::PARAM_STR,200);
		
								//add page_id parameter if we are updating
								if($page_id){
									$cmd->bindParam(':page_id',$page_id,PDO::PARAM_INT);
								}
								$cmd->execute();							
									
							}
							catch (exception $e) {
								//email the error details
								mail("plbrighto@gmail.com","Error!!",$e);
								header('location:error.php');
							}
								
							//disconnect db
							$conn=null;	
										
							//redirect to pages.php
							header('location:pages.php');
					}
			?>
		
		</body>
	
	</html>
<?php  ob_flush();?>