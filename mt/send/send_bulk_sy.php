<?php
//echo "<meta http-equiv='refresh' content='58'>";
//header("Content-Type: text/plain");
date_default_timezone_set("Asia/Kuwait");
include "../_inc/functions.php";
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
echo date("Y-m-d H:i:s") . ' : gmdate';

////////////////////////////////////// convert hexa to binary

function local_hex2bin($h)
{
	if (!is_string($h)) return null;
	$r = '';
	for ($a = 0; $a < strlen($h); $a += 2) {
		$r .= chr(hexdec($h{
			$a} . $h{
			($a + 1)}));
	}
	return $r;
}

///////////////////////////////// convert binary to utf8

function bin2utf8($str)
{
	$ucs2string = local_hex2bin($str);
	$utf8string = mb_convert_encoding($ucs2string, 'UTF-8', 'UCS-2');
	return $utf8string;
}
//////////////////////////// read sms and insert into inbox
function read_sms($str)
{
	$str = bin2utf8($str);
	return test_input($str);
}


$server_time = date("Y-m-d H:i:s");
$server_hour = date("H:i");
$date = date("Y-m-d");
$sms = '';
echo $server_time . '<br>';
echo $server_hour;
$g = '';


if ($server_hour == '14:00') {
	$count_ctg = get_count_ctg("dt like '" . $date . "%'");
	if ($count_ctg < 157) {
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
	$url = "http://localhost/mt?orig=1253&dest=963993333644;963993333621&msg={$final_sms}&res=C&type=1";
	echo $url;
	$arrContextOptions = array(
		"ssl" => array(
			"verify_peer" => false,
			"verify_peer_name" => false,
		),
	);
	$g = file_get_contents($url);
	echo $g;
	sleep(60);
	flush();

	$log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . date("Y-m-d H:i:s") . PHP_EOL .
		"Msg : " . $sms_alert . PHP_EOL .
		"MT URL : " . $url . PHP_EOL .
		"Response Value:	" . $g . PHP_EOL .
		"==================================================================================" . PHP_EOL;
	file_put_contents('../logs/sendReport/sending_log_' . date("Y-m-d") . '.txt', $log, FILE_APPEND);
}
///////////////////////////////////////////////////////////////// code for sending Syriatel services
$g_mtn = '';
$res_sms = get_all("cp_sms", "status='not sent' and ctg!='1077' and dt < '" . $server_time . "' limit 1");
if ($res_sms->num_rows == 1) {
	while ($row = $res_sms->fetch_assoc()) {
		$agency = "RAND";
		$cat = $row['ctg'];
		$content_msg = $row['mtxt'];
		$msg_db = str_replace('"', ' ', $content_msg);
		$final_msg = sms__unicode($msg_db);
		$lang = $row['lang'];
		$id = $row['id'];
		$status = $row['status'];
		$dt = $row['dt'];
		$mtn_code = get_code($cat);

		//update
		$arrVal = array('"sent"');
		$arrCol = array("status");
		update("cp_sms", $arrCol, $arrVal, "id = '" . $row['id'] . "'");

		//send
		$url = "https://localhost/news?agency={$agency}&cat={$cat}&msg={$final_msg}&lang={$lang}&res=N";
		echo $url . "<br>";
		try {
			$arrContextOptions = array(
				"ssl" => array(
					"verify_peer" => false,
					"verify_peer_name" => false,
				),
				"http" => array(
					"timeout" => 120, // Timeout set to 5 seconds
				),
			);
			$g = file_get_contents($url, false, stream_context_create($arrContextOptions));
			echo $g . "<br>";
		} catch (Exception $e) {

			//update

			$arrVal = array('"not sent"');
			$arrCol = array("status");
			update("cp_sms", $arrCol, $arrVal, "id = '" . $row['id'] . "'");

			echo 'Message: ' . $e->getMessage();
		}
		// if ($g == '1') {
		// 	$arrVal = array('"sent"');
		// 	$arrCol = array("status");
		// 	update("cp_sms", $arrCol, $arrVal, "id = '" . $row['id'] . "'");
		// }

		if ($g != '1') {

			//update
			$arrVal = array('"not sent"');
			$arrCol = array("status");
			update("cp_sms", $arrCol, $arrVal, "id = '" . $row['id'] . "'");

			$sms = 'هنالك مشكلة في ارسال الخدمات
Syriatel Services:' . $cat;
			$m1 = mb_convert_encoding((bin2hex(mb_convert_encoding($sms, 'UCS-2', 'UTF-8'))), 'UCS-2', 'UTF-8');
			$final_sms = iconv('UCS-2', 'UTF-8', $m1);
			$url = "http://localhost/mt?orig=1253&dest=963993333621;963993333643;963993338530&msg={$final_sms}&res=N&type=1";

			$arrContextOptions = array(
				"ssl" => array(
					"verify_peer" => false,
					"verify_peer_name" => false,
				),
			);
			file_get_contents($url, false, stream_context_create($arrContextOptions));
		}


		$log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . gmdate("Y-m-d H:i:s") . PHP_EOL .
			"Delivery Status:	" . ($g == '1' ? 'Succeeded' : 'Failed') . PHP_EOL .
			"Msg : " . $final_msg . PHP_EOL .
			"Msg cat : " . $cat . PHP_EOL .
			"Msg SMS : " . $msg_db . PHP_EOL .
			"Msg sending time in DB: " . $dt . PHP_EOL .
			"Syriatel_response: " . $g . PHP_EOL .


			"==================================================================================" . PHP_EOL;
		file_put_contents('../logs/send/sending_log_' . date("Y-m-d") . '.txt', $log, FILE_APPEND);
	}


	$GLOBALS['conn']->close();
}
