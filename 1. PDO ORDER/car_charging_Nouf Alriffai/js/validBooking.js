// Get the form element
const form = document.querySelector('form');

// Get the input fields
const startDate = document.getElementById('start_date');
const endDate = document.getElementById('end_date');

// Add an event listener to the form submit button
form.addEventListener('submit', function(event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Validate the start date
    if (startDate.value == '') {
        alert('Please enter a start date.');
        return;
    }

    // Validate the end date
    if (endDate.value == '') {
        alert('Please enter an end date.');
        return;
    }

    // Submit the form if all input is valid
    form.submit();
});