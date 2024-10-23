<?php
include '../../_inc/functions1.php';
date_default_timezone_set("Asia/Kuwait");

$date = date('Y-m-d h:s:i');
$sdate = $_REQUEST['sdate'];
$code = $_REQUEST['code'];
$sdate = str_replace('/', '-', $sdate);
$sdate .= ':00';
$result = get_all("cp_sms", "`ctg` = '" . $code . "' AND `dt` = '" . $sdate . "'");
$str_services = ['SCP-RATCH', 'SCP-OXXCH', 'SCP-TIGCH', 'SCP-RABCH', 'SCP-DRACH', 'SCP-SNACH', 'SCP-HORCH', 'SCP-GOACH', 'SCP-MONCH', 'SCP-ROOCH', 'SCP-DOGCH', 'SCP-PIGCH'];

if ($result->num_rows > 0) { //content Exist
  echo ('0');
} else {

  if (in_array($code, $str_services)) {
    
    $arrCol12 = array("null", $_REQUEST['smstxt'], $sdate, $code, 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol12);
    _log($_REQUEST['smstxt'], $sdate, $code, $date, $ip);
    ChineseHoroscope_to_59($_REQUEST['smstxt'], $sdate, $code, $date, $id = '', $fun = 'create');

    echo '1';
  }
  /// for sabaya
  else  if ($code == 'SABAYA_1') {
    $arrCol1 = array("null", $_REQUEST['smstxt'], $sdate, 'SABAYA_1', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol1);
    _log($_REQUEST['smstxt'], $sdate, 'SABAYA_1', $date, $ip);

    $arrCol2 = array("null", $_REQUEST['smstxt'], $sdate, 'SABAYA_2', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol2);
    _log($_REQUEST['smstxt'], $sdate, 'SABAYA_2', $date, $ip);

    $arrCol5 = array("null", $_REQUEST['smstxt'], $sdate, 'SABAYA_3', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol5);
    _log($_REQUEST['smstxt'], $sdate, 'SABAYA_3', $date, $ip);

    $arrCol6 = array("null", $_REQUEST['smstxt'], $sdate, 'SABAYA_4', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol6);
    _log($_REQUEST['smstxt'], $sdate, 'SABAYA_4', $date, $ip);
    echo '1';
  } else if ($code == 'SHOFI_MAFI') {
    $arrCol1 = array("null", $_REQUEST['smstxt'], $sdate, 'SHOFI_MAFI', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol1);
    _log($_REQUEST['smstxt'], $sdate, 'SHOFI_MAFI', $date, $ip);

    $arrCol2 = array("null", $_REQUEST['smstxt'], $sdate, 'S1_BUND_W', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol2);
    _log($_REQUEST['smstxt'], $sdate, 'S1_BUND_W', $date, $ip);

    $arrCol3 = array("null", $_REQUEST['smstxt'], $sdate, 'S2_BUND_W', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol3);
    _log($_REQUEST['smstxt'], $sdate, 'S2_BUND_W', $date, $ip);

    $arrCol4 = array("null", $_REQUEST['smstxt'], $sdate, 'S3_BUND_W', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol4);
    _log($_REQUEST['smstxt'], $sdate, 'S3_BUND_W', $date, $ip);

    $arrCol4 = array("null", $_REQUEST['smstxt'], $sdate, 'S4_BUND_W', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol4);
    _log($_REQUEST['smstxt'], $sdate, 'S4_BUND_W', $date, $ip);
    echo '1';
  } else if ($code == 'AROUND_W') {
    $arrCol7 = array("null", $_REQUEST['smstxt'], $sdate, 'AROUND_W', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol7);
    _log($_REQUEST['smstxt'], $sdate, 'AROUND_W', $date, $ip);

    $arrCol8 = array("null", $_REQUEST['smstxt'], $sdate, 'COM_VASWRD', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol8);
    _log($_REQUEST['smstxt'], $sdate, 'COM_VASWRD', $date, $ip);
    echo '1';
  }
  //  else if ($code == 'INAAA') {
  //   $arrCol5 = array("null", $_REQUEST['smstxt'], $sdate, 'INAAA', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
  //   insert("cp_sms", $arrCol5);
  //   _log($_REQUEST['smstxt'], $sdate, 'INAAA', $date, $ip);

  //   $arrCol = array("null", $_REQUEST['smstxt'], $sdate, 'LOCKIN230', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
  //   insert("cp_sms", $arrCol);
  //   _log($_REQUEST['smstxt'], $sdate, 'LOCKIN230', $date, $ip);

  //   $arrCol = array("null", $_REQUEST['smstxt'], $sdate, 'LOCKIN_3', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
  //   insert("cp_sms", $arrCol);
  //   _log($_REQUEST['smstxt'], $sdate, 'LOCKIN_3', $date, $ip);
  //   echo '1';
  // }
  else if ($code == 'ISHOW_BOX') {
    $arrCol5 = array("null", $_REQUEST['smstxt'], $sdate, 'ISHOW_BOX', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol5);
    _log($_REQUEST['smstxt'], $sdate, 'ISHOW_BOX', $date, $ip);

    $arrCol6 = array("null", $_REQUEST['smstxt'], $sdate, 'ISHOW_BOXV', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol6);
    _log($_REQUEST['smstxt'], $sdate, 'ISHOW_BOXV', $date, $ip);
    echo '1';
  } else if ($code == 'MOTH_MON') {
    $arrCol = array("null", $_REQUEST['smstxt'], $sdate, 'MOTH_MON', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol);
    _log($_REQUEST['smstxt'], $sdate, 'MOTH_MON', $date, $ip);

    $arrCol = array("null", $_REQUEST['smstxt'], $sdate, 'MOTH_WEK', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol);
    _log($_REQUEST['smstxt'], $sdate, 'MOTH_WEK', $date, $ip);
    echo '1';
  } else if ($code == 'LIVESA7') {
    $arrCol = array("null", $_REQUEST['smstxt'], $sdate, 'LIVESA7', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol);
    _log($_REQUEST['smstxt'], $sdate, 'LIVESA7', $date, $ip);

    $arrCol = array("null", $_REQUEST['smstxt'], $sdate, 'LOCKIN230', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol);
    _log($_REQUEST['smstxt'], $sdate, 'LOCKIN230', $date, $ip);

    $arrCol = array("null", $_REQUEST['smstxt'], $sdate, 'LOCKIN_3', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol);
    _log($_REQUEST['smstxt'], $sdate, 'LOCKIN_3', $date, $ip);
    echo '1';
  } else if ($code == 'ADGYM_M') {
    $arrCol = array("null", $_REQUEST['smstxt'], $sdate, 'ADGYM_M', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol);
    _log($_REQUEST['smstxt'], $sdate, 'ADGYM_M', $date, $ip);

    $arrCol = array("null", $_REQUEST['smstxt'], $sdate, 'ADGYM_W', 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol);
    _log($_REQUEST['smstxt'], $sdate, 'ADGYM_W', $date, $ip);
    echo '1';
  } else {

    $arrCol9 = array("null", $_REQUEST['smstxt'], $sdate, $code, 'Ar', '', 'not sent', 0, $date, $GLOBALS['ip'], 'not sent');
    insert("cp_sms", $arrCol9);
    _log($_REQUEST['smstxt'], $sdate, $code, $date, $ip);
    echo '1';
  }
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