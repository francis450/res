<?php
session_start();
include_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['orderId'];
    $payable = doubleval($_POST['payable']);
    $bakii = doubleval($_POST['bakii']);
    $transtype = $_POST['transtype'];
    $cashier = $_SESSION['username']; 
    $amtGiven = $_POST['amtgiven'];

    // Get the current date and time
    $dated = date('Y-m-d');
    $timed = date('H:i:s');

    // Prepare a statement to insert into receipts
    $stmt = $con->prepare("INSERT INTO `receipts`(`receipt`, `amount`, `payable`, `balance`, `transtype`, `dated`, `cashier`) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters to the statement
    $stmt->bind_param("sdddsss", $orderId, $amtGiven, $payable, $bakii, $transtype, $dated, $cashier);

    // Execute the statement
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
}