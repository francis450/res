<?php
session_start();
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['department']) && isset($_POST['category'])) {
    // category to uppercase
    $category = strtoupper($_POST['category']);
    $department = strtoupper($_POST['department']);

    $sql = "INSERT INTO `categories`(`department`, `category`) VALUES ('$department','$category')";

    if (mysqli_query($con, $sql)) {
        echo true;
    } else {
        echo false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['department'])) {
    $department  = $_GET['department'];
    if ($department != 'Department') {
        $sql = mysqli_query($con, "SELECT category FROM categories WHERE department = '$department'");
        $html = '';
        while ($category = mysqli_fetch_array($sql)) {
            $html .= '<option value="'.$category['category'].'">'.$category['category'].'</option>';
        }
        echo $html;
    }
}
