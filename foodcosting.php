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
  <!--<script src='jquery-3.3.1.min.js'></script>-->
  <!--<link rel="stylesheet" href="bs/bootstrap.min.css">-->
  <!--<script src="bs/bootstrap.min.js"></script>-->
  
  
        <!-- jQuery (required for Bootstrap JavaScript) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Bootstrap JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>

  <script src="DataTables/media/js/jquery.dataTables.min.js"></script>    
  <link rel="stylesheet" href="DataTables/media/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>Food Costing</title>
</head>
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
        font-family: "Courier New",Courier,monospace;
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
              <div class="card">
                  <div class="card-header" data-toggle="collapse" data-target="#collapse11">
                      <h4>FOOD COSTING</h4>
                  </div>
                  <div id="collapse11" class="collapse">
                    <div class="card-body">
                      <table class="table table-stripe" id='costingForm'>
                          <thead>
                              <tr>
                                  <th>FOOD<br>ITEM NAME</th>
                                  <th>FOOD CODE</th>
                                  <th>FOOD ITEM<br>CATEGORY</th>
                                  <th>INGREDIENT</th>
                                  <th>UNITS</th>
                                  <th>MEASURE</th>
                                  <th>ACTION</th>
                              </tr>
                          </thead>
                          <thead>
                              <tr>
                                  <!--Item-->
                                  <td>
                                      <input type="text" id="fooditemInput" style="width:150px">
                                      <select name="fooditem" id="fooditemSelect">
                                          <option>Item</option>
                                          <?php
                                            $allitems = mysqli_query($con, "SELECT distinct(food) FROM menu ORDER BY food ASC");
                                            while($item = mysqli_fetch_array($allitems)){
                                                echo '<option>'.$item['food'].'</option>';
                                            }
                                           ?>
                                      </select>
                                      
                                  </td>
                                  <!--FOOD CODE-->
                                  <td>
                                      <input type="number" style="width:100px" id="foodcode">
                                  </td>
                                  
                                  <!--Category-->
                                  <td>
                                      <select name="foodcategory" id="foodcategory">
                                          <option>select</option>
                                          <option value="SNACKS">SNACKS</option>
                                          <option value="BEVERAGES">BEVERAGES</option>
                                          <option value="MAIN-DISH">MAIN-DISH</option>
                                          <option value="SIDE-DISH">SIDE-DISH</option>
                                      </select>
                                  </td>
                                  <!--Ingredient-->
                                  <td>
                                      <select name="ingredient" id="ingredient">
                                          <option>Ingredient</option> 
                                          <?php
                                            $alling = mysqli_query($con, "SELECT distinct(product) FROM products ORDER BY product ASC");
                                            while($ings = mysqli_fetch_array($alling)){
                                                echo '<option>'.$ings['product'].'</option>';
                                            }
                                          ?>
                                      </select>
                                  </td>
                                  <!--Units-->
                                  <td>
                                      <input name="ingredientunits" id="ingredientunits" placeholder="UNITS">
                                  </td>
                                  <!--Measure-->
                                  <td>
                                      <select name="ingredientmeasure" id="ingredientmeasure">
                                          <option>Measure</option>
                                          <option value="kg">KGs</option>
                                          <option value="g">Gs</option>
                                          <option value="l">Ltrs</option>
                                          <option value="ml">ML</option>
                                      </select>
                                  </td>
                                  <!--Action-->
                                  <td>
                                      <button class="btn-xs btn-warning btn-outline sendingr" style="border: none;margin: 5px">ADD</button>
                                  </td>
                              </tr>
                          </thead>
                      </table>
                      <script>
                      $(document).ready(function(){
                          $('#fooditemSelect').change(function(){
                             let foodfor = $(this).val();
                             $.post('adding.php',{foodfor:foodfor},function(data){
                                 var response = JSON.parse(data);
                                 $('#foodcode').val(response.foodcode);
                                 $('#foodcategory').val(response.category);
                                 $('#fooditemInput').val(foodfor);
                                 console.log("foodcode: ",response.foodcode);
                                 console.log("category: ", response.category)
                             })
                          });
                          $('.sendingr').click(function(){
                             var thiscoded = $('#foodcode').val();
                             
                             var food = $('#fooditemInput').val();
                             var thisingredient = $('#ingredient').val();
                             var thisunit = $('#ingredientunits').val();
                             var measure = $('#ingredientmeasure').val();
                             var category = $('#foodcategory').val();
                             
                             console.log('thiscoded',thiscoded,'food',food,'thisingredient',thisingredient,'thisunit',thisunit,'measure',measure,'category',category);
                             $.post("register.php",{thiscoded:thiscoded, food:food, thisingredient:thisingredient, thisunit:thisunit, measure:measure, category:category},function(data){
                                 console.log(data);
                                 alert(data);
                                 $('#foodcode').val();
                                 $('#fooditemInput').val();
                                 $('#ingredient').val();
                                 $('#ingredientunits').val();
                                 $('#ingredientmeasure').val();
                                 $('#foodcategory').val();
                             })
                             
                          });
                      });
                      </script>
                  </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row m-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header" data-toggle="collapse" data-target="#collapse12">
                      <h4>FOOD ITEMS</h4>
                  </div>
                  
                  <div class="card-body collapse"  id="collapse12">
                      <div class="table-responsive">
                                <script>
                                    /* Formatting function for row details - modify as you need */
                                            function format(d,p) {
                                                var tableHTML = '<table id="moredetails" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                                                
                                                tableHTML += "<thead><th><h5>Ingredients</h5></th><th>Cost(Kshs.)</th><th>Action</th></thead>"
                                                for (let i = 0; i < d.length; i++) {
                                                    tableHTML +=
                                                        '<tr>' +
                                                        '<td>' + d[i]+'</td>'+'<td>'+p[i]+'</td>'+'<td>'+'&#x1F5D1;'+'</td>';
                                                        '</tr>';
                                                }
                                            
                                                tableHTML += '</table>';
                                                return tableHTML;
                                            }

                                             
                                            $(document).ready(function () {
                                                var table = $('#example').DataTable({
                                                    ajax: 'objects.php',
                                                    columns: [
                                                        {
                                                            className: 'dt-control',
                                                            orderable: false,
                                                            data: null,
                                                            defaultContent: '',
                                                        },
                                                        { data: '0' },
                                                        { data: '1' },
                                                        { data: '2' },
                                                        { data: '3' },
                                                        { 
                                                            data: '4',
                                                            className: 'edit',
                                                            orderable: false,
                                                            defaultContent: '',
                                                        },
                                                        {
                                                            data: '5',
                                                            className: 'delete',
                                                            orderable: false,
                                                            defaultContent: '',
                                                        },
                                                    ],
                                                    order: [[1, 'asc']],
                                                });
                                                
                                                
                                                var ingredients;
                                                var ing = [];
                                                var p = [];
                                                
                                                $('#costingForm').DataTable({
                                                    "searching": false,
                                                    "lengthChange": false,
                                                    "paging": false,
                                                    "info": false,
                                                });
                                                $('#example tbody').on('click', 'td.dt-control', function () {
                                                    var tr = $(this).closest('tr');
                                                    var row = table.row(tr);
                                                    var secondTdData = tr.find('td:eq(1)').text();
                                                    console.log(secondTdData)
                                                
                                                    if (row.child.isShown()) {
                                                        row.child.hide();
                                                        tr.removeClass('shown');
                                                    } else {
                                                        $.post('adding.php', { secondTdData: secondTdData }, function (data) {
                                                            ingredients = JSON.parse(data);
                                                            for (let i = 0; i < ingredients.length; i++) {
                                                                let temp = '';
                                                                temp = ingredients[i][1] + ingredients[i][2] + ' of ' + ingredients[i][0];
                                                                p[i] = ingredients[i][3];
                                                                ing[i] = temp;
                                                            }
                                                            console.log('ing:', ing);
                                                
                                                            // Now that ing and p are populated, display the child row
                                                            row.child(format(ing, p)).show();
                                                
                                                            // Clear the arrays for the next iteration
                                                            ingredients = [];
                                                            ing = [];
                                                            p = [];
                                                            tr.addClass('shown');
                                                            
                                                        });
                                                    }
                                                });
                                                $('#example tbody').on('click','.edit', function(){
                                                    var $row = $(this).closest('tr');
                                                    var $secondColumn = $row.find('td:eq(1)'); 
                                                    var second = $row.find('td:eq(2)').text(); 
                                                    var secondColumnData = $secondColumn.text();
                                                    var textContent = $row.find('.sorting_1').text();
                                                    openeditmodal(textContent,second);
                                                })
                                                $('#example tbody').on('click', '.delete', function () {
                                                    var $row = $(this).closest('tr');
                                                    var $secondColumn = $row.find('td:eq(2)');
                                                    var codetodelete = $row.find('td:eq(1)');
                                                    var secondColumnData = $secondColumn.text();
                                                    var textContent = $row.find('.sorting_1').text();
                                                    var del = confirm("Do You Really Want to Delete " + secondColumnData);
                                                
                                                    if (del) {
                                                        $row.remove();
                                                        $.post('adding.php', { codetodelete: codetodelete.text() }, function (data) {
                                                            if (data) {
                                                                
                                                            }
                                                        });
                                                    } else {
                                                        console.log("Not Removed");
                                                    }
                                                });

                                            });
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

  <script>
    function openeditmodal(code,name) {
        var foodcoding = code;
        var foodform;
        
        var modalHTML = `
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editing ${name}'s Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="foodForm">
                    
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="getEditData()">Save changes</button>
              </div>
            </div>
          </div>
        </div>`;
        $.post('getingredients.php', { foodcoding: foodcoding }, function(data) {
            var dataa = JSON.parse(data);
            mezaform(dataa);
        });
        document.querySelector('.modo').innerHTML = modalHTML;
        var fungua = document.querySelector('.fungua');
        fungua.click();
    }
    
    function mezaform(jsonData) {
    var form = document.getElementById('foodForm');

    // Loop through the JSON data and create form fields
    for (var i = 0; i < jsonData.length; i++) {
        var item = jsonData[i];

        // Create a Bootstrap card div
        var card = document.createElement('div');
        card.className = 'card mb-3';

        // Create a card header with the name of the ingredient or food name
        var cardHeader = document.createElement('div');
        var cardHeaderText = document.createElement('h5');
        cardHeader.className = 'card-header';
        if (item.food) {
            cardHeaderText.innerHTML = item.food;
        } else {
            cardHeaderText.innerHTML = item.ingredient;
        }
        cardHeader.setAttribute('data-toggle', 'collapse');
        cardHeader.setAttribute('data-target', '#collapse' + i);
        cardHeader.append(cardHeaderText);

        // Create a card body div with unique ID
        var cardBody = document.createElement('div');
        cardBody.id = 'collapse' + i;
        cardBody.className = 'collapse';
        cardBody.className += i === 0 ? ' show' : ''; // Show the first card by default

        for (var key in item) {
            // Create a Bootstrap form group div
            var formGroup = document.createElement('div');
            formGroup.className = 'form-group m-3';
            // Create a label element for the property
            var label = document.createElement('label');
            label.textContent = key + ': ';
            label.className = 'col-form-label';

            // Create a Bootstrap input group div
            var inputGroup = document.createElement('div');
            inputGroup.className = 'input-group col-sm-10';

            // Create an input element to display the value
            var input = document.createElement('input');
            input.type = 'text';
            input.value = item[key];
            input.className = 'form-control';

            // Set the name attribute for the input element
            input.name = key.toLowerCase();

            // Add the label and input to the input group
            inputGroup.appendChild(input);

            // Add the label and input group to the form group
            formGroup.appendChild(label);
            formGroup.appendChild(inputGroup);

            // Add the form group to the card body
            cardBody.appendChild(formGroup);
        }

        // Add the card header, card body, and card to the form
        card.appendChild(cardHeader);
        card.appendChild(cardBody);
        form.appendChild(card);
    }
}

    function getEditData(){
        var cardDataArray = [];

        $(".card").each(function () {
            var cardData = {}; 

            $(this).find("input[type='text']").each(function () {
                var inputName = $(this).attr("name"); 
                var inputValue = $(this).val(); 
                cardData[inputName] = inputValue; 
            });

            cardDataArray.push(cardData);
        });
        var retArray = [];
        for(let i = 2; i < cardDataArray.length; i++){
            retArray.push(cardDataArray[i]);
        }
        $.post('getingredients.php',{editedData : JSON.stringify(retArray),},function(data){
            console.log(data);
        });
    }
  </script>
</body>
</html>