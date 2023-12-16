<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');

$username  = 'Ad';
$role = "User";
if(isset($_POST['codetodelete'])){
    $codetodelete = $_POST['codetodelete'];
    $itemquery = "SELECT * FROM menu where foodcode = '$codetodelete'";
    if($itemq = mysqli_query($con, $itemquery)){
        $theitem = mysqli_fetch_array($itemq);
        $item = $theitem['food'];
        $cost = $theitem['cost'];
        $price = $theitem['price'];
        $insertintodel = "INSERT INTO deletedfrommenu(`code`, `item`, `cost`, `price`) VALUES ('$codetodelete','$item',$cost,$price)";
        if(mysqli_query($con, $insertintodel)){
            //DELETE THE ITEM
            $delete = mysqli_query($con, "DELETE from menu where foodcode = '$codetodelete'");
            if($delete){
                mysqli_query($con, "INSERT INTO logs(`user`, `activity`, `role`) VALUES ('$username','DELETED $item','$role')");
                echo true;
            }else{
                mysqli_error($con);
            }
        }else{
            mysqli_error($con);
        }
    }else{
        mysqli_error($con);
    }
}
if(isset($_POST['foodfor'])){
    $food = $_POST['foodfor'];
    $response = array();
    if($cat = mysqli_query($con, "SELECT * FROM menu where food = '$food'")){
        $category = mysqli_fetch_array($cat);
        $response['foodcode'] = $category['foodcode'];
        $response['category'] = $category['category'];
    }else{
        $response['foodcode'] = '';
        $response['category'] = '';
    }
    
    $res = json_encode($response);
    echo $res;
}

if(isset($_POST['secondTdData'])){
    $code = $_POST['secondTdData'];
    $results = [];
    $ing = mysqli_query($con, "SELECT * FROM ingredients where foodcode =  '$code'");
    while($ingredient = mysqli_fetch_array($ing)){
        $result = [];
        $result[] = $ingredient['ingredient'];
        $result[] = $ingredient['units'];
        $result[] = $ingredient['measure'];
        $result[] = $ingredient['cost'];
        $results[] = $result;
    }
    
    echo json_encode($results);
}

if(isset($_POST['suppliername'])){
    $suppliername = $_POST['suppliername'];
    
    $qu = "INSERT INTO suppliers(fullname)values('$suppliername')";
    
    if(mysqli_query($con,$qu)){
        $allsuppliers = mysqli_query($con, "SELECT * FROM suppliers ORDER BY fullname ASC");
        while($supplier = mysqli_fetch_array($allsuppliers)){
            echo '<option value="'.$supplier['fullname'].'">'.$supplier['fullname'].'</option>';
        }
    }else{
        mysqli_error($con);
    }
}

if(isset($_POST['productname'])){
    $productname = $_POST['productname'];
    
    $qu = "INSERT INTO brands(brand)values('$productname')";
    // var_dump($qu);
    if(mysqli_query($con,$qu)){
        $allsuppliers = mysqli_query($con, "SELECT * FROM brands ORDER BY brand ASC");
        // var_dump($allsuppliers);
        while($supplier = mysqli_fetch_array($allsuppliers)){
            echo '<option value="' . $supplier['brand'] . '">' . $supplier['brand'] . '</option>';
        }
    }else{
        mysqli_error($con);
    }
}