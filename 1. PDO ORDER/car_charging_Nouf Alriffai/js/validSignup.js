// Wait for the page to finish loading
document.addEventListener('DOMContentLoaded', function() {
    // Get the form element
    var form = document.querySelector('form');

    // Add a submit event listener to the form
    form.addEventListener('submit', function(event) {
        // Get the input fields
        var fullnameField = document.querySelector('input[name="fullname"]');
        var usernameField = document.querySelector('input[name="username"]');
        var passwordField = document.querySelector('input[name="password"]');
        var userTypeField = document.querySelector('select[name="user_type"]');

        // Check if the fullname field is empty
        if (fullnameField.value === '') {
            alert('Please enter your full name.');
            event.preventDefault();
        }

        // Check if the username field is empty
        if (usernameField.value === '') {
            alert('Please enter your username/email.');
            event.preventDefault();
        }

        // Check if the password field is empty
        if (passwordField.value === '') {
            alert('Please enter your password.');
            event.preventDefault();
        }

        // Check if the user type is selected
        if (userTypeField.selectedIndex === 0) {
            alert('Please select a user type.');
            event.preventDefault();
        }
    });
});
