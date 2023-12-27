<?php
session_start();
include('connection.php');

if (isset($_POST['thiscoded'])) {
    $department = $_POST['department'];
    $ingredient = $_POST['thisingredient'];
    $units = $_POST['thisunit'];
    $getcost = mysqli_query($con, "SELECT * FROM products where product = '$ingredient'");
    $fetchcost = mysqli_fetch_array($getcost);
    $cost = number_format($fetchcost['unitcost'] / $units);
    $category = $_POST['category'];
    $measure = $_POST['measure'];
    $foodcode = $_POST['thiscoded'];
    $food = $_POST['food'];
    $code  =  $food . $ingredient;
    // $department = "Restaurant";
    $totalcosts = 0;
    $price = $cost * 1.5;
    $getytable = mysqli_query($con, 'select 1 from ingredients LIMIT 1');
    if ($getytable !== FALSE) {
        $ins = "insert into ingredients(foodcode,food,ingredient,code,units,cost,measure)values('$foodcode','$food','$ingredient','$code','$units','$cost','$measure')";

        if ($insret = mysqli_query($con, $ins)) {
            $getmenutable = mysqli_query($con, 'select 1 from menu LIMIT 1');

            if ($getmenutable !== FALSE) {
                $checkexistence = mysqli_query($con, "SELECT * FROM menu WHERE foodcode = '$foodcode'");
                if (mysqli_num_rows($checkexistence) < 1) {
                    $insertmenu = "insert into menu(food,foodcode,cost,price,department,category)values('$food','$foodcode','$totalcosts','$price','$department','$category')";
                    if ($execc = mysqli_query($con, $insertmenu)) {
                        $retobj = array();
                        $retobj[] = $foodcode;
                        $retobj[] = $food;
                        $retobj[] = $totalcosts;
                        $retobj[] = $price;

                        $returnobj = array('data' => $retobj);
                        echo json_encode($returnobj);
                    }
                } else {
                    $updatecost = mysqli_query($con, "UPDATE menu SET cost = cost + '$cost' where foodcode = '$foodcode'");
                    $updateprice = mysqli_query($con, "UPDATE menu SET price = cost*1.5 where foodcode = '$foodcode'");
                }
            } else {
                $intomenu = mysqli_query($con, "CREATE TABLE IF NOT EXISTS menu(
											foodcode varchar(60)  NOT NULL UNIQUE,
											food varchar(60)  NOT NULL UNIQUE,
											department varchar(60) NOT NULL,
											cost DOUBLE NOT NULL,
											price DOUBLE NOT NULL,
											id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");

                if ($intomenu) {
                    $insertmenu = mysqli_query($con, "insert into menu(food,foodcode,cost,price,department)values('$food','$foodcode','$totalcosts','$price','$department')");
                }
            }
            echo 'inserted';
        } else {
            echo mysqli_error($con);
            echo $ingredient . " ADDED SUCCESSFULLY";
        }
    } else {
        $s = mysqli_query($con, "CREATE TABLE IF NOT EXISTS ingredients(
												  foodcode varchar(60)  NOT NULL,
												  food varchar(60)  NOT NULL,
												  ingredient varchar(60) NOT NULL,
												  code varchar(60) NOT NULL UNIQUE,
												  units DOUBLE NOT NULL,
												  cost DOUBLE NOT NULL,
												  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
        if ($s) {
            $insret = mysqli_query($con, "insert into ingredients(foodcode,food,ingredient,code,units,cost,measure)values('$foodcode','$food','$ingredient','$code','$units','$cost','$measure')");
            if ($insret) {
                $getmenutable = mysqli_query($con, 'select 1 from menu LIMIT 1');
                if ($getmenutable !== FALSE) {
                    $insertmenu = mysqli_query($con, "insert into menu(food,foodcode,cost,price,department)values('$food','$foodcode','$totalcost','$price','$department')");
                } else {
                    $intomenu = mysqli_query($con, "CREATE TABLE IF NOT EXISTS menu(
											foodcode varchar(60)  NOT NULL UNIQUE,
											food varchar(60)  NOT NULL UNIQUE,
											department varchar(60) NOT NULL,
											cost DOUBLE NOT NULL,
											price DOUBLE NOT NULL,
											id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");

                    if ($intomenu) {
                        $insertmenuu = mysqli_query($con, "insert into menu(food,foodcode,cost,price,department)values('$food','$foodcode','$totalcost','$price','$department')");
                    }
                }
                echo 'inserted';
            } else {
                echo mysqli_error($con);
            }
        } else {
            echo mysqli_error($con);
        }
    }
}
