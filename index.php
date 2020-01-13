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