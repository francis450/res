<?php
session_start();
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $getsuppliers = mysqli_query($con, "select * from purchases where id = '$id'");
    $getsuppliersr = mysqli_fetch_array($getsuppliers);
    $product = array();

    $product['id'] = $getsuppliersr['id'];
    $product['name'] = $getsuppliersr['product'];
    $product['qnty'] = $getsuppliersr['units'];
    $product['smallunit'] = $getsuppliersr['smallunit'];
    $product['bigunit'] = $getsuppliersr['bigunit'];
    $product['unitcost'] = $getsuppliersr['unitcost'];

    echo json_encode($product);
}
