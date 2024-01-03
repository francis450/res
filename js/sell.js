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
        data: 'waiter',
        dataType: 'json',
        success: function (data) {
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
        error: function (error) {
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
        success: function (paymentDetails) {
            // Populate modal content with payment details
            $('#orderIdPlaceholder').text(orderId);
            $('#payable').val(total);
            // Add more placeholders and populate them with other payment details as needed

            // Show the Bootstrap modal
            $('.close-orders').click();
            $('.paymentModal').click();
        },
        error: function (error) {
            console.error('Error fetching payment details:', error);
        }
    });
}
const cart = [];
const cartProxy = new Proxy(cart, {
    set: function (target, property, value) {
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
$(document).ready(function () {
    initializeCartFromLocalStorage();
    populateOrders();

    $('.paymentbtn').click(function () {
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
        checkedCheckboxes.each(function () {
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

function saveOrder(cartData, table) {
    let department = $('.department').text();
    let username = $('.username').text();

    $.post('handlers/saveOrder.php', {
        order: cartData,
        department: department,
        server: username,
        table: table
    }, function (response) {
        return response;
    })
}

function generateAndPrintPDF() {
    var cartData = JSON.parse(localStorage.getItem('cart'));
    saveOrder(localStorage.getItem('cart'));
    cleari();
    var subtotal = $('.total').text();
    cartData.forEach(function (item, index) {
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

var tableId;

function choosenTable(id, department, table) {
    $('.chosenTable').text(department + ', ' + table);
    tableId = id;
}

function chooseTable() {
    $('.tableModal').click();
}

$('.printorder').click(chooseTable);

$('.sendorder').click(function () {
    var cartData = JSON.parse(localStorage.getItem('cart'));

    if (cartData && Array.isArray(cartData) && cartData.length > 0) {
        if (tableId) {
            saveOrder(localStorage.getItem('cart'), tableId);
            cleari();
            tableId = 0;
            $('.chosenTable').text('');
        }else{
            alert("PLEASE CHOOSE A TABLE FOR THE ORDER");
        }
    } else {
        alert('Cart is empty. Add items to the cart before generating a receipt.');
    }
});
// $('.printorder').click(generateAndPrintPDF);