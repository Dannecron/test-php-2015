<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="ru">

<head>
	<title>Регистрация</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>
	<table><tr>
	<td><a href="/index.php">Главная страница</a></td>
	<td><a href="/reg.php">Регистрация</a></td>
	<td><a href="/log.php">Вход в систему</a></td>
	</tr>
	</table>
	<table>
	<form method="post" action="registration.php">
	<tr>
		<td><b>E-mail</b>:</td>
		<td><input name="em" type="email" size=50 required></td>
	</tr>
	<tr>
		<td><b>Login</b>:</td>
		<td><input name="lg" type="text" size=20 required></td>
	</tr>
	<tr>
		<td><b>Password</b>:</td>
		<td><input name="pass" type="password" size=20 required></td>
	</tr>
	<tr><td colspan=2 align="center">
	<input type="submit" name="submit" value="Registration"></td>
	</tr></form>
	</table>
	
</body>

</html>
