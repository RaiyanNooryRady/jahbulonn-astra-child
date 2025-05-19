jQuery(document).ready(function($) {

    $('.jahbulonn-menu-item').on('click', function() {
        $(this).removeClass('active');
    });

    // Check current page and set active menu
    const currentPath = window.location.pathname;
    if (currentPath.includes('/my-dashboard/')) {
        $('#jahbulonn-dashboard-link').addClass('active');
    } else if (currentPath.includes('/my-application/')) {
        $('#jahbulonn-application-link').addClass('active');
    } else if (currentPath.includes('/study-materials/')) {
        $('#jahbulonn-study-materials-link').addClass('active');
    } else if (currentPath.includes('/profile/')) {
        $('#jahbulonn-profile-link').addClass('active');
    }
});
