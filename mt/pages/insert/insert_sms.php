<?php
include '../../_inc/functions.php';
date_default_timezone_set("Asia/Damascus");
$date = date("Y-m-d H:i:s");


$date = date('Y-m-d h:s:i');
$sdate = $_REQUEST['sdate'];
$code = $_REQUEST['code'];
$sdate = str_replace('/', '-', $sdate);
$sdate .= ':00';
$result = get_all("cp_sms", "`ctg` = '" . $code . "' AND `dt` = '" . $sdate . "'");

if ($result->num_rows > 0) { //content Exist//content Exist

  echo ('0');
} else {

  $arrCol = array("null", $_REQUEST['smstxt'], $_REQUEST['sdate'], $_REQUEST['code'], 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip']);
  insert("cp_sms", $arrCol);
  echo '1';
}



function _log($smstxt, $sdate, $code, $date, $ip)
{
  $log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . date("F j, g:i a") . PHP_EOL .
    "smstxt : " . $smstxt . PHP_EOL .
    "sdate : " . $sdate . PHP_EOL .
    "code : " . $code . PHP_EOL .
    "ins_date : " . $date . PHP_EOL .
    "IP : " . $ip . PHP_EOL .
    "--------------------" . PHP_EOL;
  file_put_contents('../../logs/insert/insert_' . date("j.n.Y") . '.txt', $log, FILE_APPEND);
}