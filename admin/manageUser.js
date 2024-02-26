$(document).ready(function () {
    // Initialize DataTable
    $('#example').DataTable();

    // Event delegation for the "Edit" button click
    $(document).on('click', '.edit-btn', function () {
        // Retrieve the user ID from the clicked button's data attribute
        var userId = $(this).data('user-id');

        if (userId) {
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
        } else {
            console.error('Error: User ID not provided.');
        }
    });

    
    $('.delete-btn').on('click', function() {
        var idToDelete = $(this).data('id');
    
        if (idToDelete) {
            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, proceed with deletion
                    $.ajax({
                        type: 'POST',
                        url: 'delete.php',
                        data: { id: idToDelete },
                        success: function(response) {
                            console.log('Data deleted successfully');
                            Swal.fire('Deleted!', 'Your data has been deleted.', 'success').then(() => {
                                // Reload the page after deletion
                                location.reload();
                            });
                        },
                        error: function(error) {
                            // Handle the error (if needed)
                            console.error('Error deleting data:', error);
                            Swal.fire('Error!', 'Could not delete data.', 'error');
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // User canceled, do nothing
                    Swal.fire('Cancelled', 'Your data is safe :)', 'info');
                }
            });
        } else {
            console.error('Data ID not set!');
        }
    });
   
    });


  

      
    $(document).on('click', '#saveChangesBtn', function () {
        // Reference to the form
        var form = $('form');  // Assuming your form selector is 'form'
    
        // Create a custom data object
        var customData = {
            user_id: $('#inputID4').val(),  // Replace with the actual ID input field
            email: $('#inputEmail4').val(),
            password: $('#inputPassword4').val(),
            type: $('#inputType').val(),
            department: $('#inputDepartment').val()
            // Add other fields as needed
        };
    
        // Submit form data via AJAX
        $.ajax({
            async: true,
            type: 'POST',
            url: 'adminInsert.php',
            data: customData,  // Send the custom data object
            success: function (response) {
                // Show SweetAlert based on the response
                if (response.status === 'success') {
                
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success'
                    }).then((result) => {
                        // Reload the entire page after a delay
                        window.location.href('http://localhost/evaluationSystem/admin/manageUser.php');
                    });
                } else {
                    // If the response indicates an error
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error'
                    });
                    console.error('Error in form submission:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
    