(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    /*Media Button Uploader*/
    var mediaUploader;
    $('#upload_image_button').click(function (e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media({
            title: 'Select Images',
            button: {text: 'Use these images'},
            multiple: true
        });
        mediaUploader.on('select', function () {
            var attachments = mediaUploader.state().get('selection').toJSON();
            attachments.forEach(function (attachment) {
                var img = '<li class="ui-state-default" data-src="' + attachment.url + '">' +
                    '<img src="' + attachment.url + '" style="max-width: 150px;"/>' +
                    '<input type="hidden" name="my_slideshow_images[]" value="' + attachment.url + '"/>' +
                    '<a href="javascript:void(0)" class="remove-image"></a>' +
                    '</li>';
                $('#sortable-images').append(img);
            });
        });
        mediaUploader.open();
    });

    /* Sortable images */
    $('#sortable-images').sortable();

    /* Remove image button */
    $(document).on('click', '.remove-image', function () {
        $(this).closest('li').remove();
    });

})(jQuery);