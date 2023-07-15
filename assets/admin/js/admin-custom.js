jQuery(document).ready(function($) {
  $('#upload_logo_button').click(function(e) {
    e.preventDefault();
    var mediaUploader = wp.media({
      title: 'Upload Logo',
      button: { text: 'Use this image' },
      multiple: false
    });

    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();

      $('#logo_image_url').val(attachment.url);

      // Show the uploaded image preview
      $('#logo_preview').show();
      $('#logo_image').attr('src', attachment.url);
    });

    mediaUploader.open();
  });

  $('#remove_logo_button').click(function(e) {
    e.preventDefault();
    $('#logo_image_url').val('');
    $('#logo_preview').hide();
    // Don't hide the remove button
  });

  // Show or hide the remove button based on the logo presence
  if ($('#logo_image').attr('src')) {
    $('#remove_logo_button').show();
  } else {
    $('#remove_logo_button').hide();
  }

  // Update the image preview when a file is selected
  $('#logo_image_url').change(function() {
    var imageUrl = $(this).val();
    $('#logo_image').attr('src', imageUrl);
  });
});
jQuery(document).ready(function($) {
  // Add More button click event
  $('#add_social_link_button').on('click', function(e) {
    e.preventDefault();

    var socialLinksCount = $('.social_link_item').length;
    if (socialLinksCount >= 4) {
      alert('You can only add 4 social links.')
      return; // Exit the function if the limit is reached
    }

    var template = $('.social_link_item_template').clone();
    template.removeClass('social_link_item_template').addClass('social_link_item').show();
    template.find('.remove_social_link_button').on('click', removeSocialLink);
    $('#social_links_container').append(template);
  });

  // Remove button click event
  function removeSocialLink(e) {
    e.preventDefault();
    $(this).closest('.social_link_item').remove();
  }
  $(document).on('click', '.remove_social_link_button', removeSocialLink);
});






