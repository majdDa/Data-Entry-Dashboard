<?php

session_start();
include '../../_inc/__fun.php';
$date = date('Y-m-d h:s:i');
$ip = get_client_ip();
$uss = $_POST['uss'];
$_SESSION['csrf_token'] = $_POST["token"];

if ($_POST["token"] == '') {
	echo '-7';
} else {
	$row = get_all("cp_users", "user_name='" . test_input($_POST['uss']) . "' and password='" . test_input($_POST['pss']) . "'");
	if (sizeof($row) == 1) {
		foreach ($row as $row) {
			$_SESSION['id'] = $row["id"];
			$_SESSION['uname'] = $row["username"];
			echo '1';
		}
	} else {
		echo '0';
	}
}
	
/*if ($_POST["token"]=='') {
	echo '-7';
} else {
	if ( $_POST['uss'] == 'ef1ac1b94f5ced0f0ee5fb3b19d4c4390297f9a85bd02ad7be7bbcc33938fdb7' ||
	$_POST['uss'] == 'fbe039feccb4575bdf2ce2ec7beaa88d0956629ec894ab6c1460bc1090b06724' || $_POST['uss'] == '7cf696d083a7cb168de412f0d27bd548d1888b9143c7c699cf4bf387dc5210ee'
	 ) {
		$row = get_all("cp_users", "user_name='" . test_input($_POST['uss']) . "' and password='" . test_input($_POST['pss']) . "'");
		if (sizeof($row) == 1) {
			foreach ($row as $row) {
				$_SESSION['id'] = $row["id"];
				$_SESSION['uname'] = $row["username"];
				echo '1';
			}
		} else {
			echo '0';
		}
	} else {
		$row = get_all("cp_users", "user_name='" . test_input($_POST['uss']) . "' and password='" . test_input($_POST['pss']) . "' and ip='" . $ip . "'");
		if (sizeof($row) == 1) {
			foreach ($row as $row) {
				$_SESSION['id'] = $row["id"];
				$_SESSION['uname'] = $row["username"];
				echo $_SESSION['id'];
			}
		} else {
			echo '0';
		}
	}
	$log = "Date :" . $_SERVER['REMOTE_ADDR'] . '-' . date("F j, g:i a") . PHP_EOL .
		"username : " . $_POST['uss'] . PHP_EOL .
		"password : " . $_POST['pss'] . PHP_EOL .
		"ip: " . $ip . PHP_EOL .
		"date : " . $date . PHP_EOL .
		"--------------------" . PHP_EOL;
	file_put_contents('../../logs/login/login_' . date("j.n.Y") . '.txt', $log, FILE_APPEND);
}*/