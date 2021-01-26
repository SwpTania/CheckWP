<?php
/*
 * Template Name: FAQ
*/
get_header();
$background_image = get_field('page_background_image', get_the_ID());
$args = array(
    'post_type' => 'faq',
    'post_status' => 'publish',
    'order' => 'ASC',
    'posts_per_page' => -1,
);
$the_query = new WP_Query($args);
?>
    <section class="myAgesteps startPro noParallax faqSect" style="background:url('<?php echo $background_image; ?>">
        <div class="container">
            <h2 class="customHeadH2"><span>FAQ</span></h2>
            <div class="faqInner">
                <ul>
                    <?php 
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post(); ?>
                            <li>
                                <h3><?php echo get_the_title(); ?></h3>
                                <p><?php echo get_the_content(); ?></p>
                            </li>
                        <?php }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>
<?php get_footer() ?>