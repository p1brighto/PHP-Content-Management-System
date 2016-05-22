<?php ob_start();
	
	//acess current session
	session_start();
	
	//remove any variabes from the session
	session_unset();
	
	//kill the session
	session_destroy();
	
	//redirect
	header('location:login.php');
		
ob_flush();
 ?>	
