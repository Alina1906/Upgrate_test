<?php
function SendCountryToDatabase($host, $username, $passwd, $dbname, $file_) {
	include("get_country.php");
	$link = mysqli_connect($host, $username, $passwd, $dbname);
	mysqli_set_charset($link, "utf8");
	$lines = file($file_);
	$n = 0;
	$ip_array = array();
	$pattern = "/\d+\.\d+\.\d+\.\d+/";
	foreach ($lines as $line_num => $line) {
		preg_match($pattern, $line, $matches);
		foreach ($matches as $value) {
			array_push($ip_array,$value);
		}
	}
	$uniq_ip_array = array_unique($ip_array);
	foreach ($uniq_ip_array as $value) {
		$ip = '\'' . mysqli_real_escape_string($link,strval($value)) . '\'';
		$country = '\''. mysqli_real_escape_string($link,strval(GetCountry($value))) . '\'';
		$query = "INSERT  INTO country (ip, country) VALUES ($ip, $country)";
		$sendquery = mysqli_query($link, $query);
		if($sendquery) {
			$n++;
		}
		else {
			echo mysqli_error($link);
		}
	}
	echo $n . " строк вставлено";
}