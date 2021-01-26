<?php

/*

 * Template Name: Home page

 *

 */

get_header();

$background_image = get_field('page_background_image',get_the_ID()); 

$template_directory = get_template_directory_uri() . '/';

$my_program = get_field('select_my_program_page', get_the_ID());

$your_time_images = get_field('home_images', get_the_ID());

$args = array(

    'post_type' => 'program_gender',

    'post_status' => 'publish',

    'order' => 'DESC',

);

$the_query = new WP_Query($args);


?>

<section class="startPro parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>">
  <div class="container">
    <div class="innerPro startProInner">
      <div class="topHead">
        <h1><span>Reveal</span> My 6-Pack!</h1>
      </div>
      
      <div class="homeBannrMain">
      <div class ="homebanner_image">
        <div class="image1">
          <div class="imgCnt"><img src="/wp-content/themes/monawar/assets/img/pc-icon.svg" alt="Personal Coaching image"></div>
          <h2>Personal Coaching</h2>
        </div>
        <div class="image2">
          <div class="imgCnt"><img src="/wp-content/themes/monawar/assets/img/mp-icon.svg" alt="Meal Planning image"></div>
          <h2>Meal Planning</h2>
        </div>
        <div class="image3">
          <div class="imgCnt"><img src="/wp-content/themes/monawar/assets/img/wr-icon.svg" alt="Workout Routines image"></div>
          <h2>Workout Routines</h2>
        </div>
      </div>
     <div class="newBtm">
      <p>Receive the coaching level of Hollywood actors. You can text, call and email Zack himself for guidance and accountability. Know exactly what exercises to do, how many reps, what to eat and when.</p>
      <h6>Get YOUR perfect plan today! </h6>
    </div>
       </div>
      
      <!-- <h2><span>Start</span> My Program</h2>

            <?php 

            if ($the_query->have_posts()) {

                while ($the_query->have_posts()) {

                    $the_query->the_post(); ?>

                    <a href="<?php echo get_permalink($my_program);?>" class="btnMain" data-value="<?php echo get_the_ID();?>">I'm <?php echo get_the_title();?></a>

            <?php }

            }

            ?> --> 
      
      <!--<a href="<?php echo get_permalink($my_program);?>" class="btnMain" data-value="female">I'm Female</a>--> 
      
    </div>
    
  </div>
</section>
<!--div class="newBtm newbtnCstm">
  <div class="container">
    <div class="innerPro startProInner"> <span>Take our Physique Quiz so we can identify and customize a plan for you!</span>
      <h2><span>Start</span> My Program</h2>
      <//?php 

            $args = array(

                'post_type' => 'program_gender',

                'post_status' => 'publish',

                'order' => 'DESC',

            );

            $the_query = new WP_Query($args);

            if ($the_query->have_posts()) {

                while ($the_query->have_posts()) {

                    $the_query->the_post(); ?>
      <a href="<//?php echo get_permalink($my_program);?>" class="btnMain" data-value="<//?php echo get_the_ID();?>">I'm <//?php echo get_the_title();?></a>
      <//?php }

            }

            ?>
    </div>
  </div>
</div>

<!-- My Story Start -->

<section class="myStore">
  <div class="container">
    <?php 

            $args = array(

                'post_type'      => 'team',

                'post_status'    => 'publish',

                'order'          => 'ASC',

                'posts_per_page'  => -1

             );

            $the_query = new WP_Query($args);

            $flag = 0;

            if ( $the_query->have_posts() ) { ?>
    <?php while ( $the_query->have_posts() ) {

                        $the_query->the_post(); 

                        $image = get_the_post_thumbnail_url( get_the_ID(),'medium' );

                        if($flag == 0) { ?>
    <div class="row">
      <div class="mystryLeft">
        <div class="imgStory"> <img src="<?php echo $image; ?>" alt="<?php the_title();?>" /> </div>
      </div>
      <div class="mystryRight">
        <div class="delStory">
          <ul class="list-inline">
            <li>
              <h2>
                <?php the_title();?>
                :</h2>
            </li>
            <li><span class="desigStory"><?php echo get_post_meta(get_the_ID(), 'designation', true); ?></span></li>
            <!--<li><span class="ageStory">Age <//?php //echo get_post_meta(get_the_ID(), 'age', true); ?></span></li>-->
          </ul>
          <span class="mystTag">my story</span>
          <p><?php echo the_content();?></p>
        </div>
      </div>
    </div>
    <?php

                            $flag = 1;

                        } else { ?>
    <div class="row">
      <div class="mystryLeft">
        <div class="delStory">
          <ul class="list-inline">
            <li>
              <h2>
                <?php the_title();?>
                :</h2>
            </li>
            <li><span class="desigStory"><?php echo get_post_meta(get_the_ID(), 'designation', true); ?></span></li>
            <!--<li><span class="ageStory">Age <//?php //echo get_post_meta(get_the_ID(), 'age', true); ?></span></li>-->
          </ul>
          <span class="mystTag">my story</span>
          <p><?php echo the_content();?></p>
        </div>
      </div>
      <div class="mystryRight">
        <div class="imgStory"> <img src="<?php echo $image; ?>" alt="<?php the_title();?>" /> </div>
      </div>
    </div>
    <?php

                            $flag = 0;

                        }

                        ?>
    <?php } ?>
    <?php } ?>
  </div>
</section>

<!-- My Story End --> 

<!-- It's Time Start -->

<section class="itsTime">
  <div class="container-fluid">
    <h2 class="titleMain">Your time is <span>now</span></h2>
    <div class="row">
      <div class="Home_slide timePix">
        <div class="owl-carousel owl-theme">
          <?php foreach ($your_time_images as  $value) { ?>
          <div class="item">
            <div class="pixItem">
              <?php  echo wp_get_attachment_image( $value['your_time_images'],'full' );?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- It's Time End --> 

<!-- Start Pro Start -->

<section class="startProBottom parallax-window dfd" data-parallax="scroll" data-image-src="<?php echo $template_directory ?>assets/img/bottom-banner.jpg">
  <!--div class="container">
    <div class="innerPro startProInner"> <span>Take our Physique Quiz so we can identify and customize a plan for you!</span>
      <h2><span>Start</span> My Program</h2>
      <//?php 

            $args = array(

                'post_type' => 'program_gender',

                'post_status' => 'publish',

                'order' => 'DESC',

            );

            $the_query = new WP_Query($args);

            if ($the_query->have_posts()) {

                while ($the_query->have_posts()) {

                    $the_query->the_post(); ?>
      <a href="<//?php echo get_permalink($my_program);?>" class="btnMain" data-value="<//?php echo get_the_ID();?>">I'm <//?php echo get_the_title();?></a>
      <//?php }

            }

            ?>
    </div>
  </div-->
  <?php echo do_shortcode('[xyz-ips snippet="COACH-difference"]'); ?>
</section>

   <!------ Consultation Popup ------>
<!-- <div class="cnsltnPop" style="display: none">
    <div class="cpWrap">
        <div class="cpInr">
            <div class="popOverlay"></div>
            <div class="cpMain">
                <div class="cpLeft">
                    <div class="cpImg">
                    </div>
                </div>
                <div class="cpRight">
                    <div class="cpHead">
                        <h4><span>Want a free</span> fitness consultation?</h4>
                        <p>Share your short details with us.</p>
                        <div class="cpClose">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                    </div>
                    <form>
                        <div class="cpSngl">
                            <input type="text" placeholder="Name" />
                        </div>
                        <div class="cpSngl">
                            <input type="text" placeholder="Phone No." />
                        </div>
                        <div class="cpSngl">
                            <input type="text" placeholder="Email Id" />
                        </div>
                        <div class="cpBtm">
                            <button type="submit" class="btn yesBtn">Yes</button>
                          <button type="button" class="btn noBtn">No - I am a gym expert </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->



<?php get_footer(); ?>
<script type="text/javascript"> 

    jQuery('.btnMain').click(function(){
        var gender = jQuery(this).data('value');
        localStorage.setItem("program_gender", gender);
    });

    jQuery('.cpClose,.cpBtm .noBtn').click(function(){
        jQuery('.cnsltnPop').hide();
    });

</script>