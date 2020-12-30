<?php
	function hashPassword($password)
	{
		$salt = md5(uniqid('some_prefix', true));
		$salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
		return crypt($password, '$2a$08$' . $salt);
	}
	include ("bdcon.php");
	mysqli_autocommit($db, false);
	if (isset($_POST['lg'])){ 
		$login = $_POST['lg']; 
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
	if (isset($_POST['em'])) {
		$email = $_POST['em']; 
		if ($email==''){
			unset($email);
		} 
	}
	if (empty($login) or empty($pass) or empty($email)){
		exit ("Заполнены не все поля! Нужно ввести всю информацию.");
	}
	$login = stripslashes($login);
	$login = htmlspecialchars($login);
	$pass = stripslashes($pass);
	$pass = htmlspecialchars($pass);
	$email = stripslashes($email);
	$email = htmlspecialchars($email);
	$login = trim($login);
	$pass = trim($pass);
	$email = trim($email);
	$pass = hashPassword($pass);
	
	$result = mysqli_query($db,"Select uid from users where login='$login'");
	$row = mysqli_fetch_array($result);
	if (!empty($row['uid'])) {
		exit ("Извините, но данный логин уже занят.");
	}
	$result = mysqli_query($db,"Select uid from users where e_mail='$email'");
	$row = mysqli_fetch_array($result);
	if (!empty($row['uid'])) {
		exit ("Извините, но данная почта уже занята.");
	}
	$hash_code = rand(100000,999999);
	$subject = "Подтверждение регистрации";
	$message = "<p>Вы зарегистрировались на тестовом сервисе.</p>".
	"<p>Подтвердите регистрацию, перейдя по предложенной ".
	"<a href='http://dannc.doomstuff.com/activate.php?hash=" . $hash_code ."'>ссылке</a></p>";
	include ('smtp.php');
	if(!send_mime_mail($login,$email,$subject,$message,true)){
		echo "<b>Неверно указана электронная почта</b>. <a href='reg.php'>Вернуться к странице с регистрацией</a>";
	}
	else {
		$result2 = mysqli_query($db, "INSERT into users (login, pass, e_mail, ehash) values ('$login','$pass','$email','$hash_code')");
		if ($result2) {
			mysqli_commit($db);
			echo "Вы успешно зарегистрированы! На указанный e-mail отправлена ссылка для подтверждения регистрации.".
			"Теперь вы можете зайти на сайт. <a href='/index.php'>Главная страница</a>";
		}
		else {
			mysqli_rollback($db);
			echo "Ошибка! Вы не зарегистрированы. <a href='/reg.php>Назад</a>";
		}
	}	 
?>
