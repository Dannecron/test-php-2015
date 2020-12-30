<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="ru">

<head>
	<title>Главная страница</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>
	<table><tr>
	<td><a href="/index.php">Главная страница</a></td>
		<?php if (empty($_SESSION['id'])) {echo"<td><a href='/reg.php'>Регистрация</a></td>";}?>
	<?php if (empty($_SESSION['id'])) {echo"<td><a href='/log.php'>Вход в систему</a></td>";}?>
	<?php if (!empty($_SESSION['id'])) {echo"<td><a href='/lk.php'>Личный кабинет</a></td>";}?>
	<?php if (!empty($_SESSION['id'])){echo "<td><a href='exit.php'>Выход</a></td>";}?>
	</tr>
	</table>
	<p>	
		<?php
			if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
				echo "Здравствуйте, гость. Пользуясь меню, совершите, пожалуйста, вход или регистрацию.";
			}
			else {
				echo "Вы вошли на сайт, как ".$_SESSION['login'].". Приятного времени суток.";
			}
		?>
	</p>
</body>

</html>
