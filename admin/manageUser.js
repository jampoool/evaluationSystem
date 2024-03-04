$(document).ready(function () {
    // Initialize DataTable
    $('#example').DataTable();

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
                    $('#editModal').modal('show');
                },
                error: function () {
                    alert('Error occurred while fetching user details.');
                }
            });
        } else {
            console.error('Error: User ID not provided.');
        }
    });
    
    // Event listener for the submit button inside the edit modal
    $(document).on('click', '#submitEditBtn', function () {
        // Serialize form data
        var formData = $('#editForm').serialize();
    
        // Submit form data via AJAX
        $.ajax({
            type: 'POST',
            url: 'update.php',
            data: formData,
            dataType: 'json',
            success: function (response) {
                // Check the status returned from the server
                if (response && response.status === 'success') {
                    // Show success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500 // Hide after 1.5 seconds
                    }).then(function() {
                        // Hide the modal
                        $('#editModal').modal('hide');
                        $('.modal-backdrop').remove();
                        // Reload the page
                        location.reload();
                    });
                } else {
                    // Show error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response && response.message ? response.message : 'Unknown error occurred'
                    });
                }
            },
            error: function () {
                // Show error message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while updating user. Please try again later.'
                });
            }
        });
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
    $('#saveChangesBtn').click(function(event) {
        console.log("Button clicked");
        event.preventDefault(); // Prevent default form submission
        
        var user_id = $('#inputID4').val();
        var email = $('#inputEmail4').val();
        var password = $('#inputPassword4').val();
        var type = $('#inputType').val();
        var department = $('#inputDepartment').val();
        
        $.ajax({
            type: 'POST',
            url: 'adminInsert.php',
            data: {
                user_id: user_id,
                email: email,
                password: password,
                type: type,
                department: department,
                save_changes: 1
            },
            dataType: 'json',
            success: function(response) {
                // Display SweetAlert confirmation
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500 // Hide after 1.5 seconds
                }).then(function() {
                    // Hide modal after showing the SweetAlert
                    $('#staticBackdrop').modal('hide');
                    $('.modal-backdrop').remove();
                    location.reload(); // Reload the page
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while saving the user. Please try again.');
                }
            });
        });
    });

 
    