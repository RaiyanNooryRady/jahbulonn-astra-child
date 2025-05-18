<?php
/** Template Name: Study Materials */
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

                    <!-- Upload Section (for admin) -->
                    <div class="jahbulonn-upload-section">
                        <h3>Upload PDF (Admin)</h3>
                        <input type="file" accept=".pdf"><br>
                        <button>Upload</button>
                    </div>

                    <!-- PDF List Section (for users) -->
                    <h3>Available PDFs for Download</h3>
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php require "dashboard-offcanvas.php"; ?>
</main>

<?php include "footer-user-dashboard.php"; ?>