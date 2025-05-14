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
    wp_redirect(home_url('/user-login/')); // Redirect to login page after logout
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
function custom_register_form_assets()
{
    // Enqueue the register.js file
    wp_enqueue_script('custom-register-script', get_stylesheet_directory_uri() . '/register.js', array('jquery'), null, true);

    wp_localize_script('custom-register-script', 'reg_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('register_nonce')
    ));
    // Enqueue the registration-portal.js file
    wp_enqueue_script('registration-portal-script', get_stylesheet_directory_uri() . '/registration-portal.js', array('jquery'), null, true);
 
}
add_action('wp_enqueue_scripts', 'custom_register_form_assets');

// Create both database tables
function create_registration_tables()
{
    global $wpdb;
    $first_table = $wpdb->prefix . 'register1';
    $charset_collate = $wpdb->get_charset_collate();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql1 = "CREATE TABLE $first_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        vorname varchar(255) NOT NULL,
        nachname varchar(255) NOT NULL,
        username varchar(100) NOT NULL unique,
        email varchar(100) NOT NULL unique,
        password varchar(255) NOT NULL,
        telefon varchar(20),
        address varchar(250) NOT NULL,
        pdf_file varchar(250) NOT NULL,
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
add_action('after_setup_theme', 'create_registration_tables');

// Shortcode for the form
// function custom_register_form_shortcode()
// {
//     ob_start(); ?>
// <?php //include_once get_stylesheet_directory() . 'register_2.php'; ?>
//
<?php
//     return ob_get_clean();
// }
// add_shortcode('custom_register_form', 'custom_register_form_shortcode');

// Handle AJAX
function handle_register_form()
{
    check_ajax_referer('register_nonce', 'nonce');

    global $wpdb;

    $first_table = $wpdb->prefix . 'register1';
    // $second_table = $wpdb->prefix . 'registered_second';

    // Sanitize and collect data
    $first_data = [
        'vorname' => sanitize_text_field($_POST['vorname']),
        'nachname' => sanitize_text_field($_POST['nachname']),
        'username' => sanitize_text_field($_POST['username']),
        'email' => sanitize_email($_POST['email']),
        'password' => sanitize_text_field($_POST['password']),
        'telefon' => sanitize_text_field($_POST['telefon']),
        'address' => sanitize_text_field($_POST['address']),
        'pdf_file' => '', // default empty, will be set below if uploaded
        'plz' => sanitize_text_field($_POST['plz']),
        'stadt' => sanitize_text_field($_POST['stadt']),
        'land' => sanitize_key($_POST['land']),
        'newsletter1' => isset($_POST['newsletter1']) ? 1 : 0,
        'newsletter2' => isset($_POST['newsletter2']) ? 1 : 0,
    ];

    // Handle PDF file upload
    if (isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])) {
        $upload_dir = wp_upload_dir();
        $target_file = $upload_dir['path'] . '/' . basename($_FILES['pdf_file']['name']);

        if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $target_file)) {
            $first_data['pdf_file'] = $upload_dir['url'] . '/' . basename($_FILES['pdf_file']['name']);
        } else {
            wp_send_json_error('Failed to upload PDF file');
            return;
        }
    }

    // Insert data into the database
    $inserted = $wpdb->insert($first_table, $first_data);

    if ($inserted) {
        wp_send_json_success('Registration successful!');
    } else {
        wp_send_json_error('DB error: ' . $wpdb->last_error);
    }
}
add_action('wp_ajax_handle_register_form', 'handle_register_form');
add_action('wp_ajax_nopriv_handle_register_form', 'handle_register_form');

//---------------------------------------------------------------------------------------------------------------------------------

