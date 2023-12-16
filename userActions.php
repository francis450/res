<?php
session_start();
include('connection.php');

if(isset($_POST['action']) && isset($_POST['target'])){
    $action = $_POST['action'];
    $target = $_POST['target'];
    if($action == 'suspend'){
        $que = "UPDATE users SET active = 1 WHERE phone = '$target'";
        if(mysqli_query($con, $que)){
            echo true;
        }
    }
}