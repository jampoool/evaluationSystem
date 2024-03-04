document.addEventListener('DOMContentLoaded', function () {
    // Get all toggle switches with class 'enable-toggle'
    var enableToggles = document.querySelectorAll('.enable-toggle');

    // Loop through each toggle switch
    enableToggles.forEach(function(toggle) {
        // Add change event listener to each toggle switch
        toggle.addEventListener('change', function() {
            var id = this.getAttribute('data-enable-id');
            var isActive = this.checked ? 1 : 0;
            var action = this.checked ? 'enable' : 'disable';

            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to ' + action + ' this item?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                // If user confirms
                if (result.isConfirmed) {
                    // Make AJAX call to update database
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            // Show success message
                            Swal.fire('Success', 'Item ' + action + 'd successfully!', 'success');
                        }
                    };
                    xhr.open("POST", "update_status.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.send("id=" + id + "&is_active=" + isActive);
                } else {
                    // Reset toggle switch state if user cancels
                    toggle.checked = !toggle.checked;
                }
            });
        });
    });
});
