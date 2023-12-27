<?php
session_start();
include('../connection.php');

// check request method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the department name
    $department = $_POST['department'];

    // check if it already exists
    $sql = "SELECT * FROM departments WHERE department = '$department'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo 'ERROR: DEPARTMENT ALREADY EXISTS';
    } else {
        // insert into database
        $sql = "INSERT INTO departments (department) VALUES ('$department')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

} else {
    echo 'Something went wrong';
}