<?php
include'connection.php';
ob_start();
session_start();
include'connection.php';
$userid = $_SESSION['username'];
if(!isset($_SESSION['username'])){
	header("Location: index.php");
}
$uiy = date('Y-m-d H:i:s');
$long = strtotime($uiy);
$cartid= rand(1000,100000) + $long;
$orderid = $long;
?>
<html>
<head>
  <title>Login and Registration Form</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" type="text/css" href="bs/bootstrap.min.css">
  <script type="text/javascript" src="jscss/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="bs/bootstrap.min.js"></script>
  <style>
  body {
  font-family: optima, sans-serif;
}

.container {
  max-width: 80%;
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
	
	.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  
  border-radius: 5px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 5px 5px 0 0;
}

.cardcontainer {
  padding: 2px 16px;
 
}

.romeo{
	display: flex; 
	justify-content: space-around;
}
.payment{
	
    position: absolute;
    bottom: 50;
	
}

.floating-button {
  position: absolute;
  top: 100px;
  right: 0px;
  
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  border-radius: 25%;
  cursor: pointer;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.floating-button:hover {
  background-color: #3e8e41;
  color:white;
}

  </style>
  <script>
  $(document).ready(function(){
	$("#makeorder").hide();
	  
	   $('.cart').click(function(){  
		$("#makeorder").show();
		
           var fcode = $(this).val();  
		   var food = $(this).attr('foo-food'); 
		   var price = $(this).attr('foo-price'); 
		   var dep = $(this).attr('foo-dep'); 
		   var cost = $(this).attr('foo-cost'); 
		   var orderid = "<?php echo $orderid;?>";
		   var cashier = "<?php echo $userid;?>";
		   
           if(fcode == '')  
           {  
                $('#response').html('<span class="text-danger">All Fields are required</span>');  
           }  
           else  
           {  
				$('#response').html('<span class="text-info">Loading response...'+fcode+'</span>');  
				   $.post('register.php',{
					   fcode:fcode,
					   food:food,
					   price:price,
					   dep:dep,
					   cost:cost,
					   orderid:orderid,
					   cashier:cashier,
				   },function(data){
						 
									  $('#response').fadeIn().html(data); 
										
									  setTimeout(function(){  
									  $('form').trigger("reset"); 
										   //$('#response').fadeOut("slow");  
									  }, 5000); 
				   });
				   var payablestring = 1;
				   var thisorder = orderid;
				   $.post('register.php',{payablestring:payablestring,thisorder:thisorder,},function(data){
					   $('.py').fadeIn().html(data); 
				   });
             
           }  
      });
	  
	  $(document).on('click','.foo-id',function(){
		  var thisfood  = $(this).attr('foo-id');
		  var thisorder = "<?php echo $orderid;?>";
		  $.post('register.php',{thisfood:thisfood,thisorder:thisorder,},function(data){
			  $('#response').fadeIn().html(data); 
		  });
		  
		  var payablestring = 1;
				   $.post('register.php',{payablestring:payablestring,thisorder:thisorder,},function(data){
					   $('.py').fadeIn().html(data); 
				   });
	  });
	  
	  $("#makeorder").click(function(){
			var makethisorder = $(this).val();
			var waiter = "<?php echo $userid;?>";
			$.post('register.php',{makethisorder:makethisorder,waiter:waiter,},function(data){
				$('#response').fadeIn().html(data); 
			});
		});
	 
	  
  });
  </script>
</head>
<body>
  <div class="container">
  
		
		
    <h1>Welcome to Romtecx Hotel Pos</h1>
	<div class="row">
	 <div class="tabs">
		 <?php
			$gettabs = mysqli_query($con,"select * from menu group by department");
			while($gettabsr=mysqli_fetch_array($gettabs)){
				echo '<button class="tab tab-link" id="'.$gettabsr['department'].'-tab" onclick="openTab(event, \''.$gettabsr['department'].'\')">'.$gettabsr['department'].'</button>';
			}
			?>
      
    </div>
	</div>
   
	<div class="row">
	
	<?php
	$gettabcontent = mysqli_query($con,"select * from menu group by department");
	while($gettabs=mysqli_fetch_array($gettabcontent)){
		echo '<div id="'.$gettabs['department'].'" class="col-8 tabcontent">'; 
		echo '<div class="row">';
		
		$dep = $gettabs['department'];
		$getcontent = mysqli_query($con,"select * from menu where department = '$dep'");
		while($getcontentr = mysqli_fetch_array($getcontent)){
			echo '<div class="card col-3">
			  <img src="photos/p.jpg" alt="Avatar" style="width:40px"/>
			  <div class="cardcontainer">
				<h5><b>'.$getcontentr['food'].'</b></h5> 
				<p>'.number_format($getcontentr['price'],2).'</p> 
				<button foo-cost="'.$getcontentr['cost'].'" foo-dep= "'.$getcontentr['department'].'" foo-food ="'.$getcontentr['food'].'" foo-price="'.$getcontentr['price'].'" class="cart btn-primary" value="'.$getcontentr['foodcode'].'">Add to cart</button>
			  </div>
			</div>';
		}
		
		echo'</div>';
		echo'</div>';
	}
	?>

   
	<div class="col-4">
	<div id="response"></div>
	<button class="btn-success" id="makeorder" value="<?php echo $orderid;?>">Make Order</button>
	</div> 
	</div>
	
	
	
	
		<div class="col-2 btn floating-button py" style="width:150px; height:50px; margin-right: 150px;" onClick=window.open("cashiers.php?r=<?php echo $userid;?>","Ratting","width=800,height=800,left=50,top=100,toolbar=0,status=0,");>Payable</div> 
		
	
	
	
	
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
	<?php
	$gettabsr = mysqli_query($con,"select * from menu group by department LIMIT 1");
	while($gettabsrs=mysqli_fetch_array($gettabsr)){
		echo 'document.getElementById("'.$gettabsrs['department'].'").click();';
	}
	?>
    
  </script>
  
</body>
</html>