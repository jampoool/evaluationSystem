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
             // Remove existing invalid feedback
        $('#editForm input[required]').removeClass('is-invalid');

        // Check if any required field is empty
        if ($('#editForm input[required]').filter(function(){ return !$(this).val(); }).length > 0) {
            // Add is-invalid class to empty fields to outline them in red
            $('#editForm input[required]').filter(function(){ return !$(this).val(); }).addClass('is-invalid');

            // Display error message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all required fields.',
            });
            return; // Exit function if any required field is empty
        }

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
            event.preventDefault(); // Prevent default form submission
            $('#userForm input[required], #userForm select[required]').removeClass('is-invalid');
        
            // Get field values
            var user_id = $('#inputID4').val();
            var email = $('#inputEmail4').val();
            var password = $('#inputPassword4').val();
            var type = $('#inputType').val();
            var department = $('#inputDepartment').val();
            var firstname = $('#inputFirstName').val();
            var lastname = $('#inputLastName').val();
            
            // Check if any required field is empty
            if (!user_id || !email || !password || !type || !department || !firstname || !lastname) {
                // Add is-invalid class to empty fields to outline them in red
                $('#userForm input[required], #userForm select[required]').filter(function(){ return !$(this).val(); }).addClass('is-invalid');
        
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all required fields.',
                });
                return; // Exit function if any required field is empty
            }
        
            // Perform AJAX request to check if user ID and email exist
            $.ajax({
                type: 'POST',
                url: 'adminInsert.php',
                data: {
                    user_id: user_id,
                    email: email,
                    password: password,
                    type: type,
                    department: department,
                    firstname : firstname,
                    lastname : lastname,
                    save_changes: 1
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'error') {
                        // Show error message if user ID or email already exists
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: response.message,
                        });
                    } else {
                        // No existing user ID or email, proceed with saving the user data
                        // Display success message using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'User data saved successfully.',
                            showConfirmButton: false,
                            timer: 1500 // Hide after 1.5 seconds
                        }).then(function() {
                            // Hide modal after showing the SweetAlert
                            $('#staticBackdrop').modal('hide');
                            $('.modal-backdrop').remove();
                            location.reload(); // Reload the page
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while saving the user. Please try again.');
                }
            });
        });
    
    
    });

 
    