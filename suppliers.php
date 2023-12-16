<?php
ob_start();
session_start();
include'connection.php';
if(isset($_GET['unset'])){ session_destroy(); header("Location: index.php");}
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
  </style>
  <script>
  $(document).ready(function(){
	   $('#submit2').click(function(){  
           
		   var sfullname = $('#sfullname').val();
		   var sphone = $('#sphone').val();
		   var semail = $('#semail').val();
		   
		   
		  
           if(sfullname == ''|| sphone== '' ||semail =='')  
           {  
                $('#response').html('<span class="text-danger">All Fields are required</span>');  
           }  
           else  
           {  
				$('#response').html('<span class="text-info">Loading response...</span>');  
				   $.post('register.php',{
					   sfullname:sfullname,sphone:sphone,semail:semail,
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
	  
	   $(".menu-btn").click(function () {
		  $(".menu").toggleClass("menu-open");
		});

		$(".menu a").click(function () {
		  $(".menu").removeClass("menu-open");
		});
		$("#brand").hide();
		$("#bsupplier").change(function () {
		 $("#brand").show();
		});
		
		   $('#submit1').click(function(){  
           
		   var bsupplier = $('#bsupplier').val();
		   var brand= $('#brand').val();
		   
		   
		   
		  
           if(bsupplier == ''|| brand== '')  
           {  
                $('#response').html('<span class="text-danger">All Fields are required</span>');  
           }  
           else  
           {  
				$('#response').html('<span class="text-info">Loading response...</span>');  
				   $.post('register.php',{
					   bsupplier:bsupplier,brand:brand,
				   },function(data){
						$('form').trigger("reset");  
						$("#brand").hide();
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
    <div class="sidebar">
		  <nav class="menu">
			<a><div class="user"><?php echo $userid;?></div></a>
			
			<a href="suppliers.php?unset=true"></br>&#x26D4;</a>
			<a href="main.php">Home</a>
			<a href="#about">Accounts</a>
			<a href="suppliers.php">Suppliers</a>
			<a href="#contact">Inventory</a>
		  </nav>
		  <div class="menu-btn">
			<i class="fas fa-bars">HERE</i>
		  </div>
		</div>
    <h1>Welcome <?php echo $userid;?></h1>
    <div class="tabs">
	<div class="tab tab-link" id="login-tab" onclick="openTab(event, 'overview')">Overview</div>
      <div class="tab tab-link" id="login-tab" onclick="openTab(event, 'login')">Add Brand</div>
      <button class="tab tab-link" id="register-tab" onclick="openTab(event, 'register')">Add Supplier</button>
    </div>
	<div id="overview" class="tabcontent">
      <table class="table" style="border: 1px solid black;">
		  <thead>
			  <th>#</th>
			  <th>Supplier</th>
			  <th>Contacts</th>
			  <th>Purchase Value</th>
			  <th>paid</th>
			  <th>Due</th>
		  </thead>
		  <tbody>
			  <?php
			  $getsuppliers = mysqli_query($con,"select * from suppliers");
			  while($getsuppliersr = mysqli_fetch_array($getsuppliers)){
				  echo '<tr>';
				  echo '<td>'.$getsuppliersr['id'].'</td>';
				  echo '<td>'.$getsuppliersr['fullname'].'</td>';
				  echo '<td>'.$getsuppliersr['phone'].'</br>'.$getsuppliersr['email'].'</td>';
				  echo '<td>0</td>';
				  echo '<td>0</td>';
				  echo '<td>0</td>';
				  echo '</tr>';
			  }
			  ?>
			
		  </tbody>
		</table>

    </div>
    <div id="login" class="tabcontent">
      <form class="login-form" id="login_form">
        <label for="username" class="form-label">Select Supplier</label>
        <select type="text" class="form-control" id="bsupplier" name="bsupplier">
		<option>Select Supplier</option>
		 <?php
			  $getsupplierss = mysqli_query($con,"select * from suppliers");
			  while($getsuppliersrs = mysqli_fetch_array($getsupplierss)){
				 
				  echo '<option>'.$getsuppliersrs['fullname'].'</option>';
				  
			  }
			  ?>
		</select>
        <label for="password" class="form-label">Brand</label>
        <input type="text" class="form-control" id="brand" name="brand">
       <input type="button" class="btn btn-info" name="submit" id="submit1"  value="Submit" /> 
      </form>
    </div>
    <div id="register" class="tabcontent">
      <form class="login-form" id="login-form2">
	    <label for="fullname">Supplier Fullname</label>
        <input type="text" class="form-control" id="sfullname" name="fullname">
        
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="semail" name="email">
		 <label for="phone">Phone</label>
        <input type="number" class="form-control" id="sphone" name="phone">
        
        
		 <input type="button" class="btn btn-info" name="submit2" id="submit2"  value="Register" /> 
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