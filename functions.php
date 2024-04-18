<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

	wp_enqueue_script('main', get_theme_file_uri('/assets/js/main.js'), array('jquery'), true);

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );



// Flash Permalink 


flush_rewrite_rules( false );


// Create a table on database
function contact_form_submissions_create() {

    global $wpdb;
    $table_name = $wpdb->prefix. "contact_form_submissions";
    global $charset_collate;
    $charset_collate = $wpdb->get_charset_collate();
    global $db_version;
	
    if( $wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") !=  $table_name)
    {   $create_sql = "CREATE TABLE $table_name (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255),
            surname VARCHAR(255),
            phone VARCHAR(20),
            email VARCHAR(255),
            package VARCHAR(255),
            submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) $charset_collate;";
		require_once(ABSPATH . "wp-admin/includes/upgrade.php");
    	dbDelta( $create_sql );
    }
    


    //register the new table with the wpdb object
    if (!isset($wpdb->contact_form_submissions))
    {
        $wpdb->contact_form_submissions = $table_name;
        
        $wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
    }

}
add_action( 'init', 'contact_form_submissions_create');


// Form data store
add_action('admin_post_submit_contact_form', 'handle_contact_form_submission');
add_action('admin_post_nopriv_submit_contact_form', 'handle_contact_form_submission');

function handle_contact_form_submission() {
    global $wpdb;

    // Check if the form data has been submitted
    if (isset($_POST['action']) && $_POST['action'] === 'submit_contact_form') {

        $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
        $surname = isset($_POST['surname']) ? sanitize_text_field($_POST['surname']) : '';
        $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
        $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $package = isset($_POST['package']) ? sanitize_text_field($_POST['package']) : '';

        // Insert data into the database
        $table_name = $wpdb->prefix . 'contact_form_submissions';
        $wpdb->insert(
            $table_name,
            array(
                'first_name' => $first_name,
                'surname' => $surname,
                'phone' => $phone,
                'email' => $email,
                'package' => $package,
            )
        );

        // Redirect the user back to the contact page after form submission
        wp_redirect(home_url('/thank-you'));
        exit;
    }
}



// Create a custom admin menu
add_action('admin_menu', 'register_custom_admin_page');

function register_custom_admin_page() {
    add_management_page(
        'Submitted Contact Forms',
        'Contact Form Submissions',
        'manage_options',
        'contact-form-submissions',
        'display_contact_form_submissions'
    );
}




// Display the booking info to  admin page
function display_contact_form_submissions() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'contact_form_submissions';
    $submissions = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    
    ?>
    <div class="wrap">
        <h1>Contact Form Submissions</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Package</th>
                    <th>Submission Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submissions as $submission) : ?>
                    <tr>
                        <td><?php echo esc_html($submission['first_name']); ?></td>
                        <td><?php echo esc_html($submission['surname']); ?></td>
                        <td><?php echo esc_html($submission['phone']); ?></td>
                        <td><?php echo esc_html($submission['email']); ?></td>
                        <td><?php echo esc_html($submission['package']); ?></td>
                        <td><?php echo esc_html($submission['submission_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}


