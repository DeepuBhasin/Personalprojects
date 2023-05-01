document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        var usernameField = document.querySelector('#username');
        var passwordField = document.querySelector('#password');

        if (usernameField.value === '') {
            alert('Please enter a username.');
            event.preventDefault();
        }

        if (passwordField.value === '') {
            alert('Please enter a password.');
            event.preventDefault();
        }
    });
});