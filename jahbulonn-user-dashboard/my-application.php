<?php
/** Template Name: My Application */
if (!is_user_logged_in()) {
    wp_redirect(home_url() . '/complete-register');
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
                <h1>My Application</h1>
                <p>This is your application content area.</p>
                <div class="jahbulonn-application-container">
                    <div class="jahbulonn-application-header">
                        <h1 class="jahbulonn-application-title">My Application Übersicht</h1>
                    </div>
                    <?php
                    $user_id = get_current_user_id();
                    $chosen_university_table = $wpdb->prefix . 'chosen_university';
                    $chosen_universities = $wpdb->get_results("SELECT * FROM $chosen_university_table WHERE user_id = $user_id");
                    // print_r($chosen_universities);
                    ?>

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

                            <?php
                            $jahbulonn_row_number = 1;
                            foreach ($chosen_universities as $chosen_university) {
                                ?>
                                <tr>
                                    <td class="jahbulonn-row-number"><?php echo $jahbulonn_row_number++; ?></td>
                                    <td><?php echo $chosen_university->university_name; ?></td>
                                    <td><?php echo $chosen_university->university_application_status; ?></td>
                                    <td><?php echo $chosen_university->university_application_result; ?></td>
                                    <td><?php echo $chosen_university->created_at; ?></td>
                                    <td><a href="<?php echo esc_url($chosen_university->university_application_document); ?>"
                                            class="jahbulonn-download-link" target="_blank">[Download]</a></td>
                                    <td></td>
                                </tr> <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require "dashboard-offcanvas.php"; ?>
</main>

<?php include "footer-user-dashboard.php"; ?>