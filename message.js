$(document).ready(function() {
    // AJAX request to load received messages on page load
    $.ajax({
        type: 'GET',
        url: 'Amdmin/Messages.php',
        success: function(response) {
            $('#messageTable').html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred while loading received messages.');
        }
    });

    // AJAX request to send message
    $('#messageForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        var formData = $(this).serialize(); // Serialize form data
        $.ajax({
            type: 'POST',
            url: 'Amdmin/Messages.php',
            data: formData,
            success: function(response) {
                // Clear the form fields if needed
                $('#messageForm')[0].reset();
                // Show success modal
                $('#successModal').modal('show');
                // Load received messages after submitting the form
                $.ajax({
                    type: 'GET',
                    url: 'Amdmin/Messages.php',
                    success: function(response) {
                        $('#messageTable').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert(
                            'An error occurred while loading received messages.');
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while sending the message.');
            }
        });
    });
});