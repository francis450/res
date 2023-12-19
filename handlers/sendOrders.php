<?php
session_start();
include('../connection.php');
function fetchOrders($con)
{
    $query = "SELECT `orderid`, GROUP_CONCAT(`food` SEPARATOR ', ') as `foods`, SUM(`price` * `qnty`) as `total`, orderedAt as `date` FROM `orders` GROUP BY `orderid` ORDER BY date DESC";
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
function sendServerEvent($con)
{
    header("Cache-Control: no-cache");
    header("Content-Type: text/event-stream");
    header('Connection: keep-alive');

    // Start output buffering
    ob_start();

    // Send a single "ping" event.
    echo "event: ping";
    echo "\n\n";

    // Send the data (assuming fetchOrders returns a string)
    echo "data: " . fetchOrders($con) . "\n\n";

    // Flush the output buffer and send data to the client
    ob_flush();
    flush();

    // End output buffering
    ob_end_clean();

    // Close the connection explicitly
    header('Connection: close');
}
$marker = file_get_contents('streaming.txt');

if ($marker === 'start') {
    sendServerEvent($con);
    file_put_contents('streaming.txt','');
}else{
    header("Cache-Control: no-cache");
    header("Content-Type: text/event-stream");
    header('Connection: keep-alive');
    echo "event: ping";
    echo "\n\n";

    echo false;
}