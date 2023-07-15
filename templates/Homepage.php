<?php
/*
* Template name: Home
*/
get_header();
$options = get_option('theme_options');
$social_links = isset($options['social_links']) ? $options['social_links'] : '';
$social_links_images = isset($options['social_links_images']) ? $options['social_links_images'] :'';
?>
<section class="breadcrumbs">
        <div class="container">
            <?php custom_breadcrumbs();?>
        </div>
    </section>
    <div class="contact-section">
        <div class="container">
            <div class="contact-header">
            	<?php echo (get_the_title()?'<h1>'.get_the_title().'</h1>':'')?>
                <?php echo (get_the_content()?get_the_content():'')?>
            </div>
            <div class="row">
                <div class="contact-form">
                	<?php echo (get_field('contact_form_heading'))?'<h4>'.get_field('contact_form_heading').'</h4>':''?>
                    <?php echo do_shortcode('[contact-form-7 id="34" title="contact us"]');?>
                </div>
                <div class="contact-form">
                	<?php echo (get_field('reach_us_address_heading'))?'<h4>'.get_field('reach_us_address_heading').'</h4>':''?>
                    <div class="contact-address">
                        <ul>
                        	<?php echo (get_field('reach_us_address_title'))?'<li><strong>'.get_field('reach_us_address_title').'</strong></li>':''?>
                            <?php echo isset($options['address']) ? '<li>'.$options['address'].'</li>' : '' ;?>
                            <?php echo isset($options['phone_number']) ? '<li class="mt-20">Phone: <a href="tel:'.$options['phone_number'].'">'.$options['phone_number'].'</a></li>' : ''; ?>
                            <?php echo isset($options['fax_number']) ? '<li>Fax: <a href="tel:'.$options['fax_number'].'">'.$options['fax_number'].'</a></li>' : '';?>
                        </ul>
                    </div>
                    <?php if (!empty($social_links)):?>
                    <ul class="contact-social-list">
                    	<?php foreach ($social_links as $index => $link):
    							$image_url = isset($social_links_images[$index]) ? $social_links_images[$index] : '';?>
    						<li><a href="<?php echo esc_url($link) ?>"><i class="<?php echo $image_url ?>" aria-hidden="true"></i></a></li>
    						<?php endforeach;?>
                    </ul>
                <?php endif;?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>