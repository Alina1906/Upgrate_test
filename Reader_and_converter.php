<?php 
function ReadConvertLog($file_)
{
	$lines = file($file_);
	$log_array = array();
	$patterns = ["/\d{4}-\d{2}-\d{2}/", "/\d{2}:\d{2}:\d{2}/", "/\d+\.\d+\.\d+\.\d+/", "/https:\/\/\w+\.com\/\w+\/\w+|https:\/\/\w+\.com\/\w+/", "/goods_id=\d+&amount=\d+&cart_id=\d+/", "/user_id=\d+&cart_id=\d+/"];
	foreach ($lines as $line_num => $line) {
		$subarray = array();
		foreach ($patterns as $key => $value) {
			preg_match($value, $line, $matches);
			foreach ($matches as $key1 => $value1) {
				if (preg_match("/https:\/\/\w+\.com\/\w+\/\w+/", $value1)) {
					$res = explode("/", $value1);
					$subarray['category'] = $res[3];
					$subarray['good'] = $res[4];
				}
				elseif (preg_match("/https:\/\/\w+\.com\/\w+/", $value1) and !preg_match("/success_pay_|cart|pay/", $value1)) {
					$res = explode("/", $value1);
					$subarray['category'] = $res[3];
				}
				elseif (preg_match("/goods_id=\d+&amount=\d+&cart_id=\d+/", $value1)) {
					$res_ = explode("=", $value1);
					$subarray['goods_id'] = preg_replace('/[^0-9]/', '', $res_)[1];
					$subarray['amount'] = preg_replace('/[^0-9]/', '', $res_)[2];
					$subarray['cart_id'] = preg_replace('/[^0-9]/', '', $res_)[3];
				}
				elseif (preg_match("/user_id=\d+&cart_id=\d+/", $value1)) {
					$subarray['pay'] = 1;
					$res1 = explode("=", $value1);
					$subarray['user_id'] = preg_replace('/[^0-9]/', '', $res1)[1];
					$subarray['cart_id'] = preg_replace('/[^0-9]/', '', $res1)[2];
				}
				elseif (preg_match("/success_pay_\d+/", $value1)) {
					$subarray['success_pay'] = '1';
					$subarray['cart_id'] = preg_replace('/[^0-9]/', '', $value1);
				}
				elseif (preg_match("/\d{4}-\d{2}-\d{2}/", $value1)) {
					$subarray['date_'] = $value1;
				}
				elseif (preg_match("/\d{2}:\d{2}:\d{2}/", $value1)) {
					$subarray['time_'] = $value1;
				}
				elseif (preg_match("/\d+\.\d+\.\d+\.\d+/", $value1)) {
					$subarray['ip'] = $value1;
				}		
				
			}
		}
		array_push($log_array, $subarray);
	}
	return $log_array;
}