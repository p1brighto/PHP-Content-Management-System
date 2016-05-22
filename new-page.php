<?php ob_start();
	
	//auth check
	require_once('auth.php');

	//set tittle and link header
	$title='New Page';
	require_once('header.php');
	
	//check if we have an page ID in the querystring
		if(isset($_GET['page_id'])){
			//if we do, store in a variable
			$page_id=base64_decode($_GET['page_id']);
		
			try{			
				//select all the data for the selected subscriber
				$sql ="SELECT * FROM page WHERE page_id=:page_id";
				$cmd=$conn->prepare($sql);
				$cmd->bindParam('page_id',$page_id,PDO::PARAM_INT);
				$cmd->execute();
				$result =$cmd->fetchAll();
					
				//store each value from the database into a variable
				foreach($result as $row){
						$title_page=$row['title'];
						$content=$row['content'];
				}	
			}
			catch(Exception $e) {
				//email the error details
				mail("plbrighto@gmail.com","Error!!",$e);
				header('location:error.php');
			}
	
		}
?>
<!--New page Form, values will be automatically filled if it is for edit-->
	<div class="container">
		<h1>New Page</h1>
		<form method="post" action="save-page.php" class="form-horizontal">
			<div class="form-group">
			    <label for="title" class="col-sm-2">Title:*</label>
			    <input name="title" value="<?php echo $title_page;?>"/> 
			</div>
			<div class="form-group">
			    <label for="content" class="col-sm-2">Content:*</label>
			    <textarea name="content" style="width: 450px; height: 120px"><?php echo $content;?></textarea> 
			</div>
			<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
			<br>
			<input type="submit" value="Save" class="btn btn-primary"/>
		</form>
	</div>

<?php
	//link footer
	require_once('footer.php');

ob_flush();
?>