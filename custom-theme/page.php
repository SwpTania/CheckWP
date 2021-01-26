<?php
get_header();
$background_image = get_field('page_background_image', get_the_ID());
?>
<section class="myContact startPro parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>">
    <div class="container">
        <div class="innerPro contOver">
            <div class="contactForm">
                <h3 class="text-center"><?php the_title(); ?></h3>
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>