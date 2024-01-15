<?php
session_start();
include('connection.php');

if(!isset($_SESSION['username'])){
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>settings</title>
</head>
<body>
    
</body>
</html>