<div class="menu-items">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/jahbulonn-user-dashboard/logo-2.png" alt="logo"
        class="rounded jahbulonn-logo">
    <?php if (is_page('my-dashboard')): ?>
        <a href="<?php echo home_url(); ?>/my-dashboard" id="jahbulonn-dashboard-link" class="jahbulonn-menu-item active">Dashboard</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/my-dashboard" id="jahbulonn-dashboard-link" class="jahbulonn-menu-item">Dashboard</a>
    <?php endif; ?>
    <?php if (is_page('my-application')): ?>
        <a href="<?php echo home_url(); ?>/my-application" id="jahbulonn-application-link" class="jahbulonn-menu-item active">My Application</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/my-application" id="jahbulonn-application-link" class="jahbulonn-menu-item">My Application</a>
    <?php endif; ?>
    <?php if (is_page('study-materials')): ?>
        <a href="<?php echo home_url(); ?>/study-materials" id="jahbulonn-study-materials-link" class="jahbulonn-menu-item active">Study Materials</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/study-materials" id="jahbulonn-study-materials-link" class="jahbulonn-menu-item">Study Materials</a>
    <?php endif; ?>
    <?php if (is_page('profile')): ?>
        <a href="<?php echo home_url(); ?>/profile" id="jahbulonn-profile-link" class="jahbulonn-menu-item active">Profile</a>
    <?php else: ?>
        <a href="<?php echo home_url(); ?>/profile" id="jahbulonn-profile-link" class="jahbulonn-menu-item">Profile</a>
    <?php endif; ?>
    <a href="<?php echo wp_logout_url(); ?>" id="jahbulonn-logout-link" class="jahbulonn-menu-item">Logout</a>
</div>