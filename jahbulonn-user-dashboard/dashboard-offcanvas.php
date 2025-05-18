<!-- Offcanvas Sidebar for mobile -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/jahbulonn-user-dashboard/logo-2.png" alt="logo" class="rounded jahbulonn-logo">
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body sidebar">
        <?php include "menu-items.php"; ?>
    </div>
</div>