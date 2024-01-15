<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src='jquery-3.3.1.min.js'></script> -->
    <!-- <link rel="stylesheet" href="bs/bootstrap.min.css"> -->
    <!-- <script src="bs/bootstrap.min.js"></script> -->


    <!-- jQuery (required for Bootstrap JavaScript) -->
    <script src="sources/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>

    <script src="DataTables/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Food Costing</title>
</head>
<style>
    .modal-backdrop {
        z-index: 0;
        display: none;
    }
</style>
<style>
    td.dt-control:before {
        height: 1em;
        width: 1em;
        margin-top: -9px;
        display: inline-block;
        color: white;
        border: .15em solid white;
        border-radius: 1em;
        box-shadow: 0 0 .2em #444;
        box-sizing: content-box;
        text-align: center;
        text-indent: 0 !important;
        font-family: "Courier New", Courier, monospace;
        line-height: 1em;
        content: "+";
        background-color: #31b131;
    }

    .clicked:before {
        content: "-";
        background-color: red;
    }

    .dataTables_empty {
        display: none !important;
    }
</style>

<body>
    <div class="content-wrapper">
        <div class="row m-4">
            <div class="col-12">
                <div class="card d-none">
                    <div class="card-header" data-toggle="collapse" data-target="#collapse11">
                        <h4>FOOD COSTING</h4>
                    </div>
                    <div id="collapse11" class="collapse">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex" style="justify-content: space-between;">
                        <h4>MENU ITEMS</h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addItem">ADD ITEM</button>
                    </div>

                    <div class="card-body " id="collapse12">
                        <div class="table-responsive">
                            <script>
                                /* Formatting function for row details - modify as you need */
                                
                            </script>
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>CODE</th>
                                        <th>FOOD</th>
                                        <th>TOTAL COST</th>
                                        <th>PRICE</th>
                                        <th>ACTION</th>
                                        <th>DELETE</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>CODE</th>
                                        <th>FOOD</th>
                                        <th>TOTAL COST</th>
                                        <th>PRICE</th>
                                        <th>ACTION</th>
                                        <th>DELETE</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary fungua d-none" data-toggle="modal" data-target="#exampleModalCenter">
        Launch demo modal
    </button>
    <div class="modo"></div>
    <!-- Modal -->

    <!-- ADD MENU ITEM MODAL -->
    <div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="margin-top: 80px;">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">ADD MENU ITEM</h3>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <div id="myForm" class="container">
                        <form id="add-menu-item">
                            <div class="row">
                                <div class="col-12">
                                    <h5>ITEM DETAILS</h5>
                                    <hr style="margin-top:0;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <!-- Department -->
                                    <div class="form-group">
                                        <label for="department">DEPARTMENT</label>
                                        <select class="form-control" id="department" name="department">
                                            <option>Department</option>
                                            <?php
                                            $departments = mysqli_query($con, 'SELECT * FROM `departments`');
                                            while ($department = mysqli_fetch_array($departments)) {
                                                echo '<option value="' . $department['department'] . '">' . $department['department'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <!-- Food Item Name -->
                                    <div class="form-group">
                                        <label for="fooditem">NAME:</label>
                                        <input type="text" class="form-control" id="fooditem" name="fooditem" style="width: 150px">
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- Food Category -->
                                    <div class="form-group">
                                        <label for="foodcategory">CATEGORY:</label>
                                        <select class="form-control" id="foodcategory" name="foodcategory">
                                            <option>select</option>                                            
                                        </select>
                                    </div>
                                </div>                              
                                
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="price">PRICE</label>
                                        <input type="number" name="price" id="price">
                                    </div>
                                </div>

                                <div class="col">
                                    <!-- Add Category button -->
                                    <div class="form-group">
                                        <label for="newCategory">ADD NEW CATEGORY:</label>
                                        <button onclick="addCategory(event)" class="btn btn-info">ADD</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr>
                                    <h5>INGREDIENTS</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <!-- Ingredient -->
                                    <div class="form-group">
                                        <label for="ingredient">INGREDIENT:</label>
                                        <select class="form-control" id="ingredient" name="ingredient">
                                            <option>Ingredient</option>
                                            <?php
                                            $alling = mysqli_query($con, "SELECT distinct(product) FROM products ORDER BY product ASC");
                                            while ($ings = mysqli_fetch_array($alling)) {
                                                echo '<option>' . $ings['product'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <!-- Ingredient Units -->
                                    <div class="form-group">
                                        <label for="ingredientunits">UNITS:</label>
                                        <input type="text" class="form-control" id="ingredientunits" name="ingredientunits" placeholder="UNITS">
                                    </div>
                                </div>

                                <div class="col">
                                    <!-- Ingredient Measure -->
                                    <div class="form-group">
                                        <label for="ingredientmeasure">MEASURE:</label>
                                        <select class="form-control" id="ingredientmeasure" name="ingredientmeasure">
                                            <option>Measure</option>
                                            <option value="kg">KGs</option>
                                            <option value="g">Gs</option>
                                            <option value="l">Ltrs</option>
                                            <option value="ml">ML</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col d-flex" style="align-items:center;">
                                    <button class="btn btn-warning" onclick="addIngredient(event)">ADD</button>
                                </div>
                            </div>
                            <div class="row">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Ingredient</th>
                                                <th>Units</th>
                                                <th>Measure</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ingredientsTable">

                                        </tbody>
                                    </table>
                            </div>

                            <div class="modal-footer">
                                <!-- Action Button -->
                                <button class="btn btn-primary" style="margin: 5px" onclick="saveItem(event)">SAVE ITEM</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/foodcosting.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/dashboard1.js"></script>
</body>
</body>

</html>