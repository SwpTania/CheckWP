<?php
get_header();
$background_image = get_field('page_background_image', get_the_ID());
?>
<section class="myContact startPro parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>">
    <div class="container">
        <div class="innerPro contOver">
            <div class="contactForm">
                <div class="form-group">
                    <h3 class="text-center">Error 404</h3>
                    <p style="font-size: 24px;line-height: 40px;">Page not found.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>