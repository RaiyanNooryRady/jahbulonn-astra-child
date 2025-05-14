jQuery(document).ready(function ($) {
    $('#registration-form').on('submit', function (e) {
        e.preventDefault();  // Prevent form submission
        var form = $(this);  // Get the form element
        var data = new FormData(this);  // Create a FormData object to handle file uploads

        data.append('action', 'handle_register_form');  // Append the action for the AJAX handler
        data.append('nonce', reg_ajax.register_nonce);  // Append nonce for security

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

    $('#login-form').on('submit', function (e) {
        e.preventDefault();  // Prevent form submission
        var form = $(this);  // Get the form element
        var data = {
            action: 'handle_login_form',
            nonce: reg_ajax.login_nonce,
            username: form.find('#login-username').val(),
            password: form.find('#login-password').val(),
        };
        //console.log(data);
       // alert(data);
        $.ajax({
            url: reg_ajax.ajax_url,
            type: 'POST',
            data: data,
            success: function (response) {
                if (response.success) {
                    $('#login-message').html('<span style="color:green;">' + response.data + '</span>');
                    // setTimeout(function() {
                    //     window.location.href = '/user-dashboard/';
                    // }, 1000);
                } else {
                    $('#login-message').html('<span style="color:red;">' + response.data + '</span>');
                }
            },
            error: function () {
                $('#login-message').html('<span style="color:red;">An error occurred, please try again.</span>');
            }
        });
    });
    
});


