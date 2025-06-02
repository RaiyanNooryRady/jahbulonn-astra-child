jQuery(document).ready(function ($) {
  $("#registration-form").on("submit", function (e) {
    e.preventDefault(); // Prevent form submission
    var form = $(this); // Get the form element
    var data = new FormData(this); // Create a FormData object to handle file uploads

    data.append("action", "handle_register_form"); // Append the action for the AJAX handler
    data.append("nonce", reg_ajax.register_nonce); // Append nonce for security

    // AJAX request
    $.ajax({
      url: reg_ajax.ajax_url,
      type: "POST",
      data: data,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
          $("#register-message").html(
            '<p style="color:green;">' + response.data + "</p>"
          );
          form[0].reset(); // Reset the form fields
          location.reload();
        } else {
          $("#register-message").html(
            '<p style="color:red;">' + response.data + "</p>"
          );
        }
        alert(response.data);
      },
      error: function () {
        $("#register-message").html(
          '<p style="color:red;">An error occurred, please try again.</p>'
        );
      },
    });
  });

  $("#login-form").on("submit", function (e) {
    e.preventDefault(); // Prevent form submission
    var form = $(this); // Get the form element
    var data = {
      action: "handle_login_form",
      nonce: reg_ajax.login_nonce,
      username: form.find("#login-username").val(),
      password: form.find("#login-password").val(),
    };
    //console.log(data);
    // alert(data);
    $.ajax({
      url: reg_ajax.ajax_url,
      type: "POST",
      data: data,
      success: function (response) {
        if (response.success) {
          $("#login-message").html(
            '<span style="color:green;">' + response.data + "</span>"
          );
          // setTimeout(function() {
          //     window.location.href = '/user-dashboard/';
          // }, 1000);
          location.reload();
        } else {
          $("#login-message").html(
            '<span style="color:red;">' + response.data + "</span>"
          );
        }
        alert(response.data);
      },
      error: function () {
        $("#login-message").html(
          '<span style="color:red;">An error occurred, please try again.</span>'
        );
      },
    });
  });

  $("#forgot-password-form .submit-button-forgot-password").on(
    "click",
    function (e) {
      e.preventDefault(); // Prevent form submission
      console.log("Form submission intercepted"); // Debug log

      var form = $("#forgot-password-form"); // Get the form element correctly
      var data = {
        action: "handle_forgot_password",
        nonce: reg_ajax.forgot_password_nonce,
        forgot_password_mail: form.find("#forgot-password-mail").val(), // Match the name in PHP
      };

      console.log("Sending data:", data); // Debug log

      $.ajax({
        url: reg_ajax.ajax_url,
        type: "POST",
        data: data,
        success: function (response) {
          console.log("Response received:", response); // Debug log
          if (response.success) {
            $("#forgot-password-message").html(
              '<span style="color:green;">' + response.data + "</span>"
            );
          } else {
            $("#forgot-password-message").html(
              '<span style="color:red;">' + response.data + "</span>"
            );
          }
          alert(response.data);
        },
        error: function (xhr, status, error) {
          console.log("Error occurred:", error); // Debug log
          $("#forgot-password-message").html(
            '<span style="color:red;">An error occurred, please try again.</span>'
          );
        },
      });

      return false; // Additional prevention of form submission
    }
  );

  $("#dokumente-form .next-button").on("click", function (e) {
    e.preventDefault();

    // const fileInput = document.getElementById("jahbulonn-upload-pdf-file");

    // // Check if input has 'required' and is empty
    // if (fileInput.hasAttribute("required") && fileInput.files.length === 0) {
    //   alert("Please select a file.");
    //   fileInput.focus();
    //   return; // Stop further execution
    // }

    var form = $("#dokumente-form");
    var formData = new FormData(form[0]);

    // Add required action and nonce
    formData.append("action", "handle_pdf_document_form");
    formData.append("nonce", reg_ajax.pdf_document_nonce);

    // Log form data for debugging
    console.log("Form data being sent:", {
      action: formData.get("action"),
      nonce: formData.get("nonce"),
      file: formData.get("pdf_document"),
    });

    $.ajax({
      url: reg_ajax.ajax_url,
      type: "POST",
      data: formData,
      processData: false, // Important for file uploads
      contentType: false, // Important for file uploads
      success: function (response) {
        console.log("Server response:", response);
        if (response.success) {
          $("#pdf-document-message").html(
            '<span style="color:green;">' + response.data + "</span>"
          );
        } else {
          $("#pdf-document-message").html(
            '<span style="color:red;">' + response.data + "</span>"
          );
        }
        alert(response.data);
      },
      error: function (xhr, status, error) {
        $("#pdf-document-message").html(
          '<span style="color:red;">An error occurred, please try again.</span>'
        );
      },
    });
  });

  $("#upload-documents-form .next-button").on("click", function (e) {
    e.preventDefault();
    var form = $("#upload-documents-form");
    var formData = new FormData(form[0]);
    formData.append("action", "handle_user_documents_form");
    formData.append("nonce", reg_ajax.user_documents_nonce);

    // Log form data for debugging
    console.log("Form data being sent:", {
      action: formData.get("action"),
      nonce: formData.get("nonce"),
    });

    $.ajax({
      url: reg_ajax.ajax_url,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log("Server response:", response);
        if (response.success) {
          $("#upload-documents-message").html(
            '<span style="color:green;">' + response.data + "</span>"
          );
        } else {
          $("#upload-documents-message").html(
            '<span style="color:red;">' + response.data + "</span>"
          );
        }
        alert(response.data);
      },
      error: function (xhr, status, error) {
        $("#upload-documents-message").html(
          '<span style="color:red;">An error occurred, please try again.</span>'
        );
      },
    });
  });

  $("#choose-school-form .next-button").on("click", function (e) {
    e.preventDefault();
    var form = $("#choose-school-form");
    var formData = new FormData(form[0]);
    formData.append("action", "handle_chosen_university_form");
    formData.append("nonce", reg_ajax.chosen_university_nonce);
    // Add debugging
    console.log("Form data being sent:");

    $.ajax({
      url: reg_ajax.ajax_url,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log("Server response:", response);
        if (response.success) {
          $("#choose-school-message").html(
            '<span style="color:green;">' + response.data + "</span>"
          );
        } else {
          $("#choose-school-message").html(
            '<span style="color:red;">' + response.data + "</span>"
          );
        }
        alert(response.data);
      },
      error: function (xhr, status, error) {
        $("#choose-school-message").html(
          '<span style="color:red;">An error occurred, please try again.</span>'
        );
      },
    });
  });
});
