<?php
session_start();
include('../connection.php');

// check request method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the table name and department id
    $table = $_POST['table'];
    $department_id = $_POST['department'];
    
    // use department_id to get department name
    $sql = "SELECT department FROM departments WHERE dept_id = '$department_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $department = $row['department'];

    // check if table already exists
    $sql = "SELECT * FROM tables WHERE `table` = '$table' AND department = '$department'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo 'ERROR: DEPARTMENT ALREADY EXISTS';
    } else {
        // insert table into database
        $sql = "INSERT INTO tables (`table`, `department`) VALUES ('$table', '$department')";
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