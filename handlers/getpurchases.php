<?php
session_start();
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $allpurchases = mysqli_query($con, "SELECT * FROM purchases ORDER BY dated DESC");
    $purchases = array();
    while ($purchase = mysqli_fetch_array($allpurchases)) {
        $temp = array();
        $temp['receipt'] = $purchase['receipt'];
        $temp['supplier'] = $purchase['supplier'];
        $temp['desc'] = $purchase['units'] * $purchase['weight'] . " " . $purchase['measure'] . ' of ' . $purchase['product'];
        $temp['totalcost'] = $purchase['totalcost'];
        $temp['unitcost'] = $purchase['unitcost'];;
        $temp['paid'] = $purchase['paid'];
        $temp['balance'] = $purchase['balance'];
        $temp['method'] = $purchase['method'];
        $temp['dated'] = $purchase['dated'];
        $purchases[] = $temp;
    }
    echo json_encode($purchases);
}else{
    echo "METHOD NOT ALLOWED";
}
