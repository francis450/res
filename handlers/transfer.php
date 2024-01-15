<?php
session_start();
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['product']) && isset($_POST['qnty']) && isset($_POST['smallunit']) && isset($_POST['bigunit']) ) {
	$uiy = date('Y-m-d H:i:s');
    $long = strtotime($uiy);
    $cartid = rand(1000, 100000) + $long;
	$transferid = $long;
	$productid = $_POST['productid'];
	$product = $_POST['product'];
	$qnty = $_POST['qnty'];
	$smallunit = $_POST['smallunit'];
	$bigunit = $_POST['bigunit'];
	$unitcost = $_POST['unitcost'];
	$valuation = $qnty * $unitcost;
	$department = $_POST['department'];

	$iftransfersexist = mysqli_query($con, 'select 1 from transfers LIMIT 1');
	if ($iftransfersexist !== FALSE) {
		$insertintotransfers = mysqli_query($con, "insert into transfers(transferid,productid,product,qnty,unitcost,smallunit,bigunit)values('$transferid','$productid','$product','$qnty','$unitcost','$smallunit','$bigunit')");
		if ($insertintotransfers) {
			$updateproducts = mysqli_query($con, "update products set qnty = qnty-'$qnty' where id = '$productid'");
			if ($updateproducts) {
				$ifkitchenstockexists = mysqli_query($con, 'select 1 from kitchenstock LIMIT 1');
				if ($ifkitchenstockexists !== FALSE) {
					$productexists = mysqli_query($con, "select * from kitchenstock where product = '$product'");
					if (mysqli_num_rows($productexists) > 0) {
						$updateproduct = mysqli_query($con, "update kitchenstock set qnty = qnty+'$units',unitcost='$unitcost', smallunit = smallunit+'$smallunit',bigunit=bigunit+'$bigunit' where product = '$product'");
						if ($updateproduct) {
							echo 'Product has been updated';
							echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
							echo '<script>location.replace("main.php")</script>';
						} else {
							echo mysqli_error($con);
						}
					} else {
						$insertintokitchenstock = mysqli_query($con, "insert into kitchenstock(product,qnty,unitcost,smallunit,bigunit)values('$product','$qnty','$unitcost','$smallunit','$bigunit')");
						if ($insertintokitchenstock) {
							echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
							echo '<script>location.replace("main.php")</script>';
						} else {
							echo mysqli_error($con);
						}
					}
				} else {
					$createkitchenstock = mysqli_query($con, "CREATE TABLE IF NOT EXISTS kitchenstock(
																	  product varchar(60) NOT NULL UNIQUE,
																	  qnty DOUBLE NOT NULL,
																	  unitcost DOUBLE NOT NULL,
																	  smallunit DOUBLE NOT NULL,
																	  bigunit DOUBLE NOT NULL,
																	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
																	)");
					if ($createkitchenstock) {
						$insertintokitchenstock = mysqli_query($con, "insert into kitchenstock(product,qnty,unitcost,smallunit,bigunit)values('$product','$qnty','$unitcost','$smallunit','$bigunit')");
						echo '<script>location.replace("main.php")</script>';
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
	} else {
		$createtransfers = mysqli_query($con, "CREATE TABLE IF NOT EXISTS transfers(
									  transferid varchar(60)  NOT NULL UNIQUE,
									  product varchar(60) NOT NULL,
									  productid varchar(6) NOT NULL,
									  qnty DOUBLE NOT NULL,
									  unitcost DOUBLE NOT NULL,
									  smallunit DOUBLE NOT NULL,
									  bigunit DOUBLE NOT NULL,
									  valuation DOUBLE NOT NULL,
									  dated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
									  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
									)");
		if ($createtransfers) {
			$insertintotransfers = mysqli_query($con, "insert into transfers(transferid,productid,product,qnty,unitcost,smallunit,bigunit)values('$transferid','$productid','$product','$qnty','$unitcost','$smallunit','$bigunit')");
			if ($insertintotransfers) {
				$ifkitchenstockexists = mysqli_query($con, 'select 1 from kitchenstock LIMIT 1');
				if ($ifkitchenstockexists !== FALSE) {
					$productexists = mysqli_query($con, "select * from kitchenstock where product = '$product'");
					if (mysqli_num_rows($productexists) > 0) {
						$updateproduct = mysqli_query($con, "update kitchenstock set qnty = qnty+'$units',unitcost='$unitcost', smallunit = smallunit+'$smallunit',bigunit=bigunit+'$bigunit' where product = '$product'");
						if ($updateproduct) {
							echo 'Product has been updated';
							echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
							echo '<script>location.replace("main.php")</script>';
						} else {
							echo mysqli_error($con);
						}
					} else {
						$insertintokitchenstock = mysqli_query($con, "insert into kitchenstock(product,qnty,unitcost,smallunit,bigunit)values('$product','$qnty','$unitcost','$smallunit','$bigunit')");
						if ($insertintokitchenstock) {
							echo $units . ' of ' . $product . ' by ' . $supplier . ' has been added';
							echo '<script>location.replace("main.php")</script>';
						} else {
							echo mysqli_error($con);
						}
					}
				} else {
					$createkitchenstock = mysqli_query($con, "CREATE TABLE IF NOT EXISTS kitchenstock(
																	  product varchar(60) NOT NULL UNIQUE,
																	  qnty DOUBLE NOT NULL,
																	  unitcost DOUBLE NOT NULL,
																	  smallunit DOUBLE NOT NULL,
																	  bigunit DOUBLE NOT NULL,
																	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
																	)");
					if ($createkitchenstock) {
						$insertintokitchenstock = mysqli_query($con, "insert into kitchenstock(product,qnty,unitcost,smallunit,bigunit)values('$product','$qnty','$unitcost','$smallunit','$bigunit')");
						echo '<script>location.replace("main.php")</script>';
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
}
