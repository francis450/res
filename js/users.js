function initializeDataTable(dataURL) {
    $('#users').DataTable({
        ajax: dataURL,
        columns: [
            { data: '0' },
            { data: '1' },
            { data: '2' },
            { data: '3' },
            { data: '4' },
            {
                data: null,
                render: function (data, type, row) {
                    return '<button type="button" class="btn btn-primary btn-sm edit-user-btn" data-userid="' + row[5] + '"><i class="fas fa-edit"></i>Edit</button>';
                }
            }
        ],
    });

}

$(document).ready(function () {
    initializeDataTable('handlers/get_users.php');

    // handle changes on user details
    $('#editUserForm').on('submit', function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);
        $.ajax({
            url: 'handlers/edit_user.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response) {
                    $('#editModal').modal('hide');
                    $('#users').DataTable().ajax.reload();
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('#users ').on('click', '.edit-user-btn', function () {
        var userId = $(this).data('userid');

        $.ajax({
            url: 'handlers/get_users.php',
            type: 'GET',
            data: { id: userId },
            success: function (response) {
                var userData = JSON.parse(response);
                console.log(userData)
                $('#userId').val(userData[0]);
                $('#rights').val(userData[1]);

                var status = userData[2] == '1' ? true : false;
                $('#flexSwitchCheckDefault').prop('checked', status);
                $('#phone').val(userData[4]);
                $('#email').val(userData[3]);
                $('#openEditModal').click();
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

function editme() {
    // $('#userId').val(this.text);
    var userId = $(this).data('userid');
    console.log(userId);
    $('#openEditModal').click();
}