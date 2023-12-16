<!DOCTYPE html>
<!-- saved from url=(0080)https://demo.bootstrapdash.com/majestic-free/template/pages/samples/login-2.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Required meta tags -->
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./login.php_files/materialdesignicons.min.css">
  <link rel="stylesheet" href="./login.php_files/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./login.php_files/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
  <script type="text/javascript" src="jscss/jquery-3.3.1.min.js"></script>
  <!-- endinject -->
  <!--<link rel="shortcut icon" href="https://demo.bootstrapdash.com/majestic-free/template/images/favicon.png">-->
</head>

<body data-zight-toast-available="true">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="./login.php_files/logo.png" alt="logo">
              </div>
              <h4>Welcome back!</h4>
              <h6 class="font-weight-light" style="color:red" id="response"></h6>
              <form method = 'post' action = 'register.php' class="pt-3">
                <div class="form-group">
                  <label for="exampleInputEmail">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" name="username1" class="form-control form-control-lg border-left-0" id="username1" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" name="password1" class="form-control form-control-lg border-left-0" id="password1" placeholder="Password">                        
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    <i class="input-helper"></i></label>
                  </div>
                  <a class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="my-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn login" type='button'>LOGIN</button>
                </div>
                <script>
                     
                    $('.login').click(function(){
                        var username1 = $('#username1').val();  
                    var password1 = $('#password1').val(); 
                        $('#response').fadeIn().html("LOADING..."); 
                      $.post('register.php',{
					   username1:username1, password1:password1,
				   },function(data){
						 
									  $('#response').fadeIn().html(data); 
										console.log(data);
									  setTimeout(function(){  
									  $('form').trigger("reset"); 
										   $('#response').fadeOut("slow");  
									  }, 5000); 
				   });  
                    })
                </script>
                <div class="mb-2 d-flex">
                  <button type="button" class="btn btn-facebook auth-form-btn flex-grow me-1">
                    <i class="fab fa-facebook me-2"></i>Facebook
                  </button>
                  <button type="button" class="btn btn-google auth-form-btn flex-grow ms-1">
                    <i class="fab fa-google"></i>Google
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright © 2020  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="./login.php_files/vendor.bundle.base.js.download"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="./login.php_files/off-canvas.js.download"></script>
  <script src="./login.php_files/hoverable-collapse.js.download"></script>
  <script src="./login.php_files/template.js.download"></script>
  <!-- endinject -->



</body></html>