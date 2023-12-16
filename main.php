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
	<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'overview')">Purchase History</div>
	<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'inventory')">Inventory</div>
      <div class="tab tab-link" id="login-tab" onclick="openTab(event, 'login')">Food Accounting</div>
      <button class="tab tab-link" id="register-tab" onclick="openTab(event, 'register')">Purchase</button>
    </div>
	<div id="overview" class="tabcontent">
        <table class="table" style="border: 1px solid black;">
		  <thead>
			  <th>#</th>
			  <th>Supplier</th>
			  <th>Product</th>
			  <th>Unit Cost</th>
			  <th>Total</th>
			  <th>Paid</th>
			  <th>Balance</th>
			  <th>Dated</th>
		  </thead>
		  <tbody>
			  <?php
			  $getsuppliers = mysqli_query($con,"select * from purchases");
			  while($getsuppliersr = mysqli_fetch_array($getsuppliers)){
				  echo '<tr>';
				  echo '<td>'.$getsuppliersr['receipt'].'</td>';
				  echo '<td>'.$getsuppliersr['supplier'].'</td>';
				  echo '<td>'.$getsuppliersr['product'].'</br>'.$getsuppliersr['units'].'</br>'.$getsuppliersr['measure'].'</td>';
				  echo '<td>'.$getsuppliersr['unitcost'].'</td>';
				  echo '<td>'.$getsuppliersr['totalcost'].'</td>';
				  echo '<td>'.$getsuppliersr['paid'].'</td>';
				  $bal = $getsuppliersr['paid'];
				  if((int)$bal<0){
					  echo '<td class="red">'.$getsuppliersr['balance'].'</td>';
				  }else if((int)$bal>0){
					  echo '<td class="green">'.$getsuppliersr['balance'].'</td>';
				  }else{
					  echo '<td class="yellow">'.$getsuppliersr['balance'].'</td>';
				  }
				  
				  echo '<td>'.$getsuppliersr['dated'].'</td>';
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		</table>

    </div>
	
		<div id="inventory" class="tabcontent">
        <table class="table" style="border: 1px solid black;">
		  <thead>
			  <th>ID</th>
			  <th>Product</th>
			  <th>Quantity</th>
			  <th>Unit Cost</th>
			  <th>g/ml</th>
			  <th>Kg/Ltrs</th>
			  <th>Value</th>
			  <th>Transfer</th>
			  
		  </thead>
		  <tbody>
			  <?php
			  $getsuppliers = mysqli_query($con,"select * from products where qnty>0");
			  while($getsuppliersr = mysqli_fetch_array($getsuppliers)){
				  echo '<tr>';
				  echo '<td>'.$getsuppliersr['id'].'</td>';
				  echo '<td>'.$getsuppliersr['product'].'</td>';
				  echo '<td>'.$getsuppliersr['qnty'].'</td>';
				  echo '<td>'.$getsuppliersr['unitcost'].'</td>';
				  echo '<td>'.$getsuppliersr['smallunit'].'</td>';
				  echo '<td>'.$getsuppliersr['bigunit'].'</td>';
				  $value = $getsuppliersr['unitcost']*$getsuppliersr['qnty'];
				  echo '<td>'.number_format($value,2).'</td>';
				  echo '<td><a href="transfer.php?id='.$getsuppliersr['id'].'">Transfer</a></td>';
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		</table>

    </div>
	
    <div id="login" class="tabcontent">
      <form class="login-form" id="login_form">
        <label for="username" class="form-label">Add food</label>
		<div class="romeo">
			<input type="text" class="form-control" id="foodcode" name="foodcode" placeholder="food unique code">
			<input type="text" class="form-control" id="foodname" name="foodname" placeholder="food unique name">
		</div>
        
        <label for="password" class="form-label">Department</label>
		<div class="romeo">
		   <select  class="form-control" id="fooddepartment" name="fooddepartment" placeholder="food department">
			<option>Restaurant</option>
			<option>Bar</option>
			<option>Bakery</option>
		   </select>
		</div>
        <div class="romeo">
		<select  class="form-control" id="foodingredient" name="foodingredient" placeholder="food ingredient">
				<?php
				$getproducts = mysqli_query($con,"select * from products");
				while($getproductsr = mysqli_fetch_array($getproducts)){
					echo '<option>'.$getproductsr['product'].'</option>';
				}
				?>
		   </select>
		   <input type="number" class="form-control" name="gredientunit" id="gredientunit"  placeholder="ingredient  units"> 
		   <select class="form-control" id="ingredientunit" name="ingredientunit" placeholder="units">
			<option>Select Units</option>
			<option>Kgs</option>
			<option>Gr</option>
			<option>Ltrs</option>
			<option>Mls</option>
			<option>Bunch</option>
			</select>
			<input type="text" class="form-control" name="smallunittt" id="smallunittt" /> 
		   <input type="button" class="btn btn-primary" name="addingredient" id="addingredient"  value="+" /> 
		</div>
		<div class="romeo"><table id="ins" class="table"></table></div>
		<div class="romeo"><span id="tcost"></span></div>
		<input type="button" class="btn btn-info" name="submit" id="submit1"  value="Submit" /> 
			   
       
      </form>
    </div>
    <div id="register" class="tabcontent">
      <form class="login-form" id="login-form2">
	  <input type="text" class="form-control" id="ref" name="ref" placeholder="Receipt Number">
	  <span id="test"></span>
	  <label for="#">Product</label>
	  <div class="romeo">
	  
		 <select type="text" class="form-control" id="psupplier" name="psupplier">
		<option>Select Supplier</option>
		 <?php
			  $getsupplierss = mysqli_query($con,"select * from suppliers");
			  while($getsuppliersrs = mysqli_fetch_array($getsupplierss)){
				 
				  echo '<option>'.$getsuppliersrs['fullname'].'</option>';
				  
			  }
			  ?>
		</select>
		
		
		 <select type="text" class="form-control" id="product" name="products">
			<option>Select product</option>
			 
			</select>
		<input type="number" class="form-control" id="units" name="units" placeholder="Units">
	  </div>
	  <label for="fullname">Inventory</label>
	  <div class="romeo">
	    
        
		<input type="number" class="form-control" id="qnty" name="qnty" placeholder="Weight per unit">
		<select class="form-control" id="unit" name="unit" placeholder="units">
		<option>Select Units</option>
		<option>Kgs</option>
		<option>Gr</option>
		<option>Ltrs</option>
		<option>Mls</option>
		<option>Bunch</option>
		</select>
        <input type="text" class="form-control" id="smallunit" name="smallunit" placeholder="Calulated Small Unit" readonly>
		 <input type="text" class="form-control" id="bigunit" name="bigunit" placeholder="Calulated Main Unit" readonly>
		 
	   </div>
	   <label for="#">Payments</label>
	   <div class="romeo">
	   
	   <input type="number" class="form-control" id="unitcost" name="unitcost" placeholder="Unit Cost">
	   <input type="number" class="form-control" id="totalcost" name="totalcost" placeholder="Total cost">
	   <input type="number" class="form-control" id="totalpaid" name="totalpaid" placeholder="Total Paid">
	   <input type="number" class="form-control" id="totalbal" name="totalbal" placeholder="Total Balance">
	   <select  class="form-control" id="paymentmethod" name="paymentmethod">
	   <option>Cash</option>
	   <option>Mpesa</option>
	   <option>Cheque</option>
	   <option>Bank transfer</option>
	   </select>
	   </div>
	   <input type="text" class="form-control" id="paymentdescription" name="paymentdescription" placeholder="Payment Description">
        <label for="#">Comment</label>
        <input type="text" class="form-control" id="comment" name="comment">
		 
        
		 <input type="button" class="btn btn-info" name="purchase" id="purchase"  value="Purchase" /> 
      </form>
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