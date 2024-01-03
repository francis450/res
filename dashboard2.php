<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');
if(isset($_SESSION['username']) && $_SESSION['userType'] == 'admin'){
  $username = $_SESSION['username'];
}else{
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<!-- saved from url=(0064)https://demo.bootstrapdash.com/majestic-free/template/index.html -->
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Required meta tags -->

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <!-- <script src="jquery-3.3.1.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- plugins:css -->
  <link rel="stylesheet" href="./dashboard_files/materialdesignicons.min.css">
  <link rel="stylesheet" href="./dashboard_files/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- <link rel="stylesheet" href="./dashboard_files/dataTables.bootstrap4.css"> -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./dashboard_files/style.css">
  <!-- endinject -->
  <!--<link rel="shortcut icon" href="https://demo.bootstrapdash.com/majestic-free/template/images/favicon.png">-->
  <link rel="stylesheet" href="css/success.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">
    <script src="DataTables/media/js/jquery.dataTables.min.js"></script>
  <style type="text/css">
    .content-wrapper {
      padding-top: 0;
    }

    /* Chart.js */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99
      }

      to {
        opacity: 1
      }
    }

    .chartjs-render-monitor {
      animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
      position: absolute;
      direction: ltr;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      pointer-events: none;
      visibility: hidden;
      z-index: -1
    }

    .chartjs-size-monitor-expand>div {
      position: absolute;
      width: 1000000px;
      height: 1000000px;
      left: 0;
      top: 0
    }

    .chartjs-size-monitor-shrink>div {
      position: absolute;
      width: 200%;
      height: 200%;
      left: 0;
      top: 0
    }
  </style>
</head>

<body data-zight-toast-available="true">
  <div class="container-scroller">
    <!--<div class="row p-0 m-0 proBanner d-none" id="proBanner">-->
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" href=""><img src="./login.php_files/logo.png" alt="logo"></a>
          <a class="navbar-brand brand-logo-mini" href=""><img src="./dashboard_files/logo-mini.svg" alt="logo"></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
              <i class="mdi mdi-message-text mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <img src="./dashboard_files/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Bigbro
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <img src="./dashboard_files/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Infodata
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <img src="./dashboard_files/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown me-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="mdi mdi-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="mdi mdi-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="mdi mdi-account-box mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="./dashboard_files/face5.jpg" alt="profile">
              <span class="nav-profile-name">
                <?php echo $_SESSION['username']; ?>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onClick="removeContentWrapper('sales2.php')">
              <i class="mdi mdi-currency-usd menu-icon"></i>
              <span class="menu-title">SALES</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" type="button" onClick="removeContentWrapper('foodcosting.php')">
              <i class="mdi mdi-circle-outline menu-icon"></i>
              <span class="menu-title">MENU</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="sell.php">
              <i class="mdi mdi-cash menu-icon"></i>
              <span class="menu-title">CASHIER</span>
            </a>
          </li> -->

          <li class="nav-item">
            <a class="nav-link" type="button" onClick="removeContentWrapper('inventory.php')">
              <i class="mdi mdi-store-outline menu-icon"></i>
              <span class="menu-title">INVENTORY</span>
            </a>
          </li>
          <script>
            function removeContentWrapper(page) {
              console.log(page)
              $(".content-wrapper").empty();
              $(".content-wrapper").load(page);
            }
            $(document).ready(function() {
              $('.nav-item').click(function() {
                // Remove 'active' class from all nav-items
                $('.nav-item').removeClass('active');
                console.log('This: ' + $(this));
                // Add 'active' class to the clicked nav-item
                $(this).addClass('active');
              });
            });
          </script>
          
          <li class="nav-item">
            <a class="nav-link" type="button" onClick="removeContentWrapper('users.php')">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">USERS</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" type="button" onClick="removeContentWrapper('settings.php')">
              <i class="mdi mdi-settings menu-icon"></i>
              <span class="menu-title">Settings</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                    <h2>Welcome back,</h2>
                    <p class="mb-md-0">Your analytics dashboard template.</p>
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                    <!-- <p class="text-primary mb-0 hover-cursor">Analytics</p> -->
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  <button type="button" style="width: 100px;" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block " onclick="">
                    <a href="cashier.php" target="_blank" style="font-weight:bold; text-decoration:none;color:black;">
                      CASHIER
                    </a>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block " onclick="">
                    <a href="sell.php" target="_blank" style="font-weight:bold; text-decoration:none;color:black;">
                      POS
                    </a>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
                    <i class="mdi mdi-download text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-clock-outline text-muted"></i>
                  </button>

                  <div class="dropdown">
                    <button class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="mdi mdi-plus text-muted"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <li><a type="button" data-bs-toggle="modal" data-bs-target="#addTableModal" class="dropdown-item" href="#">Add Table</a></li>
                      <li><a type="button" data-bs-toggle="modal" data-bs-target="#addDepartmentModal" class="dropdown-item" href="#">Add Department</a></li>
                      <!-- <li><a class="dropdown-item" href="#">Option 3</a></li> -->
                    </ul>
                  </div>


                  <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Sales</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">Purchases</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block"><?php echo date('jS F Y'); ?></h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <?php
                            $totalQ = mysqli_query($con, 'SELECT SUM(`payable`) AS total FROM `receipts`');
                            $total = mysqli_fetch_array($totalQ);
                            ?>
                            <h5 class="me-2 mb-0"><?php echo 'KES ' . number_format($total['total'], 2); ?></h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Orders</small>
                            <?php
                            $totalQ = mysqli_query($con, 'SELECT count(DISTINCT(receipt)) AS total FROM `receipts`');
                            $total = mysqli_fetch_array($totalQ);
                            ?>
                            <h5 class="me-2 mb-0"><?php echo $total['total']; ?></h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-cash me-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="me-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-table-large me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Tables</small>
                            <?php
                            $totalQ = mysqli_query($con, 'SELECT MAX(id) as n FROM `tables`');
                            $total = mysqli_fetch_array($totalQ);
                            ?>
                            <h5 class="me-2 mb-0"><?php echo $total['n']; ?></h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="me-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="me-2 mb-0">9833552</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="me-2 mb-0">KSHS. 577545</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="me-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="">12 Aug 2018</a>
                                <a class="dropdown-item" href="">22 Sep 2018</a>
                                <a class="dropdown-item" href="">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="me-2 mb-0">KSHS. 577545</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="me-2 mb-0">9833553</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="me-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="me-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <p class="card-title">PAYMENT METHODS</p>
                  <p class="mb-4">These are the sales made on each department for the last 24HRS</p>
                  <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3">
                    <!-- <ul class="dashboard-chart-legend">
                      <li><span style="background-color: #ff4747 "></span>CASH</li>
                      <li><span style="background-color: #4d83ff "></span>M-PESA</li>
                      <li><span style="background-color: #ffc100 "></span>BANK</li>
                    </ul> -->
                  </div>
                  <canvas id="cash-deposits-chart" style="display: block; width: 547px; height: 273px;" width="547" height="273" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="chartjs-size-monitor">
                  <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                  </div>
                  <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                  </div>
                </div>
                <div class="card-body">
                  <p class="card-title">Total sales</p>
                  <?php
                    $totalSalesQ = mysqli_query($con, "SELECT SUM(amount) as total from receipts");
                    $totalSales = mysqli_fetch_array($totalSalesQ);

                  ?>
                  <h1><?php echo 'KSHS '.$totalSales['total']; ?></h1>
                  <h4>Gross Sales Over the Past 30 Days</h4>
                  <div id="total-sales-chart-legend">
                    <ul class="dashboard-chart-legend mb-0 mt-4">
                      <?php
                        // $deptsQ = mysqli_query($con, "SELECT DISTINCT(department) as department FROM tables");
                        // while($departments = mysqli_fetch_array($deptsQ)){
                        //   echo '<li><span style="background-color: rgba(47,91,191,0.77) "></span>'.$departments['department'].'</li>';
                        // }
                      ?>
                      <!-- <li><span style="background-color: rgba(47,91,191,0.77) "></span>2019</li>
                      <li><span style="background-color: rgba(77,131,255,0.77) "></span>2018</li>
                      <li><span style="background-color: rgba(77,131,255,0.43) "></span>Past years</li> -->
                    </ul>
                  </div>
                </div>
                <canvas id="total-sales-chart" width="427" height="213" style="display: block;" class="chartjs-render-monitor"></canvas>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">TIMEOUT ORDERS</p>
                  <div class="table-responsive">
                    <!-- <div id="recent-purchases-listing_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                      <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="recent-purchases-listing" class="table dataTable no-footer" role="grid">
                            <thead>
                              <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 135.781px;">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Status report: activate to sort column ascending" style="width: 177.25px;">Status report</th>
                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 123.609px;">Office</th>
                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" style="width: 57.1719px;">Price</th>
                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 89.3906px;">Date</th>
                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Gross amount: activate to sort column ascending" style="width: 136.547px;">Gross amount</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr role="row" class="odd">
                                <td class="sorting_1">Alvin Fisher</td>
                                <td>Ui design completed</td>
                                <td>East Mayra</td>
                                <td>KSHS. 23230</td>
                                <td>18 Jul 2018</td>
                                <td>KSHS. 83127</td>
                              </tr>
                              <tr role="row" class="even">
                                <td class="sorting_1">Betty Hunt</td>
                                <td>Ui design not completed</td>
                                <td>Lake Sandrafort</td>
                                <td>KSHS. 571</td>
                                <td>25 Jun 2018</td>
                                <td>KSHS. 78952</td>
                              </tr>
                              <tr role="row" class="odd">
                                <td class="sorting_1">Emily Cunningham</td>
                                <td>support</td>
                                <td>Makennaton</td>
                                <td>KSHS. 939</td>
                                <td>16 Jul 2018</td>
                                <td>KSHS. 29177</td>
                              </tr>
                              <tr role="row" class="even">
                                <td class="sorting_1">Ernest Wade</td>
                                <td>Levelled up</td>
                                <td>West Fidelmouth</td>
                                <td>KSHS. 484</td>
                                <td>08 Sep 2018</td>
                                <td>KSHS. 50862</td>
                              </tr>
                              <tr role="row" class="odd">
                                <td class="sorting_1">Jacob Kennedy</td>
                                <td>New project</td>
                                <td>Cletaborough</td>
                                <td>KSHS. 314</td>
                                <td>12 Jul 2018</td>
                                <td>KSHS. 34167</td>
                              </tr>
                              <tr role="row" class="even">
                                <td class="sorting_1">Jeremy Ortega</td>
                                <td>Levelled up</td>
                                <td>Catalinaborough</td>
                                <td>KSHS. 790</td>
                                <td>06 Jan 2018</td>
                                <td>KSHS. 2274253</td>
                              </tr>
                              <tr role="row" class="odd">
                                <td class="sorting_1">Minnie Farmer</td>
                                <td>support</td>
                                <td>Agustinaborough</td>
                                <td>KSHS. 30</td>
                                <td>30 Apr 2018</td>
                                <td>KSHS. 44617</td>
                              </tr>
                              <tr role="row" class="even">
                                <td class="sorting_1">Myrtie Lambert</td>
                                <td>Ui design completed</td>
                                <td>Cassinbury</td>
                                <td>KSHS. 36</td>
                                <td>05 Nov 2018</td>
                                <td>KSHS. 36422</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-md-5"></div>
                        <div class="col-sm-12 col-md-7"></div>
                      </div>
                    </div> -->
                    <table id="timeout" class="table">

                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bigbro.co.ke/" target="_blank">www.bigbro.co.ke </a>2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bigbro.co.ke/" target="_blank"> Restaurant </a> </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- Add Department Modal -->
  <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header card-header">
          <h5 class="modal-title" id="exampleModalLongTitle">ADD NEW DEPARTMENT</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="col-auto">
                <!-- <label class="sr-only" for="inlineFormInputGroup">Username</label> -->
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Department Name</div>
                  </div>
                  <input type="text" class="form-control" name="department" id="department" placeholder="Department">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onClick="submitDepartment()">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Table Modal -->
  <div class="modal fade" id="addTableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header card-header">
          <h5 class="modal-title" id="exampleModalLongTitle">ADD NEW TABLE</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="col-auto">
                <!-- <label class="sr-only" for="inlineFormInputGroup">Username</label> -->
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Department</div>
                  </div>
                  <!-- <input type="text" class="form-control" name="table" id="table" placeholder="Table Name"> -->
                  <select class="form-control" name="department" id="tableDepartment">
                    <option value="0">Select Department</option>
                    <?php
                    $departments = mysqli_query($con, 'SELECT * FROM `departments`');
                    while ($department = mysqli_fetch_array($departments)) {
                      echo '<option value="' . $department['dept_id'] . '">' . $department['department'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-auto">
                <!-- <label class="sr-only" for="inlineFormInputGroup">Table</label> -->
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Table Name</div>
                  </div>
                  <input type="text" class="form-control" name="table" id="table" placeholder="Table Name">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="submitTable()">SAVE</button>
        </div>
      </div>
    </div>
  </div>
  <button type="button" class="d-none successButton" data-bs-toggle="modal" data-bs-target="#success_tic">Open Modal</button>

  <!-- SUCCESS MODAL -->
  <div id="success_tic" class="modal fade" tabindex="-1" aria-labelledby="showSuccessMessage" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-xm">

      <!-- Modal content-->
      <div class="modal-content">
        <a class="close" href="#" data-bs-dismiss="modal">&times;</a>
        <div class="page-body">
          <div class="head">
            <h3 style="margin-top:5px;" class="sucesssMessage"></h3>
            <!-- <h4>Lorem ipsum dolor sit amet</h4> -->
          </div>

          <h1 style="text-align:center;">
            <div class="checkmark-circle">
              <div class="background"></div>
              <div class="checkmark draw"></div>
            </div>
            <h1>

        </div>
      </div>
    </div>

  </div>

  <!-- plugins:js -->
  <script src="./dashboard_files/vendor.bundle.base.js.download"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="./dashboard_files/Chart.min.js.download"></script>
  <!-- <script src="./dashboard_files/jquery.dataTables.js.download"></script> -->
  <!-- <script src="./dashboard_files/dataTables.bootstrap4.js.download"></script> -->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="./dashboard_files/off-canvas.js.download"></script>
  <script src="./dashboard_files/hoverable-collapse.js.download"></script>
  <script src="./dashboard_files/template.js.download"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="./dashboard_files/dashboard.js.download"></script>
  <script src="./dashboard_files/data-table.js.download"></script>
  <!-- <script src="./dashboard_files/jquery.dataTables.js(1).download"></script> -->
  <!-- <script src="./dashboard_files/dataTables.bootstrap4.js(1).download"></script> -->
  <!-- End custom js for this page-->

  <script src="./dashboard_files/jquery.cookie.js.download" type="text/javascript"></script>
  <script src="js/dashboard.js"></script>
</body>

</html>