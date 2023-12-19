<?php
session_start();
include('../connection.php');

function fetchOrders($con)
{
    $query = "SELECT `orderid`, GROUP_CONCAT(`food` SEPARATOR ', ') as `foods`, SUM(`price` * `qnty`) as `total`, orderedAt as `date` FROM `orders` GROUP BY `orderid` ORDER BY orderid DESC";
    $ordersData = array();

    // Check if the query was successful
    if ($orders = mysqli_query($con, $query)) {
        // Fetch associative array
        while ($order = mysqli_fetch_assoc($orders)) {
            $ordersData[] = $order;
        }

        mysqli_free_result($orders);
        return json_encode($ordersData);
    } else {
        // If the query was not successful, handle the error
        echo json_encode(array('error' => 'Query error: ' . mysqli_error($con)));
    }
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo fetchOrders($con);
} else {
    // If the request method is not GET, return an error
    echo json_encode(array('error' => 'Invalid request method'));
}