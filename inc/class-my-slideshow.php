<?php
/**
 * @version 1.0.0
 * This class creates the Admin Settings and Product Labels settings
 */
class My_Slideshow
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'my_slideshow_menu'));
        add_action('admin_enqueue_scripts', array($this, 'my_slideshow_admin_scripts'));
        add_action('admin_init', array($this, 'my_slideshow_settings'));

    }

    public function my_slideshow_menu()
    {
        add_menu_page(
            __('My Slideshow Settings', 'acquaint-crm'),
            __('My Slideshow', 'acquaint-crm'),
            'manage_options',
            'my-slideshow-settings',
            array($this, 'my_slideshow_settings_page'),
            'dashicons-format-gallery'
        );
    }

    public function my_slideshow_admin_scripts($setting)
    {
        if ($setting != 'toplevel_page_my-slideshow-settings'){
          return;  
        } 
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('admin-script', MY_SLIDESHOW_URL . 'admin/assets/js/admin-script.js', array('jquery', 'jquery-ui-sortable'), MY_SLIDESHOW_VERSION, true);
        wp_enqueue_style('admin-style', MY_SLIDESHOW_URL . 'admin/assets/css/admin-style.css');
    }

    public function my_slideshow_settings_page()
    {
        require_once MY_SLIDESHOW_PATH . 'admin/partials/my-slideshow-admin-display.php';
    }

    public function my_slideshow_settings()
    {
        register_setting('my-slideshow-settings-group', 'my_slideshow_images');
    }
}

new My_Slideshow();