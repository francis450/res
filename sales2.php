    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sales</title>
        <!-- JQuery -->
        <script src="jquery-3.3.1.min.js"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="bootstrap-5.0.2/css/bootstrap.min.css">
        <script src="bootstrap-5.0.2/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">
        <script src="DataTables/media/js/jquery.dataTables.min.js"></script>
    </head>
    <style>
        .modal-backdrop {
            z-index: 0;
            display: none;
        }
    </style>

    <body class="d-flex justify-content-center align-items-center bg-light p-2">
        <div class="card p-4 shadow col-12">
            <div class="card-header">
                <h4 class=" p-3">SALES</h4>
            </div>
            <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Today</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">This Week</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">This Month</button>
                    <button class="nav-link" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">This Year</button>
                </div>
            </nav>
            <div class="tab-content p-3 border " id="nav-tabContent">
                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row bg-light">
                        <h5 class="card-title">Items Sold Today</h5>
                        <hr>
                        <table class="table table-striped" id="today1">
                            <thead>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Department</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qnty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Sold By</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Department</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qnty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Sold By</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row mt-4 bg-light">
                        <h5 class="card-title">Products Performance Today</h5>
                        <hr>
                        <table class="table table-striped" id="today">
                            <thead>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Item</th>
                                    <th>Qnty</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Margin</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Item</th>
                                    <th>Qnty</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Margin</th>
                                    <th>Profit</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row bg-light">
                        <h5 class="card-title">Items Sold This Week</h5>
                        <hr>
                        <table class="table table-striped" id="week">
                            <thead>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Department</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qnty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Sold By</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Department</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qnty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Sold By</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row mt-4 bg-light">
                        <p class="card-title">Items Performance This Week</p>
                        <table class="table table-striped" id="week1">
                            <thead>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Item</th>
                                    <th>Qnty</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Margin</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Item</th>
                                    <th>Qnty</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Margin</th>
                                    <th>Profit</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="row bg-light">
                        <h5 class="card-title">Items Sold This Month</h5>
                        <hr>
                        <table class="table table-striped" id="month">
                            <thead>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Department</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qnty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Sold By</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Department</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qnty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Sold By</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row mt-4 bg-light">
                        <p class="card-title">Items Performance This Month</p>
                        <table class="table table-striped" id="month1">
                            <thead>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Item</th>
                                    <th>Qnty</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Margin</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Item</th>
                                    <th>Qnty</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Margin</th>
                                    <th>Profit</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                    <div class="row bg-light">
                        <h5 class="card-title">Items Sold This Year</h5>
                        <table class="table table-striped" id="year">
                            <thead>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Department</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qnty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Sold By</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Department</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qnty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Sold By</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row mt-4 bg-light">
                        <p class="card-title">Items Performance This Year</p>
                        <table class="table table-striped" id="year2">
                            <thead>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Item</th>
                                    <th>Qnty</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Margin</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Orderid</th>
                                    <th>Item</th>
                                    <th>Qnty</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Margin</th>
                                    <th>Profit</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/sales.js"></script>
    </body>

    </html>