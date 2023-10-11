<?php    
session_start();


// Storing Session
$user_id = $_SESSION['user_id'];


if (!isset($user_id)) 
{	
	echo "<script>window.location.href='login.php';</script>";
	exit;
}

?>


