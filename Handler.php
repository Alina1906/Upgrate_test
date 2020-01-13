<?php
$link = mysqli_connect($host, $username, $passwd, $dbname, $file_, $table_);
mysqli_set_charset($link, "utf8");
if (isset($_POST['request'])) {
	$query = 
	"SELECT COUNT(`ID`) AS COUNT_, `COUNTRY` 
	FROM `LOG_TABLE` AS LT INNER JOIN `COUNTRY` AS C ON LT.`IP`=C.`IP` 
	WHERE `CATEGORY` IS NOT NULL OR `cart_id` IS NOT NULL OR `PAY` IS NOT NULL OR `success_pay` IS NOT NULL 
	GROUP BY `COUNTRY` 
	ORDER BY COUNT_ DESC
	LIMIT 1";
	$result = mysqli_query($link, $query);
	echo mysqli_fetch_row($result)[1];
}
elseif (isset($_POST['request1'])) {
	$query = 
	'SELECT COUNT(`ID`) AS COUNT_, `COUNTRY` 
	FROM `LOG_TABLE` AS LT INNER JOIN `COUNTRY` AS C ON LT.`IP`=C.`IP` 
	WHERE `CATEGORY` = LOWER(\'' .mysqli_real_escape_string($link, $_REQUEST['input_category']).'\') 
	GROUP BY `COUNTRY` 
	ORDER BY COUNT_ DESC
	LIMIT 1';
	$result = mysqli_query($link, $query);
	echo mysqli_fetch_row($result)[1];
}
elseif (isset($_POST['request2'])) {
	$query = 
	'SELECT COUNT(`ID`) AS COUNT_, `CATEGORY`,
	CASE
		WHEN `TIME_` BETWEEN \'06:00:00\' AND \'11:59:59\' THEN \'УТРО\'
	    WHEN `TIME_` BETWEEN \'12:00:00\' AND \'17:59:59\' THEN \'ДЕНЬ\'
	    WHEN `TIME_` BETWEEN \'18:00:00\' AND \'23:59:59\' THEN \'ВЕЧЕР\'
	    WHEN `TIME_` BETWEEN \'00:00:00\' AND \'05:59:59\' THEN \'НОЧЬ\'
	END AS TIME_OF_DAY
	FROM `LOG_TABLE`
	WHERE `CATEGORY` = LOWER(\'' .mysqli_real_escape_string($link, $_REQUEST['input_category1']).'\') 
	GROUP BY `CATEGORY`, TIME_OF_DAY
	ORDER BY COUNT_ DESC
	LIMIT 1';
	$result = mysqli_query($link, $query);
	echo mysqli_fetch_row($result)[2];
}
?>