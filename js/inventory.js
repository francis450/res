$(document).ready(function () {
    // let purchaseHistory = new JSTable('#purchaseHistory');
    $('#purchaseHistory').DataTable({
        columns: [
            { title: 'receipt' },
            { title: 'supplier' },
            { title: 'desc' },
            { title: 'totalcost' },
            { title: 'unitcost' },
            { title: 'paid' },
            { title: 'balance' },
            { title: 'method' },
            { title: 'dated' }
        ]
    });
    $('#inventoryTable').DataTable();

    $.get('handlers/getpurchases.php', function (data) {
        getPurchases(JSON.parse(data));
    });

    $('#inventoryTable ').on('click', '.transfer', getproducts($(this).data('id')));

    $('.transfer-form').on('submit', function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);
        $.ajax({
            url: 'handlers/transfer.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response) {
                    $('#tranfer').modal('hide');
                    $('#inventoryTable').DataTable().ajax.reload();
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    })
});

function getproducts(id) {
    $.get('handlers/get_product.php', { id: id }, function (product) {
        var thisproduct = JSON.parse(product);
        $('#unitcost').val(thisproduct.unitcost);
        $('#productid').val(thisproduct.id);
        $('#productT').val(thisproduct.name);
        $('#qntyT').val(thisproduct.qnty);
        $('#smallunitT').val(thisproduct.smallunit);
        $('#bigunitT').val(thisproduct.bigunit);
        $('.tranferButton').click();
    });
}

function getPurchases(data) {
    $('#purchaseHistory').DataTable().clear().draw();
    for (var i = 0; i < data.length; i++) {

        $('#purchaseHistory').DataTable().row.add([
            data[i].receipt,
            data[i].supplier,
            data[i].desc,
            data[i].totalcost,
            data[i].unitcost,
            data[i].paid,
            data[i].balance,
            data[i].method,
            data[i].dated
        ]).draw();
    }
}


$(document).ready(function () {
    $('#paid').change(function () {
        var paid = parseFloat($('#paid').val()) || 0;
        var totalcost = parseFloat($('#cost').val()) || 0;
        var balanceInput = $('#balance');

        if (paid >= 0 && totalcost >= 0) {
            balanceInput.val(totalcost - paid);
        }
    });

    $('.addproduct').click(function () {
        var productname = prompt("ENTER PRODUCT NAME");
        if (productname != '' && productname != null) {
            $.post('adding.php', { productname: productname }, function (data) {
                $('#product').empty();
                $('#product').append(data);
            });
        } else {
            alert("PRODUCT NAME CANNOT BE NULL");
        }
    });

    $('.addsupplier').click(function () {
        // Prompt the user to enter a supplier name
        var suppliername = prompt("ENTER SUPPLIER NAME");

        if (suppliername != '' && suppliername != null) {
            // Send a POST request to 'adding.php' with the supplier name
            $.post('adding.php', { suppliername: suppliername }, function (data) {
                // Log the response data to the console
                $('#suppliers').empty();
                $('#suppliers').append(data);
            })
        } else {
            alert("SUPPLIER NAME CANNOT BE NULL");
        }
    });

    $('.addmeasure').click(function () {
        var measure = prompt("ENTER NEW UNIT OF MEASURE");

        if (measure != '' && measure != null) {
            $.post('adding.php', { measure: measure }, function (data) {
                $('#measure').empty();
                $('#measure').append(data);
            });
        } else {
            alert("UNIT OF MEASURE CANNOT BE NULL");
        }
    });
});

function addStock(event) {
    event.preventDefault();
    var psupplier = $('#suppliers').val();
    var product = $('#product').val();
    var productunits = $('#units').val();
    var weight = $('#weightUnit').val();
    var measure = $('#measure').val();
    var smallunit;
    var bigunit;
    var totalcost = $('#cost').val();
    var unitcost = totalcost / productunits;
    var paid = $('#paid').val();
    var balance = $('#balance').val();
    var method = $('#transactiontype').val();
    var ref = $('#receiptno').val();

    if (measure == "kgs" || measure == "l") {
        smallunit = (productunits * weight) * 1000;
    } else if (measure == 'g' || measure == 'ml') {
        smallunit = productunits * weight;
    }
    if (measure == "kgs" || measure == "l") {
        bigunit = productunits * weight;
    } else if (measure == 'g' || measure == 'ml') {
        bigunit = (productunits * weight) / 1000;
    }

    $.post('handlers/inventory.php', {
        psupplier: psupplier,
        product: product,
        productunits: productunits,
        weight: weight,
        measure: measure,
        smallunit: smallunit,
        bigunit: bigunit,
        totalcost: totalcost,
        unitcost: unitcost,
        paid: paid,
        balance: balance,
        ref: ref,
        method: method
    },
        function (data) {
            if (data) {
                $('.closeAddStockModal').click();
                $('.sucesssMessage').text(product + ' ADDED SUCCESSFULLY');
                $('.successButton').click();
            } else {
                alert("PRODUCT NOT ADDED");
            }
        }
    );

}