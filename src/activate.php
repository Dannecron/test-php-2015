<?php
	include ('bdcon.php');
	$patt = '[^0-9]';
	$replace = '';
	$hash = preg_replace($patt,$replace,$_GET['hash']);
	if ($hash!=""){
		$qe = mysqli_query($db,"Select uid from users where ehash='$hash'");
		$row = mysqli_fetch_array($qe);
		if (!empty($row['uid'])){
			$qe2 = mysqli_query($db, "update users set bel=true, ehash = '' where ehash = '$hash'");
			if ($qe2){
				mysqli_commit($db);
				echo "Активация аккаунта прошла успешно. Вернуться на <a href='index.php'>Главную страницу</a>.";
			}
			else{
				echo "Ошибка обновления.";
			}
		}
		else{
			echo "Ошибка.";
		}
	}
	else{
		echo "Ошибка. Неправильная ссылка.";
	}
?>
