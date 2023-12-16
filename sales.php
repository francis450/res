<?php
ob_start();
session_start();
include'connection.php';
$userid = $_SESSION['username'];
if(!isset($_SESSION['username'])){
	header("Location: index.php");
}
?>
<html>
<head>
  <title>Login and Registration Form</title>
  <script type="text/javascript" src="jscss/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="jscss/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jscss/jquery.dataTables.min.css">
  
  <style>
  body {
  <!--font-family: Arial, sans-serif;  font-family: monaco, monospace;-->
  
  font-family: optima, sans-serif;
}

.container {
  max-width: 1000;
  margin: 0 auto;
  text-align: center;
}

h1 {
  margin-top: 50px;
}

.user{
	border-radius: 5px 25px;
	background-color:blue;
}
  
  .tabs {
  display: flex;
  justify-content: center;
  margin: 50px 0;
  
}

.tab-link {
  padding: 10px 20px;
  margin: 0 10px;
  border: none;
  background: #ddd;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px 25px;
}

.tab-link.active {
  background: #333;
  color: #fff;
}

.tabs-content .tab-content {
  display: none;
}

.tabs-content .tab-content.active {
  display: block;
}

  
   .login-form {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
      margin: 50px auto;
      max-width: 1000px;
    }
    .t-form {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
      margin: 50px auto;
      max-width: 400px;
    }

    .form-control {
      display: block;
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      box-sizing: border-box;
      border: none;
      border-radius: 5px;
      background-color: #dddddd;
      font-size: 14px;
      outline: none;
    }

    .form-control:focus {
      background-color: #ffffff;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      font-weight: bold;
      color: #000000;
    }

    .btn {
      padding: 10px;
      border-radius: 5px;
      background-color: #0000ff;
      color: #ffffff;
      font-size: 14px;
      cursor: pointer;
      outline: none;
      border: none;
    }

    .btn:hover {
      background-color: #000099;
    }
	
	.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100px;
  height: 100%;
  background-color: #333;
  color: #fff;
  transition: transform 0.3s ease-in-out;
}

.menu {
  list-style: none;
  padding: 0;
  margin: 0;
  overflow: hidden;
}

.menu a {
  display: block;
  padding: 10px 20px;
  color: #fff;
  text-decoration: none;
  font-family: monaco, monospace;
}

.menu-btn {
  cursor: pointer;
  padding: 10px;
  position: absolute;
  top: 0;
  right: 0;
}

.menu-btn i {
  font-size: 1.5em;
  font-family: monaco, monospace;
}

/* Hide menu by default */
.menu {
  transform: translateX(-100%);
}

/* Media Queries */
@media screen and (min-width: 600px) {
  /* Show menu by default */
  .menu {
    transform: translateX(0);
  }
  
  /* Hide menu button */
  .menu-btn {
    display: none;
  }
}

.romeo{
	display: flex; 
	justify-content: space-around;
}

.wrong{
  border: 2px solid red;
  border-radius: 4px;
}

.right{
  border: 2px solid green;
  border-radius: 4px;
}

.red{
  color:red;
}
.green{
  color:green;
}
.yellow{
	color:yellow;
}
  </style>
  <script>
  $(document).ready(function(){
	  
	  
	  $("#ref").keyup(function(){
		  var refval = $(this).val();
		  $.post('register.php',{refval:refval,},function(data){
			  $('#test').html(data);
		  });
	  });
	  
	   $('#submit2').click(function(){  
           var username = $('#username').val();  
           var password = $('#password').val(); 
		   var passwordconfirm = $('#password-confirm').val(); 
		   var fullname = $('#fullname').val();
		   var phone = $('#phone').val();
		   var email = $('#email').val();
		   
		   
		  
           if(username == '' || fullname == ''|| password== '' || (password!==passwordconfirm)||email =='')  
           {  
                $('#response').html('<span class="text-danger">All Fields are required</span>');  
           }  
           else  
           {  
				$('#response').html('<span class="text-info">Loading response...</span>');  
				   $.post('register.php',{
					   username:username, password:password,fullname:fullname,phone:phone,email:email,
				   },function(data){
						//$('form').trigger("reset");  
									  $('#response').fadeIn().html(data); 
										console.log(data);
									  setTimeout(function(){  
										   $('#response').fadeOut("slow");  
									  }, 5000); 
				   });
               
           }  
      });
	  
	   $(".menu-btn").click(function () {
		  $(".menu").toggleClass("menu-open");
		});

		$(".menu a").click(function () {
		  $(".menu").removeClass("menu-open");
		});
		
		
			$("#psupplier").change(function () {
		  var psup = $(this).val();
		  
		  $.post('register.php',{psup:psup},function(data){$('#product').html(data); console.log(data);});
		});
		
		$("#unit").change(function () {
			
		  var thisunit = $(this).val();
		  
		  var qnty = $('#qnty').val();
		  var units = $('#units').val();
		  
		  if(thisunit=='Kgs'){
			var smallunit =   qnty*1000*units;
			var bigunit =   qnty*units;
		  }else if(thisunit=='Gr'){
			 var smallunit =   qnty*units;
			var bigunit =   (qnty*units)/1000; 
		  }else if(thisunit=='Ltrs'){
			var smallunit =   qnty*1000*units;
			var bigunit =   qnty*units;
		  }else if(thisunit=='Mls'){
			 var smallunit =   qnty*units;
			var bigunit =   (qnty*units)/1000; 
		  }
		  $('#bigunit').val(bigunit);
		  $('#smallunit').val(smallunit)
		});
		
		$('#unitcost').keyup(function(){
				var unitcost = $(this).val();
				var thesunits = $('#units').val();
				var totalcost = unitcost*thesunits;
				
				$('#totalcost').val(totalcost);
				
			});
			
			$('#totalpaid').keyup(function(){
				var totalpaid = $(this).val();
				var totaldue = $('#totalcost').val();
				var balance = totalpaid-totaldue;
				
				$('#totalbal').val(balance);
				
			});
			
			
			$('#purchase').click(function(){
				var psupplier = $('#psupplier').val();
				var product = $('#product').val();
				var productunits = $('#units').val();
				var weight = $('#qnty').val();
				var measure = $('#unit').val();
				var smallunit = $('#smallunit').val();
				var bigunit= $('#bigunit').val();
				var unitcost = $('#unitcost').val();
				var totalcost = $('#totalcost').val();
				var paid = $('#totalpaid').val();
				var balance = $('#totalbal').val();
				var method = $('#paymentmethod').val();
				var description = $('#paymentdescription').val();
				var comment = $('#comment').val();
				var ref = $('#ref').val();
				
				 if(ref == '' || psupplier == '' || product == ''|| productunits== '' ||weight ==''||measure ==''||smallunit ==''||bigunit ==''||unitcost ==''||totalcost ==''||paid ==''||balance ==''||method ==''||description ==''||comment =='')  
				   {  
						$('#response').html('<span class="text-danger">All Fields are required</span>');  
				   } else{
					   
					   $('#response').html('<span class="text-info">Loading response...</span>');  
				   $.post('register.php',{
					   psupplier:psupplier,
					   product : product,
					   productunits:productunits,
					   weight : weight,
					   measure : measure,
					   smallunit : smallunit,
					   bigunit : bigunit,
					   unitcost : unitcost,
					   totalcost : totalcost,
					   paid : paid,
					   balance : balance,
					   method : method,
					   description : description,
					   comment:comment,
					   ref:ref,
				   },function(data){
						            $('form').trigger("reset");  
									$("#ref").removeClass("right");
									  $('#response').fadeIn().html(data); 
										console.log(data);
									  setTimeout(function(){  
										   $('#response').fadeOut("slow");  
									  }, 5000); 
				   });
					   
				   }
				
				
			});
			
			   $('#addingredient').click(function(){
			   var foodcode = $('#foodcode').val();
			   var ingredient = $('#foodingredient').val();
			   var ingredientcode = foodcode+ingredient;
			   var ingsmallunut = $('#smallunittt').val();
			   var tcostq = foodcode;
			   alert(tcostq);
			   $.post('register.php',{foodcode:foodcode,ingredient:ingredient,ingredientcode:ingredientcode,ingsmallunut:ingsmallunut,},function(data){
				   //$('form').trigger("reset");  
									  $('#ins').fadeIn().html(data); 
										console.log(data);
									  setTimeout(function(){  
										   $('#response').fadeOut("slow");  
									  }, 5000); 
			   });
			   
			   $.post('register.php',{tcostq:tcostq,},function(data){
				   $('#tcost').fadeIn().html(data); 
			   });
		   });
		   
		   $("#ingredientunit").change(function () {
			
		  var thisinunit = $(this).val();
		  
		  var inqnty = $('#gredientunit').val();
		  
		  
		  if( thisinunit=='Kgs'){
			var smallunitt =   inqnty*1000;
			var bigunit =   inqnty;
		  }else if( thisinunit=='Gr'){
			 var smallunitt =   inqnty;
			var bigunit =   (inqnty)/1000; 
		  }else if( thisinunit=='Ltrs'){
			var smallunitt =   inqnty*1000;
			var bigunit =   inqnty;
		  }else if(thisinunit=='Mls'){
			 var smallunitt =   inqnty;
			var bigunitt =   (inqnty)/1000; 
		  }
		  //$('#bigunit').val(bigunit);
		  $('#smallunittt').val(smallunitt);
		});
		
		$(document).on('click','.coded',function(){
			var coded = $(this).attr('id');
			var foodcode = $('#foodcode').val();
			var tcostq = foodcode;
			$.post('register.php',{coded:coded,foodcode:foodcode,},function(data){
				$('#ins').fadeIn().html(data); 
			});
			
			$.post('register.php',{tcostq:tcostq,},function(data){
				   $('#tcost').fadeIn().html(data); 
			   });
			});
			
			$(document).on('click','.send',function(){
			var thiscoded = $(this).attr('data-foo');
			var thisingredient = $(this).attr('data-in');
			var thisunit = $(this).attr('data-un');
			var thiscost = $(this).attr('data-cost');
			var foodcode = $('#foodcode').val();
			var food = $('#foodname').val();
			var department = $('#fooddepartment').val();
			var cost = $('#tcost').text();
			$.post('register.php',{thiscoded:thiscoded,thisingredient:thisingredient,thisunit:thisunit,thiscost:thiscost,foodcode:foodcode,food:food,department:department,cost:cost,},function(data){
				                       $('#ins').fadeIn().html(data); 
									   $('form').trigger("reset");  
										console.log(data);
									  setTimeout(function(){  
										   $('#response').fadeOut("slow");  
									  }, 5000);
			});
			
			});
			
			$('#submit1').click(function(){
				$('.send').trigger('click');
			});
	  
  });
  </script>
</head>
<body>
  <div class="container">
    <div class="sidebar">
		  <nav class="menu">
			<a><div class="user"><?php echo $userid;?></div></a>
			<a href="#home">Home</a>
			<a href="menu.php">Kitchen</a>
			<a href="suppliers.php">Suppliers</a>
			<a href="orders.php">POS</a>
			<a href="cashier.php">Cashier</a>
			<a href="Sales.php">Sales</a>
		  </nav>
		  <div class="menu-btn">
			<i class="fas fa-bars">HERE</i>
		  </div>
		</div>
    <h1>Welcome <?php echo $userid;?></h1>
    <div class="tabs">
	<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'overview')">Today</div>
	<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'inventory')">This Month</div>
      <div class="tab tab-link" id="login-tab" onclick="openTab(event, 'login')">This Year</div>
      <button class="tab tab-link" id="register-tab" onclick="openTab(event, 'analy')">Analytics</button>
    </div>
	<div id="overview" class="tabcontent">
       <div class="tabs">
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'tsales')"><?php echo date("Y-m-d");?> Sales</div>
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'tdep')"><?php echo date("Y-m-d");?> Departments</div>
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'twaiters')"><?php echo date("Y-m-d");?> Waiters</div>
		</div>
    </div>
	
	<div id="tsales" class="tabcontent">
	<h3>Today Sales</h3>
        <table class="table" style="border: 1px solid black;">
		  <thead>
			  <th>ID</th>
			  <th>Receipt</th>
			  <th>Cashier</th>
			  <th>Amount</th>
			  <th>Profit</th>
			  <th>Timed</th>
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $td = date("Y-m-d");
			  $gettd= mysqli_query($con,"select * from receipts where dated like '%$td%'");
			  while($getrec = mysqli_fetch_array($gettd)){
				  echo '<tr>';
				  echo '<td>'.$getrec['id'].'</td>';
				  echo '<td>'.$getrec['receipt'].'</td>';
				  echo '<td>'.$getrec['cashier'].'</td>';
				  echo '<td>'.$getrec['amount'].'</td>';
				  echo '<td>'.$getrec['profit'].'</td>';
				  echo '<td>'.$getrec['timed'].'</td>';
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		  <tfoot>
		  <?php 
		  $tdr = date("Y-m-d");
			  $gettdr= mysqli_query($con,"select SUM(amount) as amount,SUM(profit) as profit from receipts where dated like '%$tdr%'");
			  $getrecr = mysqli_fetch_array($gettdr);
			  echo '<tr>';
			  echo '<td></td>';
				  echo '<td></td>';
				  echo '<td></td>';
				  echo '<td>'.number_format($getrecr['amount'],2).'</td>';
				  echo '<td>'.number_format($getrecr['profit'],2).'</td>';
				  echo '<td>'.number_format((($getrecr['profit']/$getrecr['amount'])*100),2).'%</td>';
				  echo '</tr>';
			  ?>
		  </tfoot>
		</table>

    </div>
	
	<div id="tdep" class="tabcontent">
	<h3>Today departments performance</h3>
        <table class="table" style="border: 1px solid black;">
		  <thead>
			 
			  <th>Department</th>
			  <th>Amount</th>
			  <th>Profit</th>
			  
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $tds = date("Y-m-d");
			  $gettds= mysqli_query($con,"select department,SUM(price) as price,SUM(profit) as profit from cart where dated like '%$tds%' group by department");
			  while($getrec = mysqli_fetch_array($gettds)){
				  echo '<tr>';
				  echo '<td>'.$getrec['department'].'</td>';
				  echo '<td>'.$getrec['price'].'</td>';
				  echo '<td>'.$getrec['profit'].'</td>';
				 
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		  
		</table>

    </div>
	
	
		<div id="twaiters" class="tabcontent">
		<h3>Todays service crew performance and payment modes</h3>
        <table class="table" style="border: 1px solid black;">
		  <thead>
			 
			  <th>Waiter</th>
			  <th>Cash</th>
			  <th>Mpesa</th>
			  <th>Bank</th>
			  <th>Total Amount</th>
			  <th>Profit</th>
			  
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $tds = date("Y-m-d");
			  $gettds= mysqli_query($con,"select cashier,SUM(cash) as cash,SUM(mpesa) as mpesa,SUM(bank) as bank,SUM(profit) as profit,SUM(amount) as amount from receipts where dated like '%$tds%' group by cashier");
			  while($getrec = mysqli_fetch_array($gettds)){
				  echo '<tr>';
				  echo '<td>'.$getrec['cashier'].'</td>';
				  echo '<td>'.$getrec['cash'].'</td>';
				  echo '<td>'.$getrec['mpesa'].'</td>';
				echo '<td>'.$getrec['bank'].'</td>';
				echo '<td><strong>'.$getrec['amount'].'</strong></td>';
				echo '<td>'.$getrec['profit'].'</td>';
				  echo '</tr>';
			  }
			 
			  ?>
			
		  </tbody>
		  
		  <tfoot>
		  <?php
		   echo '<tr>';
			  $tdst = date("Y-m-d");
			  $gettdsy= mysqli_query($con,"select SUM(cash) as cash,SUM(mpesa) as mpesa,SUM(bank) as bank,SUM(profit) as profit,SUM(amount) as amount from receipts where dated like '%$tdst%'");
			  $getrect = mysqli_fetch_array($gettdsy);
			  echo '<td></td><strong>';
				  echo '<td>'.$getrect['cash'].'</td>';
				  echo '<td>'.$getrect['mpesa'].'</td>';
				echo '<td>'.$getrect['bank'].'</td>';
				echo '<td>'.$getrect['amount'].'</td>';
				echo '<td>'.$getrect['profit'].'</td>';
			  echo '</strong></tr>';
			  ?>
			</tfoot>
		</table>

    </div>
	
		<div id="inventory" class="tabcontent">
       <div class="tabs">
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'msales')"><?php echo date("Y-m");?> Sales</div>
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'mdep')"><?php echo date("Y-m");?> Departments</div>
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'mwaiters')"><?php echo date("Y-m");?> Waiters</div>
		</div>

    </div>
	
	<div id="msales" class="tabcontent">
	<h3>This month sales</h3>
        <table class="table" style="border: 1px solid black;">
		  <thead>
			  <th>ID</th>
			  <th>Receipt</th>
			  <th>Cashier</th>
			  <th>Amount</th>
			  <th>Profit</th>
			  <th>Timed</th>
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $td = date("Y-m");
			  $gettd= mysqli_query($con,"select * from receipts where dated like '%$td%'");
			  while($getrec = mysqli_fetch_array($gettd)){
				  echo '<tr>';
				  echo '<td>'.$getrec['id'].'</td>';
				  echo '<td>'.$getrec['receipt'].'</td>';
				  echo '<td>'.$getrec['cashier'].'</td>';
				  echo '<td>'.$getrec['amount'].'</td>';
				  echo '<td>'.$getrec['profit'].'</td>';
				  echo '<td>'.$getrec['timed'].'</td>';
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		  <tfoot>
		  <?php 
		  $tdr = date("Y-m");
			  $gettdr= mysqli_query($con,"select SUM(amount) as amount,SUM(profit) as profit from receipts where dated like '%$tdr%'");
			  $getrecr = mysqli_fetch_array($gettdr);
			  echo '<tr>';
			  echo '<td></td>';
				  echo '<td></td>';
				  echo '<td></td>';
				  echo '<td>'.number_format($getrecr['amount'],2).'</td>';
				  echo '<td>'.number_format($getrecr['profit'],2).'</td>';
				  echo '<td>'.number_format((($getrecr['profit']/$getrecr['amount'])*100),2).'%</td>';
				  echo '</tr>';
			  ?>
		  </tfoot>
		</table>

    </div>
	
	<div id="mdep" class="tabcontent">
	<h3>This month departments performance</h3>
        <table class="table" style="border: 1px solid black;">
		  <thead>
			 
			  <th>Department</th>
			  <th>Amount</th>
			  <th>Profit</th>
			  
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $tds = date("Y-m");
			  $gettds= mysqli_query($con,"select department,SUM(price) as price,SUM(profit) as profit from cart where dated like '%$tds%' group by department");
			  while($getrec = mysqli_fetch_array($gettds)){
				  echo '<tr>';
				  echo '<td>'.$getrec['department'].'</td>';
				  echo '<td>'.$getrec['price'].'</td>';
				  echo '<td>'.$getrec['profit'].'</td>';
				 
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		  
		</table>

    </div>
	
	
		<div id="mwaiters" class="tabcontent">
		<h3>This month service crew sales and mode of payments</h3>
        <table class="table" style="border: 1px solid black;">
		  <thead>
			 
			  <th>Waiter</th>
			  <th>Cash</th>
			  <th>Mpesa</th>
			  <th>Bank</th>
			  <th>Total Amount</th>
			  <th>Profit</th>
			  
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $tds = date("Y-m");
			  $gettds= mysqli_query($con,"select cashier,SUM(cash) as cash,SUM(mpesa) as mpesa,SUM(bank) as bank,SUM(profit) as profit,SUM(amount) as amount from receipts where dated like '%$tds%' group by cashier");
			  while($getrec = mysqli_fetch_array($gettds)){
				  echo '<tr>';
				  echo '<td>'.$getrec['cashier'].'</td>';
				  echo '<td>'.$getrec['cash'].'</td>';
				  echo '<td>'.$getrec['mpesa'].'</td>';
				echo '<td>'.$getrec['bank'].'</td>';
				echo '<td><strong>'.$getrec['amount'].'</strong></td>';
				echo '<td>'.$getrec['profit'].'</td>';
				  echo '</tr>';
			  }
			 
			  ?>
			
		  </tbody>
		  
		  <tfoot>
		  <?php
		   echo '<tr>';
			  $tdst = date("Y-m");
			  $gettdsy= mysqli_query($con,"select SUM(cash) as cash,SUM(mpesa) as mpesa,SUM(bank) as bank,SUM(profit) as profit,SUM(amount) as amount from receipts where dated like '%$tdst%'");
			  $getrect = mysqli_fetch_array($gettdsy);
			  echo '<td></td><strong>';
				  echo '<td>'.$getrect['cash'].'</td>';
				  echo '<td>'.$getrect['mpesa'].'</td>';
				echo '<td>'.$getrect['bank'].'</td>';
				echo '<td>'.$getrect['amount'].'</td>';
				echo '<td>'.$getrect['profit'].'</td>';
			  echo '</strong></tr>';
			  ?>
			</tfoot>
		</table>

    </div>
	
    <div id="login" class="tabcontent">
     <div class="tabs">
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'ysales')"><?php echo date("Y");?> Sales</div>
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'ydep')"><?php echo date("Y");?> Departments</div>
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'ywaiters')"><?php echo date("Y");?> Waiters</div>
		</div>
    </div>
	
	<div id="ysales" class="tabcontent">
	<h3>This year sales</h3>
        <table class="table" style="border: 1px solid black;">
		  <thead>
			  <th>ID</th>
			  <th>Receipt</th>
			  <th>Cashier</th>
			  <th>Amount</th>
			  <th>Profit</th>
			  <th>Timed</th>
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $td = date("Y");
			  $gettd= mysqli_query($con,"select * from receipts where dated like '%$td%'");
			  while($getrec = mysqli_fetch_array($gettd)){
				  echo '<tr>';
				  echo '<td>'.$getrec['id'].'</td>';
				  echo '<td>'.$getrec['receipt'].'</td>';
				  echo '<td>'.$getrec['cashier'].'</td>';
				  echo '<td>'.$getrec['amount'].'</td>';
				  echo '<td>'.$getrec['profit'].'</td>';
				  echo '<td>'.$getrec['timed'].'</td>';
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		  <tfoot>
		  <?php 
		  $tdr = date("Y");
			  $gettdr= mysqli_query($con,"select SUM(amount) as amount,SUM(profit) as profit from receipts where dated like '%$tdr%'");
			  $getrecr = mysqli_fetch_array($gettdr);
			  echo '<tr>';
			  echo '<td></td>';
				  echo '<td></td>';
				  echo '<td></td>';
				  echo '<td>'.number_format($getrecr['amount'],2).'</td>';
				  echo '<td>'.number_format($getrecr['profit'],2).'</td>';
				  echo '<td>'.number_format((($getrecr['profit']/$getrecr['amount'])*100),2).'%</td>';
				  echo '</tr>';
			  ?>
		  </tfoot>
		</table>

    </div>
	
	<div id="ydep" class="tabcontent">
	<h3>This year departments performance</h3>
        <table class="table" style="border: 1px solid black;">
		  <thead>
			 
			  <th>Department</th>
			  <th>Amount</th>
			  <th>Profit</th>
			  
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $tds = date("Y");
			  $gettds= mysqli_query($con,"select department,SUM(price) as price,SUM(profit) as profit from cart where dated like '%$tds%' group by department");
			  while($getrec = mysqli_fetch_array($gettds)){
				  echo '<tr>';
				  echo '<td>'.$getrec['department'].'</td>';
				  echo '<td>'.$getrec['price'].'</td>';
				  echo '<td>'.$getrec['profit'].'</td>';
				 
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		  
		</table>

    </div>
	
	
		<div id="ywaiters" class="tabcontent">
		<h3>This year service crew sales and mode of payments</h3>
        <table class="table" style="border: 1px solid black;">
		  <thead>
			 
			  <th>Waiter</th>
			  <th>Cash</th>
			  <th>Mpesa</th>
			  <th>Bank</th>
			  <th>Total Amount</th>
			  <th>Profit</th>
			  
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $tds = date("Y");
			  $gettds= mysqli_query($con,"select cashier,SUM(cash) as cash,SUM(mpesa) as mpesa,SUM(bank) as bank,SUM(profit) as profit,SUM(amount) as amount from receipts where dated like '%$tds%' group by cashier");
			  while($getrec = mysqli_fetch_array($gettds)){
				  echo '<tr>';
				  echo '<td>'.$getrec['cashier'].'</td>';
				  echo '<td>'.$getrec['cash'].'</td>';
				  echo '<td>'.$getrec['mpesa'].'</td>';
				echo '<td>'.$getrec['bank'].'</td>';
				echo '<td><strong>'.$getrec['amount'].'</strong></td>';
				echo '<td>'.$getrec['profit'].'</td>';
				  echo '</tr>';
			  }
			 
			  ?>
			
		  </tbody>
		  
		  <tfoot>
		  <?php
		   echo '<tr>';
			  $tdst = date("Y");
			  $gettdsy= mysqli_query($con,"select SUM(cash) as cash,SUM(mpesa) as mpesa,SUM(bank) as bank,SUM(profit) as profit,SUM(amount) as amount from receipts where dated like '%$tdst%'");
			  $getrect = mysqli_fetch_array($gettdsy);
			  echo '<td></td><strong>';
				  echo '<td>'.$getrect['cash'].'</td>';
				  echo '<td>'.$getrect['mpesa'].'</td>';
				echo '<td>'.$getrect['bank'].'</td>';
				echo '<td>'.$getrect['amount'].'</td>';
				echo '<td>'.$getrect['profit'].'</td>';
			  echo '</strong></tr>';
			  ?>
			</tfoot>
		</table>

    </div>
   <div id="analy" class="tabcontent">
    <div class="tabs">
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'analysales')">Sales Analytics</div>
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'analydep')">Departments Analytics</div>
			<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'analywaiters')">Waiters Analytics</div>
		</div>
	
		</div>
		
		<div id="analysales" class="tabcontent">
			<iframe src="analytics/annualsales.php" height="800" width="1000" title="Analytics"></iframe>
		</div>
			
		<div id="analydep" class="tabcontent">
			<iframe src="analytics/departments.php" height="800" width="1000" title="Analytics"></iframe>
		</div>
		
		<div id="analywaiters" class="tabcontent">
			<iframe src="analytics/waiters.php" height="800" width="1000" title="Analytics"></iframe>
		</div>
			
			
	<div id="response"></div> 
  </div>
  <script>
    function openTab(event, tabName) {
      let i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tab");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(tabName).style.display = "block";
      event.currentTarget.className += " active";
    }
    document.getElementById("login-tab").click();
  </script>
  <script>
  $(document).ready(function () {
    $('.table').DataTable();
});
  </script>
</body>
</html>