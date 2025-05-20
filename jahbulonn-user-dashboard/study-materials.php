<?php
/** Template Name: Study Materials */
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
                <h1>Study Materials</h1>
                <div class="jahbulonn-study-materials-container">

                    <!-- PDF List Section (for users) -->
                    <!-- <h3>Available PDFs for Download</h3>
                    <ul class="jahbulonn-pdf-list">
                        <li>
                            <span>Maths Chapter 1 - Algebra</span>
                            <a href="#" download>Download</a>
                        </li>
                        <li>
                            <span>Physics - Laws of Motion</span>
                            <a href="#" download>Download</a>
                        </li>
                        <li>
                            <span>Chemistry - Organic Compounds</span>
                            <a href="#" download>Download</a>
                        </li>
                    </ul> -->
                    <?php 
                        if(shortcode_exists('user_pdfs')){
                            echo do_shortcode('[user_pdfs]');
                        }
                        
                        ?>
                </div>
            </div>
        </div>
    </div>
    <?php require "dashboard-offcanvas.php"; ?>
</main>

<?php include "footer-user-dashboard.php"; ?>