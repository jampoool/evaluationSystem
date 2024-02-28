<?php
    $server = "127.0.0.1:3306";
    $username = "root";
    $password = "";
    $database = "evaluation_db";

    $con = new mysqli($server,$username,$password,$database);
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
?>
