<?php
	session_start();
	if (!empty($_SESSION['id'])){
		unset($_SESSION['id']);
		unset($_SESSION['login']);
	}
	echo "Выход произведен. Перейдите на <a href='/index.php'>Главную страницу</a>";
?>
