<?php
session_start();
include('../connection.php');
date_default_timezone_set('Africa/Nairobi');


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['date'])) {
    $date = mysqli_real_escape_string($con, $_GET['date']);

    if ($date == 'today') {
        $sql = mysqli_query($con, "SELECT `orderid`, `department`, `table`, `foodcode`, `food`, `price`, `qnty`, `orderedAt`, `server`, `status` FROM `orders` WHERE DATE(`orderedAt`) = DATE(NOW())");
    } else if ($date == 'week') {
        $sql = mysqli_query($con, "SELECT `orderid`, `department`, `table`, `foodcode`, `food`, `price`, `qnty`, `orderedAt`, `server`, `status` FROM `orders` WHERE DATE(`orderedAt`) >= DATE(NOW() - INTERVAL 7 DAY) AND DATE(`orderedAt`) <= DATE(NOW())");
    } else if ($date == 'month') {
        $sql = mysqli_query($con, "SELECT `orderid`, `department`, `table`, `foodcode`, `food`, `price`, `qnty`, `orderedAt`, `server`, `status` FROM `orders` WHERE MONTH(`orderedAt`) = MONTH(NOW()) AND YEAR(`orderedAt`) = YEAR(NOW())");
    } else if ($date == 'year') {
        $sql = mysqli_query($con, "SELECT `orderid`, `department`, `table`, `foodcode`, `food`, `price`, `qnty`, `orderedAt`, `server`, `status` FROM `orders` WHERE YEAR(`orderedAt`) = YEAR(NOW())");
    } else {
        // Handle invalid or unspecified date cases
        die('Invalid date parameter');
    }

    $data = array();
    while ($response = mysqli_fetch_array($sql)) {
        $temp = array();
        $temp['orderid'] = $response['orderid'];
        $temp['department'] = $response['department'];
        $temp['table'] = $response['table'];
        $temp['foodcode'] = $response['foodcode'];
        $temp['food'] = $response['food'];
        $temp['price'] = $response['price'];
        $temp['qnty'] = $response['qnty'];
        $temp['orderedAt'] = $response['orderedAt'];
        $temp['server'] = $response['server'];
        $data[] = $temp;
    }
    echo json_encode($data);
} else {
    echo "INVALID REQUEST METHOD OR PARAMETER";
}
