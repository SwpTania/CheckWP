<?php
/*
 * Template Name: Transformations page
 *
 */
get_header();
 
$args = [
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'tpl-transformation.php'
];
$pages = get_posts($args);
$background_image = get_field('page_background_image', $pages[0]);
?> 
<section class="startPro parallax-window transformationsPage"  data-parallax="scroll" data-image-src="<?php echo $background_image; ?>">
    <div class="container">
        <div class="innerPro">
            <h2>our <span>Transformations</span></h2>
            <div class="ourList">
            <?php 
                $args = array(
                    'post_type'      => 'transformations',
                    'post_status'    => 'publish',
                    'paged'          => 1,
                    'order'          => 'DESC',
                    'posts_per_page'  => 5
                 );
                $the_query = new WP_Query($args);   
                if ( $the_query->have_posts() ) { ?>
                        <?php while ( $the_query->have_posts() ) {
                            $the_query->the_post(); 
                            $image = get_the_post_thumbnail_url( get_the_ID(),'medium' );
                            ?>
                            <div class="ourlists">
                                <div class="listImg">
                                    <img src="<?php echo $image; ?>" alt="<?php the_title();?>" />
                                </div>
                                <div class="listCnt">
                                    <h4><?php the_title();?></h4>
                                    <span class="mystTag">my story</span>
                                    <p><?php echo the_content();?></p>
                                </div>
                            </div>
                        <?php } ?>
                <?php } ?>
            </div>
            <h4 class="timenowBtn transformationsLoadMore" data-page="2" style="display: none;"><a href='javascript:void(0)'>Load More</a></h4>
            <h4 class="timenowBtn">Your Time Is <a href="<?php echo get_site_url();?>">NOW</a></h4>
        </div>
    </div>
</section>
<?php get_footer() ?>