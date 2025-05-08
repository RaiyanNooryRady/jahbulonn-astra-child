<?php
/* Template Name: Forgot Password */
ob_start();

// Include custom header for the forgot password page
get_template_part('template-parts/forgot-password/header-forgot-password');

if ( isset( $_POST['forgot_password'] ) ) {
    $user_login = sanitize_text_field( $_POST['user_login'] );

    // Check if the email exists
    $user = get_user_by( 'email', $user_login );
    
    if ( $user ) {
        // Generate a unique reset token
        $reset_token = wp_generate_password( 20, false );
        
        // Save the token in user meta (you can set an expiration time, e.g., 1 hour)
        update_user_meta( $user->ID, '_password_reset_token', $reset_token );
        update_user_meta( $user->ID, '_password_reset_token_expiry', time() + 3600 ); // Token expires in 1 hour

        // Construct the custom reset link with token
        $reset_link = home_url() . "/reset-password/?token=" . $reset_token . "&user=" . urlencode($user->user_login);

        // Send the custom reset email
        $subject = 'Password Reset Request';
        $message = 'Hello, click the link below to reset your password:<br><br>';
        $message .= '<a href="' . esc_url($reset_link) . '">' . esc_html($reset_link) . '</a>';

        $headers = array(
            'From' => 'sender@example.com',
            'Content-Type' => 'text/html; charset=UTF-8',
        );

        // Use wp_mail() for email sending
        if ( wp_mail($user->user_email, $subject, $message, $headers) ) {
            echo 'Password reset email sent!';
        } else {
            echo 'Failed to send password reset email.';
        }
    } else {
        echo '<p class="error">Email not found!</p>';
    }
}
?>


<section class="page-section login-page">
  <div class="full-width-screen">
    <div class="container-fluid">
      <div class="content-detail">

        <!-- Forgot form -->
        <form class="forgot-form" method="post">
          <div class="imgcontainer">
              <img style="width:300px; height: 200px;" src="<?php echo get_theme_file_uri(); ?>/assets/images/logo.png" alt="logo" class="avatar">
          </div>
          <div class="input-control">
            <p>Enter your email, we will send a link to reset your password.</p>
            <input name="user_login" type="email" placeholder="Enter your email" name="email" required>
            <div class="login-btns">
              <button name="forgot_password" type="submit">Reset</button>
            </div>
            <div class="login-with-btns">
              <span class="already-acc">Return to<a href="<?php echo esc_url(get_permalink(get_page_by_path('login'))); ?>" class="login-btn">Login</a></span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php
get_template_part('template-parts/forgot-password/footer-forgot-password');
?>