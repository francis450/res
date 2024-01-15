<?php
session_start();
include_once '../connection.php';

if (
	isset($_POST['psupplier']) &&
	isset($_POST['product']) &&
	isset($_POST['productunits']) &&
	isset($_POST['weight']) &&
	isset($_POST['measure']) &&
	// isset($_POST['smallunit']) && 
	// isset($_POST['bigunit']) && 
	isset($_POST['unitcost']) &&
	isset($_POST['totalcost']) &&
	isset($_POST['paid']) &&
	isset($_POST['balance']) &&
	isset($_POST['method'])
) {

	$supplier = $_POST['psupplier'];
	$product = $_POST['product'];
	$units = $_POST['productunits'];
	$weight = $_POST['weight'];
	$measure = $_POST['measure'];
	// $smallunit = $_POST['smallunit'];
	// $bigunit = $_POST['bigunit'];
	$unitcost = $_POST['unitcost'];
	$totalcost = $_POST['totalcost'];
	$paid = $_POST['paid'];
	$balance = $_POST['balance'];
	$method = $_POST['method'];
	$ref = $_POST['ref'];

	if ($measure == 'GRAMS' || $measure == 'MILLILITRES') {
		$smallunit = $units * $weight;
		$bigunit = ($units / 1000) * $weight;
	} else if ($measure == 'KILOGRAMS' || $measure == 'LITRES') {
		$smallunit = ($units * 1000) * $weight;
		$bigunit = $units * $weight;
	}

	$gettable = mysqli_query($con, 'select 1 from purchases LIMIT 1');
	if ($gettable !== FALSE) {
		$q = "insert into purchases(receipt,supplier,product,units,weight,measure,smallunit,bigunit,unitcost,totalcost,paid,balance,method)
								values('$ref','$supplier','$product','$units','$weight','$measure','$smallunit','$bigunit','$unitcost','$totalcost','$paid','$balance','$method')";
		if ($add = mysqli_query($con, $q)) {
			$getptable = mysqli_query($con, 'select 1 from products LIMIT 1');
			if ($getptable !== FALSE) {
				$productexists = mysqli_query($con, "select * from products where product = '$product'");
				if (mysqli_num_rows($productexists) > 0) {
					$updateproduct = mysqli_query($con, "update products set qnty = qnty+'$units',unitcost='$unitcost', smallunit = smallunit+'$smallunit',bigunit=bigunit+'$bigunit' where product = '$product'");
					if ($updateproduct) {
						echo true;
						// echo 'Product has been updated';
						// echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
					} else {
						mysqli_error($con);
						echo false;
					}
				} else {
					$addproducts = mysqli_query($con, "insert into products(product,qnty,unitcost,smallunit,bigunit)values('$product','$units','$unitcost','$smallunit','$bigunit')");
					if ($addproducts) {
						echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
					} else {
						echo mysqli_error($con);
					}
				}
			} else {
				$s = mysqli_query($con, "CREATE TABLE IF NOT EXISTS products(
							  product varchar(60)  NOT NULL UNIQUE,
							  qnty DOUBLE NOT NULL,
							  unitcost DOUBLE NOT NULL,
							  smallunit DOUBLE NOT NULL,
							  bigunit DOUBLE NOT NULL,
							  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
							)");
				if ($s) {
					$addproduct = mysqli_query($con, "insert into products(product,qnty,unitcost,smallunit,bigunit)values('$product','$units','$unitcost','$smallunit','$bigunit')");
					if ($addproduct) {
						echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
						echo "<script>location.replace('main.php');</script>";
					} else {
						echo mysqli_error($con);
					}
				} else {
					echo mysqli_error($con);
				}
			}
			//echo $units.' of '.$product.' by '.$supplier.' has been added';
		} else {
			echo mysqli_error($con);
		}
	} else {
		$r = mysqli_query($con, "CREATE TABLE IF NOT EXISTS purchases(
						  receipt varchar(60)  NOT NULL UNIQUE,
						  supplier varchar(60) NOT NULL,
						  product varchar(60) NOT NULL,
						  units varchar(5) NOT NULL,
						  weight varchar(12) NOT NULL,
						  measure varchar(12) NOT NULL,
						  smallunit varchar(10) NOT NULL,
						  bigunit varchar(10) NOT NULL,
						  unitcost varchar(7) NOT NULL,
						  totalcost varchar(7) NOT NULL,
						  paid varchar(7) NOT NULL,
						  balance varchar(7) NOT NULL,
						  method varchar(60) NOT NULL,
						  description varchar(60) NOT NULL,
						  comment varchar(60) NOT NULL,
						  dated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
						  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
						)");

		if ($r) {
			$add = mysqli_query($con, "insert into purchases(receipt,supplier,product,units,weight,measure,smallunit,bigunit,unitcost,totalcost,paid,balance,method,description,comment)values('$ref','$supplier','$product','$units','$weight','$measure','$smallunit','$bigunit','$unitcost','$totalcost','$paid','$balance','$method','$description','$comment')");
			if ($add) {
				echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
				$getptable = mysqli_query($con, 'select 1 from products LIMIT 1');
				if ($gettable !== FALSE) {
					$productexists = mysqli_query($con, "select * from products where product = '$product'");
					if (mysqli_num_rows($productexists) > 0) {
						$updateproduct = mysqli_query($con, "update products set qnty = qnty+'$units',unitcost='$unitcost', smallunit = smallunit+'$smallunit',bigunit=bigunit+'$bigunit' where product = '$product'");
						if ($updateproduct) {
							echo 'Product has been updated';
							echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
							echo "<script>location.replace('main.php');</script>";
						} else {
							echo mysqli_error($con);
						}
					}
				} else {
					$s = mysqli_query($con, "CREATE TABLE IF NOT EXISTS products(
												  product varchar(60)  NOT NULL UNIQUE,
												  qnty DOUBLE NOT NULL,
												  unitcost DOUBLE NOT NULL,
												  smallunit DOUBLE NOT NULL,
												  bigunit DOUBLE NOT NULL,
												  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
					if ($s) {
						$addproduct = mysqli_query($con, "insert into products(product,qnty,unitcost,smallunit,bigunit)values('$product','$units','$unitcost','$smallunit','$bigunit')");
						if ($addproduct) {
							echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
							echo "<script>location.replace('main.php');</script>";
						} else {
							echo mysqli_error($con);
						}
					} else {
						echo mysqli_error($con);
					}
				}
			} else {
				echo mysqli_error($con);
			}
		} else {
			echo mysqli_error($con);
		}
	}
} else {
	echo "something was not sent";
}
