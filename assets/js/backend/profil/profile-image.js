document.addEventListener('DOMContentLoaded', function () {

    var mediaUploader;
    var uploadButton = document.querySelector('#upload_profile_picture_button');
    var profilePictureInput = document.querySelector('#profile_picture');

    uploadButton.addEventListener('click', function (e) {
        e.preventDefault();

        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Create the media uploader object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Upload Profile Picture',
            button: {
                text: 'Upload Picture'
            },
            multiple: false
        });

        // When a file is selected, grab the URL and set it as the text field's value
        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            profilePictureInput.value = attachment.url;
        });

        // Open the uploader dialog
        mediaUploader.open();
    });

});

