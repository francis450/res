$(document).ready(function () {
    const orders = $('#orders').DataTable({
        columns: [
            { title: 'OrderId' },
            { title: 'Department' },
            { title: 'Table' },
            { title: 'Waiter' },
            { title: 'Items' },
            { title: 'Total' },
            { title: 'Time' },
            { title: 'Action' },
        ]
    });
    populateOrders();

    const evtSource = new EventSource("handlers/sendOrders.php");

    evtSource.onmessage = (event) => {
        const data = JSON.parse(event.data);

        if (data && data.length > 0) {
            // console.log(data);
            getOrders(data);
        }
    };

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

    $('.sellbtn').click(function () {
        var orderId = $('#orderIdPlaceholder').text();
        var payable = $('#payable').val();
        var amtgiven = $('#amountgiven').val();
        var bakii = $('.bakii').val();
        var transtype = $('#transtype').val();
        $.ajax({
            url: 'handlers/completeOrder.php',
            method: 'POST',
            data: { orderId: orderId, payable: payable, amtgiven: amtgiven, bakii: bakii, transtype: transtype },
            success: function (data) {
                if (data == 'success') {
                    // alert("Order Completed");
                    $('#paymentModal .btn-close').click();
                    deleteOrder(orders, 0, orderId, data);
                    document.querySelector('.sucesssMessage').textContent = ('ORDER SUCCESSFULLY PAID');

                    // Trigger the button click event to show the success message modal
                    $('.successButton').click();
                } else {
                    console.log(data);
                    alert("Error Occured");
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    });

    $('.confirmed').click(function () {
        let orderId = $('.orderNumber').text();
        let reason = $('#reason').val();
        if (reason) {
            deleteOrder(orders, 0, orderId, reason);
            // Set the success message text content
            document.querySelector('.sucesssMessage').textContent = ('ORDER SUCCESSFULLY DELETED');

            // Trigger the button click event to show the success message modal
            $('.successButton').click();
            $('.closeDelete').click();
        } else {
            alert('REASON FOR CANCELLING ORDER CANNOT BE NULL');
        }
    });

})

$(document).ready(function(){
    if($('#pay').parent().css('width','250px')){
        console.log($('#pay').parent().css('width'));
    }else{
        console.log('Not Done');w
    }
});

function openPaymentModal(orderId, total) {
    let inputs = document.querySelectorAll('input');
    inputs.forEach(element => {
        element.value = '';
    });
    $.ajax({
        url: 'handlers/payment_details.php',
        method: 'GET',
        data: { orderid: orderId },
        dataType: 'json',
        success: function () {
            // Populate modal content with payment details
            $('#orderIdPlaceholder').text(orderId);
            $('#payable').val(total);
            $('.paymentModal').click();
        },
        error: function (error) {
            console.error('Error fetching payment details:', error);
        }
    });
}

function populateOrders() {
    $.ajax({
        url: 'handlers/getOrders.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            getOrders(data);
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });
}

function getOrders(data) {
    $('#orders').DataTable().clear().draw();
    // Populate data into the DataTable
    for (var i = 0; i < data.length; i++) {
        $('#orders').DataTable().row.add([
            data[i].orderid,
            data[i].department,
            data[i].table,
            data[i].server,
            data[i].foods,
            data[i].total,
            data[i].date,
            '<button id="pay" class="btn btn-primary btn-sm" onclick="openPaymentModal(\'' + data[i].orderid + '\', ' + parseFloat(data[i].total) + ')">Pay</button>&nbsp<button class="btn btn-danger btn-sm mr-1" onclick="confirmDeleteOrder(\'' + data[i].orderid + '\')" >X Cancel</button><button onclick="showOrder(\'' + data[i].orderid + '\')" class="btn btn-info btn-sm">&#x1F441; Order</button>'
        ]).draw();
    }
}

function confirmDeleteOrder(orderId) {
    document.querySelector('.deleteItems').innerHTML = '';
    $('.orderNumber').text(orderId);
    var subtotal = 0;
    $.get('handlers/confirmDelete.php', { orderId: orderId }, function (data) {
        var items = JSON.parse(data);
        // console.log(items);
        items.forEach(element => {
            let total = document.createElement('td');
            total.textContent = (parseFloat(element.price) * parseFloat(element.qnty));

            subtotal += (parseFloat(element.price) * parseFloat(element.qnty));

            var tr = document.createElement('tr');

            var food = document.createElement('td');
            food.textContent = (element.food);

            var price = document.createElement('td');
            price.textContent = (element.price);

            var qnty = document.createElement('td');
            qnty.textContent = (element.qnty);

            tr.appendChild(food);
            tr.append(price);
            tr.append(qnty);
            tr.append(total)

            document.querySelector('.deleteItems').append(tr);
        });
        let total = document.createElement('td');
        total.textContent = (subtotal);

        subtotal += total.text;

        var tr = document.createElement('tr');

        var food = document.createElement('td');
        food.textContent = '';

        var price = document.createElement('td');
        price.textContent = '';

        var qnty = document.createElement('td');
        qnty.textContent = 'SubTotal: ';

        tr.appendChild(food);
        tr.append(price);
        tr.append(qnty);
        tr.append(total)

        document.querySelector('.deleteItems').append(tr);
    });

    $('.confirmed').show();
    $('.viewDetails').text('');
    $('#cancelText').text('CANCEL ');
    $('.subtotal').textContent = (subtotal);
    $('#reason').show();
    $('#reason').text('');
    $('.deleteModalButton').click();
}

function showOrder(orderId) {
    document.querySelector('.deleteItems').innerHTML = '';
    $('.orderNumber').text(orderId);
    var subtotal = 0;
    $.get('handlers/confirmDelete.php', { orderId: orderId }, function (data) {
        var items = JSON.parse(data);
        // console.log(items);
        items.forEach(element => {
            let total = document.createElement('td');
            total.textContent = (parseFloat(element.price) * parseFloat(element.qnty));

            subtotal += (parseFloat(element.price) * parseFloat(element.qnty));

            var tr = document.createElement('tr');

            var food = document.createElement('td');
            food.textContent = (element.food);

            var price = document.createElement('td');
            price.textContent = (element.price);

            var qnty = document.createElement('td');
            qnty.textContent = (element.qnty);

            tr.appendChild(food);
            tr.append(price);
            tr.append(qnty);
            tr.append(total)

            document.querySelector('.deleteItems').append(tr);
        });
        let total = document.createElement('td');
        total.textContent = (subtotal);

        subtotal += total.text;

        var tr = document.createElement('tr');

        var food = document.createElement('td');
        food.textContent = '';

        var price = document.createElement('td');
        price.textContent = '';

        var qnty = document.createElement('td');
        qnty.textContent = 'SubTotal: ';

        tr.appendChild(food);
        tr.append(price);
        tr.append(qnty);
        tr.append(total)

        document.querySelector('.deleteItems').append(tr);
    });
    // $('#deleteModal .modal-title').text('');
    $('#reason').hide();
    $('#cancelText').text('');
    $('#paymentModalLabel').text('ORDER DETAILS');
    $('.confirmed').hide();
    $('.viewDetails').text(' DETAILS');
    $('.subtotal').textContent = (subtotal);
    $('.deleteModalButton').click();
}


function deleteOrder(dataTable, columnIndex, targetValue, reason) {

    $.post('handlers/deleteOrder.php', { orderId: targetValue, reason: reason, }, function (data) {
        console.log(data);
        if (data == 'success') {
            // Get all data in the DataTable
            const data = dataTable.rows().data().toArray();

            // Filter the data to exclude rows with the target value in the specified column
            const filteredData = data.filter(row => row[columnIndex] !== targetValue);

            // Clear and redraw the DataTable with the filtered data
            dataTable.clear().rows.add(filteredData).draw();
        }
    });
}
