<?php 
/************************
* Theme settings options*
*************************/
// Add a new item to the WordPress admin menu
function theme_options_page() {
  add_theme_page(
    'Theme Options',     // Page title
    'Theme Options',     // Menu title
    'manage_options',    // Capability required to access the page
    'theme-options',     // Menu slug
    'theme_options_content'  // Callback function to display the page content
  );
}
add_action('admin_menu', 'theme_options_page');

// Callback function to display the theme options page content
function theme_options_content() {
  ?>
  <div class="wrap">
    <h1>Theme Options</h1>
    <form method="post" action="options.php">
      <?php
        settings_fields('theme_options');
        do_settings_sections('theme_options');
        submit_button();
      ?>
    </form>
  </div>
  <?php
}
// Register and initialize the theme options
function theme_options_init() {
  // Register a settings group
  register_setting('theme_options', 'theme_options');

  // Add a section for general settings
  add_settings_section(
    'general_settings',
    'General Settings',
    'general_settings_callback',
    'theme_options'
  );

  // Add fields to the general settings section
  add_settings_field(
    'logo',
    'Logo',
    'logo_callback',
    'theme_options',
    'general_settings'
  );

  add_settings_field(
    'phone_number',
    'Phone Number',
    'phone_number_callback',
    'theme_options',
    'general_settings'
  );

  add_settings_field(
    'address',
    'Address',
    'address_callback',
    'theme_options',
    'general_settings'
  );

  add_settings_field(
    'fax_number',
    'Fax Number',
    'fax_number_callback',
    'theme_options',
    'general_settings'
  );
  echo ''; 
  add_settings_field(
    'social_links',
    'Social Media Links <br>Here you can find the social icons just <a href="https://fontawesome.com/v4/icons/" target="_blank"> click it</a>',
    'social_links_callback',
    'theme_options',
    'general_settings'
  );
}
add_action('admin_init', 'theme_options_init');

// Callback function for the general settings section
function general_settings_callback() {
  echo 'Update the general settings below:';
}

// Callback function for the logo field

function logo_callback() {
  $options = get_option('theme_options');
  $logo_url = isset($options['logo']) ? $options['logo'] : '';

  echo '<input type="hidden" id="logo_image_url" name="theme_options[logo]" value="' . esc_attr($logo_url) . '" />';
  
  if (!empty($logo_url)) {
    echo '<div id="logo_preview"><img id="logo_image" src="' . esc_url($logo_url) . '" alt="Logo Preview" style="max-width: 200px; height: auto; margin-bottom: 20px;" /></div>';
    echo '<p><input type="button" id="remove_logo_button" class="button" value="Remove Logo" /></p>';
  } else {
    echo '<div id="logo_preview" style="display: none;"><img id="logo_image" src="" alt="Logo Preview" style="max-width: 200px; height: auto; margin-bottom: 20px;" /></div>';
    echo '<p><input type="button" id="upload_logo_button" class="button" value="Upload Logo" /></p>';
  }

  echo '<p class="description">Click "Upload Logo" to select an image from your computer, or "Remove Logo" to delete the current logo.</p>';
}






// Callback function for the phone number field
function phone_number_callback() {
  $options = get_option('theme_options');
  $phone_number = isset($options['phone_number']) ? $options['phone_number'] : '';

  echo '<input type="text" name="theme_options[phone_number]" value="' . esc_attr($phone_number) . '" />';
}

// Callback function for the address field
function address_callback() {
  $options = get_option('theme_options');
  $address = isset($options['address']) ? $options['address'] : '';

  echo '<textarea name="theme_options[address]" rows="5">' . esc_textarea($address) . '</textarea>';
}

// Callback function for the fax number field
function fax_number_callback() {
  $options = get_option('theme_options');
  $fax_number = isset($options['fax_number']) ? $options['fax_number'] : '';

  echo '<input type="text" name="theme_options[fax_number]" value="' . esc_attr($fax_number) . '" />';
}

// Callback function for the social links field
function social_links_callback() {
  $options = get_option('theme_options');
  $social_links = isset($options['social_links']) ? $options['social_links'] : array();

  echo '<div id="social_links_container">';

  $count = 0;
  foreach ($social_links as $index => $link) {
    if ($count >= 4) {
      break; // Exit the loop if the limit is reached
    }
    echo '<div class="social_link_item">';
    echo '<input type="text" name="theme_options[social_links][]" placeholder="Enter the social media link" value="' . esc_attr($link) . '" />';
    echo '<input type="text" name="theme_options[social_links_images][]" placeholder="Find the icon click the below "social media link"" value="' . esc_attr($options['social_links_images'][$index]) . '" />';
    echo '<button class="remove_social_link_button">Remove</button>';
    echo '</div>';
    $count++;
  }

  if ($count < 4) {
    echo '<div class="social_link_item_template" style="display: none;">';
    echo '<input type="text" name="theme_options[social_links][]" value="" placeholder="Enter the social media link" />';
    echo '<input type="text" name="theme_options[social_links_images][]" value="" placeholder="Enter the social media image URL" />';
    echo '<button class="remove_social_link_button">Remove</button>';
    echo '</div>';
  }

  echo '</div>';
  echo '<button id="add_social_link_button" style="margin-top:20px;">Add More</button>';


}



function register_my_menus() {
  register_nav_menus(array(
    'primary-menu' => 'Primary Menu',
  ));
}
add_action('after_setup_theme', 'register_my_menus');
function custom_breadcrumbs() {
    $delimiter = '<li>/</li>'; // Delimiter between breadcrumbs
    $home = 'Home'; // Home text
    $before = '<li>'; // Tag before the current breadcrumb
    $after = '</li>'; // Tag after the current breadcrumb

    echo '<ul class="breadcrumbs">';

    // Home breadcrumb
    echo $before . '<a href="' . get_home_url() . '">' . $home . '</a>' . $after;

    // Get the current page and its ancestors
    $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
    $current_page = get_post();

    // Loop through the ancestors and display the breadcrumbs
    foreach ($ancestors as $ancestor) {
        echo $delimiter . $before . '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>' . $after;
    }

    // Display the current page breadcrumb
    echo $delimiter . $before . '<span class="active">' . $current_page->post_title . '</span>' . $after;

    echo '</ul>';
}