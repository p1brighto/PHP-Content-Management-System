<?php ob_start();

	//set tittle and link header
	$title='Error';
	require_once('header.php');?>
	
	<div class="well">
		<h1>Oooops.........</h1>
		<p>Something went wrong. Don't worry we will make it soon</p>
	</div>
	
<?php
	//link footer		
	 require_once('footer.php');
ob_flush();
?>