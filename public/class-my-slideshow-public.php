<?php
/**
 * @version 1.0.0
 * This class creates the Public Settings and Product Labels settings
 */
class My_Slideshow_Public
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'my_slideshow_public_scripts'));
        add_shortcode('myslideshow', array($this, 'myslideshow_public_shortcode'));
    }

    public function myslideshow_public_shortcode()
    {
        $output = '';
        $image_ids = get_option('my_slideshow_images');
        if (!is_array($image_ids)) {
            $image_ids = [];
        }
        if (empty($image_ids)) {
            return '<p>' . esc_html__('No images found for the slideshow.', 'my-slideshow') . '</p>';
        }
        $images = array_map(function ($id) {
            $src = wp_get_attachment_image_src($id, 'full'); 
            return $src ? $src[0] : '';
        }, $image_ids);
        if(!empty($image_ids)){
            $output .= '<div class="wrapper_slider">';
            $output .= '<div class="my-slider">';
            foreach ($image_ids as $image) {
                $output .= '<div><img src="' . esc_url($image) . '" alt="' . esc_attr__('Slide Image', 'my-slideshow') . '" style="max-width: 100%;"></div>';
            }
            $output .= '</div>';
            $output .= '</div>';
        }
        return $output;
    }

    public function my_slideshow_public_scripts()
    {
        if (is_singular()) {
            wp_enqueue_style('my-slideshow-slick-style', MY_SLIDESHOW_URL . 'lib/slick/css/slick.css', [], MY_SLIDESHOW_VERSION);
            wp_enqueue_style('my-slideshow-slick-theme-mini', MY_SLIDESHOW_URL . 'lib/slick/css/slick-theme.min.css', [], MY_SLIDESHOW_VERSION);
            wp_enqueue_style('my-slideshow-public-custom-style', MY_SLIDESHOW_URL . 'public/assets/css/my-slideshow.css', [], MY_SLIDESHOW_VERSION);
            wp_enqueue_script('my-slideshow-slick-script', MY_SLIDESHOW_URL . 'lib/slick/js/slick.min.js', array('jquery'), MY_SLIDESHOW_VERSION, true);
            wp_enqueue_script('my-slideshow-public-custom-script', MY_SLIDESHOW_URL . 'public/assets/js/my-slideshow.js', array('jquery', 'my-slideshow-slick-script'), MY_SLIDESHOW_VERSION, true);
        }
    }
}

new My_Slideshow_Public();