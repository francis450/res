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
                                <tbody>
                                        <?php
                                            // $allusers = mysqli_query($con, "SELECT * FROM users");
                                            // while($users = mysqli_fetch_assoc($allusers)){
                                            //     echo '<tr>';
                                            //     echo '<td>'.$users['fullname'].'</td>';
                                            //     echo '<td>'.$users['email'].'</td>';
                                            //     echo '<td>'.$users['phone'].'</td>';
                                            //     $role;
                                            //     if($users['role'] == 1){
                                            //       $role = 'd-none';
                                            //     }else{
                                            //         $role = '';
                                            //     }
                                            //     $activate;
                                            //     $suspend;
                                            //     if($users['active'] == 1){
                                            //         $activate = 'd-none';
                                            //         $suspend = '';
                                            //     }else{
                                            //         $activate = '';
                                            //         $suspend = 'd-none';
                                            //     }
                                            //     echo '<td>
                                            //             <button class="btn btn-warning btn-sm activate '.$activate.'" id="'.$users['phone'].'">ACTIVATE</button>
                                            //         </td>';
                                            //     echo '<td>
                                            //             <button class="btn btn-danger btn-sm suspend '.$suspend.'" id="'.$users['phone'].'">SUSPEND</button>
                                            //         </td>';
                                            //     echo '<td>
                                            //             <button class="btn btn-info btn-sm makeAdmin '.$role.'" id="'.$users['phone'].'">MAKE ADMIN</button>
                                            //         </td>';
                                            //     echo '</tr>';
                                            // }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            
            function initializeDataTable(dataURL) {
                var table = $('#users').DataTable({
                    ajax: dataURL,
                    columns: [
                        { data: '0' },
                        { data: '1' },
                        { data: '2' },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return '<button class="btn btn-info activate ' + row[3] + '" data-userid="' + row[2] + '">ACTIVATE</button>';
                            }
                        },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return '<button class="btn btn-primary suspend ' + row[4] + '" data-userid="' + row[2] + '">SUSPEND</button>';
                            }
                        },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return '<button class="btn btn-warning makeAdmin ' + row[5] + '" data-userid="' + row[2] + '">MAKE ADMIN</button>';
                            }
                        }
                    ],
                });
            }
            initializeDataTable('get_users.php');


            // Handle button click events using event delegation
            $('#users tbody').on('click', '.activate', function() {
                var userId = $(this).data('userid');
                var closestRow = $(this).closest('tr');
                var firstName = closestRow.find('td:first').text();
                var conf = confirm('Activate ' + firstName);
                
                if(conf){
                    $.post('userActions.php',{action : 'activate', target: userId,},function(data){
                        if(data){
                            console.log(data);
                            initializeDataTable('get_users.php');
                        }
                    })
                }
            });

            $('#users tbody').on('click', '.suspend', function() {
                var userId = $(this).data('userid');
                var closestRow = $(this).closest('tr');
                var firstName = closestRow.find('td:first').text();
                alert('Suspend ' + firstName);
            });

            $('#users tbody').on('click', '.makeAdmin', function() {
                var userId = $(this).data('userid');
                var closestRow = $(this).closest('tr');
                var firstName = closestRow.find('td:first').text();
                alert('Make ' + firstName + ' an admin');
            });
        })
        
    </script>
    <script src="bootstrap-5.0.2/css/bootstrap.min.css"></script>
</body>
</html>