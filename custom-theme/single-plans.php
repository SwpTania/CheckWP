<?php

get_header();
$plan_id = get_the_ID();
$plan = get_post(get_the_ID());
$top_benefits = get_field('top_benefits',$plan_id);
$image_url = get_the_post_thumbnail_url( $plan->ID,'full' );
$member_option = get_field('member_option', 'option');
$membership_title = get_field('membership_title', 'option');
$buy_section1 = get_field('buy_section_heading_1', 'option');
$buy_section2 = get_field('buy_section_heading_2', 'option');
$buy_section3 = get_field('buy_section_heading_3', 'option');
$sell_price =  get_field('plan_sell_price_1',$plan_id);
$plan_price = get_field('plan_price',$plan_id);
$vimeo_video = get_field('vimeo_video_url', 'option');
$save_percentage = round((1-($sell_price/$plan_price))*100);
$args = array(
    'post_type' => 'testimonial',
    'post_status' => 'publish',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'meta_key' => 'select_gender',
    'meta_value' => $gender,
    'compare' => '='
);
$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
	$testimonial = array();
    while ($the_query->have_posts()) {
        $the_query->the_post();
        $testimonial[] = array(
            'title' => get_the_title(),
            'content' => get_the_content(),
            'img_url' => get_the_post_thumbnail_url(get_the_ID(),'medium')
        );
    }
}
?>
<section class="myAgesteps startPro step-results" style="background:url('https://www.6packbyzack.com/wp-content/uploads/2017/06/noMore.png')">
    <div class="innerCustom">
        <div class="container">
            <div class="innerPro processStep1">
                <div class="results">
                    <div class="listMemberPlan">
                        <div class="memList">
                            <div class="memListParent">
                                <span class="planName"><?php echo $plan->post_title?></span>
                                    <ul class="memListUl">
                                        <li class="disPrice">
                                            <span>$</span><?php echo get_field('plan_price',$plan_id); ?>
                                        </li>
                                        <li class="actPrice">
                                            <span>$</span><?php echo get_field('plan_sell_price_1',$plan_id); ?>
                                        </li>
                                        <li class="monDay">/Month</li>
                                    </ul>
                                </div>
                                <div class="memInfo">
                                    <div class="memInfoLeft">
                                        <div class="memInfoInnerLeft">
                                            <img src="<?php echo $image_url?>" alt="">
                                        </div>
                                        <div class="memInfoLeftBottom">
                                            <h3><?php echo get_field('bottom_quote',$plan_id)?></h3>
                                        </div>
                                    </div>
                                    <div class="memInfoRight">
                                        <div class="memInfoInnerRight">
                                            <h3>TOP BENEFITS</h3>
                                            <ul>
                                                <?php foreach ($top_benefits as $value) {
                                                    echo '<li>'.$value['benefits'].'</li>';
                                                } ?>
                                            </ul>
                                        </div>
                                        <div class="memInfoRightBottom">
                                            <a href="<?php echo site_url();?>/checkout/?data=<?php echo $plan->post_name;?>" class="btnbyNow" data-id="<?php echo $plan_id; ?>" data-title="<?php echo $plan->post_title?>" data-price="$<?php echo get_field('plan_sell_price_1',$plan_id); ?>" data-name="<?php echo $plan->post_name;?>">
                                                Buy Now<span>&gt;</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="memBottomProcess">
                    	<h4>
                    		<?php echo $membership_title;?>
                		</h4>
                    	<div>
                    		<?php foreach ($member_option as $value) {
                    			echo "<span>" .$value['option_note']. "</span>";
                    			echo "<p>" .$value['option_detail']. "</p>";
                    		} ?>
                		</div>
            		</div>
            		<div class="buy_sec">
                        <h4><?php echo $buy_section1; ?></h4>
                        <p class="price">Regular Price: $<?php echo get_field('plan_price',$plan_id); ?> <span>Today only $<?php echo get_field('plan_sell_price_1',$plan_id); ?></span></p>
                        <p class="offer">Limited time offer – Save <span><?php echo $save_percentage?>%!!</span></p>
                        <div class="memInfoRightBottom"> <a href="<?php echo site_url();?>/checkout/?data=<?php echo $plan->post_name;?>" class="btnbyNow" data-id="<?php echo $plan_id; ?>" data-title="<?php echo $plan->post_title?>" data-price="$<?php echo get_field('plan_sell_price_1',$plan_id); ?>" data-name="<?php echo $plan->post_name;?>">Buy the <?php echo $plan->post_title?> Plan Now<span>&gt;</span></a> </div>
                    </div>
                    <div class="video_section">
                        <iframe id="iframe1" src="<?php echo $vimeo_video; ?>" width="100%" height="500" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
                    </div>
                    <div class="buy_sec">
                        <h4><?php echo $buy_section2; ?></h4>
                       <p class="price">Regular Price: $<?php echo get_field('plan_price',$plan_id); ?> <span>Today only $<?php echo get_field('plan_sell_price_1',$plan_id); ?></span></p>
                        <p class="offer">Limited time offer – Save <span><?php echo $save_percentage?>%!!</span></p>
                        <div class="memInfoRightBottom"> <a href="<?php echo site_url();?>/checkout/?data=<?php echo $plan->post_name;?>" class="btnbyNow" data-id="<?php echo $plan_id; ?>" data-title="<?php echo $plan->post_title?>" data-price="$<?php echo get_field('plan_sell_price_1',$plan_id); ?>" data-name="<?php echo $plan->post_name;?>">Buy the <?php echo $plan->post_title?> Plan Now<span>&gt;</span></a>
                        </div>
                    </div>
                    <div class="testimonial_section">
                        <h4>Our Results Can Be Your Results!</h4>
                    	<?php foreach ($testimonial as $value) {?>
                    		<div class="ourlists">
                    			<div class="listImg">
                    				<img src="<?php echo $value['img_url']; ?>" alt=" ">
                				</div>
                    			<div class="listCnt">
                            		<h4><?php echo $value['title']; ?></h4>
                            		<p><?php echo $value['content']; ?></p>
                        		</div>	
                        	</div>
                    	<?php } ?>
                    </div>
                    <div class="buy_sec">
                        <h4><?php echo $buy_section3; ?></h4>
                        <p class="price">Regular Price: $<?php echo get_field('plan_price',$plan_id); ?> <span>Today only $<?php echo get_field('plan_sell_price_1',$plan_id); ?></span></p>
                        <p class="offer">Limited time offer – Save <span><?php echo $save_percentage?>%!!</span></p>
                        <div class="memInfoRightBottom"> <a href="<?php echo site_url();?>/checkout/?data=<?php echo $plan->post_name;?>" class="btnbyNow" data-id="<?php echo $plan_id; ?>" data-title="<?php echo $plan->post_title?>" data-price="$<?php echo get_field('plan_sell_price_1',$plan_id); ?>" data-name="<?php echo $plan->post_name;?>">Buy the <?php echo $plan->post_title?> Plan Now<span>&gt;</span></a>
                        </div>
                    </div>
                    <div class="listMemberPlan">
                        <div class="memList">
                            <div class="memListParent">
                                <span class="planName"><?php echo $plan->post_title?></span>
                                    <ul class="memListUl">
                                        <li class="disPrice">
                                            <span>$</span><?php echo get_field('plan_price',$plan_id); ?>
                                        </li>
                                        <li class="actPrice">
                                            <span>$</span><?php echo get_field('plan_sell_price_1',$plan_id); ?>
                                        </li>
                                        <li class="monDay">/Month</li>
                                    </ul>
                                </div>
                                <div class="memInfo">
                                    <div class="memInfoLeft">
                                        <div class="memInfoInnerLeft">
                                            <img src="<?php echo $image_url?>" alt="">
                                        </div>
                                        <div class="memInfoLeftBottom">
                                            <h3><?php echo get_field('bottom_quote',$plan_id)?></h3>
                                        </div>
                                    </div>
                                    <div class="memInfoRight">
                                        <div class="memInfoInnerRight">
                                            <h3>TOP BENEFITS</h3>
                                            <ul>
                                                <?php foreach ($top_benefits as $value) {
                                                    echo '<li>'.$value['benefits'].'</li>';
                                                } ?>
                                            </ul>
                                        </div>
                                        <div class="memInfoRightBottom">
                                            <a href="<?php echo site_url();?>/checkout/?data=<?php echo $plan->post_name;?>" class="btnbyNow" data-id="<?php echo $plan_id; ?>" data-title="<?php echo $plan->post_title?>" data-price="$<?php echo get_field('plan_sell_price_1',$plan_id); ?>" data-name="<?php echo $plan->post_name;?>">
                                                Buy Now<span>&gt;</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
	.video_section{ max-width: 900px; margin: 0 auto 65px; }
	.listImg{max-width: 215px}
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var iframe = document.getElementById('iframe1');
        var player = $f(iframe);
        jQuery(window).scroll(function() {
            if (jQuery('#iframe1').is(":in-viewport")) {
                player.api("play");
            } else {
                player.api("pause");
            }
        });
	});
</script>
<?php get_footer(); ?>