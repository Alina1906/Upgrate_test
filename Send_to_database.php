<?php
function SendToDatabase($host, $username, $passwd, $dbname, $file_, $table_) {
	$link = mysqli_connect($host, $username, $passwd, $dbname);
	mysqli_set_charset($link, "utf8");

	include("Reader_and_converter.php");
	$lines = ReadConvertLog($file_);
	$n = 0;
	foreach ($lines as $line) {
		$str_keys = "";
		$str_values = "";
		$array_keys = array_keys($line);
		$array_values = array_values($line);
		foreach ($array_keys as $key => $value) {
			if ($key != count($array_keys)-1) {
				$str_keys .= strval($value) . ', ';
			}
			else{
				$str_keys .= strval($value);
			}
		}
		foreach ($array_values as $key => $value) {
			if ($key != count($array_values)-1) {
				$str_values .= '\'' . mysqli_real_escape_string($link,strval($value)) . '\', ';
			}
			else{
				$str_values .= '\'' . mysqli_real_escape_string($link,strval($value)) . '\'';
			}
		}
		$query = "INSERT  INTO $table_ ($str_keys) VALUES ($str_values)";
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