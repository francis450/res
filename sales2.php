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
                        <p class="card-title">Items Sold Today</p>
                        <table class="table" id="today1">
                            <thead>
                                <tr>
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
                        <p class="card-title">Products Performance Today</p>
                        <table class="table" id="today">
                            <thead>
                                <tr>
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
                        <p class="card-title">Items Sold This Week</p>
                        <table class="table" id="month1">
                            <thead>
                                <tr>
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
                        <table class="table" id="month2">
                            <thead>
                                <tr>
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
                        <p class="card-title">Items Sold This Year</p>
                        <table class="table" id="week1">
                            <thead>
                                <tr>
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
                        <table class="table" id="week2">
                            <thead>
                                <tr>
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
                        <p class="card-title">Items Sold This Year</p>
                        <table class="table" id="year1">
                            <thead>
                                <tr>
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
                        <table class="table" id="year2">
                            <thead>
                                <tr>
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

        <script>
            $(document).ready(function(){
                $('#today').DataTable();
                $('#today1').DataTable();
                $('#week1').DataTable();
                $('#week2').DataTable();
                $('#month1').DataTable();
                $('#month2').DataTable();
                $('#year1').DataTable();
                $('#year2').DataTable();
            })
        </script>
    </body>
    </html>