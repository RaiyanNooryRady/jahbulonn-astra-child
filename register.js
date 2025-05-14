jQuery(document).ready(function ($) {
    $('#registration-form').on('submit', function (e) {
        e.preventDefault();  // Prevent form submission
        var form = $(this);  // Get the form element
        var data = new FormData(this);  // Create a FormData object to handle file uploads

        data.append('action', 'handle_register_form');  // Append the action for the AJAX handler
        data.append('nonce', reg_ajax.nonce);  // Append nonce for security

        // AJAX request
        $.ajax({
            url: reg_ajax.ajax_url,
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    $('#register-message').html('<p style="color:green;">' + response.data + '</p>');
                    form[0].reset();  // Reset the form fields
                } else {
                    $('#register-message').html('<p style="color:red;">' + response.data + '</p>');
                }
            },
            error: function () {
                $('#register-message').html('<p style="color:red;">An error occurred, please try again.</p>');
            }
        });
    });
});

