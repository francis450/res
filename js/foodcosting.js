function saveItem(event) {
    event.preventDefault();

    var department = $('#department').val();
    var fooditem = $('#fooditem').val();
    var foodcategory = $('#foodcategory').val();
    var price = $('#price').val();

    var item = {
        department: department,
        fooditem: fooditem,
        foodcategory: foodcategory,
        price: price
    };


    var table = document.getElementById("ingredientsTable");

    // Initialize an array to store the data
    var data = [];

    // Iterate through rows (skip the header row if applicable)
    for (var i = 0; i < table.rows.length; i++) {
        var row = table.rows[i];
        var rowData = {
            ingredient: row.cells[0].innerHTML,
            units: row.cells[1].innerHTML,
            measure: row.cells[2].innerHTML
        };
        data.push(rowData);
    }

    console.log(data);
    console.log(item);

    $.post('handlers/saveItem.php', { item: item, data: data }, function (response) {
        console.log(response);
    });
}

function addCategory(event) {
    event.preventDefault();
    var department = $('#department').val();
    var category;
    if (department == 'Department') {
        alert('Please Choose A Department To Add Category');
        return;
    } else {
        category = prompt("ADD NEW CATEGORY FOR " + department + "'S MENU ");
    }
    if (category) {
        if (confirm("CONFIRM YOU WANT TO ADD " + category + " TO " + department + "'S MENU ")) {
            $.post('handlers/categories.php', { department: department, category: category, }, function (response) {
                console.log(response);
            });
        }
    } else {
        alert('CATEGORY CANNOT BE EMPTY');
    }
}

function addIngredient(event) {
    event.preventDefault();
    // Get values from the form
    var ingredient = $("#ingredient").val();
    var ingredientUnits = $("#ingredientunits").val();
    var ingredientMeasure = $("#ingredientmeasure").val();

    // Validate the values (you can add more validation as needed)
    if (ingredient === "Ingredient" || ingredientUnits === "" || ingredientMeasure === "Measure") {
        alert("Please fill in all fields.");
        return;
    }

    // Create a new row with the ingredient details
    var newRow = "<tr><td>" + ingredient + "</td><td>" + ingredientUnits + "</td><td>" + ingredientMeasure + "</td><td><button class='btn btn-danger deleteItem'>&#x1F5D1; DELETE</button></td></tr>";

    // Append the new row to a table or another container
    // Example: Assuming you have a table with id "ingredientsTable"
    $("#ingredientsTable").append(newRow);

    // Clear the form fields
    $("#ingredient").val("Ingredient");
    $("#ingredientunits").val("");
    $("#ingredientmeasure").val("Measure");
}

function openeditmodal(code, name) {
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
    $.post('getingredients.php', {
        foodcoding: foodcoding
    }, function (data) {
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

function getEditData() {
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
    for (let i = 2; i < cardDataArray.length; i++) {
        retArray.push(cardDataArray[i]);
    }
    $.post('getingredients.php', {
        editedData: JSON.stringify(retArray),
    }, function (data) {
        console.log(data);
    });
}

function changeCategories() {
    var department = $('#department').val();
    $.get('handlers/categories.php', { department: department }, function (data) {
        $('#foodcategory').html('');
        $('#foodcategory').html(data);
    });
}

$(document).ready(function () {
    $('.deleteItem').click(function (event) {
        event.preventDefault();

    })
    $('.card-header').click();

    $('#department').change(function () {
        changeCategories();
    });

    $('#fooditemSelect').change(function () {
        let foodfor = $(this).val();
        $.post('adding.php', {
            foodfor: foodfor
        }, function (data) {
            var response = JSON.parse(data);
            $('#foodcode').val(response.foodcode);
            $('#foodcategory').val(response.category);
            $('#fooditemInput').val(foodfor);
            console.log("foodcode: ", response.foodcode);
            console.log("category: ", response.category)
        })
    });

    $('.sendingr').click(function () {
        event.preventDefault();
        var department = $('#department').val();
        var thiscoded = $('#foodcode').val();
        var food = $('#fooditem').val();
        var thisingredient = $('#ingredient').val();
        var thisunit = $('#ingredientunits').val();
        var measure = $('#ingredientmeasure').val();
        var category = $('#foodcategory').val();

        $.post("register.php", {
            department: department,
            thiscoded: thiscoded,
            food: food,
            thisingredient: thisingredient,
            thisunit: thisunit,
            measure: measure,
            category: category
        }, function (data) {
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
function format(d, p) {
    var tableHTML = '<table id="moredetails" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    tableHTML += "<thead><th><h5>Ingredients</h5></th><th>Cost(Kshs.)</th><th>Action</th></thead>"
    for (let i = 0; i < d.length; i++) {
        tableHTML +=
            '<tr>' +
            '<td>' + d[i] + '</td>' + '<td>' + p[i] + '</td>' + '<td>' + '&#x1F5D1;' + '</td>';
        '</tr>';
    }

    tableHTML += '</table>';
    return tableHTML;
}

$(document).ready(function () {
    var table = $('#example').DataTable({
        ajax: 'objects.php',
        columns: [{
            className: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: '',
        },
        {
            data: '0'
        },
        {
            data: '1'
        },
        {
            data: '2'
        },
        {
            data: '3'
        },
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
        order: [
            [1, 'asc']
        ],
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
            $.post('adding.php', {
                secondTdData: secondTdData
            }, function (data) {
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

    $('#example tbody').on('click', '.edit', function () {
        var $row = $(this).closest('tr');
        var $secondColumn = $row.find('td:eq(1)');
        var second = $row.find('td:eq(2)').text();
        var secondColumnData = $secondColumn.text();
        var textContent = $row.find('.sorting_1').text();
        openeditmodal(textContent, second);
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
            $.post('adding.php', {
                codetodelete: codetodelete.text()
            }, function (data) {
                if (data) {

                }
            });
        } else {
            console.log("Not Removed");
        }
    });

});