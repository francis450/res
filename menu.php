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
  max-width: 600px;
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
      max-width: 600px;
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
			
				$('.q').click(function(){
			var q = $(this).val();
			var iq = $(this).attr('fooda');
			alert(iq);
			$.post('register.php',{q:q,iq:iq,},function(data){
				$('#response').fadeIn().html(data); 
			});
		});
		
		$('.r').click(function(){
			var r = $(this).val();
			var ir = $(this).attr('fooda');
			$.post('register.php',{r:r,ir:ir,},function(data){
				$('#response').fadeIn().html(data); 
			});
		});
		
		$('.s').click(function(){
			var s = $(this).val();
			var is = $(this).attr('fooda');
			$.post('register.php',{s:s,is:is,},function(data){
				$('#response').fadeIn().html(data); 
			});
		});
		
		$('.p').click(function(){
			var p = $(this).val();
			var ip = $(this).attr('fooda');
			
			$.post('register.php',{p:p,ip:ip,},function(data){
				console.log(data);
				$('#response').fadeIn().html(data); 
			});
		});
	  
  });
  </script>
</head>
<body>
  <div class="container">
    <div class="sidebar">
		  <nav class="menu">
			<a><div class="user"><?php echo $userid;?></div></a>
			<a href="main.php">Home</a>
			<a href="menu.php">Menu</a>
			<a href="suppliers.php">Suppliers</a>
			<a href="orders.php">Orders</a>
		  </nav>
		  <div class="menu-btn">
			<i class="fas fa-bars">HERE</i>
		  </div>
		</div>
    <h1>Welcome <?php echo $userid;?></h1>
    <div class="tabs">
	<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'overview')">Menu</div>
	<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'kitcheninventory')">Kitchen Inventory</div>
      <div class="tab tab-link" id="login-tab" onclick="openTab(event, 'login')">Active Orders</div>
      <button class="tab tab-link" id="register-tab" onclick="openTab(event, 'register')">Pay Orders</button>
	  <div class="tab tab-link" id="login-tab" onclick="openTab(event, 'completed')">Completed</div>
    </div>
	<div id="overview" class="tabcontent">
        <table class="table stripe" style="border: 1px solid black;">
		  <thead>
			  <th>#</th>
			  <th>Food</th>
			  <th>Unit Cost</th>
			  <th>Proposed price</th>
			  <th>Margin</th>
			  <th>Department</th>
			  <th>Ingredients</th>
			  
		  </thead>
		  <tbody>
			  <?php
			  $getmenu = mysqli_query($con,"select * from menu");
			  while($getsuppliersr = mysqli_fetch_array($getmenu)){
				  echo '<tr>';
				  echo '<td>'.$getsuppliersr['foodcode'].'</td>';
				  echo '<td>'.$getsuppliersr['food'].'</td>';
				  echo '<td>'.$getsuppliersr['cost'].'</td>';
				  echo '<td>'.$getsuppliersr['price'].'</td>';
				  $margin = $getsuppliersr['price'] - $getsuppliersr['cost'];
				  echo '<td>'.$margin.'</td>';
				  echo '<td>'.$getsuppliersr['department'].'</td>';
				  echo '<td>';
				  echo '<ol>';
				  $cc = $getsuppliersr['foodcode'];
				  $getr = mysqli_query($con,"select * from ingredients where foodcode = '$cc'");
				  while($getrr = mysqli_fetch_array($getr)){
					  
					  echo '<li>'.$getrr['ingredient'].'</li>';
				  }
				   echo '<ol>';
				  echo '</td>';
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		</table>

    </div>
	
	<div id="kitcheninventory" class="tabcontent">
         <table class="table" style="border: 1px solid black;">
		  <thead>
			  <th>ID</th>
			  <th>Product</th>
			  <th>Quantity</th>
			  <th>Unit Cost</th>
			  <th>g/ml</th>
			  <th>Kg/Ltrs</th>
			  <th>Value</th>
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $getsuppliers = mysqli_query($con,"select * from kitchenstock where qnty>0");
			  while($getsuppliersr = mysqli_fetch_array($getsuppliers)){
				  echo '<tr>';
				  echo '<td>'.$getsuppliersr['id'].'</td>';
				  echo '<td>'.$getsuppliersr['product'].'</td>';
				  echo '<td>'.$getsuppliersr['bigunit'].'</td>';
				  echo '<td>'.$getsuppliersr['unitcost'].'</td>';
				  echo '<td>'.$getsuppliersr['smallunit'].'</td>';
				  echo '<td>'.$getsuppliersr['bigunit'].'</td>';
				  $value = $getsuppliersr['unitcost']*$getsuppliersr['qnty'];
				  echo '<td>'.number_format($value,2).'</td>';
				 // echo '<td><a href="transfer.php?id='.$getsuppliersr['id'].'">Transfer</a></td>';
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		</table>

    </div>
	
    <div id="login" class="tabcontent">
      <table class="table stripe" style="border: 1px solid black;">
		  <thead>
			  <th>#</th>
			  <th>Order Number</th>
			  <th>Table</th>
			  <th>Waiter</th>
			  <th>Status</th>
			  <th>Time</th>
			  <th>Action</th>
			  
		  </thead>
		  <tbody>
			  <?php
			  $getmenut = mysqli_query($con,"select * from peddingorders where status!='4' and status!='5'");
			  while($getsuppliersr = mysqli_fetch_array($getmenut)){
				  echo '<tr>';
				  echo '<td>'.$getsuppliersr['id'].'</td>';
				  echo '<td>'.$getsuppliersr['ordernumber'].'</td>';
				  echo '<td>'.$getsuppliersr['tablenumber'].'</td>';
				  echo '<td>'.$getsuppliersr['waiter'].'</td>';
				  
				 $status = $getsuppliersr['status'];
				 if($status=='0'){
					 echo '<td><button fooda="'.$getsuppliersr['ordernumber'].'" class="btn q" style="background-color:red" value="'.$getsuppliersr['status'].'">Add to queue</button></td>';
				 }else if($status=='1'){
					 echo '<td><button fooda="'.$getsuppliersr['ordernumber'].'" class="btn r" style="background-color:grey" value="'.$getsuppliersr['status'].'">On progress.Mark as ready</button></td>';
				 }else if($status=='2'){
					 echo '<td><button fooda="'.$getsuppliersr['ordernumber'].'" class="btn s" style="background-color:blue" value="'.$getsuppliersr['status'].'">Ready.Mark as Served</button></td>';
				 }else if($status=='3'){
					 echo '<td><button fooda="'.$getsuppliersr['ordernumber'].'" class="btn p" style="background-color:green" value="'.$getsuppliersr['status'].'">pay</button></td>';
				 }
				 $timed = $getsuppliersr['timed'];
				 $now = date("Y-m-d H:i:s");
					$datetime1 = new DateTime($timed);//start time
					$datetime2 = new DateTime($now);//end time
					$interval = $datetime1->diff($datetime2);
					echo '<td>'.$interval->format("%H hours %i minutes %s seconds").'</td>';
					//echo '<td>'.$interval->format("%Y years %m months %d days %H hours %i minutes %s seconds").'</td>';
				 /* $cc = $getsuppliersr['foodcode'];
				  $getr = mysqli_query($con,"select * from ingredients where foodcode = '$cc'");
				  while($getrr = mysqli_fetch_array($getr)){
					  
					  echo '<li>'.$getrr['ingredient'].'</li>';
				  }
				   echo '<ol>';
				  echo '</td>';
				  echo '</tr>';*/
				  echo '<td foo ="'.$getsuppliersr['ordernumber'].'" class="del">Recall order</td>';
			  }
			  ?>
			
		  </tbody>
		</table>
		
		<?php
		
		?>
    </div>
    <div id="register" class="tabcontent">
     <table class="table stripe" style="border: 1px solid black;">
		  <thead>
			  <th>#</th>
			  <th>Order Number</th>
			  <th>Table</th>
			  <th>Waiter</th>
			  
			  <th>Time</th>
			  <th>Payable</th>
			  <th>Action</th>
			  
		  </thead>
		  <tbody>
			  <?php
			  $getmenut = mysqli_query($con,"select * from peddingorders where status='4'");
			  while($getsuppliersr = mysqli_fetch_array($getmenut)){
				  echo '<tr>';
				  echo '<td>'.$getsuppliersr['id'].'</td>';
				  echo '<td>'.$getsuppliersr['ordernumber'].'</td>';
				  echo '<td>'.$getsuppliersr['tablenumber'].'</td>';
				  echo '<td>'.$getsuppliersr['waiter'].'</td>';
				 $timed = $getsuppliersr['timed'];
				 $now = date("Y-m-d H:i:s");
					$datetime1 = new DateTime($timed);//start time
					$datetime2 = new DateTime($now);//end time
					$interval = $datetime1->diff($datetime2);
					echo '<td>'.$interval->format("%H hours %i minutes %s seconds").'</td>';
					$df= $getsuppliersr['ordernumber'];
					$getr = mysqli_query($con,"select SUM(price) as tt from tempcart where ordernumber = '$df'");
					
					 while($getrr = mysqli_fetch_array($getr)){
					  
					  echo '<td>'.number_format($getrr['tt'],2).'</td>';
				  }
				  $getrh = mysqli_query($con,"select SUM(price) as tt from tempcart where ordernumber = '$df'");
				  $getrrr = mysqli_fetch_array($getrh);
					$amount=number_format($getrrr['tt'],2);
					
				  echo '<td bill ="'.$getsuppliersr['ordernumber'].'" class="del"><a href="pay.php?bill='.$getsuppliersr['ordernumber'].'&amount='.$amount.'">Pay</a></td>';
			  }
			  ?>
			
		  </tbody>
		</table>
    </div>
	    <div id="completed" class="tabcontent">
     <table class="table stripe" style="border: 1px solid black;">
		  <thead>
			  <th>#</th>
			  <th>Order Number</th>
			  <th>Table</th>
			  <th>Waiter</th>
			  
			  <th>Time</th>
			  <th>Payable</th>
			  
			  
		  </thead>
		  <tbody>
			  <?php
			  $getmenut = mysqli_query($con,"select * from peddingorders where status='5'");
			  while($getsuppliersr = mysqli_fetch_array($getmenut)){
				  echo '<tr>';
				  echo '<td>'.$getsuppliersr['id'].'</td>';
				  echo '<td>'.$getsuppliersr['ordernumber'].'</td>';
				  echo '<td>'.$getsuppliersr['tablenumber'].'</td>';
				  echo '<td>'.$getsuppliersr['waiter'].'</td>';
				 $timed = $getsuppliersr['timed'];
				 $now = date("Y-m-d H:i:s");
					$datetime1 = new DateTime($timed);//start time
					$datetime2 = new DateTime($now);//end time
					$interval = $datetime1->diff($datetime2);
					echo '<td>'.$interval->format("%H hours %i minutes %s seconds").'</td>';
					$df= $getsuppliersr['ordernumber'];
					$getr = mysqli_query($con,"select SUM(price) as tt from cart where ordernumber = '$df'");
					
					 while($getrr = mysqli_fetch_array($getr)){
					  
					  echo '<td>'.number_format($getrr['tt'],2).'</td>';
				  }
				  $getrh = mysqli_query($con,"select SUM(price) as tt from cart where ordernumber = '$df'");
				  $getrrr = mysqli_fetch_array($getrh);
					$amount=number_format($getrrr['tt'],2);
					
				 // echo '<td bill ="'.$getsuppliersr['ordernumber'].'" class="del"><a href="pay.php?bill='.$getsuppliersr['ordernumber'].'&amount='.$amount.'">Pay</a></td>';
			  }
			  ?>
			
		  </tbody>
		</table>
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