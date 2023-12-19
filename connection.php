<?php
date_default_timezone_set('Africa/Nairobi');
$user = 'root';
$password = "";
$db = 'infodata_hotel';

$host = 'localhost';
$con = mysqli_connect("$host", "$user", "$password", "$db");


if (mysqli_connect_error()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



?>