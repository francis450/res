$(document).ready(function () {
    // Initialize DataTables for all tables
    var todayTable = $('#today').DataTable();
    var today1Table = $('#today1').DataTable();
    var weekTable = $('#week').DataTable();
    var week2Table = $('#week2').DataTable();
    var monthTable = $('#month').DataTable();
    var month2Table = $('#month2').DataTable();
    var yearTable = $('#year').DataTable();
    var year2Table = $('#year2').DataTable();

    // Retrieve data for the 'today' table
    $.get('handlers/getSales.php', { date: 'today' }, function (data) {
        var data = JSON.parse(data);
        // Ensure data is an array of objects
        if (Array.isArray(data) && data.length > 0) {
            // Map specific data to specific rows
            var mappedData = data.map(function (item) {
                var total = parseFloat(item.qnty) * parseFloat(item.price);
                return [
                    item.orderid,
                    item.department,
                    item.food,
                    item.price,
                    item.qnty,
                    total, 
                    item.orderedAt,
                    item.server
                ];
            });

            // Update 'today' table with the mapped data
            today1Table.clear().rows.add(mappedData).draw();
        } else {
            console.error("Invalid data format. Expected an array.");
        }
    });

    // week
    $.get('handlers/getSales.php', { date: 'week' }, function (data) {
        var data = JSON.parse(data);
        // Ensure data is an array of objects
        if (Array.isArray(data) && data.length > 0) {
            // Map specific data to specific rows
            var mappedData = data.map(function (item) {
                var total = parseFloat(item.qnty) * parseFloat(item.price);
                return [
                    item.orderid,
                    item.department,
                    item.food,
                    item.price,
                    item.qnty,
                    total, 
                    item.orderedAt,
                    item.server
                ];
            });

            // Update 'today' table with the mapped data
            weekTable.clear().rows.add(mappedData).draw();
        } else {
            console.error("Invalid data format. Expected an array.");
        }
    });

    // month
    $.get('handlers/getSales.php', { date: 'month' }, function (data) {
        var data = JSON.parse(data);
        // Ensure data is an array of objects
        if (Array.isArray(data) && data.length > 0) {
            // Map specific data to specific rows
            var mappedData = data.map(function (item) {
                var total = parseFloat(item.qnty) * parseFloat(item.price);
                return [
                    item.orderid,
                    item.department,
                    item.food,
                    item.price,
                    item.qnty,
                    total, 
                    item.orderedAt,
                    item.server
                ];
            });

            // Update 'today' table with the mapped data
            monthTable.clear().rows.add(mappedData).draw();
        } else {
            console.error("Invalid data format. Expected an array.");
        }
    });

    // year
    $.get('handlers/getSales.php', { date: 'year' }, function (data) {
        var data = JSON.parse(data);
        // Ensure data is an array of objects
        if (Array.isArray(data) && data.length > 0) {
            // Map specific data to specific rows
            var mappedData = data.map(function (item) {
                var total = parseFloat(item.qnty) * parseFloat(item.price);
                return [
                    item.orderid,
                    item.department,
                    item.food,
                    item.price,
                    item.qnty,
                    total, 
                    item.orderedAt,
                    item.server
                ];
            });

            // Update 'today' table with the mapped data
            yearTable.clear().rows.add(mappedData).draw();
        } else {
            console.error("Invalid data format. Expected an array.");
        }
    });


    
});
