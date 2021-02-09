<?php
/**
 * Plugin settings page
 */
function wpvcps_cpt_vertical_scroller_settings() {

    // register a new section
    add_settings_section(
        'wpvcps_settings_field_section',
        __('WP Vertical CPT Scroller Settings', 'wpv-cp-sc'), 'wpvcps_settings_field_section_text',
        'wpvcps_settings_section'
    );

    // register a new field select post type
    add_settings_field(
        'wpvcps_cpt_select_value',
        __('Select Post Type','wpv-cp-sc'), 'wpvcps_select_cpt_field_callback',
        'wpvcps_settings_section',
        'wpvcps_settings_field_section'
    );
    // register a new field settings for select post type
    register_setting('wpvcps_settings_field_section', 'wpvcps_cpt_select_value');


    // register a new field number of post
    add_settings_field(
        'wpvcps_cpt_no_of_post',
        __('Number of Latest Post','wpv-cp-sc'), 'wpvcps_no_of_post_field_callback',
        'wpvcps_settings_section',
        'wpvcps_settings_field_section'
    );
    // register a new field settings number of post
    register_setting('wpvcps_settings_field_section', 'wpvcps_cpt_no_of_post');

}

add_action('admin_init', 'wpvcps_cpt_vertical_scroller_settings');


//Select post type field
function wpvcps_select_cpt_field_callback(){
    $wpvcps_cpt_val = get_option('wpvcps_cpt_select_value');

    //Get all post types
    $post_types_args = array(
        'public' => true,
    );
    $post_types = get_post_types( $post_types_args, 'objects' );
    ?>
    <select class="widefat" name="wpvcps_cpt_select_value">
        <?php foreach ( $post_types as $post_type_obj ):
            $labels = get_post_type_labels( $post_type_obj );
            ?>
            <option value="<?php echo esc_attr( $post_type_obj->name ); ?>" <?php echo ($wpvcps_cpt_val == $post_type_obj->name) ? 'selected' : ''; ?> ><?php echo esc_html( $labels->name ); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}


//Number of input fields
function wpvcps_no_of_post_field_callback(){
    $wpvcps_cpt_no_of_post = empty(get_option('wpvcps_cpt_no_of_post')) ? '5' : get_option('wpvcps_cpt_no_of_post');
    printf('<input name="wpvcps_cpt_no_of_post" type="number" class="regular-text" value="%s"/>', $wpvcps_cpt_no_of_post);
}

//Plugin settings page section text
function wpvcps_settings_field_section_text() {
    printf('%s %s %s', '<p>', __('Plese select post type from here', 'wpv-cp-sc'), '</p>');
}


//Register plugin admin menu
add_action('admin_menu', 'wplalr_login_logout_redirect_menu');
function wplalr_login_logout_redirect_menu() {
    add_menu_page(__('WP Vertical CPT Scroller', 'wpv-cp-sc'), __('Verticle Scroll', 'wpv-cp-sc'), 'manage_options', 'wpvcps_vertical_scroll', 'wpvcps_vertical_scroll_settings_form', 'dashicons-align-wide');
}


//Plugin options form
function wpvcps_vertical_scroll_settings_form(){
    settings_errors();
    ?>
    <form action="options.php" method="POST">
        <?php do_settings_sections('wpvcps_settings_section');?>
        <?php settings_fields('wpvcps_settings_field_section');?>
        <?php submit_button();?>
    </form>

    <div class="wpvcps-shortcode-container">
        <h3>Copy below shortcode and paste inside any page or text widget.</h3>
        <textarea style="text-align:left" cols="50" rows="3" onclick="this.focus(); this.select()">[wpvcps_scroll]</textarea>
    </div>
<?php }