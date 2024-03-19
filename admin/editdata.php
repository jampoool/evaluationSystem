<?php
// Include your database connection file
include "../connect.php";

// Check if user ID is provided via POST
if(isset($_POST['id'])) {
    // Sanitize user ID
    $userId = mysqli_real_escape_string($con, $_POST['id']);
    
    // Fetch user data from the database based on user ID
    $query = "SELECT * FROM user WHERE `user-id` = '$userId'";
    $result = mysqli_query($con, $query);

    // Check if query was successful
    if($result) {
        // Check if user exists
        if(mysqli_num_rows($result) > 0) {
            // Fetch user details
            $userData = mysqli_fetch_assoc($result);
            ?>
            <!-- HTML form to display user data in the edit modal -->
            <form id="editForm">
                    <div class="col-12">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="email" required value="<?php echo $userData['email']; ?>">
                        <div class="invalid-feedback">Please provide a Email.</div>
                    </div>
                    <div class="col-12">
                        <label for="inputFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="inputFirstName" name="editFirstName" required value="<?php echo $userData['firstname']; ?>">
                        <div class="invalid-feedback">Please provide a First Name.</div>
                    </div>
                    <div class="col-12">
                        <label for="inputLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="inputLastName" name="editLastName" required value="<?php echo $userData['lastname']; ?>">
                        <div class="invalid-feedback">Please provide a Last Name.</div>
                    </div>
                    <div class="col-12">
                        <label for="inputType" class="form-label">Type</label>
                        <select class="form-select" id="inputType" name="editType" required>
                            <option value="admin" <?php echo $userData['type'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                            <option value="guidance" <?php echo $userData['type'] == 'guidance' ? 'selected' : ''; ?>>Guidance</option>
                            <option value="student" <?php echo $userData['type'] == 'student' ? 'selected' : ''; ?>>Student</option>
                            <option value="teacher" <?php echo $userData['type'] == 'teacher' ? 'selected' : ''; ?>>Teacher</option>
                        </select>
                        <div class="invalid-feedback">Please provide a Type of the User.</div>
                    </div>
                    <div class="col-12">
                        <label for="inputDepartment" class="form-label">Department</label>
                        <select class="form-select" id="inputDepartment" name="editDepartment" required>
                            <option value="1" <?php echo $userData['department'] == '1' ? 'selected' : ''; ?>>Basic Education Department</option>
                            <option value="2" <?php echo $userData['department'] == '2' ? 'selected' : ''; ?>>Higher Education Department</option>
                        </select>
                        <div class="invalid-feedback">Please provide a Department of the User.</div>
                    </div>
                    <!-- Hidden input field to store user ID -->
                    <input type="hidden" name="user_id" value="<?php echo $userData['user-id']; ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitEditBtn">Submit</button>
                    </div>
            </form>
            <?php
        } else {
            echo "User not found";
        }
    } else {
        echo "Error fetching user data: " . mysqli_error($con);
    }
} else {
    echo "User ID not provided";
}
?>
