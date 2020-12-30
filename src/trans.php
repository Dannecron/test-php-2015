<?php
	session_start();
	if (isset($_POST['uname'])){
		$name = $_POST['uname'];
	}
	$name = stripslashes($name);
	$name = htmlspecialchars($name);
	if (isset($_POST['sum'])){
		$sum = $_POST['sum'];
		if (!is_numeric($sum)){
			exit ("Нужно ввести число <a href='lk.php'>Вернуться назад</a>.");
		}
	}
	if (empty($name) or empty($sum)){ 
		exit("Нужно заполнить все поля. <a href='lk.php'>Вернуться назад</a>.");
	}
	if ($sum<0) { $sum=-$sum; }
	include("bdcon.php");
	mysqli_autocommit($db, false);
	
	$res1 = mysqli_query($db,"Select * from users where login='$name'");
	if (!$res1){
		exit ("Пользователя с таким именем нет в базе. <a href='/lk.php'>Вернуться назад</a>");
	}
	$row1 = mysqli_fetch_array($res1);
	$uid1=$row1['uid'];
	
	$uid2 = $_SESSION['id'];
	$res2 = mysqli_query($db, "Select * from users where uid=$uid2");
	$row2 = mysqli_fetch_array($res2);
	$name2 = $row2['login'];
	$sum2=-$sum;
	$comm2 = "Расход. Перевод пользователю $name.";
	
	$dt = date("d-m-Y H:i");
	$comm1 = "Приход. Перевод от пользователя $name2.";
	
	$qe1 = mysqli_query($db, "Insert into history (uid,tdate,`inout`,`comm`) values($uid1,STR_TO_DATE('$dt','%d-%m-%Y %H:%i'),$sum,'$comm1')");
	$qe2 = mysqli_query($db, "Insert into history (uid,tdate,`inout`,`comm`) values($uid2,STR_TO_DATE('$dt','%d-%m-%Y %H:%i'),$sum2,'$comm2')");
	
	if ($qe1 and $qe2) { 
		mysqli_commit($db);
		echo "Все прошло успешно. Вернуться в <a href='lk.php'>Личный кабинет</a>.";
	}
	else {
		mysqli_rollback($db);
		echo "Произошла ошибка.";
	}
?>
