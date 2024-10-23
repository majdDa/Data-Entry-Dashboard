<?php
date_default_timezone_set("Asia/Damascus"); // set time zone
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function insert($table_name, $values, $columns)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $sql = "insert into `" . $table_name . "`  (";
    for ($i = 0; $i < sizeof($columns); $i++) {
        $sql .= "`" . $columns[$i] . "`" . ',';
    }
    $sql = substr($sql, 0, -1);
    $sql .= ") ";
    $sql .= "VALUES (";

    for ($i = 0; $i < sizeof($values); $i++) {
        $sql .= "?,";
    }
    $sql = substr($sql, 0, -1);
    $sql .= ") ";
    echo $sql;
    try {
        $stmt = $pdo->prepare($sql);
        for ($i = 0; $i < sizeof($values); $i++) {
            $stmt->bindParam($i + 1, $values[$i]);
        }
        //echo $stmt;
        $stmt->execute();
    } catch (Exception $e) {
        throw $e;
    }
}
/*
$columns=array("id","name","population");
$values=array(NULL,"Syria",55210054);
insert("countries",$values,$columns,$types);
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_all($table_name, $condition)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $stm = $pdo->query("select * from $table_name where $condition");
    //echo "select * from $table_name where $condition";
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
/*
$row=get_all("countries","1=1");
foreach($row as $row)
{
	echo $row["id"]." - ".$row["name"]." - ".$row["population"]."<br>";
}
 */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

function get_all_order_by($tb, $cond, $col, $type)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $stm = $pdo->query("SELECT * FROM `" . $tb . "` where $cond order by `" . $col . "` $type");
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}

/*
 $result=get_all_order_by("_chat_c","1=1","id","asc");
 $result=get_all_order_by("_chat_c","1=1","id","desc");
foreach($row as $row)
{
  echo $row["id"]."-".$row["gsm"]."</br>";
 }*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function delete($table_name, $condition)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $nrows = $pdo->exec("delete from $table_name where $condition");
}
/*
delete("countries","id=17");
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update($table_name, $arrCol, $arrVal, $cond)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $sql = "update `" . $table_name . "`  set ";
    for ($i = 0; $i < sizeof($arrCol); $i++) {
        $sql .= $arrCol[$i] . '=' . "'" . $arrVal[$i] . "'" . ",";
    }
    $sql = substr($sql, 0, -1);
    $sql .= " where $cond";
    //echo $sql;
    $pdo->exec($sql);
}
/*
 $val='ayham112';
 $val="'".$val."'";
$arrVal=array($val);
$arrCol=array("name");
update("countries",$arrCol,$arrVal,"id = 1000");
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_count($table_name, $condition)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $stm = $pdo->query("select count(*) as s from $table_name where $condition");
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
/* 
$row=get_count("countries","1=1");
foreach($row as $row)
{
	echo $row["s"]."<br>";
}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_usertype($username)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $stm = $pdo->query("select type from cp_users where`username`='" . $username . "'");
    //echo "select type from cp_users where`username`='" . $username . "'";
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $row;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
function get_user_id($username)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $stm = $pdo->query("select id from cp_users  where `username`='" . $username . "'");
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_mtn_sc($ctg)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $stm = $pdo->query("SELECT mtn_sc FROM `cp_services1` WHERE code ='" . $ctg . "'");
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_ctg_not_sent($dt)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $stm = $pdo->query("select name FROM `cp_services1` WHERE code not in (select ctg from cp_sms where dt like '" . $dt . "%') order by id asc");
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function send_response($gsm, $sms, $op_id)
{
    ini_set('max_execution_time', 60);
    $code = '';
    $m1 = mb_convert_encoding((bin2hex(mb_convert_encoding($sms, 'UCS-2', 'UTF-8'))), 'UCS-2', 'UTF-8');
    $final_sms = iconv('UCS-2', 'UTF-8', $m1);
    $url = '';

    if (!empty($op_id) && !empty($gsm) && !empty($final_sms)) {
        $code = '1253';
        $url = "http://localhost/mt?orig={$code}&dest={$gsm}&msg={$final_sms}&res=N&type=1";
    }
    //echo $url."<br>";
    try {
        $g = file_get_contents($url);
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    return $g;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_count_ctg($cond)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $stm = $pdo->query("SELECT count(DISTINCT ctg) as s FROM `cp_sms` where $cond");
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $row["s"];
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_code($ctg)
{
    $dsn = "mysql:host=localhost;dbname=cp_service_sms";
    $user = "root";
    $passwd = "";
    $pdo = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $stm = $pdo->query("SELECT mtn_code FROM `cp_services1` WHERE code ='" . $ctg . "'");
    $row = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $row['mtn_code'];
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function test_input($data)
{
    $data = str_replace('#', '', $data);
    $data = str_replace('&', '', $data);
    $data = str_replace(';', '', $data);
    $data = str_replace('!', '', $data);
    $data = str_replace('"', '', $data);
    $data = str_replace('$', '', $data);
    $data = str_replace('?', '', $data);
    $data = str_replace('%', '', $data);
    $data = str_replace("'", '', $data);
    $data = str_replace('(', '', $data);
    $data = str_replace(')', '', $data);
    $data = str_replace('*', '', $data);
    $data = str_replace('+', '', $data);
    $data = str_replace(',', '', $data);
    $data = str_replace('/', '', $data);
    $data = str_replace('<', '', $data);
    $data = str_replace('=', '', $data);
    $data = str_replace('>', '', $data);
    $data = str_replace('?', '', $data);
    $data = str_replace('[', '', $data);
    $data = str_replace('\\', '', $data);
    $data = str_replace(']', '', $data);
    $data = str_replace('^', '', $data);
    $data = str_replace('`', '', $data);
    $data = str_replace('{', '', $data);
    $data = str_replace('|', '', $data);
    $data = str_replace('}', '', $data);
    $data = str_replace('~', '', $data);
    $data = str_replace("select", "", $data);
    $data = str_replace("SELECT", "", $data);
    $data = str_replace("update", "", $data);
    $data = str_replace("UPDATE", "", $data);
    $data = str_replace("delete", "", $data);
    $data = str_replace("DELETE", "", $data);
    $data = str_replace("union", "", $data);
    $data = str_replace("UNION", "", $data);
    $data = str_replace("from", "", $data);
    $data = str_replace("FROM", "", $data);
    $data = str_replace("concat", "", $data);
    $data = str_replace("CONCAT", "", $data);
    $data = str_replace("usrnam", "", $data);
    $data = str_replace("passwod", "", $data);
    $data = str_replace("cmslog", "", $data);
    $data = str_replace("drop", "", $data);
    $data = str_replace("DROP", "", $data);
    $data = str_replace(";", "", $data);
    $data = str_replace("--", "", $data);
    $data = str_replace("\0", "", $data);

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function status_update($table_name, $id)
{
    $arrVal = array(1);
    $arrCol = array("status");
    update("$table_name", $arrCol, $arrVal, "id = '" . $id . "'");
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function send_name_log($gsm, $F_name, $F_latter, $S_name, $S_latter, $final_sms, $R_date, $g)
{
    $log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . date("Y-m-d, h:i:s") . PHP_EOL
        . "GSM : " . $gsm . PHP_EOL
        . "First_name : " . $F_name . PHP_EOL
        . "First_latter : " . $F_latter . PHP_EOL
        . "Second_name : " . $S_name . PHP_EOL
        . "Second_latter : " . $S_latter . PHP_EOL
        . "Final_sms : " . $final_sms . PHP_EOL
        . "Receiving Date : " . $R_date . PHP_EOL
        . "Sending Date : " . date("Y-m-d") . PHP_EOL
        . "G : " . $g . PHP_EOL
        . "--------------------" . PHP_EOL;

    file_put_contents('_logs/send/send_' . date("Y-m-d") . '.txt', $log, FILE_APPEND);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function inbox_log($gsm, $msgtxt, $date, $op_id)
{
    $log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . date("Y-m-d, h:i:s") . PHP_EOL
        . "GSM : " . $gsm . PHP_EOL
        . "MSG : " . $msgtxt . PHP_EOL
        . "Date : " . $date . PHP_EOL
        . "OP_ID : " . $op_id . PHP_EOL
        . "--------------------" . PHP_EOL;

    file_put_contents('_logs/recieve/log_receive_' . date("Y-m-d") . '.txt', $log, FILE_APPEND);
}
?>