<?php
// echo "<meta http-equiv='refresh' content='58'>";
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



//$str=sms__unicode('06230643062f0020064506480642063900200633064606270628002006340627062a0020062306460020062e06270635064a06290020062a062d0648064a06440020062706440623064506480627064400200628064a064600200627064406230635062f0642062706210020002206330646062706280020064306270634002200200633062a062a06480642064100200639064600200627064406390645064400200648064106420627064b00200644062a06350631064a062d00200645064600200645062a062d062f062b00200628062706330645002000220633064606270628002006340627062a0022002c00200648064406450020064a064306340641002006390646002006270644062306330628062706280020064806310627062100200625063a0644062706420020064706300647002006270644062e06270635064a0629002c002006450643062a0641064a0627064b0020062806340643063100200643064400200645064600200642062706450020062806270633062a062e062f062706450647062700200641064a0020062706440633064606480627062a002006270644064506270636064a0629002e');
$server_time = date("Y-m-d H:i:s");
//$server_time = date("Y-m-d H:i:s",strtotime('-1 hour'));
$server_hour = date("H:i");
// $server_hour = date("H:i" , strtotime('-1 hour'));  
$date = date("Y-m-d");
$sms = '';

echo $server_time . '<br>';
echo $server_hour;

$str_services = "'TOD_BOOK','BCETQ','1077'";
// $str_services = "'TOD_BOOK','BCETQ','SCP-RATCH','SCP-OXXCH','SCP-TIGCH','SCP-RABCH','SCP-DRACH','SCP-SNACH','SCP-HORCH','SCP-GOACH','SCP-MONCH','SCP-ROOCH','SCP-DOGCH','SCP-PIGCH','1077'";

$mtn_array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);


$g_mtn = '';
$res_sms = get_all("cp_sms", "mtn_status='not sent' and ctg in ($str_services) and dt < '" . $server_time . "' limit 1");
$url_mtn = '';
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
		$mtn_sc = get_mtn_sc($cat);
		//echo $mtn_sc;

		$url_mtn = "https://services.mtnsyr.com:7443/General/MTNSERVICES/MonthlySrvcProvider.aspx?From={$mtn_sc}&Category={$mtn_code}&Msg={$final_msg}&User=Rand12&Pass=Rand12345&Lang=0";

		echo $url_mtn . "<br>";
		try {
			$g_mtn_response = file_get_contents($url_mtn);
			echo $g_mtn_response . "<br>";
		} catch (Exception $e) {
			echo 'Message: ' . $e->getMessage();
		}







		if ($mtn_sc == '1077') {
			$arrVal = array('"sent"', '"sent"');
			$arrCol = array("status", "mtn_status");
			update("cp_sms", $arrCol, $arrVal, "id = '" . $row['id'] . "'");
		} else {
			$arrVal = array('"sent"');
			$arrCol = array("mtn_status");
			update("cp_sms", $arrCol, $arrVal, "id = '" . $row['id'] . "'");
		}

		if (!in_array($g_mtn_response, $mtn_array)) {

			$sms = 'هنالك مشكلة في إرسال خدمات mtn
Server IP : 10.0.34.58
Path: services_55479/mt/send/S5.php
MTN Response : '
				. $g_mtn_response . '';

			$m1 = mb_convert_encoding((bin2hex(mb_convert_encoding($sms, 'UCS-2', 'UTF-8'))), 'UCS-2', 'UTF-8');
			$final_sms = iconv('UCS-2', 'UTF-8', $m1);
			$url = "http://localhost/mt?orig=1253&dest=963993333621;963993338530&msg={$final_sms}&res=N&type=1";
			$arrContextOptions = array(
				"ssl" => array(
					"verify_peer" => false,
					"verify_peer_name" => false,
				),
			);
			$g = file_get_contents($url, false, stream_context_create($arrContextOptions));
		}



		$log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . date("Y-m-d H:i:s") . PHP_EOL .
			"MTN_Link: " . $url_mtn . PHP_EOL .
			"MTN_response: " . $g_mtn_response . PHP_EOL .
			"==================================================================================" . PHP_EOL;
		file_put_contents('../logs/send/sending_log_MTN_' . date("Y-m-d") . '.txt', $log, FILE_APPEND);
	}
}
