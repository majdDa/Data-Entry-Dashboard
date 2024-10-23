<?php
include '_config11.php';
//date_default_timezone_set("Asia/Damascus");
function get_all($tb, $cond)
{
     $sql = "SELECT * FROM `" . $tb . "` where $cond";
     // echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);

     if ($result->num_rows > 0) {
          return $result;
     } else {
          return $result;
     }

     $GLOBALS['conn']->close();
}

/*
  $result=get_all("cp_actegory","1=1");
 //$result=get_all("_chat_c","id=1");
 while($row = $result->fetch_assoc())
 {
  echo $row["name"]."</br>";
 }
 */


//  function check_value_exist($tb,$cond)
//  {
//     $sql = "SELECT * FROM `".$tb."` where $cond";
//      //echo $sql;
//     $GLOBALS['conn']->query("SET NAMES utf8");  
// 	$result = $GLOBALS['conn']->query($sql);

// 	if ($result->num_rows > 0) 
// 	{
// 	 return true;
// 	}
// 	else
// 	{
// 	 return false;
// 	}

// $GLOBALS['conn']->close();
//  }

function get_all_order_by($tb, $cond, $col, $type)
{

     $sql = "SELECT * FROM `" . $tb . "` where $cond order by `" . $col . "` $type";
     //echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);


     if ($result->num_rows > 0) {
          return $result;
     }

     $GLOBALS['conn']->close();
}

/*
 $result=get_all_order_by("_chat_c","1=1","id","asc");
 $result=get_all_order_by("_chat_c","1=1","id","desc");
 while($row = $result->fetch_assoc())
 {
  echo $row["id"]."-".$row["gsm"]."</br>";
 }
 
 */

/////////////////////////////////////////////////////////////////

function insert($tb, $arrCol)
{

     $sql = "insert into `" . $tb . "` values (";
     for ($i = 0; $i < sizeof($arrCol); $i++) {
          $sql .= "'" . $arrCol[$i] . "'" . ',';
     }
     $sql = substr($sql, 0, -1);
     $sql .= ")";
     //echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);


     $GLOBALS['conn']->close();
}
/*
$arrCol=array("null",1,"963955411233",0);
insert("_chat_c",$arrCol);
*/

/////////////////////////////////////////////////////////////////

function update($tb, $arrCol, $arrVal, $cond)
{

     $sql = "update `" . $tb . "` set ";
     for ($i = 0; $i < sizeof($arrCol); $i++) {
          $sql .= $arrCol[$i] . '=' . $arrVal[$i] . ",";
     }
     $sql = substr($sql, 0, -1);
     $sql .= " where $cond";
     echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);


     // $GLOBALS['conn']->close();
}

/*
$arrVal=array(1,"963955411233",0);
$arrCol=array("ch_id","gsm","chat_type");
update("_chat_c",$arrCol,$arrVal,"id = 1");
*/


/////////////////////////////////////////////////////////////////

function delete($tb, $cond)
{

     $sql = "delete from `" . $tb . "` where $cond";
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);


     $GLOBALS['conn']->close();
}


//delete("_chat_c","id = 7");


/////////////////////////////////////////////////////////////////

function get_count($tb, $cond)
{

     $sql = "select count(*) as s from `" . $tb . "` where $cond";
     //echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);
     $row = $result->fetch_assoc();
     return $row["s"];



     $GLOBALS['conn']->close();
}

/*
$count=get_count("_chat_c","1=1");
echo $count;

*/

function get_count_ctg($cond)
{

     $sql = "SELECT count(DISTINCT ctg) as s FROM `cp_sms` where $cond";
     //echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);
     $row = $result->fetch_assoc();
     return $row["s"];



     $GLOBALS['conn']->close();
}


function get_ctg_not_sent($dt)
{

     $sql = "SELECT name FROM `cp_services1` WHERE code not in (select ctg from cp_sms where dt like '" . $dt . "%') order by id asc";
     //echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);
     //$row = $result->fetch_assoc();
     return $result;



     $GLOBALS['conn']->close();
}


function get_code($ctg)
{

     $sql = "SELECT mtn_code FROM `cp_services1` WHERE code ='" . $ctg . "'";
     //echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);
     $row = $result->fetch_assoc();
     return $row['mtn_code'];

     $GLOBALS['conn']->close();
}



function get_mtn_sc($ctg)
{

     $sql = "SELECT mtn_sc FROM `cp_services1` WHERE code ='" . $ctg . "'";
     //echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);
     $row = $result->fetch_assoc();
     return $row['mtn_sc'];

     $GLOBALS['conn']->close();
}

function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}


function get_usertype($username)
{

     $sql = "select type from cp_users  where `username`='" . $username . "'";
     //echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);
     $row = $result->fetch_assoc();
     return $row["type"];



     $GLOBALS['conn']->close();
}



function get_user_id($username)
{
     $sql = "select id from cp_users  where `username`='" . $username . "'";
     //echo $sql;
     $GLOBALS['conn']->query("SET NAMES utf8");
     $result = $GLOBALS['conn']->query($sql);
     $row = $result->fetch_assoc();
     return $row["id"];
}

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