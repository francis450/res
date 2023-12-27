<?php
session_start();
include('../connection.php');
$user = $_SESSION['username'];
// check if its a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // check if the order id is set
    if (isset($_POST['orderId']) && isset($_POST['reason'])) {
        // get the order id
        $orderId = $_POST['orderId'];

        $reason = $_POST['reason'];
        if ($reason != 'success') {
            //Get order details
            // $ordersq = mysqli_query($con, "SELECT `orderid`, `department`, `table`, `foodcode`, `food`, `price`, `qnty`, `orderedAt` FROM `orders` where `orderid` = '$orderId'");
            $ordersq = mysqli_query($con, "SELECT `orderid`, `department`, `table`, GROUP_CONCAT(`food` SEPARATOR ', ') as `foods`, SUM(`price` * `qnty`) as `total`, `orderedAt`, `server` FROM `orders` WHERE `orderid` = '$orderId' GROUP BY `orderid` ORDER BY orderid DESC");
            if (mysqli_num_rows($ordersq)) {
                $order = mysqli_fetch_assoc($ordersq);
                $department = $order['department'];
                $table = $order['table'];
                $desc = $order['foods'];
                $total = $order['total'];
                $server = $order['server'];
                $orderedAt = $order['orderedAt'];
                $reason = $_POST['reason'];
                // store it in cancelledOrders table
                $intocancelled = mysqli_query($con, "INSERT INTO `cancelledorders`(`orderid`, `department`, `table`, `description`, `reason`, `cancelledBy`, `server`, `orderedAt`) 
                                                        VALUES ('$orderId','$department','$table','$desc','$reason','$user','$server','$orderedAt')");
                // delete the order query
                $deleteOrder = "DELETE FROM orders WHERE orderid = '$orderId'";
                // check if the order was deleted
                if ($intocancelled) {
                    if (mysqli_query($con, $deleteOrder)) {
                        echo 'success';
                    }else{
                        echo 'error';
                    }
                } else {
                    echo 'error';
                }
            }
        }else{
            $query = mysqli_query($con, "UPDATE `orders` SET `status`='paid' WHERE orderid = '$orderId'");
            if($query){
                echo "success";
            }else{
                echo 'error';
            }
        }
    } else {
        // return error
        echo 'error';
    }
} else {
    // return error
    echo 'error';
}
