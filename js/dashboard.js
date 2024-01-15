$(document).ready(function () {
  
  // Handle click event on the button
  $('#optionsButton').click(function () {
    // Toggle the visibility of the optionsDiv
    $('#optionsDiv').toggle();
  });

  $('#timeout').DataTable({
    columns: [
      { title: 'OrderId' },
      { title: 'Description' },
      { title: 'Total' },
      { title: 'Server' },
      { title: 'Date' }
    ]
  });
  // Handle click event on the document to hide the optionsDiv when clicking outside
  $(document).click(function (event) {
    if (!$(event.target).closest('#optionsButton').length && !$(event.target).is('#optionsButton')) {
      // Hide the optionsDiv if the click is outside the button
      $('#optionsDiv').hide();
    }
  });
});

function submitDepartment() {
  var department = $('#department').val();
  // remove trailing and extra spaces and convert to uppercase
  department = department.trim().toUpperCase();
  // check if the department is valid
  if (department == "") {
    alert("Please enter a valid department name");
    return;
  }
  // send the department to the server endpoint
  $.ajax({
    url: 'handlers/department.php',
    type: 'POST',
    data: {
      department: department
    },
    success: function (response) {
      if (response == "success") {
        // hide the department modal
        $('#addDepartmentModal').modal('hide');
        // DISPLAY SUCCESS MODAL
        $('.sucesssMessage').text('DEPARTMENT ADDED SUCCESSFULLY');
        $('#success_tic').modal('show');

      } else {
        alert(response);
      }
    }
  });
}

function submitTable() {
  var department = $('#tableDepartment').val();
  var table = $('#table').val();
  // remove trailing and extra spaces and convert to uppercase
  table = table.trim().toUpperCase();

  // check if the table is valid
  if (table == "") {
    alert("Please enter a valid table name");
    return;
  }
  // send the table to the server endpoint
  $.ajax({
    url: 'handlers/table.php',
    type: 'POST',
    data: {
      table: table,
      department: department
    },
    success: function (response) {
      if (response == "success") {
        // hide the table modal
        $('#addTableModal').modal('hide');
        // DISPLAY SUCCESS MODAL
        $('.sucesssMessage').text('TABLE ADDED SUCCESSFULLY');
        $('#success_tic').modal('show');
      } else {
        alert(response);
      }
    }
  });
}