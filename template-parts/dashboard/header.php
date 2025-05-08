<?php 
// Ensure user is logged in, otherwise redirect
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

get_header('dashboard');

$current_user = wp_get_current_user();
$logout_url = wp_logout_url(home_url()); // Logout and redirect to homepage
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<main class="page-content content-wrap">
    <div class="page-sidebar sidebar">
        <div class="page-sidebar-inner slimscroll">
            <ul class="menu accordion-menu">
                <li class="<?php echo (is_page('user-dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo home_url('/user-dashboard'); ?>" class="waves-effect waves-button">
                        <span class="menu-icon icon-user"></span>
                        <p>Profile</p>
                        <span class="active-page"></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url($logout_url); ?>" class="waves-effect waves-button">
                        <span class="menu-icon icon-logout"></span>
                        <p>Logout</p>
                    </a>
                </li>
            </ul> 
        </div><!-- Page Sidebar Inner -->
    </div>


