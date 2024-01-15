<?php
session_start();
include('../connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $query = "UPDATE users SET status = '$status' WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        if ($result) {
            $data = array();
            $row = mysqli_fetch_assoc($result);
            $data[] = $row['username'];
            $data[] = $row['userType'];
            $data[] = $row['status'];
            $data[] = $row['email'];
            $data[] = $row['phone'];

            echo json_encode($data);
        } else {
            echo 'error';
        }
    } else {
        $query = "SELECT * FROM users";
        $result = mysqli_query($con, $query);

        if (!$result) {
            die("Database query failed: " . mysqli_error($con));
        }

        $userData = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $temp = array();
            $temp[] = strtoupper($row['fullname']);
            $temp[] = $row['email'];
            $temp[] = $row['phone'];
            $temp[] = strtoupper($row['userType']);
            if ($row['status'] == 1) {
                $temp[] = '<span class="badge bg-success">Active</span>';
            } else {
                $temp[] = '<span class="badge bg-danger">Inactive</span>';
            }
            $temp[] = $row['id'];
            $userData[] = $temp;
        }

        mysqli_close($con);

        header('Content-Type: application/json');

        $return_array = array('data' => $userData);
        echo json_encode($return_array);
    }
}
