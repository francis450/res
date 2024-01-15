<?php
session_start();
include_once '../connection.php';
if (isset($_POST['username1']) && isset($_POST['password1']) && isset($_POST['department'])) {
	$department = $_POST['department'];
	$user =  $_POST['username1'];
	$pass =  md5($_POST['password1']);
	$res = mysqli_query($con, "SELECT *  FROM users WHERE username = '$user'  AND password = '$pass' AND status = '1'");

	if (mysqli_num_rows($res) <= 0) {
		$msg = "INCORRECT USERNAME OR PASSWORD";
		echo $msg;
	} else {
		$timed = date('d/m/Y h:i:sa');
		$ress = mysqli_fetch_array($res);
		$username = $ress['username'];
		$identity = $ress['password'];
		$_SESSION['department'] = $department;
		$_SESSION['valid'] = true;
		$_SESSION['username'] = $username;
		$_SESSION['identity'] = $identity;
		$_SESSION['userType'] = $ress['userType'];
		$role = $ress['userType'];
		$activity = "login";

		$gettable = mysqli_query($con, 'select 1 from logs LIMIT 1');
		if ($gettable !== FALSE) {
			mysqli_query($con, "insert into logs(user,activity,role)values('$username','$activity','$role')");
		} else {
			$df = mysqli_query($con, "CREATE TABLE IF NOT EXISTS logs(user varchar(30) NOT NULL, timed varchar(30) NOT NULL, activity varchar(30) NOT NULL, role int(2) NOT NULL, dated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY )");

			if ($df) {
				mysqli_query($con, "insert into logs(user,activity,role)values('$username','$activity','$role')");
			} else {
				echo mysqli_error($con);
			}
		}

		if ($_SESSION['userType'] == 'cashier') {
			// header('location: cashier.php');
			echo "<script>window.location.href = 'cashier.php'</script>";
		} else if ($_SESSION['userType'] == 'server') {
			echo "<script>window.location.href = 'sell.php'</script>";
		}else if ($_SESSION['userType'] == 'admin') {
			echo "<script>window.location.href = 'dashboard.php'</script>";
		}
	}
} else {
	echo "USERNAME OR PASSWORD OR DEPARTMENT NOT ENTERED";
}