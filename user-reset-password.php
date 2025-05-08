<?php
/* Template Name: Reset Password */
ob_start();
get_template_part('template-parts/reset-password/header-reset-password');
?>

<section class="page-section login-page">
    <div class="full-width-screen">
        <div class="container-fluid">
            <div class="content-detail">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo esc_html($error); ?></div>
                <?php endif; ?>

                <form class="login-form" method="post">
                    <?php wp_nonce_field('user_login_action'); ?>
                    <div class="imgcontainer">
                        <img style="width:300px; height: 200px;" src="<?php echo get_theme_file_uri(); ?>/assets/images/logo.png" alt="logo" class="avatar">
                    </div>
                    <div class="input-control">
                        <div class="row p-l-5 p-r-5">
                            <div class="col-md-12 p-l-10 p-r-10">
                                <input type="password" placeholder="Enter New Password" name="new password" required>
                            </div>                            
                            <div class="col-md-12 p-l-10 p-r-10">
                                <input type="password" placeholder="Enter Confirm Password" name="confirm password" required>
                            </div>
                        </div>
                        <div class="login-btns">
                            <button type="submit" name="reset-password">Reset Password</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/reset-password/footer-reset-password'); ?>
