<?php
#Закомментированный ниже кусок php кода реализует создание таблиц `log_table` и `country`; заполняет таблицу `log_table` данными из `logs.txt`, заполняет в таблице `country` название страны (столбец `country`), используя API сайта https://ipgeolocation.io  
/*
$link = mysqli_connect('localhost', 'root', '', 'vse_na_dno');
mysqli_set_charset($link, "utf8");
$query = 'CREATE TABLE `vse_na_dno`.`log_table` ( `id` INT NOT NULL AUTO_INCREMENT , `date_` DATE NOT NULL , `time_` TIME NOT NULL , `ip` VARCHAR(25) NOT NULL , `category` VARCHAR(50) NULL , `good` VARCHAR(50) NULL , `goods_id` VARCHAR(25) NULL , `amount` INT(10) NULL , `user_id` VARCHAR(25) NULL , `cart_id` VARCHAR(25) NULL , `pay` BOOLEAN NULL , `success_pay` BOOLEAN NULL , PRIMARY KEY (`id`) , UNIQUE INDEX (`ip`)) ENGINE = InnoDB;
	CREATE TABLE `vse_na_dno`.`country` ( `ip` VARCHAR(25) NOT NULL , `country` VARCHAR(50) NULL , FOREIGN KEY (`ip`) REFERENCES `log_table`(`ip`)) ENGINE = InnoDB;';
$sendquery = mysqli_query($link, $query);
if($sendquery) {
	echo 'таблицы успешно созданы';
}
else {
	echo mysqli_error($link);
}
include("Send_to_database.php");
SendToDatabase($host, $username, $passwd, $dbname, $file_ = 'logs.php', $table_ = 'log_table');
include("set_country.php");
SendCountryToDatabase($host, $username, $passwd, $dbname, $file_ = 'logs.php');
*/
?>
<html>
  	<head>
  		<meta charset="utf-8">
    	<title>Отчеты</title>
  	<head>
	<body>
	    <h1>Аналитические отчеты сайта компании "Все на дно":</h1>

		<form name="report1" method="post" action="Handler.php">
		 	<p><b>1. Посетители из какой страны совершают больше всего действий на сайте?</b><br>
				<input type="submit" name="request" value="Узнать"> <Br>
			</p>
		</form>
		<form name="report2" method="post" action="Handler.php">
		 	<p><b>2. Посетители из какой страны чаще всего интересуются товарами из определенных категорий?</b><br>
		 		<p><b>Введите название категории:</b><br>
				<input type="text" name="input_category"> <Br>
				<input type="submit" name="request1" value="Узнать"> <Br>
			</p>
		</form>
		<form name="report3" method="post" action="Handler.php">
		 	<p><b>3. В какое время суток чаще всего просматривают определенную категорию товаров?</b><br>
		 		<p><b>Введите название категории:</b><br>
				<input type="text" name="input_category1"> <Br>
				<input type="submit" name="request2" value="Узнать"> <Br>
			</p>
		</form>
	</body>
</html>
