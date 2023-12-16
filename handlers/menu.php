<?php
session_start();
include('../connection.php');

if(isset($_POST['category'])){
    $cat = $_POST['category'];
    $itemsquery = "SELECT * FROM menu WHERE category = '$cat'";
    $allitems = mysqli_query($con, $itemsquery);
    $returnArr = array();
    $c = 0;
    while($item = mysqli_fetch_array($allitems)){
        $c++;
        $temp = array();
        $temp['code'] = $item['foodcode'];
        $temp['name'] = $item['food'];
        $temp['price'] = $item['price'];
        $returnArr[] = $temp;
    }

    $res = json_encode($returnArr);
    echo $res;
}