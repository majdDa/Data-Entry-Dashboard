<?php
date_default_timezone_set("Asia/Kuwait");
include '../../_inc/functions1.php';


$teaserText = $_REQUEST['smstxt'];

//$Gsm = $_REQUEST['gsm'];

$Msg = str_replace('"', '', $teaserText);
$m1 = mb_convert_encoding((bin2hex(mb_convert_encoding($Msg, 'UCS-2', 'UTF-8'))), 'UCS-2', 'UTF-8');
    $Msg = iconv('UCS-2', 'UTF-8', $m1);
    $Gsm = '963993333624';
	$User = 'Rand12';
	$Pass = 'Rand12345';
	$From = '1637';
								
	$url = "https://services.mtnsyr.com:7443/general/MTNSERVICES/ConcatenatedSender.aspx?User=" . $User . "&Pass=" . $Pass . "&From=" . $From . "&Gsm=" . $Gsm . "&Msg=" . $Msg . "&Lang=0";
	$url=str_replace ('&amp;','&', $url);
    $g = file_get_contents($url);
	
		if ($g == $Gsm) {
		  echo '1';
		} else {
		 echo $g;
		}

_log($teaserText, $Gsm, $g,$url);

function _log($teaserText, $Gsm, $g,$url)
{
  $log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . date("F j, g:i a") . PHP_EOL .
    "smstxt : " . $teaserText . PHP_EOL .
    "Tested Gsm : " . $Gsm . PHP_EOL .
    "g : " . $g . PHP_EOL .
    "URL : " . $url . PHP_EOL .
    "Test Date : " .  date('Y-m-d h:i:s') . PHP_EOL .

    "--------------------" . PHP_EOL;
  file_put_contents('../../logs/test/test__' . date("j.n.Y") . '.txt', $log, FILE_APPEND);
}