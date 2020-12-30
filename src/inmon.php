<?php
	session_start();
	if (isset($_POST['sum'])){
		$sum = $_POST['sum'];
		if (is_numeric($sum)==false){
			exit ("Нужно ввести число <a href='lk.php'>Вернуться назад</a>.");
		}
	}
	if (empty($sum)){ 
		exit ("Нужно ввести число <a href='lk.php'>Вернуться назад</a>.");
	}
	if ($sum<0) { $sum=-$sum; }
	$uid = $_SESSION['id'];
	include("bdcon.php");
	mysqli_autocommit($db, false);
	$dt = date("d-m-Y H:i");
	$comm = "Приход. Пополнение на сайте.";
	$qe3 = mysqli_query($db, "Insert into history (uid,tdate,`inout`,`comm`) values($uid,STR_TO_DATE('$dt','%d-%m-%Y %H:%i'),$sum,'$comm')");
	if ($qe3) { 
		mysqli_commit($db);
		echo "Все прошло успешно. Вернуться в <a href='lk.php'>Личный кабинет</a>.";
	}
	else {
		mysqli_rollback($db);
		echo "Произошла ошибка.";
	}
?>
