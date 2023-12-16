<?php
include'connection.php';

$uiy = date('Y-m-d H:i:s');
$long = strtotime($uiy);
$cartid= rand(1000,100000) + $long;
$transferid = $long;

$id = $_GET['id'];
$getsuppliers = mysqli_query($con,"select * from products where id = '$id'");
$getsuppliersr = mysqli_fetch_array($getsuppliers);
$product =$getsuppliersr['product'];
$qnty = $getsuppliersr['qnty'];
$smallunit = $getsuppliersr['smallunit'];
$bigunit = $getsuppliersr['bigunit'];
$unitcost = $getsuppliersr['unitcost'];
if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['phone'])&&isset($_POST['email'])&&isset($_POST['fullname'])){
	
}
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
	  
	  $('#tunit').keyup(function(){ var tu = $(this).val(); $('#sent').val(tu);});
	  $('#tunit').change(function(){ var tu = $(this).val(); $('#sent').val(tu);});
	   $('#submit1').click(function(){  
           var productid = $('#productid').val();
			var product = $('#product').val();
			var initqnty = $('#qnty').val();
			var qnty = $('#sent').val();
			var initsmallunit = $('#smallunit').val();
			var smallunit = initsmallunit*(qnty/initqnty);
			var initbigunit = $('#bigunit').val();
			var bigunit = initbigunit*(qnty/initqnty);
			var transferid = "<?php echo $transferid;?>";
			var unitcost = "<?php echo $unitcost;?>";
		
		   
           if(transferid == '' || productid== '' )  
           {  
                $('#response').html('<span class="text-danger">All Fields are required</span>');  
           }  
           else  
           {  
				$('#response').html('<span class="text-info">Loading response...</span>');  
				  // $.post('register.php',{username1:username1, password1:password1,},function(data){ $('#response').fadeIn().html(data); setTimeout(function(){$('form').trigger("reset"); $('#response').fadeOut("slow");}, 5000); });
             $.post('register.php',{transferid:transferid,productid:productid,product:product,qnty:qnty,smallunit:smallunit,bigunit:bigunit,unitcost:unitcost,},function(data){
				$('#response').fadeIn().html(data); 
				console.log(data);
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
      <button class="tab tab-link" id="login-tab" onclick="openTab(event, 'login')">Product Transfer</button>
      <button class="tab tab-link" id="register-tab" onclick="openTab(event, 'register')">Transfer History</button>
    </div>
    <div id="login" class="tabcontent">
      <form class="login-form" id="login_form">
        <label for="username" class="form-label">Product ID</label>
        <input type="text" class="form-control" id="productid" name="productid" value="<?php echo $id;?>" readonly>
        <label for="password" class="form-label">Product</label>
        <input type="text" class="form-control" id="product" name="product" value="<?php echo $product;?>" readonly>
		<label for="qnty" class="form-label">Quantity Available</label>
        <input type="text" class="form-control" id="qnty" name="qnty" value="<?php echo $qnty;?>" readonly>
		<label for="qnty" class="form-label">g/ml Available</label>
        <input type="text" class="form-control" id="smallunit" name="smallunit" value="<?php echo $smallunit;?>" readonly>
		<label for="qnty" class="form-label">kg/ltrs Available</label>
        <input type="text" class="form-control" id="bigunit" name="bigunit" value="<?php echo $bigunit;?>" readonly>
		
		<label for="qnty" class="form-label">Enter Units to transfer</label>
        <input type="number" class="form-control" id="tunit" name="tunit" max="<?php echo $qnty;?>" min="0">
		
		<label for="qnty" class="form-label">Transfered Units</label>
        <input type="number" class="form-control" id="sent" name="sent" max="<?php echo $qnty;?>" min="0" readonly>
		
		
		
		
       <input type="button" class="btn btn-info" name="submit" id="submit1"  value="Submit" /> 
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
			  $getsuppliers = mysqli_query($con,"select * from transfers where productid='$id'");
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