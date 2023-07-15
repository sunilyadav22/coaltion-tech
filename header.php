<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coalitiontest
 */
	$options = get_option('theme_options');

	$options = get_option('theme_options');
	$logo_url = isset($options['logo']) ? $options['logo'] : '';
	if (!empty($logo_url)) {
	  $logo_id = attachment_url_to_postid($logo_url);
	  $alt = '';
	  $title = '';
	  if ($logo_id) {
	    $attachment = get_post($logo_id);
	    $alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
	    $title = $attachment->post_title;
	  }
	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <header>
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="call-us">
                    	<?php echo isset($options['fax_number'])?'<h4>CALL US NOW!<a href="tel:'.$options['fax_number'].'" title="'.$options['fax_number'].'">'.$options['fax_number'].'</a></h4>':''?>
                        
                    </div>
                    <ul class="login-sign-list">
                        <li><a href="#">LOGIN</a></li>
                        <li><a href="#">SIGNUP</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-header" >
            <div class="container">
                <div class="row">
                    <div class="logo">
                    	<?php echo ($logo_url) ?'<a href="'.site_url().'"><img src="'.$logo_url.'" alt="'.$title.'" title="'.$title.'"></a>':'';?>                        
                    </div>
                    <div class="mobile-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="header-menu">
					  <ul>
					    <?php
						wp_nav_menu(array(
						    'theme_location' => 'primary-menu', // Replace 'primary-menu' with your actual menu location
						    'container' => '',
						    'menu_class' => 'menu',
						    'fallback_cb' => false,
					    ));
					    ?>
					  </ul>
					</div>

                </div>
            </div>          
        </div>
    </header>