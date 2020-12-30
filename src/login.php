<?php
	session_start();
	function confirmPassword($hash, $password)
	{
		return crypt($password, $hash) === $hash;
	}
	include ("bdcon.php");
	if (isset($_POST['login'])){ 
		$login = $_POST['login']; 
		if ($login==''){
			unset($login);
		} 
	}
	if (isset($_POST['pass'])) {
		$pass = $_POST['pass']; 
		if ($pass==''){
			unset($pass);
		} 
	}
	if (empty($login) or empty($pass)){
		exit ("Заполнены не все поля! Нужно ввести логин и пароль.");
	}
	$login = stripslashes($login);
	$login = htmlspecialchars($login);
	$pass = stripslashes($pass);
	$pass = htmlspecialchars($pass);
	$login = trim($login);
	$pass = trim($pass);
	
	$result = mysqli_query($db, "Select * from users where login='$login'");
	$row = mysqli_fetch_array($result);
	if (empty($row['pass'])){
		exit ("Неверно введены логин или пароль.");
	}
	else{
		if (confirmPassword($row['pass'],$pass)){
			$_SESSION['login']=$row['login'];
			$_SESSION['id']=$row['uid'];
			echo "Вы успешно вошли на сайт. <a href='lk.php'>Личный кабинет</a>.";
		}
		else{
			exit ("Неверно введены логин или пароль.");
		}
	}	 
?>
