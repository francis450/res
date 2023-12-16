<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');
if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['phone'])&&isset($_POST['email'])&&isset($_POST['fullname'])){
	  
           $password = $_POST['password']; 
		   $username =$_POST['username']; 
		   $fullname = $_POST['fullname'];
		   $phone = $_POST['phone'];
		   $email = $_POST['email'];
		   $pass = md5($password);
		   $role = 0;
		   $active = 1;
		   
		   $gettable = mysqli_query($con,'select 1 from users LIMIT 1');
		   if($gettable !== FALSE)
			{
			   $add = mysqli_query($con,"insert into users(fullname,username,password,phone,email,role,active)values('$fullname','$username','$pass','$phone','$email','$role','$active')");
			   if($add){
				   echo $username.' HAS BEEN ADDED SUCCESSFULLY';
				   header('Location: main.php');
			   }else{
				   mysqli_error($con);
				   echo "AN ERROR OCCURED WHILE REGISTERING. PLEASE TRY AGAIN";
			   }
			}
			else
			{
				$r = mysqli_query($con,"CREATE TABLE IF NOT EXISTS users (
						  fullname varchar(60) NOT NULL,
						  username varchar(30) NOT NULL UNIQUE,
						  password varchar(125) NOT NULL,
						  email varchar(30) NOT NULL UNIQUE,
						  phone varchar(30) NOT NULL UNIQUE,
						  role int(2) NOT NULL,
						  active  int(2) NOT NULL,
						  dated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
						  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
						)");
						
						if($r){
							 $add = mysqli_query($con,"insert into users(fullname,username,password,phone,email,role,active)values('$fullname','$username','$pass','$phone','$email','$role','$active')");
			   if($add){
				   echo $username.' has been added successifully';
			   }else{
				   echo mysqli_error($con);
			   }
						}else{
						echo mysqli_error($con);	
						}
			}
		   
}


if(isset($_POST['username1'])&&isset($_POST['password1'])){
   $user =  $_POST['username1'];
   $pass =  md5($_POST['password1']);
    $res = mysqli_query($con,"SELECT *  FROM users WHERE username = '$user'  AND password = '$pass' AND active = '1'");
                    
                    if(mysqli_num_rows($res) <= 0) {
                       $msg ="INCORRECT USERNAME OR PASSWORD";
					   echo $msg;
					    
                    } else {
						$timed = date('d/m/Y h:i:sa');
						
						
						
                       $ress = mysqli_fetch_array($res);
                       $name = $ress['username'];
                       $identity = $ress['password'];
                       $gg = $ress['role'];
                       $_SESSION['valid'] = true;
                       $_SESSION['username'] = $user;
                       $_SESSION['identity'] = $identity;
                       $msg = 'Welcome '.$user;
					   
					   $activity = "login";
					   
                       if($gg == 1){
                           
						   $activity = "login";
						   $role=$gg;
						   mysqli_query($con,"insert into logs(user,activity,role,timed)values('$user','$activity','$role','$timed')");
						  // header("Location: main.php");
						  //echo $msg;
						  //header("Location: backups-daily.php?id=dashboard");
						  echo '<script>location.replace("backups-daily.php?id=dashboard");</script>';
                       }else if($gg == 2){
                            $activity = "login";
						   $role=$gg;
						   	   mysqli_query($con,"insert into logs(user,activity,role,timed)values('$user','$activity','$role','$timed')");
						   echo $msg;
						    //header("Location: backups-daily.php?id=main");
						   echo '<script>location.replace("backups-daily.php?id=sell");</script>';
						  
                       }
					   $gettable = mysqli_query($con,'select 1 from logs LIMIT 1');
						if($gettable !== FALSE)
						{   
						    $er = "SELECT *  FROM users WHERE username = '$user'  AND password = '$pass' AND active = '1'";
						    $r = mysqli_query($con,$er);
							$ree = mysqli_fetch_array($r);
							$role = $ree['role'];
							$activity = "login";
							mysqli_query($con,"insert into logs(user,activity,role)values('$user','$activity','$role')");	
						}else{
							$df = mysqli_query($con,"CREATE TABLE IF NOT EXISTS logs(
								  user varchar(30) NOT NULL,
								  timed varchar(30) NOT NULL,
								  activity varchar(30) NOT NULL,
								  role int(2) NOT NULL,
								  
								  dated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
								  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
								)");
								
								if($df){
								   $activity = "login";
								   $re = mysqli_fetch_array($res);
							$role = $re['role'];
							      mysqli_query($con,"insert into logs(user,activity,role)values('$user','$activity','$role')");
							   }else{
								   echo mysqli_error($con);
							   }
						}
                       
                  
                    }
}

if(isset($_POST['sphone'])&&isset($_POST['semail'])&&isset($_POST['sfullname'])){
	  
           
		   $fullname = $_POST['sfullname'];
		   $phone = $_POST['sphone'];
		   $email = $_POST['semail'];
		   
		   
		   $gettable = mysqli_query($con,'select 1 from suppliers LIMIT 1');
		   if($gettable !== FALSE)
			{
			   $add = mysqli_query($con,"insert into suppliers(fullname,phone,email)values('$fullname','$phone','$email')");
			   if($add){
				   echo $fullname.' has been added successfully';
				   echo "<script>location.replace('suppliers.php');</script>";
			   }else{
				   echo mysqli_error($con);
			   }
			}
			else
			{
				$r = mysqli_query($con,"CREATE TABLE IF NOT EXISTS suppliers(
						  fullname varchar(60) NOT NULL,
						  email varchar(30) NOT NULL UNIQUE,
						  phone varchar(30) NOT NULL UNIQUE,
						  dated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
						  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
						)");
						
						if($r){
							  $add = mysqli_query($con,"insert into suppliers(fullname,phone,email)values('$fullname','$phone','$email')");
			   if($add){
				   echo $fullname.' has been added successifully';
				   echo "<script>location.replace('suppliers.php');</script>";
			   }else{
				   echo mysqli_error($con);
			   }
						}else{
						echo mysqli_error($con);	
						}
			}
		   
}
 
if(isset($_POST['bsupplier'])&&isset($_POST['brand'])){
	  
           
		   $brand = $_POST['brand'];
		   $supplier = $_POST['bsupplier']; 
		   $code = $brand.$supplier; 
		    
		   
		   $gettable = mysqli_query($con,'select 1 from brands LIMIT 1');
		   if($gettable !== FALSE)
			{
			   $add = mysqli_query($con,"insert into brands(brand,supplier,code)values('$brand','$supplier','$code')");
			   if($add){
				   echo $brand.' has been added successfully';
				   echo "<script>location.replace('suppliers.php');</script>";
			   }else{
				   echo mysqli_error($con);
			   }
			}
			else
			{
				$r = mysqli_query($con,"CREATE TABLE IF NOT EXISTS brands(
						  brand varchar(60) NOT NULL,
						  supplier varchar(60) NOT NULL,
						  code varchar(60) NOT NULL UNIQUE,
						  
						  dated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
						  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
						)");
						
						if($r){
							  $add =mysqli_query($con,"insert into brands(brand,supplier,code)values('$brand','$supplier','$code')");
			   if($add){
				   echo $brand.' has been added successifully';
				   echo "<script>location.replace('suppliers.php');</script>";
			   }else{
				   echo mysqli_error($con);
			   }
						}else{
						echo mysqli_error($con);	
						}
			}
		   
}

if(isset($_POST['psup'])){
	$supplier = $_POST['psup'];
	$getbrands= mysqli_query($con,"select * from brands where supplier='$supplier'");
			  while($getbrandsr= mysqli_fetch_array($getbrands)){
				 
				  echo '<option>'.$getbrandsr['brand'].'</option>';
				  
			  }
}



if(isset($_POST['psupplier'])&&isset($_POST['product'])&&isset($_POST['productunits'])&&isset($_POST['weight'])&&isset($_POST['measure'])&&isset($_POST['smallunit'])&&isset($_POST['bigunit'])&&isset($_POST['unitcost'])&&isset($_POST['totalcost'])&&isset($_POST['paid'])&&isset($_POST['balance'])&&isset($_POST['method'])){
	$supplier =$_POST['psupplier'];
	$product =$_POST['product'];
	$units=$_POST['productunits'];
	$weight=$_POST['weight'];
	$measure=$_POST['measure'];
	$smallunit=$_POST['smallunit'];
	$bigunit=$_POST['bigunit'];
	$unitcost = $_POST['unitcost'];
	$totalcost =$_POST['totalcost'];
	$paid=$_POST['paid'];
	$balance = $_POST['balance'];
	$method = $_POST['method'];
// 	$description =$_POST['description'];
// 	$comment =$_POST['comment'];
	$ref = $_POST['ref'];
// 	echo "supplier->$supplier product->$product units->$units weight->$weight measure->$measure smallunit->$smallunit bigunit->$bigunit";
	
	$gettable = mysqli_query($con,'select 1 from purchases LIMIT 1');
	if($gettable !== FALSE)
			{
			    $q = "insert into purchases(receipt,supplier,product,units,weight,measure,smallunit,bigunit,unitcost,totalcost,paid,balance,method)values('$ref','$supplier','$product','$units','$weight','$measure','$smallunit','$bigunit','$unitcost','$totalcost','$paid','$balance','$method')";
			   if($add = mysqli_query($con,$q)){
				   $getptable = mysqli_query($con,'select 1 from products LIMIT 1');
				   if($getptable !== FALSE)
						{
							$productexists = mysqli_query($con,"select * from products where product = '$product'");
							if(mysqli_num_rows($productexists) > 0){
								$updateproduct = mysqli_query($con,"update products set qnty = qnty+'$units',unitcost='$unitcost', smallunit = smallunit+'$smallunit',bigunit=bigunit+'$bigunit' where product = '$product'");
								if($updateproduct){
									echo 'Product has been updated';
									echo $units.' of '.$product.' by '.$supplier.' has been added';
								}else{
									 mysqli_error($con);
									echo "Product Not Added";
								}
							}else{
								$addproducts = mysqli_query($con,"insert into products(product,qnty,unitcost,smallunit,bigunit)values('$product','$units','$unitcost','$smallunit','$bigunit')");
								if($addproducts){ echo $units.' of '.$product.' by '.$supplier.' has been added'; }else{echo mysqli_error($con);}
							}
						}else{
							$s = mysqli_query($con,"CREATE TABLE IF NOT EXISTS products(
							  product varchar(60)  NOT NULL UNIQUE,
							  qnty DOUBLE NOT NULL,
							  unitcost DOUBLE NOT NULL,
							  smallunit DOUBLE NOT NULL,
							  bigunit DOUBLE NOT NULL,
							  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
							)");
							if($s){
								$addproduct = mysqli_query($con,"insert into products(product,qnty,unitcost,smallunit,bigunit)values('$product','$units','$unitcost','$smallunit','$bigunit')");
							if($addproduct){ echo $units.' of '.$product.' by '.$supplier.' has been added'; echo "<script>location.replace('main.php');</script>";}else{echo mysqli_error($con);}
							}else{
								echo mysqli_error($con);
							}
						}
				   //echo $units.' of '.$product.' by '.$supplier.' has been added';
			   }else{
				   echo mysqli_error($con);
			   }
			}else{
				$r = mysqli_query($con,"CREATE TABLE IF NOT EXISTS purchases(
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
						
							if($r){
							  $add = mysqli_query($con,"insert into purchases(receipt,supplier,product,units,weight,measure,smallunit,bigunit,unitcost,totalcost,paid,balance,method,description,comment)values('$ref','$supplier','$product','$units','$weight','$measure','$smallunit','$bigunit','$unitcost','$totalcost','$paid','$balance','$method','$description','$comment')");
							   if($add){
								   echo $units.' of '.$product.' by '.$supplier.' has been added';
								    $getptable = mysqli_query($con,'select 1 from products LIMIT 1');
									   if($gettable !== FALSE)
											{
												$productexists = mysqli_query($con,"select * from products where product = '$product'");
												if(mysqli_num_rows($productexists) > 0){
													$updateproduct = mysqli_query($con,"update products set qnty = qnty+'$units',unitcost='$unitcost', smallunit = smallunit+'$smallunit',bigunit=bigunit+'$bigunit' where product = '$product'");
													if($updateproduct){
														echo 'Product has been updated';
														echo $units.' of '.$product.' by '.$supplier.' has been added';
														echo "<script>location.replace('main.php');</script>";
													}else{
														echo mysqli_error($con);
													}
												}
											}else{
												$s = mysqli_query($con,"CREATE TABLE IF NOT EXISTS products(
												  product varchar(60)  NOT NULL UNIQUE,
												  qnty DOUBLE NOT NULL,
												  unitcost DOUBLE NOT NULL,
												  smallunit DOUBLE NOT NULL,
												  bigunit DOUBLE NOT NULL,
												  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
												if($s){
													$addproduct = mysqli_query($con,"insert into products(product,qnty,unitcost,smallunit,bigunit)values('$product','$units','$unitcost','$smallunit','$bigunit')");
												if($addproduct){ echo $units.' of '.$product.' by '.$supplier.' has been added'; echo "<script>location.replace('main.php');</script>";}else{echo mysqli_error($con);}
												}else{
													echo mysqli_error($con);
												}
											}
							   }else{
								   echo mysqli_error($con);
							   }
							}else{
							echo mysqli_error($con);	
							}
				
			}
	
	
}

if(isset($_POST['refval'])){
	$receipt = $_POST['refval'];
	$grtrec = mysqli_query($con,"select * from purchases where receipt LIKE '%$receipt%'");
	if(mysqli_num_rows($grtrec) <= 0) {
                       echo '<script>$("#ref").addClass("right");</script>';   
                    }else{
						echo '<script>$("#ref").addClass("wrong");</script>';
					}
}

if(isset($_POST['foodcode'])&&isset($_POST['ingredient'])&&isset($_POST['ingredientcode'])&&isset($_POST['ingsmallunut'])){
	$foodcode=$_POST['foodcode'];
	$ingredient=$_POST['ingredient'];
	$ingredientcode=$_POST['ingredientcode'];
	$ingsmallunut=$_POST['ingsmallunut'];
	
	$getytable = mysqli_query($con,'select 1 from ingtemp LIMIT 1');
									   if($getytable !== FALSE)
											{
												$getcost = mysqli_query($con,"select * from products where product = '$ingredient'");
												$getcostr = mysqli_fetch_array($getcost);
												$u = $getcostr['unitcost'];
												$p = $getcostr['smallunit'];
												$cost = ($u/$p)*$ingsmallunut;
												$insret = mysqli_query($con,"insert into ingtemp(foodcode,product,code,units,cost)values('$foodcode','$ingredient','$ingredientcode','$ingsmallunut','$cost')");
												if($insret){
												$all= mysqli_query($con,"select * from ingtemp where foodcode='$foodcode'");
												while($r = mysqli_fetch_array($all)){
													echo '<tr>';
																echo '<td class="thisingredient">'.$r['product'].'</td>';
																echo '<td class="thisunits">'.$r['units'].'</td>';
																echo '<td class="thiscost">'.$r['cost'].'</td>';
																echo '<td><span class="coded" id="'.$r['code'].'">X</span></td>';
																echo '<td><span data-foo="'.$r['code'].'"  data-in="'.$r['product'].'" data-un="'.$r['units'].'" data-cost="'.$r['cost'].'" class="send">Send</span></td>';
																echo '<tr>';
												}
													}else{
														echo 'There was an error'.mysqli_error($con);
														$all= mysqli_query($con,"select * from ingtemp where foodcode='$foodcode'");
															while($r = mysqli_fetch_array($all)){
																echo '<tr>';
																echo '<td class="thisingredient">'.$r['product'].'</td>';
																echo '<td class="thisunits">'.$r['units'].'</td>';
																echo '<td class="thiscost">'.$r['cost'].'</td>';
																echo '<td><span class="coded" id="'.$r['code'].'">X</span></td>';
																echo '<td><span data-foo="'.$r['code'].'"  data-in="'.$r['product'].'" data-un="'.$r['units'].'" data-cost="'.$r['cost'].'" class="send">Send</span></td>';
																echo '<tr>';
															}
														}
											}else{
												$s = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ingtemp(
												  foodcode varchar(60)  NOT NULL,
												  product varchar(60) NOT NULL,
												  code varchar(60) NOT NULL UNIQUE,
												  units DOUBLE NOT NULL,
												  cost DOUBLE NOT NULL,
												  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
												
												if($s){
													$insret = mysqli_query($con,"insert into ingtemp(foodcode,product,code,units,cost)values('$foodcode','$ingredient','$ingredientcode','$ingsmallunut','$cost')");
													if($insret){echo 'inserted';}else{echo mysqli_error($con);}
												}else{echo mysqli_error($con);}
											}
	
}

if(isset($_POST['coded'])){
	$coded = $_POST['coded'];
	$foodcode=$_POST['foodcode'];
	
	$df = mysqli_query($con,"delete from ingtemp where code='$coded'");
	if($df){
		$all= mysqli_query($con,"select * from ingtemp where foodcode='$foodcode'");
															while($r = mysqli_fetch_array($all)){
																echo '<tr>';
																echo '<td class="thisingredient">'.$r['product'].'</td>';
																echo '<td class="thisunits">'.$r['units'].'</td>';
																echo '<td class="thiscost">'.$r['cost'].'</td>';
																echo '<td><span class="coded" id="'.$r['code'].'">X</span></td>';
																echo '<td><span data-foo="'.$r['code'].'"  data-in="'.$r['product'].'" data-un="'.$r['units'].'" data-cost="'.$r['cost'].'" class="send">Send</span></td>';
																echo '<tr>';
															}
		
	}
}

if(isset($_POST['thiscoded'])){

	$ingredient = $_POST['thisingredient'];
	$units = $_POST['thisunit'];
	$getcost = mysqli_query($con, "SELECT * FROM products where product = '$ingredient'");
	$fetchcost = mysqli_fetch_array($getcost);
	$cost = number_format($fetchcost['unitcost']/$units);
	
	$category = $_POST['category'];
	$measure = $_POST['measure'];
	$foodcode = $_POST['thiscoded'];
	$food = $_POST['food'];
	$code  =  $food.$ingredient;
	$department = "Restaurant";
	$totalcosts = 0;
	$price = $cost*1.5;
	$getytable = mysqli_query($con,'select 1 from ingredients LIMIT 1');
		if($getytable !== FALSE) 
			{
				$ins = "insert into ingredients(foodcode,food,ingredient,code,units,cost,measure)values('$foodcode','$food','$ingredient','$code','$units','$cost','$measure')";
				
						if($insret = mysqli_query($con,$ins)){
							$getmenutable = mysqli_query($con,'select 1 from menu LIMIT 1');
							
							if($getmenutable!== FALSE)
								{
								    $checkexistence = mysqli_query($con, "SELECT * FROM menu WHERE foodcode = '$foodcode'");
								    if(mysqli_num_rows($checkexistence) < 1){
    									$insertmenu = "insert into menu(food,foodcode,cost,price,department,category)values('$food','$foodcode','$totalcosts','$price','$department','$category')";
    									if($execc = mysqli_query($con, $insertmenu)){
    									    $retobj = array();
    									    $retobj[] = $foodcode;
    									    $retobj[] = $food;
    									    $retobj[] = $totalcosts;
    									    $retobj[] = $price;
    									    
    									    $returnobj = array('data'=>$retobj);
    									    echo json_encode($returnobj);
    									}
								    }else{
								        $updatecost = mysqli_query($con, "UPDATE menu SET cost = cost + '$cost' where foodcode = '$foodcode'");
								        $updateprice = mysqli_query($con, "UPDATE menu SET price = cost*1.5 where foodcode = '$foodcode'");
								    }
								}else{
									$intomenu = mysqli_query($con,"CREATE TABLE IF NOT EXISTS menu(
											foodcode varchar(60)  NOT NULL UNIQUE,
											food varchar(60)  NOT NULL UNIQUE,
											department varchar(60) NOT NULL,
											cost DOUBLE NOT NULL,
											price DOUBLE NOT NULL,
											id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)"); 
												
												if($intomenu){
													$insertmenu = mysqli_query($con,"insert into menu(food,foodcode,cost,price,department)values('$food','$foodcode','$totalcosts','$price','$department')");
												}
								}
							echo 'inserted';
							}else{
								echo mysqli_error($con);
								echo $ingredient." ADDED SUCCESSFULLY";
							}
			}else{
				$s = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ingredients(
												  foodcode varchar(60)  NOT NULL,
												  food varchar(60)  NOT NULL,
												  ingredient varchar(60) NOT NULL,
												  code varchar(60) NOT NULL UNIQUE,
												  units DOUBLE NOT NULL,
												  cost DOUBLE NOT NULL,
												  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
				if($s){
					$insret = mysqli_query($con,"insert into ingredients(foodcode,food,ingredient,code,units,cost,measure)values('$foodcode','$food','$ingredient','$code','$units','$cost','$measure')");
						if($insret){
							$getmenutable = mysqli_query($con,'select 1 from menu LIMIT 1');
							if($getmenutable!== FALSE)
								{
									$insertmenu = mysqli_query($con,"insert into menu(food,foodcode,cost,price,department)values('$food','$foodcode','$totalcost','$price','$department')");
								}else{
									$intomenu = mysqli_query($con,"CREATE TABLE IF NOT EXISTS menu(
											foodcode varchar(60)  NOT NULL UNIQUE,
											food varchar(60)  NOT NULL UNIQUE,
											department varchar(60) NOT NULL,
											cost DOUBLE NOT NULL,
											price DOUBLE NOT NULL,
											id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)"); 
												
												if($intomenu){
													$insertmenuu = mysqli_query($con,"insert into menu(food,foodcode,cost,price,department)values('$food','$foodcode','$totalcost','$price','$department')");
												}
								}
							echo 'inserted';
							}else{echo mysqli_error($con);}
								
								}else
								{
									echo mysqli_error($con);
									}
						
				
			}
	
}

if(isset($_POST['tcostq'])){
	$g = $_POST['tcostq'];
	$gt = mysqli_query($con,"select SUM(cost) as cost from ingtemp where foodcode='$g'");
	if($gt){
		while($gtr = mysqli_fetch_array($gt)){
		echo $gtr['cost'];
	}
	}else{
		echo mysqli_error($con);
	}
	
}

if(isset($_POST['fcode'])){
	$f = $_POST['fcode'];
	$food = $_POST['food'];
	$price = $_POST['price'];
	$department = $_POST['dep'];
	$ordernumber = $_POST['orderid'];
	$cashier = $_POST['cashier'];
	$cost = $_POST['cost'];
	$profit  = $price - $cost;
	$getmenutable = mysqli_query($con,'select 1 from tempcart LIMIT 1');
	if($getmenutable!== FALSE)
		{
			$gt = mysqli_query($con,"insert into tempcart(ordernumber,code,food,price,department,qnty,cost,profit,cashier)values('$ordernumber','$f','$food','$price','$department','1','$cost','$profit','$cashier')");
				if($gt){
					
					//$gentable = mysqli_query($con,"select code,SUM(qnty) as qnty, food,price from tempcart group by food");
					$gentable = mysqli_query($con,"select code,COUNT(code) as qnty, food,price from tempcart where ordernumber='$ordernumber' group by food");
					if($gentable){
						echo'<table class="table" border="1"  border-color: red blue gold teal;">';
																	echo '<th>Qnty</th> <th>Food</th> <th>Price</th> <th>Total</th><th></th><tbody>';
																	while($gentabler = mysqli_fetch_array($gentable)){
																		$ts = $gentabler['qnty']*$gentabler['price'];
																			echo '<tr> <td>'.$gentabler['qnty'].'</td> <td>'.$gentabler['food'].'</td> <td>'.number_format($gentabler['price'],2).'</td> <td>'.$ts.'</td> <td class ="foo-id btn-danger" foo-id="'.$gentabler['food'].'">x</td></tr>';
																		}
																		
																		$gettotal = mysqli_query($con,"select SUM(price) as priced from tempcart where ordernumber='$ordernumber'");
																		while($gettotalr=mysqli_fetch_array($gettotal)){
																			echo '<td></td> <td></td> <td></td> <td>'.number_format($gettotalr['priced'],2).'</td> <td></td>';
																		}
																		echo '</tbody><table/>';
					}else{echo mysqli_error($con);}
					
				}else{echo mysqli_error($con);}
				}else{
					$jimmy = mysqli_query($con,"CREATE TABLE IF NOT EXISTS tempcart(
											ordernumber varchar(15) NOT NULL,
											code varchar(60)  NOT NULL,
											food varchar(60)  NOT NULL,
											department varchar(60) NOT NULL,
											qnty varchar(3) NOT NULL,
											price DOUBLE NOT NULL,
											cost DOUBLE NOT NULL,
											profit DOUBLE NOT NULL,
											cashier varchar(60)  NOT NULL,
											dated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
											id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
												$gt = mysqli_query($con,"insert into tempcart(ordernumber,code,food,price,department,qnty,cost,profit,cashier)values('$ordernumber','$f','$food','$price','$department','1','$cost','$profit','$cashier')");
												if($jimmy){
													$gentable = mysqli_query($con,"select code,SUM(qnty) as qnty, food,price from tempcart group by food");
															if($gt){
																
																$gentable = mysqli_query($con,"select code,COUNT(code) as qnty, food,price from tempcart where ordernumber='$ordernumber' group by food");
																if($gentable){
																	echo'<table class="table" border="1"  border-color: red blue gold teal;">';
																	echo '<th>Qnty</th> <th>Food</th> <th>Price</th> <th>Total</th><th></th>';
																	while($gentabler = mysqli_fetch_array($gentable)){
																		$ts = $gentabler['qnty']*$gentabler['price'];
																			echo '<tr> <td>'.$gentabler['qnty'].'</td> <td>'.$gentabler['food'].'</td> <td>'.number_format($gentabler['price'],2).'</td> <td>'.$ts.'</td> <td class ="foo-id btn-danger" foo-id="'.$gentabler['food'].'">x</td></tr>';
																		}
																		
																		$gettotal = mysqli_query($con,"select SUM(price) as priced from tempcart where ordernumber='$ordernumber'");
																		while($gettotalr=mysqli_fetch_array($gettotal)){
																			echo '<td></td> <td></td> <td></td> <td>'.number_format($gettotalr['priced'],2).'</td> <td></td>';
																		}
																		echo '<table/>';
																}else{echo mysqli_error($con);}
																
															}else{echo mysqli_error($con);}
												}
				}						
}


if(isset($_POST['thisfood'])){
	$thisfood = $_POST['thisfood'];
	$ordernumber = $_POST['thisorder'];
	$del = mysqli_query($con,"Delete from tempcart where food = '$thisfood' and ordernumber='$ordernumber'");
	if($del){
		$gentable = mysqli_query($con,"select code,COUNT(code) as qnty, food,price from tempcart where ordernumber='$ordernumber' group by food");
																if($gentable){
																	echo'<table class="table" border="1"  border-color: red blue gold teal;">';
																	echo '<th>Qnty</th> <th>Food</th> <th>Price</th> <th>Total</th><th></th>';
																	while($gentabler = mysqli_fetch_array($gentable)){
																		$ts = $gentabler['qnty']*$gentabler['price'];
																			echo '<tr> <td>'.$gentabler['qnty'].'</td> <td>'.$gentabler['food'].'</td> <td>'.number_format($gentabler['price'],2).'</td> <td>'.$ts.'</td> <td class ="foo-id btn-danger" foo-id="'.$gentabler['food'].'">x</td></tr>';
																		}
																		
																		$gettotal = mysqli_query($con,"select SUM(price) as priced from tempcart where ordernumber='$ordernumber'");
																		while($gettotalr=mysqli_fetch_array($gettotal)){
																			echo '<td></td> <td></td> <td></td> <td>'.number_format($gettotalr['priced'],2).'</td> <td></td>';
																		}
																		echo '<table/>';
																}else{echo mysqli_error($con);}
	}
}
	
if(isset($_POST['payablestring'])){
	$ordernumber = $_POST['thisorder'];
	$gettotal = mysqli_query($con,"select SUM(price) as priced from tempcart where ordernumber='$ordernumber'");
																		while($gettotalr=mysqli_fetch_array($gettotal)){
																			echo 'ksh '.number_format($gettotalr['priced'],2);
																		}
}

if(isset($_POST['productid'])&&isset($_POST['product'])&&isset($_POST['qnty'])&&isset($_POST['smallunit'])&&isset($_POST['bigunit'])&&isset($_POST['transferid']))
		{
			$transferid = $_POST['transferid'];
			$productid = $_POST['productid'];
			$product = $_POST['product'];
			$qnty = $_POST['qnty'];
			$smallunit = $_POST['smallunit'];
			$bigunit = $_POST['bigunit'];
			
			
			$unitcost = $_POST['unitcost'];
			$valuation = $qnty*$unitcost;
			
			$iftransfersexist = mysqli_query($con,'select 1 from transfers LIMIT 1');
				if($iftransfersexist !== FALSE)
						{
							$insertintotransfers = mysqli_query($con,"insert into transfers(transferid,productid,product,qnty,unitcost,smallunit,bigunit)values('$transferid','$productid','$product','$qnty','$unitcost','$smallunit','$bigunit')");
							if($insertintotransfers){
								$updateproducts = mysqli_query($con,"update products set qnty = qnty-'$qnty' where id = '$productid'");
									if($updateproducts){
										$ifkitchenstockexists = mysqli_query($con,'select 1 from kitchenstock LIMIT 1');
														if($ifkitchenstockexists!== FALSE){
															$productexists = mysqli_query($con,"select * from kitchenstock where product = '$product'");
																if(mysqli_num_rows($productexists) > 0){
																			$updateproduct = mysqli_query($con,"update kitchenstock set qnty = qnty+'$units',unitcost='$unitcost', smallunit = smallunit+'$smallunit',bigunit=bigunit+'$bigunit' where product = '$product'");
																			if($updateproduct){
																				echo 'Product has been updated';
																				echo $units.' of '.$product.' by '.$supplier.' has been added';
																				echo '<script>location.replace("main.php")</script>';
																			}else{
																				echo mysqli_error($con);
																			}
																		}else{
																			$insertintokitchenstock = mysqli_query($con,"insert into kitchenstock(product,qnty,unitcost,smallunit,bigunit)values('$product','$qnty','$unitcost','$smallunit','$bigunit')");
																			if($insertintokitchenstock){ 
																				echo $units.' of '.$product.' by '.$supplier.' has been added';
																				echo '<script>location.replace("main.php")</script>';
																				}else{
																				echo mysqli_error($con);
																				}
																		}
															}else{
																$createkitchenstock = mysqli_query($con,"CREATE TABLE IF NOT EXISTS kitchenstock(
																	  product varchar(60) NOT NULL UNIQUE,
																	  qnty DOUBLE NOT NULL,
																	  unitcost DOUBLE NOT NULL,
																	  smallunit DOUBLE NOT NULL,
																	  bigunit DOUBLE NOT NULL,
																	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
																	)");
																if($createkitchenstock){
																	$insertintokitchenstock = mysqli_query($con,"insert into kitchenstock(product,qnty,unitcost,smallunit,bigunit)values('$product','$qnty','$unitcost','$smallunit','$bigunit')");
																	echo '<script>location.replace("main.php")</script>';
																}else{
																	echo mysqli_error($con);
																	}
															}
									}else{
										echo mysqli_error($con);
										}
							}else{
								echo mysqli_error($con);
								}
							}else{
								$createtransfers = mysqli_query($con,"CREATE TABLE IF NOT EXISTS transfers(
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
									if($createtransfers){
										$insertintotransfers = mysqli_query($con,"insert into transfers(transferid,productid,product,qnty,unitcost,smallunit,bigunit)values('$transferid','$productid','$product','$qnty','$unitcost','$smallunit','$bigunit')");
											if($insertintotransfers){
													$ifkitchenstockexists = mysqli_query($con,'select 1 from kitchenstock LIMIT 1');
														if($ifkitchenstockexists!== FALSE){
															$productexists = mysqli_query($con,"select * from kitchenstock where product = '$product'");
																if(mysqli_num_rows($productexists) > 0){
																			$updateproduct = mysqli_query($con,"update kitchenstock set qnty = qnty+'$units',unitcost='$unitcost', smallunit = smallunit+'$smallunit',bigunit=bigunit+'$bigunit' where product = '$product'");
																			if($updateproduct){
																				echo 'Product has been updated';
																				echo $units.' of '.$product.' by '.$supplier.' has been added';
																				echo '<script>location.replace("main.php")</script>';
																			}else{
																				echo mysqli_error($con);
																			}
																		}else{
																			$insertintokitchenstock = mysqli_query($con,"insert into kitchenstock(product,qnty,unitcost,smallunit,bigunit)values('$product','$qnty','$unitcost','$smallunit','$bigunit')");
																			if($insertintokitchenstock){ 
																				echo $units.' of '.$product.' by '.$supplier.' has been added';
																				echo '<script>location.replace("main.php")</script>';
																				}else{
																				echo mysqli_error($con);
																				}
																		}
															}else{
																$createkitchenstock = mysqli_query($con,"CREATE TABLE IF NOT EXISTS kitchenstock(
																	  product varchar(60) NOT NULL UNIQUE,
																	  qnty DOUBLE NOT NULL,
																	  unitcost DOUBLE NOT NULL,
																	  smallunit DOUBLE NOT NULL,
																	  bigunit DOUBLE NOT NULL,
																	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
																	)");
																if($createkitchenstock){
																	$insertintokitchenstock = mysqli_query($con,"insert into kitchenstock(product,qnty,unitcost,smallunit,bigunit)values('$product','$qnty','$unitcost','$smallunit','$bigunit')");
																	echo '<script>location.replace("main.php")</script>';
																}else{
																	echo mysqli_error($con);
																	}
															}
												}else{
													echo mysqli_error($con);
												}
										}else{
											echo mysqli_error($con);
										}
							}
			}
			
	if(isset($_POST['makethisorder'])){
				$makethisorder = $_POST['makethisorder'];
				$getpeddingorders = mysqli_query($con,'select 1 from peddingorders LIMIT 1');
					if($getpeddingorders!== FALSE){
						$ordernumber = $makethisorder;
						$tablenumber = 1;
						$waiter = $_POST['waiter'];
						$status = 0;
						
						$addorder = mysqli_query($con,"insert into peddingorders(ordernumber,tablenumber,waiter,status)values('$ordernumber','$tablenumber','$waiter','$status')");
								if($addorder){
														echo '<script>location.replace("orders.php")</script>';
													}else{
														echo mysqli_error($con);
														}
					}else{
						$ordernumber = $makethisorder;
						$tablenumber = 1;
						$waiter = $_POST['waiter'];
						$status = 0;
						$createtablepeddingorders = mysqli_query($con,"CREATE TABLE IF NOT EXISTS peddingorders(
												  ordernumber varchar(21)  NOT NULL UNIQUE,
												  tablenumber varchar(15)  NOT NULL,
												  waiter varchar(60) NOT NULL,
												  status varchar(2) NOT NULL,
												  timed timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
												  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
												
												if($createtablepeddingorders){
													$addorder = mysqli_query($con,"insert into peddingorders(ordernumber,tablenumber,waiter,status)values('$ordernumber','$tablenumber','$waiter','$status')");
													if($addorder){
														echo '<script>location.replace("orders.php")</script>';
													}else{
														echo mysqli_error($con);
														}
													}else{
														echo mysqli_error($con);
													}
					}
			}
			
		if(isset($_POST['q'])&&isset($_POST['iq'])){ $init = $_POST['q']; $cc = $_POST['iq']; $gh = mysqli_query($con,"update peddingorders set status = '$init'+1 where ordernumber='$cc'"); if($gh){ echo '<script>location.replace("menu.php");</script>';}else{echo mysqli_error($con);} }
		if(isset($_POST['r'])&&isset($_POST['ir'])){$init = $_POST['r']; $cc = $_POST['ir']; $gh = mysqli_query($con,"update peddingorders set status = '$init'+1 where ordernumber='$cc'"); if($gh){ echo '<script>location.replace("menu.php");</script>';}else{echo mysqli_error($con);}}
		if(isset($_POST['s'])&&isset($_POST['is'])){$init = $_POST['s']; $cc = $_POST['is']; $gh = mysqli_query($con,"update peddingorders set status = '$init'+1 where ordernumber='$cc'"); if($gh){ echo '<script>location.replace("menu.php");</script>';}else{echo mysqli_error($con);}}
		if(isset($_POST['p'])&&isset($_POST['ip'])){$init = $_POST['p']; $cc = $_POST['ip']; $gh = mysqli_query($con,"update peddingorders set status = '$init'+1 where ordernumber='$cc'"); if($gh){ echo '<script>location.replace("menu.php");</script>';}else{echo mysqli_error($con);}}



if(isset($_POST['cash'])&&isset($_POST['mpesa'])&&isset($_POST['bank'])&&isset($_POST['total'])&&isset($_POST['payable'])&&isset($_POST['balance'])){
			   $cash = $_POST['cash'];
			   $mpesa = $_POST['mpesa'];
			   $bank = $_POST['bank'];
			   $total = $_POST['total'];
			   $payable =$_POST['payable'];
			   $balance = $_POST['balance'];
			   $receipt = $_POST['receipt'];
			   $dated = date('Y-m-d');
			   $amount = $payable;
			   
			   
			   $getprofit = mysqli_query($con,"select SUM(profit) as prof from tempcart where ordernumber='$receipt'");
			   $profitr = mysqli_fetch_array($getprofit);
			   $profit = $profitr['prof'];
			   
			   
			   $getcashier = mysqli_query($con,"select * from tempcart where ordernumber = '$receipt' LIMIT 1");
			   $getcashierr = mysqli_fetch_array($getcashier);
			   $cashier = $getcashierr['cashier'];
			   echo $cashier;
			   
			   $checkcarttable = mysqli_query($con,'select 1 from cart LIMIT 1');
				if($checkcarttable!== FALSE){
				 $inserttocart = mysqli_query($con,"insert into cart select * from tempcart where ordernumber='$receipt'");
					if($inserttocart){
							$checkreceiptstable = mysqli_query($con,'select 1 from receipts LIMIT 1');
								if($checkreceiptstable!== FALSE){
										$insertreceipt = mysqli_query($con,"insert into receipts(receipt,amount,cash,mpesa,bank,balance,dated,cashier,profit)values('$receipt','$amount','$cash','$mpesa','$bank','$balance','$dated','$cashier','$profit')");
										if($insertreceipt ){
														#update inventories
															$getallproductsintempacart  = mysqli_query($con,"select * from tempcart where ordernumber='$receipt'");
															while($gptr = mysqli_fetch_array($getallproductsintempacart)){
																$food = $gptr['food'];
																$getallingredients = mysqli_query($con,"select * from ingredients where food = '$food'");
																if($getallingredients){
																	while($gis = mysqli_fetch_array($getallingredients)){
																	$ingredient = $gis['ingredient'];
																	$units = $gis['units'];
																	$bigunit = ($units/1000);
																	
																	$upd = mysqli_query($con,"update kitchenstock set smallunit = smallunit - '$units',bigunit=bigunit-'$bigunit', qnty=qnty-'$bigunit' where product='$ingredient'");
																	if($upd){
																			echo $ingredient.' updated in kitchen inventory';
																			mysqli_query($con,"delete from tempcart where food='$food' and ordernumber='$receipt' LIMIT 1");
																		}else{
																			echo mysqli_error($con);
																		}
																	}
																	}else{echo mysqli_error($con);}
																 
																
																}
																$updateorders = mysqli_query($con,"update peddingorders set status='5' where ordernumber='$receipt'");
																if($updateorders){ echo 'order '.$receipt.' has been completed'; echo "<script>location.replace('menu.php');</script>";}else{echo mysqli_error($con);}
															}else{
																echo mysqli_error($con);
															}
									}else{
									 //create receipts table
									 $createreceipts = mysqli_query($con,"CREATE TABLE IF NOT EXISTS receipts(
											receipt varchar(15) NOT NULL UNIQUE,
											amount DOUBLE NOT NULL,
											cash DOUBLE NOT NULL,
											mpesa DOUBLE NOT NULL,
											bank DOUBLE NOT NULL,
											balance DOUBLE NOT NULL,
											dated varchar(12)  NOT NULL,
											cashier varchar(60) NOT NULL,
											profit DOUBLE NOT NULL,
											timed timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
											id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
												
												if($createreceipts){
													$insertreceipt = mysqli_query($con,"insert into receipts(receipt,amount,cash,mpesa,bank,balance,dated,cashier,profit)values('$receipt','$amount','$cash','$mpesa','$bank','$balance','$dated','$cashier','$profit')");
														if($insertreceipt ){
														#update inventories
															$getallproductsintempacart  = mysqli_query($con,"select * from tempcart where ordernumber='$receipt'");
															while($gptr = mysqli_fetch_array($getallproductsintempacart)){
																$food = $gptr['food'];
																$getallingredients = mysqli_query($con,"select * from ingredients where food = '$food'");
																while($gis = mysqli_fetch_array($getallingredients)){
																	$ingredient = $gis['ingredient'];
																	$units = $gis['units'];
																	$bigunit = ($units/1000);
																	
																	$upd = mysqli_query($con,"update kitchenstock set smallunit = smallunit - '$units',bigunit=bigunit-'$bigunit', qnty=qnty-'$bigunit' where product='$ingredient'");
																	if($upd){
																			echo $ingredient.' updated in kitchen inventory';
																			mysqli_query($con,"delete from tempcart where food='$food' and ordernumber='$receipt' LIMIT 1");
																		}else{
																			echo mysqli_error($con);
																		}
																	} 
																
																}
																$updateorders = mysqli_query($con,"update peddingorders set status='5' where ordernumber='$receipt'");
																if($updateorders){ echo 'order '.$receipt.' has been completed'; echo "<script>location.replace('menu.php');</script>";}else{echo mysqli_error($con);}
															}else{
																echo mysqli_error($con);
															}
													}else{
														echo mysqli_error($con);
													}
									}
						}
					}else{
						$createcart = mysqli_query($con,"CREATE TABLE IF NOT EXISTS cart(
											ordernumber varchar(15) NOT NULL,
											code varchar(60)  NOT NULL,
											food varchar(60)  NOT NULL,
											department varchar(60) NOT NULL,
											qnty varchar(3) NOT NULL,
											price DOUBLE NOT NULL,
											cost DOUBLE NOT NULL,
											profit DOUBLE NOT NULL,
											cashier varchar(30)  NOT NULL,
											dated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
											id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
												
												if($createcart){
													$inserttocart = mysqli_query($con,"insert into cart select * from tempcart where ordernumber='$receipt'");
					if($inserttocart){
							$checkreceiptstable = mysqli_query($con,'select 1 from receipts LIMIT 1');
								if($checkreceiptstable!== FALSE){
										$insertreceipt = mysqli_query($con,"insert into receipts(receipt,amount,cash,mpesa,bank,balance,dated,cashier,profit)values('$receipt','$amount','$cash','$mpesa','$bank','$balance','$dated','$cashier','$profit')");
										if($insertreceipt ){
														#update inventories
															$getallproductsintempacart  = mysqli_query($con,"select * from tempcart where ordernumber='$receipt'");
															while($gptr = mysqli_fetch_array($getallproductsintempacart)){
																$food = $gptr['food'];
																$getallingredients = mysqli_query($con,"select * from ingredients where food = '$food'");
																while($gis = mysqli_fetch_array($getallingredients)){
																	$ingredient = $gis['ingredient'];
																	$units = $gis['units'];
																	$bigunit = ($units/1000);
																	
																	$upd = mysqli_query($con,"update kitchenstock set smallunit = smallunit - '$units',bigunit=bigunit-'$bigunit', qnty=qnty-'$bigunit' where product='$ingredient'");
																	if($upd){
																			echo $ingredient.' updated in kitchen inventory';
																			mysqli_query($con,"delete from tempcart where food='$food' and ordernumber='$receipt' LIMIT 1");
																		}else{
																			echo mysqli_error($con);
																		}
																	} 
																
																}
																$updateorders = mysqli_query($con,"update peddingorders set status='5' where ordernumber='$receipt'");
																if($updateorders){ echo 'order '.$receipt.' has been completed'; echo "<script>location.replace('menu.php');</script>";}else{echo mysqli_error($con);}
															}else{
																echo mysqli_error($con);
															}
									}else{
									 //create receipts table
									 $createreceipts = mysqli_query($con,"CREATE TABLE IF NOT EXISTS receipts(
											receipt varchar(15) NOT NULL UNIQUE,
											amount DOUBLE NOT NULL,
											cash DOUBLE NOT NULL,
											mpesa DOUBLE NOT NULL,
											bank DOUBLE NOT NULL,
											balance DOUBLE NOT NULL,
											dated varchar(12)  NOT NULL,
											cashier varchar(60) NOT NULL,
											profit DOUBLE NOT NULL,
											timed timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
											id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY 
												)");
												
												if($createreceipts){
													$insertreceipt = mysqli_query($con,"insert into receipts(receipt,amount,cash,mpesa,bank,balance,dated,cashier,profit)values('$receipt','$amount','$cash','$mpesa','$bank','$balance','$dated','$cashier','$profit')");
														if($insertreceipt ){
														#update inventories
															$getallproductsintempacart  = mysqli_query($con,"select * from tempcart where ordernumber='$receipt'");
															while($gptr = mysqli_fetch_array($getallproductsintempacart)){
																$food = $gptr['food'];
																$getallingredients = mysqli_query($con,"select * from ingredients where food = '$food'");
																while($gis = mysqli_fetch_array($getallingredients)){
																	$ingredient = $gis['ingredient'];
																	$units = $gis['units'];
																	$bigunit = ($units/1000);
																	
																	$upd = mysqli_query($con,"update kitchenstock set smallunit = smallunit - '$units',bigunit=bigunit-'$bigunit', qnty=qnty-'$bigunit' where product='$ingredient'");
																	if($upd){
																			echo $ingredient.' updated in kitchen inventory';
																			mysqli_query($con,"delete from tempcart where food='$food' and ordernumber='$receipt' LIMIT 1");
																		}else{
																			echo mysqli_error($con);
																		}
																	} 
																
																}
																$updateorders = mysqli_query($con,"update peddingorders set status='5' where ordernumber='$receipt'");
																if($updateorders){
																	echo 'order '.$receipt.' has been completed';
																	echo "<script>location.replace('menu.php');</script>";
																	}else{echo mysqli_error($con);}
															}else{
																echo mysqli_error($con);
															}
													}else{
														echo mysqli_error($con);
													}
									}
						}
													}
					}
			   }
			   
			   
		if(isset($_POST['delthisorder'])){
			$order = $_POST['delthisorder'];
			
			$removefromorders = mysqli_query($con,"delete from peddingorders where ordernumber='$order'");
				if($removefromorders){
						$removefromtemcart = mysqli_query($con,"delete from tempcart where ordernumber='$order'");
							if($removefromtemcart){
								
								echo $order.' Deleted!';
								}else{
									echo mysqli_error($con);
								}
					}else{
						echo mysqli_error($con);
					}
			}
?>