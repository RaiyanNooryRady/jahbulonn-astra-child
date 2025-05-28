<?php
/* Template Name: Reset Password */
ob_start();

// Include custom header
get_header('registration');

// Get token and user from URL
$token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : '';
$user_login = isset($_GET['user']) ? sanitize_text_field($_GET['user']) : '';

// Verify token and user
$user = get_user_by('login', $user_login);
$is_valid = false;
$error_message = '';

if ($user) {
    $stored_token = get_user_meta($user->ID, '_password_reset_token', true);
    $token_expiry = get_user_meta($user->ID, '_password_reset_token_expiry', true);
    
    if ($token === $stored_token && $token_expiry > time()) {
        $is_valid = true;
    } else {
        $error_message = 'Invalid or expired reset link. Please request a new password reset.';
    }
} else {
    $error_message = 'Invalid user. Please request a new password reset.';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    if ($is_valid) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        if ($new_password === $confirm_password) {
            // Update password
            wp_set_password($new_password, $user->ID);
            
            // Clear reset token
            delete_user_meta($user->ID, '_password_reset_token');
            delete_user_meta($user->ID, '_password_reset_token_expiry');
            
            // Auto login the user
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);
            
            // Redirect to dashboard
            wp_redirect(home_url('/my-dashboard/'));
            exit;
        } else {
            $error_message = 'Passwords do not match.';
        }
    }
}
?>

<section class="page-section login-page">
    <div class="full-width-screen">
        <div class="container-fluid">
            <div class="content-detail">
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo esc_html($error_message); ?></div>
                <?php endif; ?>

                <?php if ($is_valid): ?>
                    <form method="post" class="reset-password-form">
                        <div class="imgcontainer">
                            <img style="width:300px; height: 200px;" src="<?php echo get_theme_file_uri(); ?>/assets/images/logo.png" alt="logo" class="avatar">
                        </div>
                        <div class="input-control">
                            <div class="form-group">
                                <label for="new_password">New Password:</label>
                                <input type="password" name="new_password" id="new_password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" name="confirm_password" id="confirm_password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="reset_password" class="submit-button">Reset Password</button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="text-center">
                        <p>Please request a new password reset link.</p>
                        <a href="<?php echo home_url('/complete-register/'); ?>" class="btn btn-primary">Back to Login</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer('registration');
?> 