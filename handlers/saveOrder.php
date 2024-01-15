<?php
session_start();
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order']) && isset($_POST['server'])) {
    $order = $_POST['order'];
    $department = $_POST['department'];
    $server = $_POST['server'];
    $table = $_POST['table'];
    $status = 'pending';
    // Decode the JSON string
    $foodItems = json_decode($order, true);
    $uiy = date('Y-m-d H:i:s');
    $long = strtotime($uiy);
    $cartid = rand(1000, 100000) + $long;
    $orderid = $long;

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

            $query = "INSERT INTO `orders`(`orderid`,`department`, `foodcode`, `food`, `price`, `qnty`, `server`,`table`,`status`) 
                    VALUES ('$orderid','$department','$foodcode','$name','$price','$quantity','$server','$table','$status')";
            if (!mysqli_query($con, $query)) {
                echo "Error Saving Order Item";
            } else {
                file_put_contents('streaming.txt', 'start');
                echo true;
            }
        }
    } else {
        // Handle JSON decoding error
        echo "Error decoding JSON";
    }
}