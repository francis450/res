<?php
session_start();
include('connection.php');
$decodedData;
if(isset($_POST['editedData'])){
    // Get the JSON data from the POST variable 'editedData'
    $payload = $_POST['editedData'];
    $err = array();
    $success = array();
    
    // Decode the JSON data
    $data = json_decode($payload, true);
    
    // Access Updated Food Data
    $foodObject = $data[0];
    $code = $foodObject['code'];
    $foodName = $foodObject['food'];
    $category = $foodObject['category'];
    $department = $foodObject['department'];
    $price = $foodObject['price'];
    
    $updatefood = "UPDATE menu SET `food`='$foodName',`category`='$category',`department`='$department',`price`='$price' WHERE foodcode='$code'";
    if(!mysqli_query($con, $updatefood)){
        mysqli_error($con);
        $err[] = "Invalid Details Added on ".$foodName;
    }else{
        $success[] = $foodName." Updated Successfully";
    }
    $c = count($data);
    // Access the different objects
    for($i=0; $i < count($data); $i++){
        $ingredientObject = $data[$i];
        $ingredientName = $ingredientObject['ingredient'];
        $units = $ingredientObject['units'];
        $measure = $ingredientObject['measure'];
        $cost = $ingredientObject['cost'];
        
        $updateingredient = "UPDATE ingredients SET
        `units`='$units',`measure`='$measure',`cost`='$cost' WHERE foodcode = '$code' AND ingredient = '$ingredientName'";
        if(!mysqli_query($con, $updateingredient)){
            mysqli_error($con);
            $err[] = "Invalid Details Added on ".$ingredientName;
        }else{
            $success[] = $ingredientName." Updated Successfully";
        }
    }
    if(count($err) > 0){
        for($i = 0; $i < count($err); $i++){
            echo $err[$i];
        }
    }else{
        for($i = 0; $i < count($success); $i++){
            echo $success[$i];
        }
    }
}

if(isset($_POST['foodcoding'])){
    $foodcoding = $_POST['foodcoding'];
    $data = array();
    $sql = "SELECT * FROM ingredients where foodcode = '$foodcoding'";
    $result = mysqli_query($con, $sql);
    
    $frommenu = "SELECT * FROM menu where foodcode = '$foodcoding'";
    $fromenu = mysqli_query($con, $frommenu);
    if (!$result) {
        die("SQL query failed: " . mysqli_error($con));
    }
    $inmenu = mysqli_fetch_assoc($fromenu);
    $menu = array(
        "code" => $inmenu['foodcode'],
        "food" => $inmenu['food'],
        "category" => $inmenu['category'],
        "department" => $inmenu['department'],
        "price" => $inmenu['price'],
    );
    
    $data[] = $menu;
    
    // Fetch and format the data
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $entry = array(
            
    //         "ingredient" => $row['ingredient'],
    //         "units" => $row['units'],
    //         "measure" => $row['measure'],
    //         "cost" => $row['cost'],
    //     );
    
    //     // Add the formatted entry to the data array
    //     $data[] = $entry;
    // }
    
    // Encode the data array as JSON
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    
    // Output the JSON data
    echo $jsonData;
}