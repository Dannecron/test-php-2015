<?php
	$db = mysqli_connect($_ENV['db_url'], $_ENV['db_username'], $_ENV['db_password'], "test");
	mysqli_query($db,"SET NAMES 'utf8'");
	mysqli_query($db,"SET CHARACTER SET 'utf8'");
	mysqli_query($db, "SET SESSION collation_connection = 'utf8_general_ci'");
?>
