<?php

echo "<meta http-equiv='refresh' content='59'>";
//error_reporting(0); 
date_default_timezone_set("Asia/Damascus"); // set time zone
$hour = date('H:i');
$date1 = date('Y-m-d');
$date1 = date_create($date1);
if ($hour == '09:33'  || $hour == '15:30') {
	echo $hour . "<br>";
	include '_inc/__fun.php';
	$op_id = 1;
	$res = get_all("cp_monitoring", "1=1");
	foreach ($result as $result) {
		$gsm = $row["responsable"];
		$service_name = $row["service_name"];
		$date2 = $row["sending_date"];
		$date2 = date_create($date2);
		$diff = date_diff($date1, $date2);
		echo $diff->format("%a") . "<br>";
		if (($diff->format("%a")) <= 1) {
			echo $service_name . "<br>";
			$result = "يرجى إرسال الخدمات التالية:
		 ";
			$result .= $service_name;
			$gsm = $row["responsable"];
			$g = send_response($gsm, $result, $op_id);
			echo $g;
			$g = send_response(963993333637, $result, $op_id);
			$log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . gmdate("Y-m-d H:i:s") . PHP_EOL .
				"g: " . $g . PHP_EOL .
				"sms: " . $result . PHP_EOL .
				"gsm: " . $gsm . PHP_EOL .
				"==================================================================================" . PHP_EOL;
			file_put_contents('logs/alert/alert_' . date("Y-m-d") . '.txt', $log, FILE_APPEND);
		} else {
		}
	}
	// $gsm='963993333637;963993333601;963993333633;963993333609;963988530367';
	//$gsm='963993333637;963993333601;963988530367';
	//$g=send_response($gsm,$result,$op_id);
	//echo $g;
} else {
	echo $hour . "<br>";
}