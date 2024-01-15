<?php
session_start();
include('connection.php');
if (isset($_SESSION['username']) && $_SESSION['userType'] != 'server') {
    $username = $_SESSION['username'];
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier</title>
    <script src="jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.0.2/css/bootstrap.min.css">
    <script src="bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">
    <script src="DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="css/cashier.css">
</head>
<style>
    <?php
        if($_SESSION['userType'] != 'cashier'){
            echo ".mr-1{display:none;}";
            echo "#pay{display:none}";
            echo ".btn{display:none;,}";
        }
    ?>
</style>

<body>
    <div class="nav h-10">

    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>ORDERS</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-border table-hover table-striped" id="orders">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary d-none paymentModal" data-bs-target="#paymentModal" data-bs-toggle="modal" data-bs-dismiss="modal">button</button>

    <!-- PAYMENT DETAILS MODAL -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-md modal-lg">
            <div class="modal-content">
                <div class="modal-header card-header">
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
                                <div class="row paymentForm" style="justify-content:center">
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
                                    <div class="row mt-2">
                                        <div class=" col-md-11">
                                            <button type="submit" class="btn btn-lg btn-warning sellbtn" style="display: none;">SAVE</button>
                                        </div>
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

    <button class="deleteModalButton d-none" data-bs-target="#deleteModal" data-bs-toggle="modal" data-bs-dismiss="modal"></button>

    <!-- DELETE ORDER MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h5 class="modal-title" id="paymentModalLabel"><span id="cancelText"> </span>ORDER NO: <span class="orderNumber"></span><span class="viewDetails"></span></h5>
                    <button type="button" class="btn-close closeDelete" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead class="card-header">
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Qnty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="deleteItems">

                        </tbody>
                    </table>
                </div>
                <div class="card">
                    <textarea name="reason" id="reason" cols="30" rows="3" placeholder="Reason For Cancellng Order"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary confirmed">CONFIRM</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- sucess message modal and button -->
    <button type="button" class="d-none successButton" data-bs-toggle="modal" data-bs-target="#success_tic">Open Modal</button>

    <!-- Modal -->
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

</body>
<script src="js/cashier.js"></script>

</html>