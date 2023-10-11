<?php
date_default_timezone_set('Asia/Kolkata');

$db["db_host"] = "localhost";
$db["db_user"] = "root";
$db["db_password"] = "";
$db["db_database"] = "innovins_task";


 foreach ($db as $key => $value) {
        
     define(strtoupper($key), $value);
        
 }

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);

if (!$conn) {
 echo "Database is not Connected";
}

?>