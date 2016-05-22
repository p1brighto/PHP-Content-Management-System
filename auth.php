<?php 
//auth check
session_start();

if(empty($_SESSION['user_id'])){
	//user is not authenticated
	header('location:login.php');
	//stop the page
	exit();
	}
?>
