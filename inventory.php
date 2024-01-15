 <?php
    session_start();
    include('connection.php');
    ?>
 <!DOCTYPE html>
 <html lang='eng'>

 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <!-- Required meta tags -->
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Inventory</title>
     <script src='jquery-3.3.1.min.js'></script>

     <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->

     <!-- plugins:css -->
     <link rel="stylesheet" href="./dashboard_files/materialdesignicons.min.css">
     <link rel="stylesheet" href="./dashboard_files/vendor.bundle.base.css">
     <!-- endinject -->
     <!-- plugin css for this page -->

     <!-- End plugin css for this page -->
     <!-- inject:css -->
     <link rel="stylesheet" href="./dashboard_files/style.css">
     <!-- endinject -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="JSTable/dist/jstable.css">
     <script src="JSTable/dist/jstable.min.js"></script>
     <link rel="stylesheet" href="jsgrid/dist/jsgrid.min.css">
     <script src="./dashboard_files/vendor.bundle.base.js.download"></script>

     <script src="DataTables/media/js/jquery.dataTables.min.js"></script>
     <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">

     <link rel="stylesheet" href="bootstrap-5.0.2/css/bootstrap.min.css">
     <script src="bootstrap-5.0.2/js/bootstrap.bundle.js"></script>
     <link rel="stylesheet" href="css/cashier.css">
 </head>
 <style>
     .modal-backdrop {
         z-index: 0;
         display: none;
     }

     .modal-content {
         z-index: 10;

     }
 </style>

 <body>
     <div class="content-wrapper">
         <div class="row">
             <div class="col-md-12 grid-margin stretch-card">
                 <div class="card">
                     <div class="card-body dashboard-tabs p-0">
                         <ul class="nav nav-tabs px-4" role="tablist">
                             <li class="nav-item">
                                 <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Purchases</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Inventory</a>
                             </li>

                         </ul>
                         <div class="tab-content py-0 px-0">
                             <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                 <div class="d-flex flex-wrap justify-content-xl-between p-2">
                                     <div class="card col-12">
                                         <div class="card-header d-flex" style="justify-content:space-between;">
                                             <h5>ALL PURCHASES</h5>
                                             <button class="btn btn-info" type="button" data-bs-target="#addItem" data-bs-toggle="modal">Add Stock</button>
                                         </div>
                                         <div class="card-body">
                                             <table class="table" id="purchaseHistory">
                                                 <thead>

                                                 </thead>
                                                 <tbody>

                                                 </tbody>
                                             </table>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                                 <div class="d-flex flex-wrap justify-content-xl-between">
                                     <div class="col-12 p-3">
                                         <div class="card">
                                             <div class="card-header">
                                                 <h5>ALL ITEMS AVAILABLE</h5>
                                             </div>
                                             <div class="card-body">
                                                 <table id="inventoryTable" class="table table-stripe no-footer" role="grid">
                                                     <thead>
                                                         <tr>
                                                             <th>#</th>
                                                             <th>Product</th>
                                                             <th>Quantity</th>
                                                             <th>Unit Cost</th>
                                                             <th>G or ML</th>
                                                             <th>KG or L</th>
                                                             <th>Value</th>
                                                             <th>Action</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>
                                                         <?php
                                                            $getsuppliers = mysqli_query($con, "select * from products where qnty>0");
                                                            while ($getsuppliersr = mysqli_fetch_array($getsuppliers)) {
                                                                echo '<tr>';
                                                                echo '<td>' . $getsuppliersr['id'] . '</td>';
                                                                echo '<td>' . $getsuppliersr['product'] . '</td>';
                                                                echo '<td>' . $getsuppliersr['qnty'] . '</td>';
                                                                echo '<td>' . $getsuppliersr['unitcost'] . '</td>';
                                                                echo '<td>' . $getsuppliersr['smallunit'] . '</td>';
                                                                echo '<td>' . $getsuppliersr['bigunit'] . '</td>';
                                                                $value = $getsuppliersr['unitcost'] * $getsuppliersr['qnty'];
                                                                echo '<td>' . number_format($value, 2) . '</td>';
                                                                echo '<td><a class="badge bg-info transfer" type="button" data-id="' . $getsuppliersr['id'] . '" >Transfer</a></td>';
                                                                echo '</tr>';
                                                            }
                                                            ?>
                                                     </tbody>
                                                 </table>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- MODALS -->
     <div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" style="margin-top:180px;">
             <div class="modal-content">
                 <div class="modal-header card-header">
                     <h3 class="modal-title fs-5" id="exampleModalLabel">ADDING STOCK</h3>
                     <button type="button" class="btn btn-close closeAddStockModal" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <!-- supplier -->
                         <div class="col">
                             <div class="form-group">
                                 <label class="form-label" for="supplier">SUPPLIER
                                     <span class="addsupplier" style="font-size:x-large; color:green; cursor:pointer">+</span>
                                 </label>
                                 <select class="form-control" name="suppliers" id="suppliers">
                                     <option>SELECT</option>
                                     <?php
                                        $allsuppliers = mysqli_query($con, "SELECT * FROM suppliers ORDER BY fullname ASC");
                                        while ($suppliers = mysqli_fetch_array($allsuppliers)) {
                                            echo '<option value=' . $suppliers['fullname'] . '>' . strtoupper($suppliers['fullname']) . '</option>';
                                        }
                                        ?>
                                 </select>
                             </div>
                         </div>

                         <!-- PRODUCT -->
                         <div class="col">
                             <div class="form-group">
                                 <label for="product" class="form-label">ITEM
                                     <span class="addproduct" style="font-size:x-large; color:green; cursor:pointer">+</span>
                                 </label>
                                 <select class="form-control" name="product" id="product">
                                     <option>SELECT</option>
                                     <?php
                                        $allproducts = mysqli_query($con, "SELECT * FROM brands ORDER BY brand ASC");
                                        while ($products = mysqli_fetch_array($allproducts)) {
                                            echo '<option value="' . $products['brand'] . '">' . strtoupper($products['brand']) . '</option>';
                                        }
                                        ?>
                                 </select>
                             </div>
                         </div>

                         <!-- UNITS -->
                         <div class="col">
                             <div class="form-group">
                                 <label for="units" class="form-label">UNITS</label>
                                 <input name="units" class="form-control" id="units" type="number">
                             </div>
                         </div>

                         <!-- NET/UNIT -->
                         <div class="col">
                             <div class="form-group">
                                 <label for="weightUnit" class="form-label">NET/UNIT</label>
                                 <input class="form-control" name="weightUnit" id="weightUnit" type="number">
                             </div>
                         </div>

                         <!-- Measure -->
                         <div class="col">
                             <div class="form-group">
                                 <label for="measure" class="form-label">UNIT OF MEASURE
                                     <span class="addmeasure" style="font-size:large; color:green; cursor:pointer">+</span>
                                 </label>
                                 <select class="form-control" name="measure" id="measure">
                                     <option>SELECT</option>
                                     <?php
                                        $allmeasures = mysqli_query($con, "SELECT * FROM measures");
                                        while ($measure = mysqli_fetch_array($allmeasures)) {
                                            echo '<option value="' . $measure['unit'] . '">' . $measure['unit'] . '</option>';
                                        }
                                        ?>
                                 </select>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <!-- RECEIPT NO -->
                         <div class="col">
                             <div class="form-group">
                                 <label for="receiptno" class="form-label">INVOICE NO.</label>
                                 <input name="receiptno" class="form-control" id="receiptno" type="text">
                             </div>
                         </div>

                         <!-- COST -->
                         <div class="col">
                             <div class="form-group">
                                 <label for="Cost" class="form-label">COST</label>
                                 <input class="form-control" name="cost" id="cost" type="number">
                             </div>
                         </div>

                         <!-- AMOUNT PAID -->
                         <div class="col">
                             <div class="form-group">
                                 <label for="paid" class="form-label">PAID</label>
                                 <input class="form-control" name="paid" id="paid" type="number">
                             </div>
                         </div>

                         <!-- BALANCE -->
                         <div class="col">
                             <div class="form-group">
                                 <label for="balance" class="form-label">BALANCE</label>
                                 <input class="form-control" name='balance' id="balance" type="number" readonly>
                             </div>
                         </div>

                         <!-- TRANSACTION -->
                         <div class="col">
                             <div class="form-group">
                                 <label for="transactiontype" class="form-label">PAYMENT MODE</label>
                                 <select class="form-control" name="transactiontype" id="transactiontype">
                                     <option>SELECT</option>
                                     <option value="Cash">Cash</option>
                                     <option value="Mpesa">Mpesa</option>
                                     <option value="Bank">Bank</option>
                                 </select>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-4">
                             <button type="button" class="btn btn-success btn-outline" onclick="addStock(event)">ADD</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- SUCCESS MODAL -->
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

     <button type="button" class="d-none tranferButton" data-bs-toggle="modal" data-bs-target="#tranfer">Open Modal</button>


     <!-- TRANSFER MODAL -->
     <div class="modal fade" id="tranfer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" style="margin-top:180px;">
             <div class="modal-content">
                 <div class="modal-header card-header">
                     <h3 class="modal-title fs-5" id="exampleModalLabel">TRANSFER STOCK</h3>
                     <button type="button" class="btn btn-close closeAddStockModal" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>

                 <div class="modal-body">
                     <form class="transfer-form">
                         <div class="row">
                            <input type="text" name="productid" class="d-none" id="productid">
                            <input type="text" name="unitcost" id="unitcost" class="d-none">
                             <div class="col">
                                 <div class="mb-3">
                                     <label for="product" class="form-label">Product</label>
                                     <input type="text" class="form-control" id="productT" name="product" readonly>
                                 </div>
                             </div>

                             <div class="col">
                                 <div class="mb-3">
                                     <label for="qnty" class="form-label">Quantity Available</label>
                                     <input type="text" class="form-control" id="qntyT" name="qnty"  readonly>
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col">
                                 <div class="mb-3">
                                     <label for="smallunit" class="form-label">g/ml Available</label>
                                     <input type="text" class="form-control" id="smallunitT" name="smallunit" readonly>
                                 </div>
                             </div>
                                 <div class="col">
                                 <div class="mb-3">
                                     <label for="bigunit" class="form-label">kg/ltrs Available</label>
                                     <input type="text" class="form-control" id="bigunitT" name="bigunit" readonly>
                                 </div>
                             </div>
                            
                         </div>

                         <div class="row">
                            <!-- department -->
                            <div class="col">
                                 <div class="mb-3">
                                     <label for="productid" class="form-label">Transfer To Department</label>
                                     <!-- <input type="text" class="form-control" id="productid" name="productid" value="2" readonly> -->
                                     <select class="form-control" name="department" id="departmentTransfer" >
                                        <option>SELECT</option>
                                        <?php
                                            $getdepartments = mysqli_query($con, "select * from departments");
                                            while ($getdepartmentsr = mysqli_fetch_array($getdepartments)) {
                                                echo '<option value="' . $getdepartmentsr['department'] . '">' . $getdepartmentsr['department'] . '</option>';
                                            }
                                        ?>
                                     </select>
                                 </div>
                             </div>

                            <!-- Units to tranfer -->
                             <div class="col">
                                 <div class="mb-3">
                                     <label for="tunit" class="form-label">Enter Units to transfer</label>
                                     <input type="number" class="form-control" id="tunit" name="tunit" min="1">
                                 </div>
                             </div>

                             <!-- Units of measure for transfer -->
                             <div class="col">
                                <div class="mb-3">
                                    <label for="tmeasure" class="form-label">Unit of Measure</label>
                                    <select name="tmeasure" id="tmeasure" class="form-control">
                                        <?php
                                            $allmeasures = mysqli_query($con, "SELECT * FROM measures");
                                            while ($measure = mysqli_fetch_array($allmeasures)) {
                                                echo '<option value="' . $measure['unit'] . '">' . $measure['unit'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                             </div>
                         </div>
                         <button type="submit" class="btn btn-info" name="submit" id="submit1">Submit</button>
                     </form>
                 </div>

                 <div class="modal-footer">

                 </div>
             </div>
         </div>
     </div>
 </body>
 <script src="js/inventory.js"></script>

 </html>