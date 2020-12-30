<?php
	session_start();
	include ("bdcon.php");
	$uid = $_SESSION['id'];
	$res = mysqli_query($db, "select tdate, `inout`, `comm` from history where uid=$uid");
	$res2 = mysqli_query($db,"select sum(`inout`) as sum from history where uid=$uid group by uid");
	$row2 = mysqli_fetch_array($res2);
	$res3 = mysqli_query($db,"select bel from users where uid=$uid");
	$row3 = mysqli_fetch_array($res3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="ru">

<head>
	<title>Личный кабинет</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<script type="text/javascript">
		window.onload = function(){
			document.getElementById('togg').onclick = function(){
				openbox('box','box2','box3','togg');
				return false;
			}
			document.getElementById('togg2').onclick = function(){
				openbox('box2','box','box3','togg2');
				return false;
			}
			document.getElementById('togg3').onclick = function(){
				openbox('box3','box','box2','togg3');
				return false;
			}
		}
		function openbox(id1,id2,id3,toggler){
			var div = document.getElementById(id1);
			var div2 = document.getElementById(id2);
			var div3 = document.getElementById(id3);
			if (div.style.display == 'block'){
				div.style.display = 'none';
			}
			else{
				div.style.display = 'block';
				if (div2.style.display == 'block'){ div2.style.display = 'none'; }
				if (div3.style.display == 'block'){ div3.style.display = 'none'; }
			}
		}
	</script>
</head>

<body>
	<table><tr>
	<td><a href="/index.php">Главная страница</a></td>
	<td><a href="/lk.php">Личный кабинет</a></td>
	<?php if (!empty($_SESSION['id'])){
		echo "<td><a href='exit.php'>Выход</a></td>";
		} 
		if (!$row3['bel']){
			echo "<td>Ваш аккаунт не активирован.</td>";
		}
	?>
	</tr>
	</table>
	<p>Ваш баланс лицевого счета: <?php if (empty($row2['sum'])){
											echo "0";
										}
										else{
											echo $row2['sum'];
										} ?></p>
	<table><tr>
		<td><button id="togg">Пополнить баланс</button></td>
		<td><button id="togg2">Посмотреть историю операций</button></td>
		<td><button id="togg3">Перевести средства</button></td>
	</tr></table>
	<div id="box" style="display: none;"><table width=30%>
		<tr><td colspan=2 align="center" style="font-size: 16pt;"><b>Пополнение баланса лицевого счета</b></td></tr>
	<form method="post" action="inmon.php">
		<tr><td>Введите сумму:</td><td align="center"><input type="text" name="sum" maxlength="7" required></td></tr>
		<tr><td colspan=2 align="center">
			<input type="submit" name="submit" value="Пополнить">
		</td></tr>
	</form>
	</table>
	</div>
	<div id="box2" style="display: none;"><table width=40%>
		<tr><td colspan=3 align="center" style="font-size: 16pt;"><b>История операций</b></td></tr>
		<?php 
			$i=0;
			while ($row = mysqli_fetch_row($res)){
				echo "<tr align='center'><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
				$i++;
			}
			if ($i==0) { echo "<tr align='center'><td>Операций не производилось</td></tr>"; }
		?>
	</table>
	</div>
	<div id="box3", style="display: none;"><table width=30%>
		<tr><td colspan=2 align="center" style="font-size: 16pt;"><b>Перевод средств другому пользователю</b></td></tr>
		<form method="post" action="trans.php">
			<tr><td>Имя пользователя:</td><td align="center">
				<input type="text" name="uname" required>
			</td></tr>
			<tr><td>Сумма:</td><td align="center"><input type="text" name="sum" maxlength="7" required></td></tr>
			<tr><td colspan=2 align="center">
				<input type="submit" name="submit" value="Перевести">
			</td></tr>
		</form>
	</table>
	</div>
</body>

</html>
