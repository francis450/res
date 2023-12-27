 <?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang='eng'>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Required meta tags -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashboard</title>
      <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
      
      <!-- plugins:css -->
      <link rel="stylesheet" href="./dashboard_files/materialdesignicons.min.css">
      <link rel="stylesheet" href="./dashboard_files/vendor.bundle.base.css">
      <!-- endinject -->
      <!-- plugin css for this page -->
      
      <!-- End plugin css for this page --> 
      <!-- inject:css -->
      <link rel="stylesheet" href="./dashboard_files/style.css">
      <script src='jquery-3.3.1.min.js'></script>
      <!-- endinject -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="JSTable/dist/jstable.css">
    <script src="JSTable/dist/jstable.min.js"></script>
    <link rel="stylesheet" href="jsgrid/dist/jsgrid.min.css">
    <script src="DataTables/media/js/jquery.dataTables.min.js"></script>    
    <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">

    </head>
    <body>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Purchase</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Inventory</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between p-2">
                        <div class="card col-12">
                            <div class="card-header">
                                <h5>ADD PRODUCTS</h5>
                            </div>
                            <div class="card-body">
                                <table class="table-hover table-stripe col-12" id="addproducts">
                                    <thead>
                                        <tr class="col-12">
                                            <th class="col">Invoice No.</th>
                                            <th class="col">Supplier</th>
                                            <th class="col">Product</th>
                                            <th class="col">Units<br>No. of packets</th>
                                            <th class="col">Weight/Unit<br>Weight per Packet</th>
                                            <th class="col">Measure<br>Units of Measure</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="col-12">
                                            <td class="col">
                                                <!--RECEIPT NO-->
                                                <input name="receiptno" id="receiptno" type="text" >
                                            </td>
                                            <td class="col">
                                                <!--SUPPLIER-->
                                                <select name = "suppliers" id="suppliers">
                                                    <option>supplier</option>
                                                    <?php
                                                        $allsuppliers = mysqli_query($con, "SELECT * FROM suppliers ORDER BY fullname ASC");
                                                        while($suppliers = mysqli_fetch_array($allsuppliers)){
                                                            echo '<option value='.$suppliers['fullname'].'>'.$suppliers['fullname'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                                <span class="addsupplier" style="font-size:x-large; color:green; cursor:pointer">+</span>
                                            </td>
                                            
                                            <td class="col"> 
                                                <!--PRODUCT-->
                                                <select name="product" id="product">
                                                    <option>item</option>
                                                    <?php
                                                        $allproducts = mysqli_query($con, "SELECT * FROM brands ORDER BY brand ASC");
                                                        while($products = mysqli_fetch_array($allproducts)){
                                                            echo '<option value="' . $products['brand'] . '">' . $products['brand'] . '</option>';
                                                        }
                                                    
                                                    ?>
                                                </select>
                                                <span class="addproduct" style="font-size:x-large; color:green; cursor:pointer">+</span>
                                            </td> 
                                            <td class="col">
                                                <!--UNITS-->
                                                <input name="units" id="units" type="number">
                                            </td>
                                            <td class="col">
                                                <!--NET/UNIT-->
                                                <input name="weightUnit" id="weightUnit" type="number">
                                            </td>
                                            <td class="col">
                                                <!--MEASURE-->
                                                <select name="measure" id="measure">
                                                    <option value="null">Measure</option>
                                                    <option value="kgs">KGs</option>
                                                    <option value="g">Gs</option>
                                                    <option value="l">Ltrs</option>
                                                    <option value="ml">MLs</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <thead>
                                                <tr class="col-12">
                                                    <th class="col">Total Cost</th>
                                                    <th class="col">Amount Paid<br>To Supplier</th>
                                                    <th class="col">Balance</th>
                                                    <th class="col">Transaction</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class"row">
                                                    <!--cost-->
                                                    <td class="col">
                                                        <input name="cost" id="cost" type="number">
                                                    </td>
                                                    <!--Amount Paid-->
                                                    <td class="col">
                                                        <input name="paid" id="paid" type="number">
                                                    </td>
                                                    <!--Balance-->
                                                    <td class="col">
                                                        <input name='balance' id="balance" type="number" readonly>
                                                    </td>
                                                    <!--Transaction-->
                                                    <td class="col">
                                                        <select name="transactiontype" id="transactiontype">
                                                            <option value="Cash">Cash</option>
                                                            <option value="Mpesa">Mpesa</option>
                                                            <option value="Bank">Bank</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success btn-outline add">ADD</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </tr>
                                    </tbody>
                                </table>
                                <script>
                                    $(document).ready(function(){
                                        $('#paid').change(function(){
                                            var paid = parseFloat($('#paid').val()) || 0; // Convert to number or default to 0
                                            var totalcost = parseFloat($('#cost').val()) || 0; // Convert to number or default to 0
                                            var balanceInput = $('#balance'); // Target the balance input
                                        
                                            if(paid >= 0 && totalcost >= 0){ // Ensure paid and totalcost are non-negative
                                                balanceInput.val(totalcost - paid); // Calculate and set the balance
                                            } 
                                        });

                                        $('.add').click(function(){
                                           var psupplier =  $('#suppliers').val();
                                           var product = $('#product').val();
                                           var productunits = $('#units').val();
                                           var weight = $('#weightUnit').val();
                                           var measure = $('#measure').val();
                                           var smallunit;
                                           var bigunit;
                                           var totalcost = $('#cost').val();
                                           var unitcost = totalcost/productunits;
                                           var paid = $('#paid').val();
                                           var balance = $('#balance').val();
                                           var method = $('#transactiontype').val();
                                            var ref    = $('#receiptno').val();
                                           
                                           if(measure == "kgs" || measure == "l"){
                                               smallunit = (productunits * weight)*1000;
                                           }else if(measure == 'g' || measure == 'ml'){
                                               smallunit = productunits * weight;
                                           }
                                           if(measure == "kgs" || measure == "l"){
                                               bigunit = productunits * weight;
                                           }else if(measure == 'g' || measure == 'ml'){
                                               bigunit = (productunits * weight)/1000;
                                           }
                                           
                                           $.post('handlers/inventory.php',
                                            {
                                                psupplier:psupplier,
                                                product:product,
                                                productunits:productunits,
                                                weight:weight,
                                                measure:measure,
                                                smallunit:smallunit,
                                                bigunit:bigunit,
                                                totalcost:totalcost,
                                                unitcost:unitcost,
                                                paid:paid,
                                                balance:balance,
                                                ref:ref,
                                                method:method
                                            },
                                            function(data){
                                                alert(data);
                                                location.reload();
                                            }
                                           );
                                        
                                        });
                                        $('.addproduct').click(function(){
                                            var productname = prompt("ENTER PRODUCT NAME");
                                            if(productname != '' && productname != null){
                                                $.post('adding.php', { productname: productname }, function(data){
                                                    console.log(data); 
                                                    $('#product').empty();
                                                    $('#product').append(data);
                                                });
                                            }else{
                                                alert("PRODUCT NAME CANNOT BE NULL");
                                            }
                                        });
                                        
                                        $('.addsupplier').click(function(){
                                            // Prompt the user to enter a supplier name
                                            var suppliername = prompt("ENTER SUPPLIER NAME");
                                        
                                            if (suppliername != '' && suppliername != null) { // Use '&&' instead of '||'
                                                // Send a POST request to 'adding.php' with the supplier name
                                                $.post('adding.php', { suppliername: suppliername }, function(data){
                                                    // Log the response data to the console
                                                    console.log(data);
                                                    $('#suppliers').empty();
                                                    $('#suppliers').append(data);
                                                });
                                            } else {
                                                alert("SUPPLIER NAME CANNOT BE NULL");
                                            }
                                        });

                                    });
                                </script>
                            </div>
                        </div>
                      </div>
                      <div class="d-flex flex-wrap justify-content-xl-between p-2">
                        <div class="card col-12">
                            <div class="card-header">
                                <h4>Purchase History</h4>
                            </div>
                            <div class="card-body">
                                <table class="table" id="purchaseHistory">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Supplier</th>
                                            <th>Product Desc.</th>
                                            <th>Total Cost</th>
                                            <th>Cost/Unit</th>
                                            <th>Paid(Kshs)</th>
                                            <th>Balance</th>
                                            <th>Method</th>
                                            <th>Dated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $allpurchases = mysqli_query($con, "SELECT * FROM purchases ORDER BY dated DESC");
                                            while($purchase = mysqli_fetch_array($allpurchases)){
                                                echo "<tr>";
                                                echo "<td>";
                                                echo $purchase['receipt'];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $purchase['supplier'];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $purchase['units']*$purchase['weight']." ".$purchase['measure'].' of '.$purchase['product'];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $purchase['totalcost'];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $purchase['unitcost'];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $purchase['paid'];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $purchase['balance'];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $purchase['method'];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $purchase['dated'];
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        ?>
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
                                    <h4>ALL ITEMS AVAILABLE</h4>
                                </div>
                                <div class="card-body">
                                    <table id="inventoryTable"  class="table table-stripe no-footer" role="grid">
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
                                			  $getsuppliers = mysqli_query($con,"select * from products where qnty>0");
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
                                				  echo '<td><a href="transfer.php?id='.$getsuppliersr['id'].'">Transfer</a></td>';
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
        <script>
            $(document).ready( function () {
                let purchaseHistory = new JSTable('#purchaseHistory');
                let inventoryTable = new JSTable('#inventoryTable');
                let foodCosting = new JSTable('#foodCosting');
                // $('#example').DataTable();
            } );
            
        </script>
    </body>
    <script src="./dashboard_files/vendor.bundle.base.js.download"></script>
</html>