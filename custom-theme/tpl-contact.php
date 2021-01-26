<?php
/* 
 * Template Name: Contact Page
 */
get_header();
$contact_form_id = get_field('page_background_image',get_the_ID()); 
$contact_form = '[contact-form-7 id="' . $contact_form_id .'" title="Contact"]';
$background_image = get_field('page_background_image',get_the_ID()); 

?>
    <section class="myContact startPro parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image;?>">
        <div class="container">
            <div class="innerPro contOver">
                <div class="contactForm">
                    <h3><?php the_title(); ?>:</h3>
                    <?php echo do_shortcode($contact_form);?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer();?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.Name input').attr('data-placeholder',jQuery('.Name input').attr('placeholder'));
        jQuery('.email input').attr('data-placeholder',jQuery('.email input').attr('placeholder'));
        jQuery('.textarea textarea').attr('data-placeholder',jQuery('.textarea textarea').attr('placeholder'));
    });
    jQuery('.Name input').focus(function(){
        jQuery('.Name input').attr('placeholder','');
    });
    jQuery('.Name input').blur(function(){
        jQuery('.Name input').attr('placeholder',jQuery('.Name input').attr('data-placeholder'));
    });
    jQuery('.email input').focus(function(){
        jQuery('.email input').attr('placeholder','');
    });
    jQuery('.email input').blur(function(){
        jQuery('.email input').attr('placeholder',jQuery('.email input').attr('data-placeholder'));
    });
    jQuery('.textarea textarea').focus(function(){
        jQuery('.textarea textarea').attr('placeholder','');
    });
    jQuery('.textarea textarea').blur(function(){
        jQuery('.textarea textarea').attr('placeholder',jQuery('.textarea textarea').attr('data-placeholder'));
    });
</script>