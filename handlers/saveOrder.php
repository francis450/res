<?php
session_start();
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order'])) {
    $order = $_POST['order'];
    $department = $_POST['department'];
    // Decode the JSON string
    $foodItems = json_decode($order, true);
    $currentDateTime = new DateTime();
    $orderid = $currentDateTime->format('YmdHis');
    // echo $orderid;
    // Check if decoding was successful
    if ($foodItems !== null) {
        // Loop through the array of food items
        foreach ($foodItems as $item) {
            // Access individual item properties
            $foodcode = $item['foodcode'];
            $name = $item['name'];
            $quantity = $item['quantity'];
            $price = $item['price'];

            $query = "INSERT INTO `orders`(`orderid`,`department`, `foodcode`, `food`, `price`, `qnty`) 
                    VALUES ('$orderid','$department','$foodcode','$name','$price','$quantity')";
            if (!mysqli_query($con, $query)) {
                echo "Error Saving Order Item";
            } else {
                file_put_contents('streaming.txt', 'start');
            }
        }
    } else {
        // Handle JSON decoding error
        echo "Error decoding JSON";
    }
}

function fetchOrders($con)
{
    $query = "SELECT `orderid`,department GROUP_CONCAT(`food` SEPARATOR ', ') as `foods`, SUM(`price` * `qnty`) as `total` FROM `orders` GROUP BY `orderid`";
    $ordersData = array();

    // Check if the query was successful
    if ($orders = mysqli_query($con, $query)) {
        // Fetch associative array
        while ($order = mysqli_fetch_assoc($orders)) {
            // Add each row to the $ordersData array
            $ordersData[] = $order;
        }

        // Free result set
        mysqli_free_result($orders);

        // Close the connection (you may not want to do this depending on your use case)
        // mysqli_close($con);

        // Set the response header to indicate JSON content
        // header('Content-Type: application/json');

        // Return the data as JSON
        return json_encode($ordersData);
    } else {
        // If the query was not successful, handle the error
        echo json_encode(array('error' => 'Query error: ' . mysqli_error($con)));
    }
}

function sendServerEvent($con)
{
    header("Cache-Control: no-store");
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

// sendServerEvent($con);
