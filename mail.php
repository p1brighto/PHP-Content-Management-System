<?php


 $r = array();

if(isset($_POST['contact_form'])) {


	$to = 'brghto@gmail.com';

	$email = $_POST['email'];

	$name = $_POST['name'];

	if( ! $email || 
		! $name )

	{
		$r[] = array("status" => false, "message" => "Email or Message is missing. Please complete all fields!");		
	}




	if(empty($r)) {

		$message = "Email: " . $email . "<br />";
		$message .= "Name: " . $name . "<br /><br />";
		$message .= "Message: " . $_POST['message'] . "<br />";
		$subject="Website Message from: ".$name;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


		try {

			mail('p1brighto@gmail.com', $subject, $message, $headers);

			$r[] = array("status" => true, "message" => "Thanks for cotacting. I will contact you soon!");

		} catch(Exception $e) {

			$r[] = array("status" => false, "message" => $e->getMessage());
		}

	} // no validation errors
	
	
	echo json_encode($r);


}  // EO if POST


