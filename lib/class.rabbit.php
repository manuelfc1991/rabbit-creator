<?php

class Rabbit {
    public static function rabbit_init() {
        if(is_admin())
        {
            self::rabbit_config();
        }
        self::rabbit_front();
    }
    public static function rabbit_front()
    {

    }
    public static function rabbit_config()
    {
        self::rabbit_navbar();
        self::rabbit_asset();
        self::rabbit_pages();
    }
    public static function rabbit_navbar() {
        // function rabbit_header_menubar() {
        //     global $wp_admin_bar;
        
        //     // Change 'My Plugin' and 'My Plugin Link' to your plugin name and the link text you prefer.
        //     $wp_admin_bar->add_menu(
        //         array(
        //             'id' => 'rabbit-creator',
        //             'title' => 'Rabbit Creator',
        //             'href' => admin_url('admin.php?page=rabbit-dashboard'), // Replace 'my-plugin-page' with your plugin's admin page slug.
        //         )
        //     );
        
        //     // Add a sub-menu item
        //     $wp_admin_bar->add_menu(
        //         array(
        //             'id' => 'rabbit-submenu',
        //             'parent' => 'rabbit-creator', // This should match the 'id' of the parent menu
        //             'title' => 'Submenu Item',
        //             'href' => admin_url('admin.php?page=rabbit-submenu'), // Replace with the URL for your submenu
        //         )
        //     );
        // }
        // add_action('admin_bar_menu', 'rabbit_header_menubar', 999);
    }
    public static function rabbit_asset() {
        function  rabbit_plugin_script_style() {
            wp_register_style('rabbit_admin', RC_PLUGIN_URL. 'assets/css/rabbit-1.css');
            wp_enqueue_style('rabbit_admin');
        
            wp_register_style('rabbit_datatables_style', RC_PLUGIN_URL. 'assets/datatables/datatables.min.css');
            wp_enqueue_style('rabbit_datatables_style');
        
            wp_enqueue_script('jquery');
            wp_register_script( 'rabbit_datatables_script', RC_PLUGIN_URL. 'assets/datatables/datatables.min.js');
            wp_enqueue_script( 'rabbit_datatables_script' );	
        }
        add_action( 'admin_enqueue_scripts', 'rabbit_plugin_script_style' );
    }
    public static function rabbit_pages() {
        add_menu_page('Dashbord', 'Rabbit Creator', 'edit_posts', 'rabbit-dashboard', 'rabbit_dashboard', 'dashicons-admin-site-alt3');
        function rabbit_dashboard(){
            global $wpdb;
            require_once RC_PLUGIN_BASE_DIR. 'pages/rabbit-dashboard.php';
        }
    }
    public static function rabbit_activation() {
        global $wpdb;
        try
        {
            dbDelta("CREATE TABLE `".$wpdb->prefix. "rabbit_creator_template` (
                `template_id` bigint(20) NOT NULL AUTO_INCREMENT,
                `template_name` varchar(250) NOT NULL,
                `template_post_type` varchar(250) NOT NULL,
                `template_post_author` bigint(20) NOT NULL,
                `template_post_title` varchar(250) NOT NULL,
                `template_post_content` longtext NOT NULL,
                `template_data_file` varchar(250) NOT NULL,
                `template_data_file_skip_row` VARCHAR(10) NOT NULL,
                `template_placeholder` text NOT NULL,
                `template_data_column` text NOT NULL,
                `template_post_date_column` text NOT NULL,
                `template_post_ids` LONGTEXT NOT NULL,
                `template_post_ids_temp` LONGTEXT NOT NULL, 
                `template_category` TEXT NOT NULL,
                `template_tag` TEXT NOT NULL,
                `template_post_slug_column` TEXT NOT NULL,
                `template_page_template` TEXT NOT NULL,
                `template_parent_page` INT NOT NULL,
                `template_post_status` TEXT NOT NULL,
                `template_seo_title` TEXT NOT NULL,
                `template_seo_description` TEXT NOT NULL,
                `template_seo_focus_keyword` TEXT NOT NULL,
                `template_featured_image_column` text NOT NULL,
                `template_featured_image_alt_column` INT NOT NULL,
                `template_featured_image_title_column` INT NOT NULL,
                `template_featured_image_caption_column` INT NOT NULL,
                `template_featured_image_description_column` INT NOT NULL,
                `template_keyword` TEXT NOT NULL,
                `template_robots_meta` TEXT NOT NULL,
                `template_parent_page_column` TEXT NOT NULL,
                `template_datetime` datetime NOT NULL,
                `template_csv_rows` LONGTEXT NOT NULL,
                `template_csv_data` LONGTEXT NOT NULL,
                `template_status` ENUM('publish','draft') NOT NULL DEFAULT 'publish',
                `template_processing_pointer` BIGINT NOT NULL,
                PRIMARY KEY (`template_id`)
            );");

            dbDelta("CREATE TABLE `".$wpdb->prefix. "rabbit_creator` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `option_name` text NOT NULL,
                `option_value` text NOT NULL,
                `status` enum('Y','N') NOT NULL DEFAULT 'Y',
                PRIMARY KEY (`id`)
            );");

            dbDelta("CREATE TABLE `".$wpdb->prefix. "rabbit_creator_pages` (
                `page_id` bigint(20) NOT NULL AUTO_INCREMENT,
                `post_id` bigint(20) NOT NULL,
                `template_id` bigint(20) NOT NULL,
                `created_date` datetime NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY (`page_id`)
            );");
        } 
        catch (Exception $e) {}	
    }
}