<?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!--jquery-->
    <script src="jquery-3.3.1.min.js"></script>
    <!--bootstrap-->
    <link rel="stylesheet" href="bootstrap-5.0.2/css/bootstrap.min.css">
    <!--datatables-->
    <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">
    <script src="DataTables/media/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="">
        <div class="content-panel">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>USERS</h4>
                        </div>
                        <div class="card-body">
                            <table id="users" class="table table-stripe table-hover">
                                <thead>
                                    <tr>
                                        <th>FULLNAME</th>
                                        <th>EMAIL</th>
                                        <th>PHONE</th>
                                        <th>ACTIVATE</th>
                                        <th>SUSPEND</th>
                                        <th>MAKE ADMIN</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function initializeDataTable(dataURL) {
            var table = $('#users').DataTable({
                ajax: dataURL,
                columns: [{
                        data: '0'
                    },
                    {
                        data: '1'
                    },
                    {
                        data: '2'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button onclick="handleme()" class="btn btn-info activate ' + row[3] + '" data-userid="' + row[2] + '">ACTIVATE</button>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button onclick="handleme()" class="btn btn-primary suspend ' + row[4] + '" data-userid="' + row[2] + '">SUSPEND</button>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button onclick="handleme()" class="btn btn-warning makeAdmin ' + row[5] + '" data-userid="' + row[2] + '">MAKE ADMIN</button>';
                        }
                    }
                ],
            });
        }
        
        function handleme() {
            alert($(this).text());
                var userId = $(this).data('userid');
                var closestRow = $(this).closest('tr');
                var firstName = closestRow.find('td:first').text();
                var conf = confirm('Activate ' + firstName);

                if (conf) {
                    $.post('userActions.php', {
                        action: 'activate',
                        target: userId,
                    }, function(data) {
                        if (data) {
                            // console.log(data);
                            if (data) {
                                initializeDataTable('get_users.php');
                            }
                        }
                    })
                }
        }
        $(document).ready(function() {
            initializeDataTable('get_users.php');
        })
    </script>
    <script src="bootstrap-5.0.2/js/bootstrap.min.js"></script>
</body>

</html>