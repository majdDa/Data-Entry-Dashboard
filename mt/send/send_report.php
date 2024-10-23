<?php
date_default_timezone_set("Asia/Kuwait");
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 60; URL=$url1");

include "../_inc/functions.php";
$server_time = date("Y-m-d H:i:s");
$server_hour = date("H:i");
$date = date("Y-m-d");
$time = date('H:i');
echo $time;





if ($time == '14:44') {
	$count_ctg = get_count_ctg("dt like '" . $date . "%'");
	if ($count_ctg != 163) {
		$sms_alert = ' لم يتم ادخال جميع الرسائل ';
		$res_ctg_n = get_ctg_not_sent($date);
		while ($row_ctg_n = $res_ctg_n->fetch_assoc()) {
			$sms_alert .= $row_ctg_n['name'];
			$sms_alert .= ',';
		}
		$sms_alert = substr($sms_alert, 0, -1);
	} else {
		$sms_alert = 'تم ادخال جميع الرسائل';
	}
	$final_sms = sms__unicode($sms_alert);
	$url = "http://localhost/mt?orig=1253&dest=963993333649&msg={$final_sms}&res=N&type=1";
	echo $url;
	$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
); 
	$g = file_get_contents($url);
	echo $g;


	$log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . date("Y-m-d H:i:s") . PHP_EOL .
		"Msg : " . $sms_alert . PHP_EOL .
		"MT URL : " . $url . PHP_EOL .
		"Response Value:	" . $g . PHP_EOL .
		"==================================================================================" . PHP_EOL;
	file_put_contents('../logs/sendReport/sending_log_' . date("Y-m-d") . '.txt', $log, FILE_APPEND);
}



function sms__unicode($message)
{
	if (function_exists('iconv')) {
		$latin = @iconv('UTF-8', 'ISO-8859-1', $message);
		if (strcmp($latin, $message)) {
			$arr = unpack('H*hex', @iconv('UTF-8', 'UCS-2BE', $message));
			return $arr['hex'];
		}
	}
	return FALSE;
}
