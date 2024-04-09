<?php

	
	$db_name = 'condominioag';
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'mydb';

	$conn = new PDO("mysql:dbname=" . $db_name . ";charset=utf8mb4;host=" . $db_host, $db_user, $db_pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);