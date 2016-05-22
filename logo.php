<?php ob_start();
	
	//auth check
	require_once('auth.php');

	//set tittle and link header
	$title='Logo';
	require_once('header.php');
	?>
		<!--Form to upload logo-->
		<div class="container">
			<h1>Logo</h1></br>
			<form method="post" action="save-upload.php" enctype="multipart/form-data">
				<div class="form-group">
					<label for="logo">Upload Logo(Image should be PNG/JPEG):</label>
					<input type="file" name="logo"/>
				</div>
				<input type="submit" value="Upload"/>
			</form></br>
		</div>
	<?php
 	//link footer
	require_once('footer.php');

ob_flush();
?>