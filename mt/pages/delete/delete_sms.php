<?php
include '../../_inc/functions1.php';
$date = date('Y-m-d h:s:i');
$ip = $GLOBALS['ip'];
$res_sms = get_all("cp_sms", "id='" . $_REQUEST['id'] . "'");

$str_services = ['SCP-RATCH', 'SCP-OXXCH', 'SCP-TIGCH', 'SCP-RABCH', 'SCP-DRACH', 'SCP-SNACH', 'SCP-HORCH', 'SCP-GOACH', 'SCP-MONCH', 'SCP-ROOCH', 'SCP-DOGCH', 'SCP-PIGCH'];

$code = '';
while ($row_sms = $res_sms->fetch_assoc()) {
	$code = $row_sms['ctg'];
	if (in_array($code, $str_services)) {
		
		delete("cp_sms", "ctg=$code and dt='" . $row_sms['dt'] . "'");
		_log($code, $row_sms['dt'], $date, $ip);
		//ChineseHoroscope_to_59('', '', '', '', $_REQUEST['id'], $fun = 'delete');

		echo '1';
	} else if ($row_sms['ctg'] == 'SABAYA_1' || $row_sms['ctg'] == 'SABAYA_2' || $row_sms['ctg'] == 'SABAYA_3' || $row_sms['ctg'] == 'SABAYA_4' || $row_sms['ctg'] == 'SABAYA_1_F' || $row_sms['ctg'] == 'SABAYA_2_F' || $row_sms['ctg'] == 'SABAYA_3_C' || $row_sms['ctg'] == 'SABAYA_5_C' || $row_sms['ctg'] == 'SABAYA_D' || $row_sms['ctg'] == 'SABAYA_W') {
		delete("cp_sms", "ctg='SABAYA_1' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_1', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='SABAYA_2' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_2', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='SABAYA_1_F' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_1_F', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='SABAYA_2_F' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_2_F', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='SABAYA_3_C' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_3_C', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='SABAYA_5_C' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_5_C', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='SABAYA_D' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_D', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='SABAYA_W' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_W', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='SABAYA_4' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_4', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='SABAYA_3' and dt='" . $row_sms['dt'] . "'");
		_log('SABAYA_3', $row_sms['dt'], $date, $ip);
		echo '1';
	} else if ($row_sms['ctg'] == 'S1_BUND_W' || $row_sms['ctg'] == 'S2_BUND_W' || $row_sms['ctg'] == 'S3_BUND_W' || $row_sms['ctg'] == 'S4_BUND_W') {

		delete("cp_sms", "ctg='S1_BUND_W' and dt='" . $row_sms['dt'] . "'");
		_log('S1_BUND_W', $row_sms['dt'], $date, $ip);


		delete("cp_sms", "ctg='S2_BUND_W' and dt='" . $row_sms['dt'] . "'");
		_log('S2_BUND_W', $row_sms['dt'], $date, $ip);

		delete("cp_sms", "ctg='S3_BUND_W' and dt='" . $row_sms['dt'] . "'");
		_log('S3_BUND_W', $row_sms['dt'], $date, $ip);


		delete("cp_sms", "ctg='S4_BUND_W' and dt='" . $row_sms['dt'] . "'");
		_log('S4_BUND_W', $row_sms['dt'], $date, $ip);

		echo '1';
		//} else if ($row_sms['ctg'] == 'INAAA'  || $row_sms['ctg'] == 'LOCKIN230' || $row_sms['ctg'] == 'LOCKIN_3') {
	} else if ($row_sms['ctg'] == 'LOCKIN230' || $row_sms['ctg'] == 'LOCKIN_3') {
		/* delete("cp_sms", "ctg='INAAA' and dt='" . $row_sms['dt'] . "'");
		_log('INAAA', $row_sms['dt'], $date, $ip); */

		delete("cp_sms", "ctg='LOCKIN230' and dt='" . $row_sms['dt'] . "'");
		_log('LOCKIN230', $row_sms['dt'], $date, $ip);

		delete("cp_sms", "ctg='LOCKIN_3' and dt='" . $row_sms['dt'] . "'");
		_log('LOCKIN_3', $row_sms['dt'], $date, $ip);

		echo '1';
	} else if ($row_sms['ctg'] == 'TOP_APP' || $row_sms['ctg'] == 'COM_VASAPP') {
		delete("cp_sms", "ctg='TOP_APP' and dt='" . $row_sms['dt'] . "'");
		_log('TOP_APP', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='COM_VASAPP' and dt='" . $row_sms['dt'] . "'");
		_log('COM_VASAPP', $row_sms['dt'], $date, $ip);
		echo '1';
	} /* else if ($row_sms['ctg'] == 'AROUND_W' || $row_sms['ctg'] == 'COM_VASWRD') {
		delete("cp_sms", "ctg='AROUND_W' and dt='" . $row_sms['dt'] . "'");
		_log('AROUND_W', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='COM_VASWRD' and dt='" . $row_sms['dt'] . "'");
		_log('COM_VASWRD', $row_sms['dt'], $date, $ip);
		echo '1';
	}  */ else if ($row_sms['ctg'] == 'YOUR_INF_M' || $row_sms['ctg'] == 'YOUR_INF_W') {
		delete("cp_sms", "ctg='YOUR_INF_M' and dt='" . $row_sms['dt'] . "'");
		_log('YOUR_INF_M', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='YOUR_INF_W' and dt='" . $row_sms['dt'] . "'");
		_log('YOUR_INF_W', $row_sms['dt'], $date, $ip);
		echo '1';
	} else if ($row_sms['ctg'] == 'LENERGY_M' || $row_sms['ctg'] == 'LENERGY_W') {
		delete("cp_sms", "ctg='LENERGY_M' and dt='" . $row_sms['dt'] . "'");
		_log('LENERGY_M', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='LENERGY_W' and dt='" . $row_sms['dt'] . "'");
		_log('LENERGY_W', $row_sms['dt'], $date, $ip);
		echo '1';
	} else if ($row_sms['ctg'] == 'NATURE_W' || $row_sms['ctg'] == 'NATURE_M') {
		delete("cp_sms", "ctg='NATURE_W' and dt='" . $row_sms['dt'] . "'");
		_log('NATURE_W', $row_sms['dt'], $date, $ip);
		delete("cp_sms", "ctg='NATURE_M' and dt='" . $row_sms['dt'] . "'");
		_log('NATURE_M', $row_sms['dt'], $date, $ip);
		echo '1';
	} else if ($row_sms['ctg'] == 'WISDOM_M' || $row_sms['ctg'] == 'WISDOM_W') {
		delete("cp_sms", "ctg='WISDOM_M' and dt='" . $row_sms['dt'] . "'");
		_log('WISDOM_M', $row_sms['dt'], $date, $ip);

		echo '1';
	} else {
		delete("cp_sms", "id='" . $_REQUEST['id'] . "'");
		_log($_REQUEST['id'], $row_sms['dt'], $date, $ip);
		echo '1';
	}
}

$GLOBALS['conn']->close();

/*
  $log ="Date :".$_SERVER['REMOTE_ADDR'].'-'.date("F j, g:i a").PHP_EOL.
              "smstxt : ".$_REQUEST['smstxt'].PHP_EOL.
              "sdate : ".$_REQUEST['sdate'].PHP_EOL.
              "code : ".$_REQUEST['code'].PHP_EOL.
              "ins_date : ".$date.PHP_EOL.
              "IP : ".$GLOBALS['ip'].PHP_EOL.
              "--------------------".PHP_EOL;
              
    file_put_contents('../../logs/insert/insert_'.date("j.n.Y").'.txt',$log,FILE_APPEND);
*/
function _log($ctg, $dt, $date, $ip)
{
	$log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . date("F j, g:i a") . PHP_EOL .
		"Message date in DB : " . $dt . PHP_EOL .
		"code : " . $ctg . PHP_EOL .
		"delete_date : " . $date . PHP_EOL .
		"IP : " . $ip . PHP_EOL .
		"--------------------" . PHP_EOL;
	file_put_contents('../../logs/delete/delete_' . date("j.n.Y") . '.txt', $log, FILE_APPEND);
}