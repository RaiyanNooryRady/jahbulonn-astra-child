<?php
/** Template Name: Users List */

if (!is_user_logged_in()) {
    wp_redirect(home_url() . '/complete-register');
    exit;
} else {
    if (!current_user_can('administrator')) {
        wp_redirect(home_url() . '/my-dashboard');
        exit;
    }
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
                <h1>Users List</h1>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Display Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Profile Photo</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    global $wpdb;

                                    // Pagination settings
                                    $users_per_page = 5;
                                    $current_page = isset($_GET['page_num']) ? max(1, intval($_GET['page_num'])) : 1;
                                    $offset = ($current_page - 1) * $users_per_page;

                                    // Get total number of users
                                    $total_users = $wpdb->get_var("SELECT COUNT(*) FROM wp_users");
                                    $total_pages = ceil($total_users / $users_per_page);

                                    // Get users for current page
                                    $users = $wpdb->get_results($wpdb->prepare(
                                        "SELECT * FROM wp_users LIMIT %d OFFSET %d",
                                        $users_per_page,
                                        $offset
                                    ));

                                    foreach ($users as $user) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($user->user_login); ?></td>
                                            <td><?php echo htmlspecialchars($user->display_name); ?></td>
                                            <td><?php echo htmlspecialchars($user->user_email); ?></td>
                                            <td><?php
                                            $user_data = get_userdata($user->ID);
                                            $roles = $user_data->roles;
                                            echo htmlspecialchars(implode(', ', $roles));
                                            ?></td>
                                            <td><img src="<?php
                                            $custom_picture = get_user_meta($user->ID, 'profile_picture', true);
                                            echo $custom_picture ? $custom_picture : get_avatar_url($user->ID);
                                            ?>" alt="Profile Picture" class="jahbulonn-user-photo" /></td>
                                            <td><a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal<?php echo $user->ID; ?>"><i
                                                        class="bi bi-pencil-square"></i></a></td>
                                            <td><a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteUserModal<?php echo $user->ID; ?>"><i
                                                        class="bi bi-trash"></i></a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                                <nav aria-label="Page navigation" class="mt-4">
                                    <ul class="pagination justify-content-center">
                                        <?php if ($current_page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page_num=<?php echo $current_page - 1; ?>"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?php echo $i === $current_page ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page_num=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($current_page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page_num=<?php echo $current_page + 1; ?>"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit User Modals -->
    <?php foreach ($users as $user) { ?>
        <div class="modal fade" id="editUserModal<?php echo $user->ID; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User: <?php echo htmlspecialchars($user->display_name); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" id="edit_user_form<?php echo $user->ID; ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_display_name<?php echo $user->ID; ?>" class="form-label">Display
                                    Name</label>
                                <input type="text" class="form-control" id="edit_display_name<?php echo $user->ID; ?>"
                                    name="edit_display_name<?php echo $user->ID ?>"
                                    value="<?php echo htmlspecialchars($user->display_name); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="edit_password<?php echo $user->ID; ?>" class="form-label">New Password (leave
                                    blank to keep current)</label>
                                <input type="password" class="form-control" id="edit_password<?php echo $user->ID; ?>"
                                    name="edit_password<?php echo $user->ID ?>">
                            </div>
                            <div class="mb-3">
                                <label for="edit_profile_picture<?php echo $user->ID; ?>" class="form-label">Profile
                                    Picture</label>
                                <input type="file" class="form-control" id="edit_profile_picture<?php echo $user->ID; ?>"
                                    name="edit_profile_picture<?php echo $user->ID ?>">
                            </div>
                            <?php
                            $user_id = $user->ID;
                            $chosen_university_table = $wpdb->prefix . 'chosen_university';
                            $chosen_universities = $wpdb->get_results("SELECT * FROM $chosen_university_table WHERE user_id = $user_id");
                            // print_r($chosen_universities);
                            if (empty($chosen_universities)) {
                                echo "<h5>No University is selected by user</h5>";
                            }
                            ?>
                            <div class="jahbulonn-university-edit-container">
                                <?php foreach ($chosen_universities as $chosen_university) { ?>

                                    <h5 class="jahbulonn_user_university_name">
                                        <?php echo $chosen_university->university_name; ?>
                                    </h5>
                                    <div class="mb-3">
                                        <label for="edit_university_application_status<?php echo $user->ID."_".$chosen_university->id; ?>"
                                            class="form-label">University Application Status</label>
                                        <input type="text" class="form-control"
                                            id="edit_university_application_status<?php echo $user->ID."_".$chosen_university->id; ?>"
                                            name="edit_university_application_status<?php echo $user->ID."_".$chosen_university->id; ?>"
                                            value="<?php echo $chosen_university->university_application_status; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_university_application_result<?php echo $user->ID."_".$chosen_university->id; ?>"
                                            class="form-label">University Application Result</label>
                                        <input type="text" class="form-control"
                                            id="edit_university_application_result<?php echo $user->ID."_".$chosen_university->id; ?>"
                                            name="edit_university_application_result<?php echo $user->ID."_".$chosen_university->id; ?>"
                                            value="<?php echo $chosen_university->university_application_result; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_university_application_document<?php echo $user->ID."_".$chosen_university->id; ?>"
                                            class="form-label">Upload University Application Document:</label>
                                        <?php if(!empty($chosen_university->university_application_document)): ?>
                                        <a href="<?php echo esc_url($chosen_university->university_application_document); ?>"
                                            target="_blank">View Existing Document</a>
                                        <?php endif; ?>
                                        <input type="file" class="form-control"
                                            id="edit_university_application_document<?php echo $user->ID."_".$chosen_university->id; ?>"
                                            name="edit_university_application_document<?php echo $user->ID."_".$chosen_university->id; ?>" value="">
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="edit_user_save<?php echo $user->ID ?>" class="btn btn-primary">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete User Modal -->
        <div class="modal fade" id="deleteUserModal<?php echo $user->ID; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete user "<?php echo htmlspecialchars($user->display_name); ?>"?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="" method="POST" style="display: inline;">
                            <input type="hidden" name="delete_user_id" value="<?php echo $user->ID; ?>">
                            <button type="submit" name="delete_user<?php echo $user->ID; ?>" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php require "dashboard-offcanvas.php"; ?>
</main>

<?php include "footer-user-dashboard.php"; ?>