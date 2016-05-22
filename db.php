<?php
	try{
		//connect Database
		$conn=new PDO('mysql:host=sql.computerstudi.es;dbname=gc200303805','gc200303805','En29HbWP');
		//enable pdo debugging
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	
	catch (Exception $e) {
		//email the error details
		mail("plbrighto@gmail.com","Error!!",$e);
		header('location:error.php');
	}
?>
