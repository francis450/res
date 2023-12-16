<?php
session_start();
// Include your database connection code here (e.g., connect to your MySQL database)
include('connection.php');
// Assuming you have already connected to the database





// Perform a query to retrieve user data
$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);

if (!$result) {
    // Handle the database error if the query fails
    die("Database query failed: " . mysqli_error($con));
}

// Create an array to store the user data
$userData = array();

// Fetch and store the user data in the array
while ($row = mysqli_fetch_assoc($result)) {
    $temp = array();
    $temp[] = $row['fullname'];
    $temp[] = $row['email'];
    $temp[] = $row['phone'];
    if($row['active'] == 1){
        $temp[] = 'd-none';
        $temp[] = '';
    }else{
        $temp[] = '';
        $temp[] = 'd-none';
    }
    
    if($row['role'] == 1){
        $temp[] = 'd-none';
    }else{
        $temp[] = '';
    }
    $userData[] = $temp;
}

// Close the database connection
mysqli_close($con);

// Set the content type to JSON
header('Content-Type: application/json');

// Return the user data as JSON
$return_array = array('data'=>$userData);
echo json_encode($return_array);
// echo json_encode($userData);
?>
