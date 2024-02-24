
$(document).ready(function () {
    // Initialize DataTable
    $('#example').DataTable();

    // Edit Button Click Event
    $('.edit-btn').click(function () {
        var userId = $(this).data('user-id');
        // Fetch user details via AJAX and populate the edit modal
        $.ajax({
            async: true,
            url: 'editdata.php',
            type: 'POST',
            data: {
                id: userId
            },
            success: function (response) {
                $('#editModal .modal-body').html(response);
            },
            error: function () {
                alert('Error occurred while fetching user details.');
            }
        });
    });

    // Event listener for form submission
    $('form').submit(function (event) {

        // Serialize form data
        var formData = $(this).serialize();

        // Submit form data via AJAX
        $.ajax({
            async: true,
            type: 'POST',
            url: 'adminCrud.php',
            data: formData,
            success: function (response) {
                // Reload the content of Manage User page
                loadManageUserPage();
                $('#exampleModal').modal('hide');
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });

    // Function to load Manage User page
    function loadManageUserPage() {
        $.ajax({
            async: true,
            url: 'manageUser.php',
            success: function (response) {
                $("#page-content").html(response);
            },
            error: function (xhr, status, error) {
                console.error("Error loading Manage User page:", error);
            }
        });
    }
});