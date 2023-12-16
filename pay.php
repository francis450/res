<?php
include'connection.php';

$uiy = date('Y-m-d H:i:s');
$long = strtotime($uiy);
$cartid= rand(1000,100000) + $long;
$transferid = $long;

$orderid = $_GET['bill'];
$amount = $_GET['amount'];
$getlist = mysqli_query($con,"select * from tempcart where ordernumber = '$orderid '");


?>
<html>
<head>
  <title>Login and Registration Form</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
   <script type="text/javascript" src="jscss/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="jscss/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jscss/jquery.dataTables.min.css">
  <style>
  body {
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
      max-width: 400px;
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
	
	.wrong{
         border: 1px solid red;
    }
	
	.right{
         border: 1px solid yellow;
    }
	.ok{
         border: 1px solid green;
    }
	.romeo{
		display: flex; 
		justify-content: space-around;
	}
  </style>
  <script>
  $(document).ready(function(){
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
						$('form').trigger("reset");  
									  $('#response').fadeIn().html(data); 
										console.log(data);
									  setTimeout(function(){  
										   $('#response').fadeOut("slow");  
									  }, 5000); 
				   });
             
           }  
      });
	  
	 
	  
  });
  </script>
</head>
<body>
  <div class="container">
  
		
		
    <h1>Welcome to Romtecx Hotel Pos</h1>
    <div class="tabs"> 
      <button class="tab tab-link" id="login-tab" onclick="openTab(event, 'login')">Order Payment</button>
      <button class="tab tab-link" id="register-tab" onclick="openTab(event, 'register')">Pending Orders</button>
    </div>
    <div id="login" class="tabcontent">
      <form class="login-form" id="login_form">
        <label for="username" class="form-label">Order ID</label>
        <input type="text" class="form-control" id="productid" name="productid" value="<?php echo $orderid;?>" readonly>
        <label for="password" class="form-label">Details</label>
        <textarea  class="form-control" id="product" rows="5" name="product">
			<?php
				while($getlistr = mysqli_fetch_array($getlist)){
					echo $getlistr['food'].' '.$getlistr['qnty'].' '.$getlistr['price'].',';
				}
			?>
		</textarea>
		<label for="username" class="form-label">Total Payable</label>
        <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $_GET['amount'];?>">
		
		
		
		
       <!--<input type="button" class="btn btn-info" name="submit" id="submit1"  value="Submit" /> -->
	   <table>
	   <tr>
	   <td>Cash</td><td><input type="text" class="form-control" id="cash" name="cash" required></td>
	   </tr>
	   <tr>
	   <td>Mpesa</td><td><input type="text" class="form-control" id="mpesa" name="mpesa" required></td>
	   </tr>
	   <tr>
	   <td>Bank</td><td><input type="text" class="form-control" id="bank" name="bank" required></td>
	   </tr>
	   <tr>
	   <td>Total</td><td><input type="text" class="form-control" id="total" name="total" required></td>
	   </tr>
	   <tr>
	   <td>Balance</td><td class="wow"><input type="text" class="form-control" id="balance" name="balance" required></td>
	   </tr>
	   </table>
	   <div class="romeo btn sendbtn">
			SUBMIT ORDER PAYMENT
	   </div>
	   <script>
	   $('.sendbtn').hide();
	   $('#cash,#mpesa,#bank').keyup(function(){
		   var thisvalue = $(this).val();
		   var cash = parseFloat($('#cash').val())|| 0;
		   var mpesa = parseFloat($('#mpesa').val())||0;
		   var bank = parseFloat($('#bank').val())|| 0;
		   var total  = cash+mpesa+bank;
		   var payable = "<?php echo number_format($_GET['amount'],2);?>";
		   $('#total').val(total);
		   var balance = total - parseFloat(payable);
		   $('#balance').val(balance);
		   
		   if(balance<0){
			   $(".wow").addClass("wrong");
			   $(".login-form").addClass("wrong");
			   $('.sendbtn').hide();
		   }else if(balance>0){
			   $(".wow").addClass("right");
			   $(".login-form").addClass("right");
			   $('.sendbtn').show();
		   }else if(balance===0){
			   $(".wow").addClass("ok");
			   $(".login-form").addClass("ok");
			   $('.sendbtn').show();
		   }
	   });
	   
	   $('.sendbtn').click(function(){
			var cash = parseFloat($('#cash').val())|| 0;
			var mpesa = parseFloat($('#mpesa').val())||0;
			var bank = parseFloat($('#bank').val())|| 0;
			var total  = cash+mpesa+bank;
			var payable = "<?php echo number_format($_GET['amount'],2);?>";
			var balance = total - parseFloat(payable);
			var receipt = "<?php echo $orderid;?>";
			
			$.post('register.php',{cash:cash,mpesa:mpesa,bank:bank,total:total,payable:payable,balance:balance,receipt:receipt},function(data){
					$('#response').fadeIn().html(data);
					$('form').trigger("reset"); 
				});
		   //send items from tempcart to cart
		   //add sales to receipts receipt number,amount,balance,dated,timed,cashier,calculatedprofit,department
		   //remove incredients from kitcheninventory when order is approved at menu.php page
		   //print receipt
		   
	   });
	   </script>
	   <?php
		   
		   ?>
      </form>
    </div>
    <div id="register" class="tabcontent">
    <table class="table" style="border: 1px solid black;">
		  <thead>
			  <th>ID</th>
			  <th>Product</th>
			  <th>Quantity</th>
			  <th>Unit Cost</th>
			  <th>g/ml</th>
			  <th>Kg/Ltrs</th>
			  <th>Value</th>
			  <th>Date</th>
			  
		  </thead>
		  <tbody>
			  <?php
			  $getsuppliers = mysqli_query($con,"select * from transfers");
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
				  echo '<td>'.$getsuppliersr['dated'].'</td>';
				  echo '</tr>';
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