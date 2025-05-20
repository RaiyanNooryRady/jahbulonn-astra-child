<?php
/** Template Name: My Dashboard */
if(!is_user_logged_in()){
    wp_redirect(home_url().'/complete-register');
    exit;
}
include "header-user-dashboard.php";

?>
<main class="jahbulonn-main" id="jahbulonn-dashboard">

    <?php require "dashboard-mobile-navbar.php"; ?>
    <!-- Sidebar for desktop -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 d-none d-md-block sidebar">
                <?php include "menu-items.php"; ?>
            </div>

            <div class="col-md-9 col-lg-10 col-12 p-4">
                <h1>Welcome, <?php echo $current_user->display_name; ?>!</h1>
                <p>This is your dashboard content area.</p>
            </div>
        </div>
    </div>
    <?php require "dashboard-offcanvas.php"; ?>
</main>

<?php include "footer-user-dashboard.php"; ?>