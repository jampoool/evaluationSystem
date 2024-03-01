document.addEventListener('DOMContentLoaded', function () {
    // Get all buttons with class 'enable-btn'
    var enableButtons = document.querySelectorAll('.enable-btn');

    // Loop through each button
    enableButtons.forEach(function(button) {
        // Add click event listener to each button
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-enable-id');
            var isActive = this.getAttribute('data-is-active');
            var action = isActive == 1 ? 'disable' : 'enable';

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
                            // Update button text and attributes
                            if (isActive == 1) {
                                button.innerText = 'Disabled';
                                button.classList.remove('btn-success');
                                button.classList.add('btn-secondary');
                                button.setAttribute('data-is-active', 0);
                            } else {
                                button.innerText = 'Enabled';
                                button.classList.remove('btn-secondary');
                                button.classList.add('btn-success');
                                button.setAttribute('data-is-active', 1);
                            }
                            // Show success message
                            Swal.fire('Success', 'Item ' + action + 'd successfully!', 'success');
                        }
                    };
                    xhr.open("POST", "update_status.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.send("id=" + id + "&is_active=" + (isActive == 1 ? 0 : 1));
                }
            });
        });
    });
});
