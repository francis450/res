<?php
session_start();
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];
    $query = "SELECT * FROM orders where orderid = '$orderid'";
    $orderArray = array();
    if($orders = mysqli_query($con, $query)){
        while($order = mysqli_fetch_array($orders)){
            $orderArray[] = $order;
        }
        echo json_encode($orderArray);
    }
}else{

}