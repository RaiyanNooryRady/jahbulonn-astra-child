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

    // Additional styles
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css');
    wp_enqueue_style('login-custom', get_stylesheet_directory_uri() . '/assets/css/login.css');

    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css');
    wp_enqueue_style('meteor', get_stylesheet_directory_uri() . '/assets/css/meteor.min.css');
    wp_enqueue_style('simple-line', get_stylesheet_directory_uri() . '/assets/plugins/line-icons/simple-line-icons.css');
    wp_enqueue_style('dark-layer', get_stylesheet_directory_uri() . '/assets/css/layers/dark-layer.css');
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/plugins/fontawesome/css/font-awesome.min.css');

    // JavaScript files
    wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri() . '/assets/plugins/jquery-ui/jquery-ui.min.js', array('jquery'), null, true);
    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/assets/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), null, true);
    wp_enqueue_script('waves', get_stylesheet_directory_uri() . '/assets/plugins/waves/waves.min.js', array('jquery'), null, true);
    wp_enqueue_script('meteor', get_stylesheet_directory_uri() . '/assets/js/meteor.min.js', array('jquery'), null, true);
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
        wp_redirect(home_url('/user-dashboard/'));
        exit;
    }
});

// Redirect non-logged-in users away from user-dashboard
function restrict_dashboard_access()
{
    if (is_page_template('user-dashboard.php') && !is_user_logged_in()) {
        wp_redirect(home_url('/user-login/')); // Redirect to login page
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
            return home_url('/user-dashboard/');
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
            $dashboard_url = site_url('/user-dashboard/');
            $logout_url = wp_logout_url(site_url('/user-login/')); // Redirect after logout

            $items .= '<li class="menu-item"><a href="' . esc_url($dashboard_url) . '">Dashboard</a></li>';
        }
    } else {
        $login_url = site_url('/user-login/');
        $register_url = site_url('/user-register/');

        $items .= '<li class="menu-item"><a href="' . esc_url($login_url) . '">Login</a></li>';
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'custom_user_menu_item', 10, 2);

// -----------------------------------------------------------------------------------------------------------------------------

// Enqueue CSS & JS for the form
function jahbulonn_custom_register_form_assets()
{
    // Enqueue the register.js file
    wp_enqueue_script('custom-register-script', get_stylesheet_directory_uri() . '/register.js', array('jquery'), null, true);

    wp_localize_script('custom-register-script', 'reg_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'register_nonce' => wp_create_nonce('register_nonce'),
        'login_nonce' => wp_create_nonce('login_nonce'),
        'pdf_document_nonce' => wp_create_nonce('pdf_document_nonce'),
        'user_documents_nonce' => wp_create_nonce('user_documents_nonce')
    ));
    // Enqueue the registration-portal.js file
    wp_enqueue_script('registration-portal-script', get_stylesheet_directory_uri() . '/registration-portal.js', array('jquery'), null, true);
 
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
        wp_send_json_success('Registration successful!');
    } else {
        wp_send_json_error('DB error: ' . $wpdb->last_error);
    }
}
add_action('wp_ajax_handle_register_form', 'jahbulonn_handle_register_form');
add_action('wp_ajax_nopriv_handle_register_form', 'jahbulonn_handle_register_form');


function jahbulonn_handle_login_form(){
    check_ajax_referer('login_nonce', 'nonce');
    $info=array();
    if(isset($_POST['username'])){
        $info['user_login'] = sanitize_text_field($_POST['username']);
    }
    if(isset($_POST['password'])){
        $info['user_password'] = sanitize_text_field($_POST['password']);
    }
    if(is_email($info['user_login'])){
        $user_data=get_user_by('email', $info['user_login']);
        if($user_data){
            $info['user_login']=$user_data->user_login; //use username to login
        }
        else{
            wp_send_json_error('No user found with that email address.');
        }
    }
    $user_verify = wp_signon($info, false);
    if(is_wp_error($user_verify)){
        wp_send_json_error('Invalid username or password');
    }else{
        wp_send_json_success('Login successful');
       // wp_redirect(home_url('/user-dashboard/'));
        exit;
    }

}
add_action('wp_ajax_handle_login_form', 'jahbulonn_handle_login_form');
add_action('wp_ajax_nopriv_handle_login_form', 'jahbulonn_handle_login_form');
//---------------------------------------------------------------------------------------------------------------------------------

function jahbulonn_create_pdf_document_table() {
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

function jahbulonn_handle_pdf_document_form() {
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

function jahbulonn_create_user_documents_table() {
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

function jahbulonn_handle_user_documents_form() {
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

