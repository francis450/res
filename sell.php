<?php
session_start();
include('connection.php');
if (!isset($_SESSION['username']) && isset($_SESSION['department'])) {
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
    <!--<script src="jquery-3.3.1.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                        <button class="btn btn-secondary printorder">PRINT ORDER</button>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">ORDERS</button>
                    </div>
                </div>
            </div>
            <div class="row d-flex" style="justify-content:center;gap:20px;">
                <div class="col-4">
                    <table id="cart" class="table table-stripe table-hover">

                    </table>
                    <button class="btn btn-danger col-12">
                        <!-- <span>Confirm Order For</span> -->
                        <span>Total: </span>
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
                            $catquer = mysqli_query($con, "SELECT * FROM menu where category = '$catt'");
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
    </div>
    <script>
        function cleari() {
            cart.length = 0;
            updateCartInLocalStorage();
            updateDataTable();
            updateTotal();
        }

        function getItems(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        const dataTable = $('#cart').DataTable({
            columns: [{
                    title: ''
                },
                {
                    title: 'Item'
                },
                {
                    title: 'Quantity'
                },
                {
                    title: 'Price'
                },
                {
                    title: 'Total'
                },
            ],
        });
        const orders = $('#orders').DataTable({
            columns: [{
                    title: 'OrderId'
                },
                {
                    title: 'Items'
                },
                {
                    title: 'Total'
                },
                {
                    title: 'Action'
                },
            ]
        });

        function populateOrders() {
            $.ajax({
                url: 'handlers/getOrders.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Assuming the data is an array of objects with properties like OrderId, Items, Total

                    // Clear existing rows in the DataTable
                    $('#orders').DataTable().clear().draw();

                    // Populate data into the DataTable
                    for (var i = 0; i < data.length; i++) {
                        $('#orders').DataTable().row.add([
                            data[i].orderid,
                            data[i].foods,
                            data[i].total,
                            '<button class="btn btn-primary" onclick="openPaymentModal(\'' + data[i].orderid + '\', ' + parseFloat(data[i].total) + ')">Pay</button>'
                        ]).draw();
                    }
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function openPaymentModal(orderId, total) {
            $.ajax({
                url: 'handlers/payment_details.php',
                method: 'GET',
                data: {
                    orderid: orderId
                },
                dataType: 'json',
                success: function(paymentDetails) {
                    // Populate modal content with payment details
                    $('#orderIdPlaceholder').text(orderId);
                    $('#payable').val(total);
                    // Add more placeholders and populate them with other payment details as needed

                    // Show the Bootstrap modal
                    $('.close-orders').click();
                    $('.paymentModal').click();
                },
                error: function(error) {
                    console.error('Error fetching payment details:', error);
                }
            });
        }
        const cart = [];
        const cartProxy = new Proxy(cart, {
            set: function(target, property, value) {
                // Intercept array changes here
                if (property === 'length') {
                    // Handle array length changes (e.g., push, splice)
                    updateDataTable();
                } else if (property === 'push' && Array.isArray(value)) {
                    // Handle push with an array (used for batch adding items)
                    value.forEach(item => addToCart(item));
                } else if (property === 'remove') {
                    const itemIndex = target.findIndex(item => item.name === value);
                    if (itemIndex !== -1) {
                        target.splice(itemIndex, 1);
                    }

                    // Update cart data in localStorage
                    updateCartInLocalStorage();

                    updateDataTable();
                    updateTotal();
                } else {
                    // Handle item updates (e.g., cart[index] = newItem)
                    const itemIndex = target.findIndex(item => item.name === property);
                    if (itemIndex !== -1) {
                        // Item already exists, increase its quantity by 1
                        target[itemIndex].quantity += 1;
                    } else {
                        target.push(value);
                    }
                    updateCartInLocalStorage();

                    updateDataTable();
                    updateTotal();
                }
                return true;
            },
        });

        function updateCartInLocalStorage() {
            localStorage.setItem('cart', JSON.stringify(cart));
        }
        $(document).ready(function() {
            initializeCartFromLocalStorage();
            populateOrders();

            $('.paymentbtn').click(function() {
                var payable = $('#payable').val();
                var transtype = $(this).text();
                var amtgiven = prompt("Enter Amount Given");
                if (amtgiven !== null && amtgiven !== '') {
                    $('#amountgiven').val(amtgiven);
                    $('#transtype').val(transtype);
                    $('.bakii').val(amtgiven - payable);
                    if ($('.bakii').val() >= 0 && payable > 0) {
                        $('.sellbtn').show();
                    } else {
                        $('.sellbtn').hide();
                    }
                } else {
                    alert("Amount Cannot Be Empty");
                }
            });
        });

        function initializeCartFromLocalStorage() {
            const storedCart = localStorage.getItem('cart');
            if (storedCart) {
                const parsedCart = JSON.parse(storedCart);
                parsedCart.forEach(item => addToCart(item, false));
                updateDataTable(); // Update UI after adding all items
                updateTotal();
            }
        }

        function updateDataTable() {
            // Clear the DataTable
            dataTable.clear();

            // Populate the DataTable with the updated cart data
            cartProxy.forEach(item => {
                const {
                    name,
                    quantity,
                    price
                } = item;
                const checkbox = $('<input>').prop({
                    type: 'checkbox',
                    id: name, // Unique ID for each checkbox
                    name: name, // Unique name for each checkbox
                    checked: false // You can set it based on some condition
                });

                const total = quantity * price;
                dataTable.row.add([checkbox[0].outerHTML, name, quantity, price, total]);
            });

            // Redraw the DataTable
            dataTable.draw();
        }

        function updateTotal() {
            let total = 0;
            cartProxy.forEach(item => {
                let additional = item.quantity * item.price;
                total += additional;
            });
            $('.total').html(total);
        }

        function addToCart(item, updateUI = true) {
            // Check if the item already exists in the cart
            const existingItem = cartProxy.find(cartItem => cartItem.name === item.name);
            if (existingItem) {
                // Item exists, increase its quantity by 1
                existingItem.quantity += 1;
            } else {
                // Item does not exist, add it to the cart
                cartProxy.push(item);
            }

            // Update cart data in localStorage if required
            if (updateUI) {
                updateCartInLocalStorage();
                updateDataTable();
                updateTotal();
            }
        }

        function add(foodcode, food, price,) {
            addToCart({
                foodcode: foodcode,
                name: food,
                quantity: 1,
                price: price
            });
        }

        function removeItemFromCart(itemName) {
            const itemIndex = cart.findIndex(item => item.name === itemName);
            if (itemIndex !== -1) {
                cart.splice(itemIndex, 1);
                return true; // Item removed successfully
            }
            return false; // Item not found in the cart
        }

        function removeSelectedItems() {
            // Get all the checked checkboxes within the table
            var checkedCheckboxes = $('#cart input[type="checkbox"]:checked');

            // Check if there are any checked checkboxes
            if (checkedCheckboxes.length > 0) {
                // Iterate over the checked checkboxes and remove corresponding items from the cart
                checkedCheckboxes.each(function() {
                    var itemName = $(this).attr('name'); // Assuming you store the item name as a data attribute
                    var removed = removeItemFromCart(itemName); // Remove the item from the cart
                    if (removed) {
                        // Update the data table, total, and possibly localStorage
                        updateDataTable();
                        updateTotal();
                        updateCartInLocalStorage(); // If needed
                    }
                });
            } else {
                // No checkboxes are checked, you can show a message or take other actions
                alert('No items selected for removal.');
            }
        }
        $('#removeButton').on('click', removeSelectedItems);

        function saveOrder(cartData) {
            $.post('handlers/saveOrder.php', {
                order: cartData,
                department: '<?php echo $department; ?>'
            }, function(response) {
                if (response) {

                }
            })
        }

        function generateAndPrintPDF() {
            var cartData = JSON.parse(localStorage.getItem('cart'));
            saveOrder(localStorage.getItem('cart'));
            cleari();
            var subtotal = $('.total').text();
            cartData.forEach(function(item, index) {
                item.rowNumber = index + 1;
                item.total = (item.price * item.quantity).toFixed(2);
            });
            if (cartData && Array.isArray(cartData) && cartData.length > 0) {
                // Define the custom page size in inches (2.9 inches width)
                var pageSizeInches = {
                    width: 2.9 * 72,
                    height: 'auto'
                };
                cartData.push({
                    rowNumber: '',
                    name: 'Subtotal',
                    quantity: '',
                    price: '',
                    total: subtotal
                });
                var docDefinition = {
                    pageOrientation: 'portrait',
                    pageSize: pageSizeInches,
                    pageMargins: [5, 5, 5, 0],
                    content: [{
                            text: 'ORDER',
                            style: 'header',
                            alignment: 'center',
                            fontSize: 9
                        },
                        {
                            layout: 'headerLineOnly',
                            table: {
                                headerRows: 1,
                                widths: ['auto', 'auto', 'auto', 'auto', 'auto'],
                                body: [
                                    ['#', 'Item', 'Qnty', 'Price', 'Total'],
                                    ...cartData.map(item => [item.rowNumber, item.name, item.quantity, item.price, item.total])
                                ]
                            }
                        }
                    ],
                    styles: {
                        header: {
                            fontSize: 7,
                            bold: true
                        }
                    }
                };

                var pdfDoc = pdfMake.createPdf(docDefinition);
                pdfDoc.print({}, window);
            } else {
                alert('Cart is empty. Add items to the cart before generating a receipt.');
            }
        }
        $('.printorder').click(generateAndPrintPDF);
    </script>
</body>

</html>