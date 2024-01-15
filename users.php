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
    <script src="bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
    <!--datatables-->
    <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">
    <script src="DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="sources/fontawesome/css/all.min.css">
</head>
<style>
    .modal-backdrop {
        z-index: 0;
        display: none;
    }
</style>

<body>
    <div>
        <div class="content-panel">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>USERS</h4>
                        </div>
                        <div class="card-body">

                            <table id="users" class="table table-striped table-hover">
                                <thead class="bg-dark text-light">
                                    <tr>
                                        <!-- <th><input type="checkbox" name="bulk" id="bulk"></th> -->
                                        <th>FULLNAME</th>
                                        <th>EMAIL</th>
                                        <th>PHONE</th>
                                        <th>ROLE</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <!-- <th><input type="checkbox" name="bulk" id="bulk"></th> -->
                                        <th>FULLNAME</th>
                                        <th>EMAIL</th>
                                        <th>PHONE</th>
                                        <th>ROLE</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="d-none" id="openEditModal" data-bs-toggle="modal" data-bs-target="#editModal"></button>
    <!-- MODALS -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 80px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to edit user rights -->
                    <form id="editUserForm">
                        <div class="mb-3">
                            <label for="userId" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userId" name="username" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="userRights" class="form-label">
                                CHANGE ROLE TO
                            </label>
                            <select class="form-control" name="role" id="rights">
                                <option>SELECT</option>
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM user_types");
                                while ($ret = mysqli_fetch_array($sql)) {
                                    echo '<option value = "' . $ret['type'] . '">' . strtoupper($ret['type']) . '</option>';
                                }
                                ?>
                            </select>
                            <!-- <input type="text" class="form-control" id="userRights" placeholder="Enter new user rights"> -->
                        </div>
                        <div class="mb-3">
                            <label class="form-check-label" for="flexSwitchCheckDefault">ACTIVATE/DEACTIVATE</label>

                            <div class="form-check form-switch">
                                <!-- <label class="form-check-label" for="flexSwitchCheckDefault">ACTIVATE/DEACTIVATE</label> -->
                                <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckDefault">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">PHONE</label>
                            <input type="tel" class="form-control" name="phone" id="phone">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-MAIL</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <button type="submit" class="btn btn-primary saveChanges">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <script src="js/users.js"></script>
</body>

</html>