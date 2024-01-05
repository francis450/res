<?php
session_start();
include_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];
    $data = $_POST['data'];

    $department = strtoupper($item['department']);
    $food = strtoupper($item['fooditem']);
    $category = strtoupper($item['foodcategory']);
    $price = $item['price'];
    // get department code
    $deprcodequery = "SELECT `id` FROM `departments` WHERE `department` = '$department'";
    $deprcoderesult = mysqli_query($con, $deprcodequery);
    $deprcoderow = mysqli_fetch_assoc($deprcoderesult);
    $deprcode = $deprcoderow['id'];

    // get category id
    $categorycodequery = "SELECT `id` FROM `categories` WHERE `category` = '$category'";
    $categorycoderesult = mysqli_query($con, $categorycodequery);
    $categorycoderow = mysqli_fetch_assoc($categorycoderesult);
    $categorycode = $categorycoderow['id'];

    $foodcode = strtoupper(substr($food, 0, 1)).$deprcode.$categorycode;

    $itemquery = "INSERT INTO `menu`(`foodcode`, `food`, `category`, `department`, `cost`, `price`) 
                            VALUES ('$foodcode','$food','$category','$department','0','$price')";
    for($i = 0; $i < count($data); $i++) {
        $ingredient = $data[$i]['ingredient'];
        $code = $ingredient.$food;
        $units = $data[$i]['units'];
        $measure = $data[$i]['measure'];
        $ingquery = "INSERT INTO `ingredients`(`foodcode`, `food`, `ingredient`, `code`, `units`, `measure`, `cost`) 
                                        VALUES ('$foodcode','$food','$ingredient','$code','$units','$measure','0')";
        mysqli_query($con, $ingquery);
    }
    // foreach ($data as $row) {
    //     // echo "Ingredient: " . $row['ingredient'] . ", Units: " . $row['units'] . ", Measure: " . $row['measure'] . "\n";
    //     $ingredient = $row['ingredient'];
    //     $code = $ingredient.$food;
    //     $units = $row['units'];
    //     $measure = $row['measure'];
    //     $ingquery = "INSERT INTO `ingredients`(`foodcode`, `food`, `ingredient`, `code`, `units`, `measure`, `cost`) 
    //                                     VALUES ('$foodcode','$food','$ingredient','$code','$units','$measure','0')";
    // }
    if(mysqli_query($con, $itemquery)){
        echo "Item saved successfully";
    } else {
        echo "Error: " . $itemquery . "<br>" . mysqli_error($con);
    }
} else {
    echo "Invalid request method.";
}
?>
