<?php
date_default_timezone_set("Asia/Kuwait");
function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


$GLOBALS['ip'] = get_client_ip();
if ($ip = '::1') {
    $GLOBALS['_servername'] = "localhost";
    $GLOBALS['_username'] = "root";
    $GLOBALS['_password'] = "";
    $GLOBALS['_dbname'] = "cp_service_sms";
    $GLOBALS['conn'] = new mysqli($GLOBALS['_servername'], $GLOBALS['_username'], $GLOBALS['_password'], $GLOBALS['_dbname']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        mysql_error();
    }
} else {
    echo '<script>window.location="./";</script>';
}
