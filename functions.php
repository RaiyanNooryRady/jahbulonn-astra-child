<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */

add_action('wp_enqueue_scripts', 'astra_child_style');
function astra_child_style()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));

    //fonts styles
    wp_enqueue_style('fonts', '//fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap');

    // Additional styles
    wp_enqueue_style('login-custom', get_stylesheet_directory_uri() . '/assets/css/login.css');

    wp_enqueue_style('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
    //bootstrap icons
    wp_enqueue_style('bootstrap-icons', '//cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
    //  wp_enqueue_style('meteor', get_stylesheet_directory_uri() . '/assets/css/meteor.min.css');
    wp_enqueue_style('simple-line', get_stylesheet_directory_uri() . '/assets/plugins/line-icons/simple-line-icons.css');
    wp_enqueue_style('dark-layer', get_stylesheet_directory_uri() . '/assets/css/layers/dark-layer.css');
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/plugins/fontawesome/css/font-awesome.min.css');

    // JavaScript files
    wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri() . '/assets/plugins/jquery-ui/jquery-ui.min.js', array('jquery'), null, true);
    wp_enqueue_script('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    // wp_enqueue_script('waves', get_stylesheet_directory_uri() . '/assets/plugins/waves/waves.min.js', array('jquery'), null, true);
    //wp_enqueue_script('meteor', get_stylesheet_directory_uri() . '/assets/js/meteor.min.js', array('jquery'), null, true);
}

/**
 * Your code goes below.
 */


// Hide admin bar for subscribers
add_action('after_setup_theme', function () {
    if (current_user_can('subscriber')) {
        show_admin_bar(false);
    }
});

// Allow admins to access WP Admin and restrict subscribers
add_action('admin_init', function () {
    if (is_admin() && !wp_doing_ajax() && current_user_can('subscriber')) {
        wp_redirect(home_url('/my-dashboard/'));
        exit;
    }
});

// Redirect non-logged-in users away from user-dashboard
function restrict_dashboard_access()
{
    if (is_page_template('dashboard.php') && !is_user_logged_in()) {
        wp_redirect(home_url('/complete-register/')); // Redirect to login page
        exit;
    }
}
add_action('template_redirect', 'restrict_dashboard_access');

// Custom login redirect based on user role
function custom_login_redirect($redirect_to, $request, $user)
{
    if (isset($user->roles) && is_array($user->roles)) {
        // Subscribers go to the user dashboard
        if (in_array('subscriber', $user->roles)) {
            return home_url('/my-dashboard/');
        }
        // Admins and others go to WP Admin
        return admin_url();
    }
    return $redirect_to;
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);

// Ensure logout redirects users correctly
function custom_logout_redirect()
{
    wp_redirect(home_url('/complete-register/')); // Redirect to login page after logout
    exit();
}
add_action('wp_logout', 'custom_logout_redirect');

function handle_user_dashboard_form()
{
    if (isset($_POST['user_dashboard_form'])) {
        // Verify Nonce (Security Check)
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'user_dashboard_action')) {
            wp_die('Security check failed!');
        }

        // Get Current User
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;

        // Sanitize Inputs
        $user_name = sanitize_text_field($_POST['user_name']);
        $user_email = sanitize_email($_POST['user_email']);

        // Update User Data
        wp_update_user([
            'ID' => $user_id,
            'display_name' => $user_name,
            'user_email' => $user_email
        ]);

        // Redirect After Submission
        wp_redirect(add_query_arg('updated', 'true', get_permalink()));
        exit;
    }
}
add_action('init', 'handle_user_dashboard_form');

//menu
function custom_user_menu_item($items, $args)
{
    if ($args->theme_location !== 'primary') {
        return $items;
    }

    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();

        if (in_array('subscriber', $current_user->roles)) {
            $dashboard_url = site_url('/my-dashboard/');
            $logout_url = wp_logout_url(site_url('/complete-register/')); // Redirect after logout

            $items .= '<li class="menu-item"><a href="' . esc_url($dashboard_url) . '">Dashboard</a></li>';
        }
    } else {
        $login_url = site_url('/complete-register/');
        $register_url = site_url('/complete-register/');

        $items .= '<li class="menu-item"><a href="' . esc_url($login_url) . '">Login</a></li>';
    }

    return $items;
}
//add_filter('wp_nav_menu_items', 'custom_user_menu_item', 10, 2);

// -----------------------------------------------------------------------------------------------------------------------------
function jahbulonn_shortcode_registration_portal()
{
    ob_start();
    include(get_stylesheet_directory() . '/registration-portal.php');
    return ob_get_clean();
}
add_shortcode('jahbulonn_registration_portal', 'jahbulonn_shortcode_registration_portal');

// Enqueue CSS & JS for the form
function jahbulonn_custom_register_form_assets()
{
    // Enqueue the register.js file
    wp_enqueue_script('custom-register-script', get_stylesheet_directory_uri() . '/register.js', array('jquery'), filemtime(get_stylesheet_directory() . '/register.js'), true);

    wp_localize_script('custom-register-script', 'reg_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'register_nonce' => wp_create_nonce('register_nonce'),
        'login_nonce' => wp_create_nonce('login_nonce'),
        'pdf_document_nonce' => wp_create_nonce('pdf_document_nonce'),
        'user_documents_nonce' => wp_create_nonce('user_documents_nonce'),
        'chosen_university_nonce' => wp_create_nonce('chosen_university_nonce'),
        'forgot_password_nonce' => wp_create_nonce('forgot_password_nonce')
    ));
    // Enqueue the registration-portal.js file
    wp_enqueue_script('registration-portal-script', get_stylesheet_directory_uri() . '/registration-portal.js', array('jquery'), filemtime(get_stylesheet_directory() . '/registration-portal.js'), true);

}
add_action('wp_enqueue_scripts', 'jahbulonn_custom_register_form_assets');

// Create both database tables
function jahbulonn_create_registration_tables()
{
    global $wpdb;
    $first_table = $wpdb->prefix . 'register1';
    $charset_collate = $wpdb->get_charset_collate();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql1 = "CREATE TABLE $first_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id mediumint(9) NOT NULL,
        vorname varchar(255) NOT NULL,
        nachname varchar(255) NOT NULL,
        username varchar(100) NOT NULL unique,
        email varchar(100) NOT NULL unique,
        password varchar(255) NOT NULL,
        telefon varchar(20),
        address varchar(250) NOT NULL,
        birth_date date NOT NULL,
        plz varchar(20) NOT NULL,
        stadt varchar(100) NOT NULL,
        land varchar(100) NOT NULL,
        newsletter1 TINYINT(1) NOT NULL DEFAULT 0,
        newsletter2 TINYINT(1) NOT NULL DEFAULT 0,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
      ) $charset_collate;";
    dbDelta($sql1);

}
add_action('after_setup_theme', 'jahbulonn_create_registration_tables');


// Handle AJAX
function jahbulonn_handle_register_form()
{
    check_ajax_referer('register_nonce', 'nonce');

    global $wpdb;

    $first_table = $wpdb->prefix . 'register1';
    // $second_table = $wpdb->prefix . 'registered_second';

    // Sanitize and collect data
    // collect wordpress user data

    //1. create the wordpress user
    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $vorname = sanitize_text_field($_POST['vorname']);
    $nachname = sanitize_text_field($_POST['nachname']);
    $user_data = [
        'user_login' => $username,
        'user_email' => $email,
        'user_pass' => $password,
        'first_name' => $vorname,
        'last_name' => $nachname,
        'role' => 'subscriber',
    ];
    $user_id = wp_insert_user($user_data);
    if (is_wp_error($user_id)) {
        wp_send_json_error('User creation failed: ' . $user_id->get_error_message());
        return;
    }

    $first_data = [
        'user_id' => $user_id,
        'vorname' => $vorname,
        'nachname' => $nachname,
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'telefon' => sanitize_text_field($_POST['telefon']),
        'address' => sanitize_text_field($_POST['address']),
        'birth_date' => sanitize_text_field($_POST['birth_date']),
        'plz' => sanitize_text_field($_POST['plz']),
        'stadt' => sanitize_text_field($_POST['stadt']),
        'land' => sanitize_key($_POST['land']),
        'newsletter1' => isset($_POST['newsletter1']) ? 1 : 0,
        'newsletter2' => isset($_POST['newsletter2']) ? 1 : 0,
    ];


    // Insert data into the database
    $inserted = $wpdb->insert($first_table, $first_data);

    if ($inserted) {
        $info = array(
            'user_login' => $username,
            'user_password' => $password,
            'remember' => true
        );
        $user = wp_signon($info, false);
        $attached_file = '<a href="https://medcompact.eu/wp-content/uploads/2025/06/MedCompact_Vollmacht.pdf">View Attached PDF</a>';
        if (!is_wp_error($user)) {
            function set_html_mail_content_type()
            {
                return 'text/html';
            }

            add_filter('wp_mail_content_type', 'set_html_mail_content_type');
            $subject = 'Registration successful';
            $message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Successful</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .jahbulonn-site-logo { display: flex; justify-content: center; margin: 20px 0; }
        .jahbulonn-site-logo img { width: 150px; height: auto; }
        .jahbulonn-mail-container { padding: 20px; }
        .jahbulonn-message-container { display: flex; flex-direction: row; justify-content: center; flex-wrap: wrap; align-items: center; }
        .jahbulonn-message { padding: 0 10px; max-width: 500px; }
        .jahbulonn-mail-img { width: 300px; height: 300px; object-fit: contain; }
        .jahbulonn-download-link { color: #0A6E83; text-decoration: none; }
        .jahbulonn-download-link:hover { text-decoration: underline; }
        .jahbulonn-mail-footer { background-color: #0A6E83; text-align: center; color: white; padding: 30px 10px; }
        .jahbulonn-mail-footer p { margin-bottom: 0; margin-top: 5px; }
        .jahbulonn-footer-link { display: block; color: white; text-decoration: none; margin-top: 5px; }
        .jahbulonn-footer-link:hover { text-decoration: underline; }
        .jahbulonn-social-share { padding: 10px 0; }
        .jahbulonn-social-share img { width: 30px; height: 30px; margin: 0 5px; }
    </style>
</head>
<body>
    <div class="jahbulonn-mail-container">
        <a href="#" class="jahbulonn-site-logo">
            <img src="https://medcompact.eu/wp-content/themes/jahbulonn-astra-child/jahbulonn-user-dashboard/logo-2.png" alt="Logo" />
        </a>
        <div class="jahbulonn-message-container">
            <div class="jahbulonn-message">
                <h4>Hallo ' . esc_html($vorname) . '</h4>
                <p>Vielen Dank, dass du bei MedCompact deine Registrierung gestartet hast.</p>
                <p>
                    Hier findest du den <a
                        href="https://medcompact.eu/wp-content/uploads/2025/06/MedCompact_Vollmacht.pdf"
                        class="jahbulonn-download-link" target="_blank">Download-Link</a> zur Vollmacht. Bitte unterschreibe diese und lade sie auf dem Registrierungsportal hoch.
                </p>
                <p>Falls du noch weitere Fragen hast, melde dich gerne jederzeit bei uns.</p>
                <p>Liebe Grüße und bis bald,</p>
                <p>Das Team von MedCompact</p>
            </div>
            <img src="https://medcompact.eu/wp-content/uploads/2025/06/Bild-HP.png" alt="Vollmacht Illustration" class="jahbulonn-mail-img">
        </div>
    </div>
    <div class="jahbulonn-mail-footer">
        <p><b>MedCompact GmbH</b></p>
        <p>Gentzgasse 127</p>
        <p>1180 Wien</p>
        <a href="tel:+4368120397265" class="jahbulonn-footer-link">+43 681 20397265</a>
        <a href="mailto:info@medcompact.eu" class="jahbulonn-footer-link">info@medcompact.eu</a>
        <div class="jahbulonn-social-share">
            <a href="https://www.instagram.com/medcompact_eu?igsh=cGthb3RteXB2OGpv&utm_source=qr">
                <img src="https://medcompact.eu/wp-content/uploads/2025/06/Adobe-Express-file-5.png" alt="Instagram">
            </a>
            <a href="https://www.tiktok.com/@medcompact.eu?_t=ZN-8wqwbnWKbri&_r=1">
                <img src="https://medcompact.eu/wp-content/uploads/2025/06/Adobe-Express-file-4.png" alt="TikTok">
            </a>
            <a href="https://wa.me/message/ACIJOLJKUXU2B1">
                <img src="https://medcompact.eu/wp-content/uploads/2025/06/Adobe-Express-file-3.png" alt="WhatsApp">
            </a>
        </div>
        <a href="#" class="jahbulonn-footer-link">Unsubscribe</a>
    </div>
</body>
</html>';
            $headers = array(
                'From' => 'MedCompact <info@medcompact.eu>',
                'Content-Type' => 'text/html; charset=UTF-8',
            );
            if (wp_mail($email, $subject, $message, $headers)) {
                wp_send_json_success('Registration successful!');
            } else {
                wp_send_json_success('Registration successful but email failed: ' . $user->get_error_message());
            }
            remove_filter('wp_mail_content_type', 'set_html_mail_content_type');
        } else {
            wp_send_json_error('Registration successful but auto-login failed: ' . $user->get_error_message());
        }
    } else {
        wp_send_json_error('DB error: ' . $wpdb->last_error);
    }
}
add_action('wp_ajax_handle_register_form', 'jahbulonn_handle_register_form');
add_action('wp_ajax_nopriv_handle_register_form', 'jahbulonn_handle_register_form');


function jahbulonn_handle_login_form()
{
    check_ajax_referer('login_nonce', 'nonce');
    $info = array();
    if (isset($_POST['username'])) {
        $info['user_login'] = sanitize_text_field($_POST['username']);
    }
    if (isset($_POST['password'])) {
        $info['user_password'] = sanitize_text_field($_POST['password']);
    }
    if (is_email($info['user_login'])) {
        $user_data = get_user_by('email', $info['user_login']);
        if ($user_data) {
            $info['user_login'] = $user_data->user_login; //use username to login
        } else {
            wp_send_json_error('No user found with that email address.');
        }
    }
    $user_verify = wp_signon($info, false);
    if (is_wp_error($user_verify)) {
        wp_send_json_error('Invalid username or password');
    } else {
        wp_send_json_success('Login successful');
        exit;

    }

}
add_action('wp_ajax_handle_login_form', 'jahbulonn_handle_login_form');
add_action('wp_ajax_nopriv_handle_login_form', 'jahbulonn_handle_login_form');
//---------------------------------------------------------------------------------------------------------------------------------

function jahbulonn_create_pdf_document_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'pdf_document';
    $charset_collate = $wpdb->get_charset_collate();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id mediumint(9) NOT NULL unique,
        pdf_document varchar(255) NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta($sql);
}
add_action('after_setup_theme', 'jahbulonn_create_pdf_document_table');

function jahbulonn_handle_pdf_document_form()
{
    check_ajax_referer('pdf_document_nonce', 'nonce');
    global $wpdb;
    $pdf_document_table = $wpdb->prefix . 'pdf_document';

    // Check if user is logged in
    if (!is_user_logged_in()) {
        wp_send_json_error('User must be logged in to upload documents');
        return;
    }

    $user_id = get_current_user_id();

    // Debug log
    error_log('FILES: ' . print_r($_FILES, true));
    error_log('POST: ' . print_r($_POST, true));

    if (isset($_FILES['pdf_document']) && !empty($_FILES['pdf_document']['name'])) {
        $upload_dir = wp_upload_dir();
        $file_name = basename($_FILES['pdf_document']['name']);
        $target_file = $upload_dir['path'] . '/' . $file_name;

        // Check if file is a PDF
        $file_type = wp_check_filetype($file_name);
        if ($file_type['type'] !== 'application/pdf') {
            wp_send_json_error('Only PDF files are allowed');
            return;
        }

        if (move_uploaded_file($_FILES['pdf_document']['tmp_name'], $target_file)) {
            // Get the URL of the uploaded file
            $file_url = $upload_dir['url'] . '/' . $file_name;

            // Check if user already has a document
            $existing_doc = $wpdb->get_var($wpdb->prepare(
                "SELECT id FROM $pdf_document_table WHERE user_id = %d",
                $user_id
            ));

            if ($existing_doc) {
                // Update existing record
                $result = $wpdb->update(
                    $pdf_document_table,
                    array('pdf_document' => $file_url),
                    array('user_id' => $user_id)
                );
            } else {
                // Insert new record
                $result = $wpdb->insert(
                    $pdf_document_table,
                    array(
                        'user_id' => $user_id,
                        'pdf_document' => $file_url
                    )
                );
            }

            if ($result) {
                wp_send_json_success('PDF document uploaded successfully!');

            } else {
                wp_send_json_error('Failed to save document information: ' . $wpdb->last_error);
            }
        } else {
            wp_send_json_error('Failed to upload PDF file');
            return;
        }
    } else {
        wp_send_json_error('No New PDF file uploaded');
        return;
    }
}
add_action('wp_ajax_handle_pdf_document_form', 'jahbulonn_handle_pdf_document_form');
add_action('wp_ajax_nopriv_handle_pdf_document_form', 'jahbulonn_handle_pdf_document_form');

function jahbulonn_create_user_documents_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_documents';
    $charset_collate = $wpdb->get_charset_collate();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    user_id mediumint(9) NOT NULL unique,
    reisepass_doc varchar(255) NOT NULL,
    geburtsurkunde_doc varchar(255) NOT NULL,
    hochschulzeugnis_doc varchar(255) NOT NULL,
    lebenslauf_doc varchar(255),
    sonstiges_doc varchar(255),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta($sql);
}
add_action('after_setup_theme', 'jahbulonn_create_user_documents_table');

function jahbulonn_handle_user_documents_form()
{
    check_ajax_referer('user_documents_nonce', 'nonce');
    global $wpdb;
    $user_documents_table = $wpdb->prefix . 'user_documents';

    // Check if user is logged in
    if (!is_user_logged_in()) {
        wp_send_json_error('User must be logged in to upload documents');
        return;
    }
    $user_id = get_current_user_id();

    // Debug log
    error_log('FILES: ' . print_r($_FILES, true));
    error_log('POST: ' . print_r($_POST, true));

    // Initialize document data array with only user_id
    $document_data = array(
        'user_id' => $user_id
    );

    // Handle each document type
    $document_types = array(
        'reisepass_doc',
        'geburtsurkunde_doc',
        'hochschulzeugnis_doc',
        'lebenslauf_doc',
        'sonstiges_doc'
    );

    $has_uploads = false;
    foreach ($document_types as $doc_type) {
        if (isset($_FILES[$doc_type]) && !empty($_FILES[$doc_type]['name'])) {
            $file = $_FILES[$doc_type];

            // Upload file
            $upload_dir = wp_upload_dir();
            $file_name = basename($file['name']);
            $target_file = $upload_dir['path'] . '/' . $file_name;

            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                $document_data[$doc_type] = $upload_dir['url'] . '/' . $file_name;
                $has_uploads = true;
            } else {
                wp_send_json_error("Failed to upload $doc_type");
                continue;
            }
        }
    }

    // If no files were uploaded, return error
    if (!$has_uploads) {
        wp_send_json_error('No new files were uploaded');
        return;
    }

    // Check if user already has documents
    $existing_docs = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM $user_documents_table WHERE user_id = %d",
        $user_id
    ));

    error_log('Existing docs check result: ' . print_r($existing_docs, true));

    if ($existing_docs) {
        // Update only the fields that have new uploads
        $result = $wpdb->update(
            $user_documents_table,
            $document_data,
            array('user_id' => $user_id)
        );
        error_log('Update operation result: ' . print_r($result, true));
        error_log('Update error: ' . $wpdb->last_error);
    } else {
        // For new insert, we need to provide default values for NOT NULL fields
        $document_data['reisepass_doc'] = isset($document_data['reisepass_doc']) ? $document_data['reisepass_doc'] : '';
        $document_data['geburtsurkunde_doc'] = isset($document_data['geburtsurkunde_doc']) ? $document_data['geburtsurkunde_doc'] : '';
        $document_data['hochschulzeugnis_doc'] = isset($document_data['hochschulzeugnis_doc']) ? $document_data['hochschulzeugnis_doc'] : '';
        $document_data['lebenslauf_doc'] = isset($document_data['lebenslauf_doc']) ? $document_data['lebenslauf_doc'] : '';
        $document_data['sonstiges_doc'] = isset($document_data['sonstiges_doc']) ? $document_data['sonstiges_doc'] : '';

        // Insert new record
        $result = $wpdb->insert(
            $user_documents_table,
            $document_data
        );
        error_log('Insert operation result: ' . print_r($result, true));
        error_log('Insert error: ' . $wpdb->last_error);
    }

    if ($result) {
        wp_send_json_success('Documents uploaded successfully');
    } else {
        $error_message = 'Failed to save document information. ';
        $error_message .= 'Database error: ' . $wpdb->last_error;
        $error_message .= ' Last query: ' . $wpdb->last_query;
        wp_send_json_error($error_message);
    }
}
add_action('wp_ajax_handle_user_documents_form', 'jahbulonn_handle_user_documents_form');
add_action('wp_ajax_nopriv_handle_user_documents_form', 'jahbulonn_handle_user_documents_form');

// Enqueue CSS & JS for the user dashboard
function jahbulonn_enqueue_user_dashboard_assets()
{
    // Enqueue CSS
    wp_enqueue_style('user-dashboard-style', get_stylesheet_directory_uri() . '/jahbulonn-user-dashboard/style.css', array(), fileatime(get_stylesheet_directory() . '/jahbulonn-user-dashboard/style.css'));
    // Enqueue JS
    wp_enqueue_script('user-dashboard-script', get_stylesheet_directory_uri() . '/jahbulonn-user-dashboard/script.js', array('jquery'), fileatime(get_stylesheet_directory() . '/jahbulonn-user-dashboard/script.js'), true);
}
add_action('wp_enqueue_scripts', 'jahbulonn_enqueue_user_dashboard_assets');

// Change username on dashboard
function jahbulonn_change_username()
{

    if (isset($_POST['change_display_name'])) {
        $new_display_name = sanitize_text_field($_POST['display_name']);
        $user_id = get_current_user_id();
        // Update the username
        wp_update_user(array('ID' => $user_id, 'display_name' => $new_display_name));
    }
}
add_action('init', 'jahbulonn_change_username');

// Change password on dashboard
function jahbulonn_change_password()
{
    if (isset($_POST['change_password'])) {
        $new_password = sanitize_text_field($_POST['password']);
        $user_id = get_current_user_id();

        if (!empty($new_password)) {
            wp_update_user(array('ID' => $user_id, 'user_pass' => $new_password));
            echo "<script>alert('Password updated successfully');</script>";
        }
    }
}
add_action('init', 'jahbulonn_change_password');

// Change profile picture on dashboard
function jahbulonn_change_profile_picture()
{
    if (isset($_POST['change_profile_picture']) && isset($_FILES['profile_picture'])) {
        $user_id = get_current_user_id();
        $profile_picture = $_FILES['profile_picture'];
        $upload_dir = wp_upload_dir();
        $file_name = basename($profile_picture['name']);
        $target_file = $upload_dir['path'] . '/' . $file_name;

        if (move_uploaded_file($profile_picture['tmp_name'], $target_file)) {
            $profile_picture_url = $upload_dir['url'] . '/' . $file_name;
            update_user_meta($user_id, 'profile_picture', $profile_picture_url);
        } else {
            echo "<script>alert('Error uploading file');</script>";
        }
    }
}
add_action('init', 'jahbulonn_change_profile_picture');

// Create chosen university table
function jahbulonn_create_chosen_university_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chosen_university';
    $charset_collate = $wpdb->get_charset_collate();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id mediumint(9) NOT NULL,
        department_name varchar(255) NOT NULL,
        university_name varchar(255) NOT NULL,
        university_application_status varchar(255),
        university_application_result varchar(255),
        university_application_document varchar(255),
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta($sql);
}
add_action('after_setup_theme', 'jahbulonn_create_chosen_university_table');

function jahbulonn_handle_chosen_university_form()
{
    check_ajax_referer('chosen_university_nonce', 'nonce');
    global $wpdb;
    $chosen_university_table = $wpdb->prefix . 'chosen_university';
    if (!is_user_logged_in()) {
        wp_send_json_error('User must be logged in to choose university');
        return;
    }
    $user_id = get_current_user_id();
    $department_name = sanitize_text_field($_POST['chosen_school']);
    $result = false;
    $delete_existing_university = $wpdb->delete($chosen_university_table, array('user_id' => $user_id));
    if (isset($_POST['chosen_school']) && $_POST['chosen_school'] == 'Humanmedizin') {

        $humanmedizin_universities = array(
            'humanmedizin_comenius_university' => 'Comenius Universität – Bratislava, Slowakei(H)',
            'humanmedizin_jessenius_university' => 'Jessenius Universität – Martin, Slowakei(H)',
            'humanmedizin_karlsuniversitat_prag' => 'Karlsuniversität Prag – Prag, Tschechien(H)',
            'humanmedizin_univerzita_karlova' => 'Univerzita Karlova – Prag, Tschechien(H)',
            'humanmedizin_semmelweis_university' => 'Semmelweis Universität – Budapest, Ungarn(H)',
            'humanmedizin_pecs_university' => 'University of Pécs – Pécs, Ungarn(H)',
            'humanmedizin_humanitas_university' => 'Humanitas Universität – Mailand, Italien(H)',
            'humanmedizin_split_university' => 'University of Split – Split, Kroatien(H)',
            'humanmedizin_pomeranian_university' => 'Pomeranian University – Szczecin, Polen(H)',
            'humanmedizin_frycz_university' => 'Andrzej Frycz Modrzewski Universität – Krakau, Polen(H)',
            'humanmedizin_victor_babes_university' => 'Victor Babes Universität – Timișoara, Rumänien(H)',
            'humanmedizin_cluj_napoca_university' => 'Cluj Napoca Universität – Cluj-Napoca, Rumänien(H)',
            'humanmedizin_carol_davila_university' => 'Carol Davila Universität – Bukarest, Rumänien(H)',
            'humanmedizin_varna_university' => 'University of Varna – Varna, Bulgarien(H)',
            'humanmedizin_stradins_university' => 'Stradins Universität – Riga, Lettland(H)',
        );
        foreach ($humanmedizin_universities as $university_name => $university_name_value) {
            if (isset($_POST[$university_name])) {
                $university_name = $university_name_value;
                $table_data = array(
                    'user_id' => $user_id,
                    'department_name' => $department_name,
                    'university_name' => $university_name,
                    'university_application_status' => '',
                    'university_application_result' => '',
                    'university_application_document' => '',
                );
                $result = $wpdb->insert($chosen_university_table, $table_data);
            }
        }

    } else if (isset($_POST['chosen_school']) && $_POST['chosen_school'] == 'Zahnmedizin') {
        $zahnmedizin_universities = array(
            'zahnmedizin_comenius_university' => 'Comenius Universität – Bratislava, Slowakei (Z)',
            'zahnmedizin_semmelweis_university' => 'Semmelweis Universität – Budapest, Ungarn (Z)',
            'zahnmedizin_pecs_university' => 'University of Pécs – Pécs, Ungarn (Z)',
            'zahnmedizin_pomeranian_university' => 'Pomeranian University – Szczecin, Polen (Z)',
            'zahnmedizin_frycz_university' => 'Andrzej Frycz Modrzewski Universität – Krakau, Polen (Z)',
            'zahnmedizin_cluj_napoca_university' => 'Cluj Napoca Universität – Cluj-Napoca, Rumänien (Z)',
            'zahnmedizin_carol_davila_university' => 'Carol Davila Universität – Bukarest, Rumänien (Z)',
            'zahnmedizin_varna_university' => 'University of Varna – Varna, Bulgarien (Z)',
            'zahnmedizin_stradins_university' => 'Stradins Universität – Riga, Lettland (Z)',
        );
        foreach ($zahnmedizin_universities as $university_name => $university_name_value) {
            if (isset($_POST[$university_name])) {
                $university_name = $university_name_value;
                $table_data = array(
                    'user_id' => $user_id,
                    'department_name' => $department_name,
                    'university_name' => $university_name,
                    'university_application_status' => '',
                    'university_application_result' => '',
                    'university_application_document' => '',
                );
                $result = $wpdb->insert($chosen_university_table, $table_data);
            }
        }
    } else if (isset($_POST['chosen_school']) && $_POST['chosen_school'] == 'Beides') {
        $beides_universities = array(
            'beides_comenius_university' => 'Comenius Universität – Bratislava, Slowakei (H,Z)',
            'beides_jessenius_university' => 'Jessenius Universität – Martin, Slowakei (H,Z)',
            'beides_karlsuniversitat_prag' => 'Karlsuniversität Prag – Prag, Tschechien (H,Z)',
            'beides_semmelweis_university' => 'Semmelweis Universität – Budapest, Ungarn (H,Z)',
            'beides_pecs_university' => 'University of Pécs – Pécs, Ungarn (H,Z)',
            'beides_humanitas_university' => 'Humanitas Universität – Mailand, Italien (H,Z)',
            'beides_split_university' => 'University of Split – Split, Kroatien (H,Z)',
            'beides_pomeranian_university' => 'Pomeranian University – Szczecin, Polen (H,Z)',
            'beides_frycz_university' => 'Andrzej Frycz Modrzewski Universität – Krakau, Polen (H,Z)',
            'beides_victor_babes_university' => 'Victor Babes Universität – Timișoara, Rumänien (H,Z)',
            'beides_cluj_napoca_university' => 'Cluj Napoca Universität – Cluj-Napoca, Rumänien (H,Z)',
            'beides_carol_davila_university' => 'Carol Davila Universität – Bukarest, Rumänien (H,Z)',
            'beides_varna_university' => 'University of Varna – Varna, Bulgarien (H,Z)',
            'beides_stradins_university' => 'Stradins Universität – Riga, Lettland (H,Z)',
        );
        foreach ($beides_universities as $university_name => $university_name_value) {
            if (isset($_POST[$university_name])) {
                $university_name = $university_name_value;
                $table_data = array(
                    'user_id' => $user_id,
                    'department_name' => $department_name,
                    'university_name' => $university_name,
                    'university_application_status' => '',
                    'university_application_result' => '',
                    'university_application_document' => '',
                );
                $result = $wpdb->insert($chosen_university_table, $table_data);
            }
        }
    }
    if ($result) {
        wp_send_json_success('University chosen successfully');
    } else {
        wp_send_json_error('Failed to choose university');
    }

}
add_action('wp_ajax_handle_chosen_university_form', 'jahbulonn_handle_chosen_university_form');
add_action('wp_ajax_nopriv_handle_chosen_university_form', 'jahbulonn_handle_chosen_university_form');


function jahbulonn_edit_users_info()
{
    global $wpdb;
    $users = $wpdb->get_results('SELECT * FROM wp_users');
    foreach ($users as $user) {
        $user_id = $user->ID;
        if (isset($_POST['edit_user_save' . $user_id])) {
            // Get the updated user data from POST
            $updated_data = array(
                'ID' => $user_id,
                'display_name' => sanitize_text_field($_POST['edit_display_name' . $user_id]),
                'user_pass' => sanitize_text_field($_POST['edit_password' . $user_id])
            );

            // Update the user
            $result = wp_update_user($updated_data);

            if (is_wp_error($result)) {
                echo $result->get_error_message();
            } else {
                echo "";
            }

            if (isset($_FILES['edit_profile_picture' . $user_id])) {
                $profile_picture = $_FILES['edit_profile_picture' . $user_id];
                $upload_dir = wp_upload_dir();
                $file_name = basename($profile_picture['name']);
                $target_file = $upload_dir['path'] . '/' . $file_name;

                // Check if file is an allowed type
                $allowed_types = array(
                    'image/png',
                    'image/jpeg',
                    'image/jpg',
                    'image/webp'
                );

                $file_type = wp_check_filetype($file_name);
                if (!in_array($file_type['type'], $allowed_types)) {
                    echo "<script>alert('Only PNG, JPG, JPEG, and WebP files are allowed for profile pictures');</script>";
                } else {
                    if (move_uploaded_file($profile_picture['tmp_name'], $target_file)) {
                        $profile_picture_url = $upload_dir['url'] . '/' . $file_name;
                        update_user_meta($user_id, 'profile_picture', $profile_picture_url);
                    } else {
                        echo "";
                    }
                }
            }

            $chosen_university_table = $wpdb->prefix . 'chosen_university';
            $chosen_universities = $wpdb->get_results("SELECT * FROM $chosen_university_table WHERE user_id = $user_id");

            foreach ($chosen_universities as $chosen_university) {
                $university_data = array(
                    "university_application_status" => sanitize_text_field($_POST['edit_university_application_status' . $user_id . '_' . $chosen_university->id]),
                    "university_application_result" => sanitize_text_field($_POST["edit_university_application_result" . $user_id . '_' . $chosen_university->id])
                );

                // Handle file upload for application document
                if (
                    isset($_FILES['edit_university_application_document' . $user_id . '_' . $chosen_university->id]) &&
                    !empty($_FILES['edit_university_application_document' . $user_id . '_' . $chosen_university->id]['name'])
                ) {

                    $file = $_FILES['edit_university_application_document' . $user_id . '_' . $chosen_university->id];
                    $upload_dir = wp_upload_dir();
                    $file_name = basename($file['name']);
                    $target_file = $upload_dir['path'] . '/' . $file_name;

                    // Check if file is an allowed type
                    $allowed_types = array(
                        'application/pdf',
                        'image/png',
                        'image/jpeg',
                        'image/jpg',
                        'image/webp'
                    );

                    $file_type = wp_check_filetype($file_name);
                    if (!in_array($file_type['type'], $allowed_types)) {
                        echo "Only PDF, PNG, JPG, JPEG, and WebP files are allowed for application documents";
                        continue;
                    }

                    if (move_uploaded_file($file['tmp_name'], $target_file)) {
                        $university_data["university_application_document"] = $upload_dir['url'] . '/' . $file_name;
                    } else {
                        echo "Failed to upload application document";
                        continue;
                    }
                }

                $condition = array(
                    "user_id" => $user_id,
                    "university_name" => $chosen_university->university_name
                );

                $university_update_result = $wpdb->update($chosen_university_table, $university_data, $condition);
                if (is_wp_error($university_update_result)) {
                    echo $university_update_result->get_error_message();
                } else {
                    echo "";
                }
            }
        }
    }
}
add_action("init", "jahbulonn_edit_users_info");

function jahbulonn_delete_user()
{
    global $wpdb;
    $users = $wpdb->get_results('SELECT * FROM wp_users');
    foreach ($users as $user) {
        if (isset($_POST['delete_user' . $user->ID])) {
            wp_delete_user($user->ID);
            $table = $wpdb->prefix . 'register1'; // e.g., wp_custom_data
            $where = ['user_id' => $user->ID];
            $wpdb->delete($table, $where);
        }
    }
}
add_action('init', 'jahbulonn_delete_user');

function jahbulonn_handle_forgot_password()
{
    // Verify nonce
    check_ajax_referer('forgot_password_nonce', 'nonce');

    // Get and sanitize the email
    $forgot_password_mail = isset($_POST['forgot_password_mail']) ? sanitize_email($_POST['forgot_password_mail']) : '';

    if (empty($forgot_password_mail)) {
        wp_send_json_error('Please enter an email address');
        return;
    }

    // Check if the email exists
    $user = get_user_by('email', $forgot_password_mail);

    if ($user) {
        // Generate a unique reset token
        $reset_token = wp_generate_password(20, false);

        // Save the token in user meta (you can set an expiration time, e.g., 1 hour)
        update_user_meta($user->ID, '_password_reset_token', $reset_token);
        update_user_meta($user->ID, '_password_reset_token_expiry', time() + 3600); // Token expires in 1 hour

        // Construct the custom reset link with token
        $reset_link = home_url() . "/reset-password/?token=" . $reset_token . "&user=" . urlencode($user->user_login);

        // Send the custom reset email
        $subject = 'Password Reset Request';
        $message = 'Hello, click the link to reset your password: ';
        $message .= '<a href="' . esc_url($reset_link) . '">' . esc_html($reset_link) . '</a>';

        $headers = array(
            'From' => 'raiyannooryrady@gmail.com',
            'Content-Type' => 'text/html; charset=UTF-8',
        );

        // Use wp_mail() for email sending
        if (wp_mail($user->user_email, $subject, $message, $headers)) {
            wp_send_json_success('Password reset email sent. Please check your inbox.');
        } else {
            wp_send_json_error('Failed to send password reset email. Please try again later.');
        }
    } else {
        wp_send_json_error('No account exists with this email address.');
    }

    wp_die(); // Always die in ajax functions
}
add_action('wp_ajax_handle_forgot_password', 'jahbulonn_handle_forgot_password');
add_action('wp_ajax_nopriv_handle_forgot_password', 'jahbulonn_handle_forgot_password');
