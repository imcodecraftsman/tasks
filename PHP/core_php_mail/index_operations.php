<?php 

if (isset($_POST['submit'])) {
	$Name = htmlspecialchars($_REQUEST['name']);
	$Email = htmlspecialchars($_REQUEST['email']);
	$Posistions = htmlspecialchars($_REQUEST['posistions']);
	$Password = htmlspecialchars($_REQUEST['password']);
	$Gender = htmlspecialchars($_REQUEST['gender']);

	$to      = 'digitechsuraj@gmail.com';
	//$to = "atishjaiwal9@gmail.com";
	$subject = 'New Enquiry From Digital Techsura';
	$headers = 'From: info@techsura.com' . "\r\n" .
	'Reply-To: info@techsura.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	$headers .= "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$message = "<b>Customer Name</b> :- ".$Name."<br>
				<b>Customer Email </b> :- ".$Email."<br>
				<b>Customer Position</b> :- ".$Posistions."<br>
				<b>Customer Password</b> :- ".$Password."<br>
				<b>Customer Gender</b> :- ".$Gender."<br>"; 

	if (mail($to, $subject, $message, $headers)) {
		echo "<script type='text/javascript'>Success</script>";
	}else{
		echo "<script type='text/javascript'>Failed</script>";
	}
}

	
