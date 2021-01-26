<?php
get_header();
$background_image = get_field('page_background_image', get_the_ID());
?>
<section class="myContact startPro parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>">
    <div class="container">
        <div class="innerPro contOver">
            <div class="contactForm">
                <h3><?php the_title(); ?></h3>
                <!--<img src="<?php //echo get_the_post_thumbnail_url( get_the_ID(), 'full' )?>" alt="6packbyzack">-->
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