<?php
include '../../_inc/__fun.php';
//include '../../_inc/functions.php';
$date = date('Y-m-d h:s:i');
//$ip=$GLOBALS['ip'];
$id = $_REQUEST["id"];

$str_services = ['SCP-RATCH', 'SCP-OXXCH', 'SCP-TIGCH', 'SCP-RABCH', 'SCP-DRACH', 'SCP-SNACH', 'SCP-HORCH', 'SCP-GOACH', 'SCP-MONCH', 'SCP-ROOCH', 'SCP-DOGCH', 'SCP-PIGCH'];


$res_sms = get_all("cp_sms", "id='" . $id . "'");
foreach ($res_sms as $row_sms) {
    if (in_array($code, $str_services)) {

        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "id='" . $_REQUEST['id'] . "'");
        //ChineseHoroscope_to_59($_REQUEST['smstxt'], $sdate = $_REQUEST['sdate'], $code = '', $date, $id, $fun = 'update');

        echo '1';
    } else if ($_REQUEST['code'] == 'SABAYA_1' || $_REQUEST['code'] == 'SABAYA_2' || $_REQUEST['code'] == 'SABAYA_1_F' || $_REQUEST['code'] == 'SABAYA_2_F') {
        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "ctg='SABAYA_1' and dt='" . $row_sms['dt'] . "'");

        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "ctg='SABAYA_2' and dt='" . $row_sms['dt'] . "'");

        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "ctg='SABAYA_1_F' and dt='" . $row_sms['dt'] . "'");

        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "ctg='SABAYA_2_F' and dt='" . $row_sms['dt'] . "'");

        echo '1';
    } else if ($_REQUEST['code'] == 'TOP_APP' || $_REQUEST['code'] == 'COM_VASAPP') {
        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "ctg='TOP_APP' and dt='" . $row_sms['dt'] . "'");

        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "ctg='COM_VASAPP' and dt='" . $row_sms['dt'] . "'");
        echo '1';
    } else if ($_REQUEST['code'] == 'AROUND_W' || $_REQUEST['code'] == 'COM_VASWRD') {
        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "ctg='AROUND_W' and dt='" . $row_sms['dt'] . "'");

        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "ctg='COM_VASWRD' and dt='" . $row_sms['dt'] . "'");
        echo '1';
    } else {
        $arrVal = array($_REQUEST['smstxt'], $_REQUEST['sdate'], $date);
        $arrCol = array("mtxt", "dt", "ins_date");
        update("cp_sms", $arrCol, $arrVal, "id='" . $_REQUEST['id'] . "'");
        echo '1';
    }
}
