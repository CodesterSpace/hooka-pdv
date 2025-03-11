$(document).ready(function() {
    $('#updateForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Create a FormData object from the form element
        var formData = new FormData(this);

        $.ajax({
            url: 'editprocess.php', // Replace with your PHP script URL
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Assuming the response is in JSON format
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.success) {
                    $('#response').html('<div class="alert alert-success">' + jsonResponse.success + '</div>');
                    setTimeout(function() {
                            window.location.reload();
                        }, 2000); // Reload after 2 seconds
                } else {
                    $('#response').html('<div class="alert alert-danger">' + jsonResponse.error + '</div>');
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000); // Reload after 2 seconds
                }
            },
            error: function(xhr, status, error) {
                // Handle errors here
                $('#response').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
            }
        });
    });
});