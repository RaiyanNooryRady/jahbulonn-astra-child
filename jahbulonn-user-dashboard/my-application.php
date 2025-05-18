<?php
/** Template Name: My Application */
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
                <h1>My Application</h1>
                <p>This is your application content area.</p>
                <div class="jahbulonn-application-container">
                    <div class="jahbulonn-application-header">
                        <h1 class="jahbulonn-application-title">My Application Übersicht</h1>
                        <div class="jahbulonn-application-actions">
                            <button class="jahbulonn-action-button" title="Download">↓</button>
                            <button class="jahbulonn-action-button" title="Expand">⤢</button>
                        </div>
                    </div>

                    <table class="jahbulonn-application-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>University</th>
                                <th>Status</th>
                                <th>Result</th>
                                <th>Last Updated</th>
                                <th>Document</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="jahbulonn-row-number">1</td>
                                <td>ETH Zurich</td>
                                <td>In Process</td>
                                <td>–</td>
                                <td>10.05.2025</td>
                                <td>–</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="jahbulonn-row-number">2</td>
                                <td>University of Basel</td>
                                <td>Result Available</td>
                                <td>Accepted</td>
                                <td>13.05.2025</td>
                                <td><a href="#" class="jahbulonn-download-link">[Download]</a></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="jahbulonn-row-number">3</td>
                                <td>University of Geneva</td>
                                <td>Submitted</td>
                                <td>–</td>
                                <td>09.05.2025</td>
                                <td>–</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require "dashboard-offcanvas.php"; ?>
</main>

<?php include "footer-user-dashboard.php"; ?>