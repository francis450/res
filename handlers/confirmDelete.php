<?php
session_start();
include('../connection.php');
$responseArray = array();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $orderId = $_GET['orderId'];

    $sql = "SELECT food, qnty, price FROM orders WHERE orderid = '$orderId'";
    if($orders = mysqli_query($con, $sql)){
        while($res = mysqli_fetch_assoc($orders)){
            $responseArray[] = $res;
        }
        echo json_encode($responseArray);
    }
}