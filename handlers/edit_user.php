<?php
session_start();
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    if ($_POST['status'] == 'on') {
        $status = 1;
    } else {
        $status = 0;
    }

    $sql = "UPDATE users SET email='$email', phone='$phone', userType='$role', status='$status' WHERE username='$username'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        echo true;
    } else {
        echo false;
    }
}
