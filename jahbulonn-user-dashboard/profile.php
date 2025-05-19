<?php
/** Template Name: Profile */
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
                <h1>Profile</h1>
                <div class="jahbulonn-profile-container">
                    <div class="jahbulonn-profile-header">
                        <h1>Profile Information</h1>
                    </div>
                    <div class="jahbulonn-profile-content">
                        <div class="jahbulonn-profile-picture-container">
                            <img src="<?php 
                                $custom_picture = get_user_meta(get_current_user_id(), 'profile_picture', true);
                                echo $custom_picture ? $custom_picture : get_avatar_url(get_current_user_id()); 
                            ?>" alt="Profile Picture"
                                class="jahbulonn-profile-picture" />
                        </div>
                        <div class="jahbulonn-profile-info"><strong>I'm <?php echo wp_get_current_user()->display_name; ?></strong></div>

                        <!-- Change Profile Picture Form -->
                        <form class="jahbulonn-profile-form" method="POST" enctype="multipart/form-data"
                            id="form-picture">
                            <label class="jahbulonn-profile-label" for="profile_picture">Change your profile
                                picture</label>
                            <div class="jahbulonn-profile-form-row">
                                <div class="jahbulonn-profile-form-input">
                                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                                        class="jahbulonn-profile-input" />
                                </div>
                                <button type="submit" name="change_profile_picture" class="jahbulonn-profile-button">Change
                                    Picture</button>
                            </div>
                        </form>

                        <!-- Change Username Form -->
                        <form class="jahbulonn-profile-form" method="POST" id="form-username">
                            <label class="jahbulonn-profile-label" for="display_name">Change your display name</label>
                            <div class="jahbulonn-profile-form-row">
                                <div class="jahbulonn-profile-form-input">
                                    <input type="text" name="display_name" id="display_name" value="<?php echo wp_get_current_user()->display_name; ?>"
                                        class="jahbulonn-profile-input" required minlength="3" />
                                </div>
                                <button type="submit" name="change_display_name" class="jahbulonn-profile-button">Change
                                    Display Name</button>
                            </div>
                            <small class="text-muted">Note: This changes your display name, not your login username.</small>
                        </form>

                        <!-- Change Password Form -->
                        <form class="jahbulonn-profile-form" method="POST" id="form-password">
                            <label class="jahbulonn-profile-label" for="password">Change your password</label>
                            <div class="jahbulonn-profile-form-row">
                                <div class="jahbulonn-profile-form-input">
                                    <input type="password" name="password" id="password" class="jahbulonn-profile-input"
                                        required minlength="6" placeholder="New password" autocomplete="new-password" />
                                </div>
                                <button type="submit" name="change_password" class="jahbulonn-profile-button">Change
                                    Password</button>
                            </div>
                        </form>
                        <!-- PDF List Section (for users) -->
                        <h3 class="my-4">All Uploaded Documents</h3>

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
    </div>
    <?php require "dashboard-offcanvas.php"; ?>
</main>

<?php include "footer-user-dashboard.php"; ?>