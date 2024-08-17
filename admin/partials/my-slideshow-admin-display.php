<?php
/**
 * Provide a admin area view for the plugin
 * @since      1.0.0
 * @package    my-slideshow
 * @subpackage my-slideshow/admin/partials
 */
?>
<div class="wrap">
    <h1><?php esc_attr_e('My Slideshow Settings','my-slideshow'); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('my-slideshow-settings-group');
        $image_ids = get_option('my_slideshow_images');
        if (!is_array($image_ids)) {
            $image_ids = [];
        }
        $images = array_map(function ($id) {
            $src = wp_get_attachment_image_src($id, 'thumbnail');
            return $src ? $src[0] : '';
        }, $image_ids); ?>
        <section>
            <div class="main-container">
                <fieldset>
                    <input type="button" id="upload_image_button" value="<?php esc_attr_e('Add Images', 'my-slideshow'); ?>"/>
                    <ul class="grid-wrapper" id="sortable-images">
                    <?php foreach ($image_ids as $image) : ?>
                        <?php if ($image): ?>
                            <li class="ui-state-default" data-id="<?php echo esc_attr($image); ?>">
                                <img src="<?php echo esc_url($image); ?>" style="max-width: 150px;"/>
                                <input type="hidden" name="my_slideshow_images[]"
                                       value="<?php echo esc_attr($image); ?>"/>
                                <a href="javascript:void(0)" class="remove-image"></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <?php submit_button(); ?>
                </fieldset>
            </div>
        </section>
    </form>
</div>