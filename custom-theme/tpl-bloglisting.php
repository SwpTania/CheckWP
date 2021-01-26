<?php
/*
 * Template Name: Blog listing page
 *
 */
get_header();
 
$args = [
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'tpl-bloglisting.php'
];
$pages = get_posts($args);
$background_image = get_field('page_background_image', $pages[0]);
?> 
<section class="startPro parallax-window transformationsPage"  data-parallax="scroll" data-image-src="<?php echo $background_image; ?>">
    <div class="container">
        <div class="innerPro">
            <h2>our <span>blogs</span></h2>
            <div class="ourList">
            <?php 
               $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'paged' => 1,
                    'order' => 'ASC',
                    'posts_per_page' => 5
                );
                $the_query = new WP_Query($args);   
                if ( $the_query->have_posts() ) { ?>
                        <?php while ( $the_query->have_posts() ) {
                            $the_query->the_post(); 
                            $image = get_the_post_thumbnail_url( get_the_ID(),'medium' );
                            ?>
                            <div class="ourlists">
                                <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                    <div class="listImg">
                                        <img src="<?php echo $image; ?>" alt="<?php the_title();?>" />
                                    </div>
                                </a>
                                <div class="listCnt">
                                    <h4><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_title();?></a></h4>
                                    <span class="mystTag"></span>

                                    <?php $excerpt = get_field('blog_post_enter_excerpt',get_the_ID());
                                    if(empty($excerpt)){?>
                                        <p><?php echo the_content();?></p>
                                    <?php } else {
                                        echo "<p>" .$excerpt. " <a href=". get_permalink(get_the_ID()). ">...more</a></p>";    
                                    }?>

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
<style type="text/css">
    .mystTag{background:none!important;}
</style>
<?php get_footer() ?>