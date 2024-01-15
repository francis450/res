<?php
session_start();
include('connection.php');
if (!isset($_SESSION['username']) && !isset($_SESSION['department']) ) {
    header('index.php');
} else {
    $username = $_SESSION['username'];
    $department = $_SESSION['department'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JQuery -->
    <script src="jquery-3.3.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- bootstrap -->
    <!--<link rel="stylesheet" href="bs/bootstrap.min.css">-->
    <link rel="stylesheet" href="bootstrap-5.0.2/css/bootstrap.min.css">

    <!--<script src="bs/bootstrap.min.js"></script>-->
    <script src="bootstrap-5.0.2/js/bootstrap.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">
    <script src="DataTables/media/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

    <title>Sell</title>
    <style>
        #cart_filter {
            display: none;
        }

        #cart_length {
            display: none;
        }

        #cart_info {
            display: none;
        }

        #cart_paginate {
            display: none;
        }

        .selected {
            background-color: #f0f0f0;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

        .tabcontent {
            animation: fadeEffect 1s;
            /* Fading effect takes 1 second */
        }

        /* Go from zero to full opacity */
        @keyframes fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .item {
            font-size: small;
        }
    </style>
</head>

<body>
    <div class="main-panel">
        <div class="content-wrapper m-2">
            <div class="row">
                <div class="col-12">
                    <div class="card-header" style="margin-left:40px">
                        <button class="btn btn-info clear" onClick="cleari()">&#x1F9F9;CLEAR LIST</button>
                        <button class="btn btn-dark btn-outline" id="removeButton">REMOVE ITEM</button>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">MY ORDERS</button>
                        <!-- <button class="btn btn-secondary printorder">PRINT ORDER</button> -->
                    </div>
                </div>
            </div>
            <div class="row d-flex" style="justify-content:center;gap:20px;">
                <div class="col-4">
                    <table id="cart" class="table table-stripe table-hover">

                    </table>
                    <button class="btn btn-danger col-12 printorder">
                        <span>Complete Order For</span>
                        <span>: </span>
                        <span class="total"></span>
                        <span> Kshs.</span>
                    </button>
                </div>
                <div class="col-2">
                    <h5>SELECT CATEGORY</h5>
                    <div class="categories d-flex" style="gap:10px; flex-direction:column">
                        <?php
                        $catquery = "SELECT DISTINCT(category) FROM menu WHERE department = '$department'";
                        $allcategories = mysqli_query($con, $catquery);
                        while ($categories = mysqli_fetch_array($allcategories)) {
                            echo '<button data-bs-toggle="tab" type="button" onclick="getItems(event,\'' . $categories['category'] . '\')" class="btn btn-lg btn-success btn-outline" style="width:100%">' . $categories['category'] . '</button>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-5 row">
                    <div class="">
                        <?php
                        $divs = mysqli_query($con, $catquery);
                        while ($div = mysqli_fetch_array($divs)) {
                            echo '<div class="tabcontent" id="' . $div['category'] . '">';
                            echo '<div class="card">';
                            echo '<div class="card-header"><h6>' . $div['category'] . '<h6></div>';
                            echo '<div class="card-body col-12" style="display: flex;gap: 5px;">';
                            $catt = $div['category'];
                            $catquer = mysqli_query($con, "SELECT * FROM menu where category = '$catt' AND department = '$department'");
                            while ($divv = mysqli_fetch_array($catquer)) {
                                echo '<button class="btn btn-warning col-3 item" onclick="add(\'' . $divv['foodcode'] . '\',\'' . $divv['food'] . '\',' . $divv['price'] . ')">' . $divv['food'] . '<br>Kshs. ' . $divv['price'] . '</button>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- modals -->
        <!-- ORDERS MODAL -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ORDERS</h5>
                        <button type="button" class="btn-close close-orders" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-striped" id="orders">

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- MODALS -->

        <!-- MODAL BUTTON -->
        <button class="btn btn-primary d-none paymentModal" data-bs-target="#paymentModal" data-bs-toggle="modal" data-bs-dismiss="modal">button</button>
        <!-- PAYMENT DETAILS MODAL -->
        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-md modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <!-- <span aria-hidden="true">&times;</span> -->
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Payment details for OrderId: <span id="orderIdPlaceholder"></span> -->
                        <div class="card">
                            <div class="card-header">
                                Payment details for OrderId: <span id="orderIdPlaceholder"></span>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row" style="justify-content:center">
                                        <div class="form-group" style="display:flex;gap:20px;justify-content:center;">
                                            <button class="btn btn-lg btn-success paymentbtn cashbtn">Cash</button>
                                            <button class="btn btn-lg btn-info paymentbtn mpesabtn">M-PESA</button>
                                            <button class="btn btn-lg btn-warning paymentbtn bankbtn">Bank</button>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="payable">Payable</label>
                                                <input type="text" class="form-control gottotalprice" id="payable" name="cashpayable" readonly="" required="">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="hidden" name="amt1given" id="amt1given">
                                                <input type="hidden" name="amt2given" id="amt2given">
                                                <input type="hidden" name="amt3given" id="amt3given">
                                                <label class="amountgiventext" for="amountgiven">Amount Paid</label>
                                                <input type="number" class="form-control amountgiven" id="amountgiven" readonly="" name="cashgiven" required="">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="bakii">Balance</label>
                                                <input type="text" class="form-control bakii" id="bakii" name="cashbalance" readonly="" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="transtype">Transaction type</label>
                                                <input type="hidden" name="transtype1" id="transtype1">
                                                <input type="hidden" name="transtype2" id="transtype2">
                                                <input class="form-control transtype selectbtn" readonly="" id="transtype" readon="" name="transtype">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="discount">Discount</label>
                                                <input type="number" class="form-control discount" id="discount" name="discount" min="0" max="300" placeholder="Max Discount 300 allowed" required="">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="transdesc"><span class="tran">Transaction
                                                        description</span></label>
                                                <input type="text" class="form-control transdesc" id="transdesc" name="transdesc">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4" style="display: flex;align-items: end;">
                                            <button type="submit" class="btn btn-lg btn-warning sellbtn" style="display: none;">Sell</button>
                                        </div>
                                        <div class="form-group col-md-4" style="display: flex; align-items: end">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- TABLE MODAL -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary tableModal d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        </button>
        <p class="d-none department"><?php echo $department; ?></p>
        <p class="d-none username"><?php echo $username; ?></p>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header card-header">
                        <h5 class="modal-title" id="staticBackdropLabel">CHOOSE TABLE TO SEND ORDER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body card-body">
                        <h5>TABLE: <span class="chosenTable mb-0"></span></h5>

                        <?php
                            $deptQuery = mysqli_query($con, "SELECT DISTINCT(department) as department FROM tables");
                            $colors = array('warning', 'success', 'info', 'secondary', 'dark');
                            $counter = 0;
                            while ($depts = mysqli_fetch_assoc($deptQuery)) {
                                echo '<div style="font-weight:bold;margin-top:20px;">'.$depts['department'].'</div><hr style="margin-top:0;">';
                                $thisDept = $depts['department'];
                                $tablesQ = mysqli_query($con, "SELECT * FROM tables WHERE department = '$thisDept'");
                                while($tables = mysqli_fetch_assoc($tablesQ)){
                                    $tableId = $tables['id'];
                                    echo '<button onclick="choosenTable(\''.$tableId.'\',\''.$thisDept.'\',\''.$tables['table'].'\')" class="btn btn-'.$colors[$counter].' btn-lg me-1">'.$tables['table'].'</button>';
                                    // echo '<button onclick="choosenTable('.$tableId.','.$thisDept.','.$tables['table'].')" class="btn btn-'.$colors[$counter].' btn-lg me-1">'.$tables['table'].'</button>';
                                }
                                echo '<br>';
                                $counter++;
                            }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary sendorder">send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="js/sell.js"></script>

</html>