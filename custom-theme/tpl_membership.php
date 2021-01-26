<?php
/*
 * Template Name: Membership page
 *
 */
get_header();
$template_directory = get_template_directory_uri() . '/assets/';
$args = [
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'tpl-transformation.php'
];
$pages = get_posts($args);
$background_image = get_field('page_background_image', get_the_ID());
$plans = get_plans();
?>
<section class="myAgesteps startPro memBarship" style="background:url('<?php echo $background_image; ?>')">
    <div class="innerCustom">
        <div class="container">
            <div class="innerPro processStep1">
            	<h2 class="titleH2"><span>Membership</span> PLANS</h2>
                <div class="results">
                    <?php foreach($plans['result'] as $plan){ ?>
                        <div class="listMemberPlan">
                            <div class="memList">
                                <div class="memListParent">
                                    <span class="planName"><?php echo $plan['title']; ?></span>
                                    <ul class="memListUl">
                                        <?php if($plan['saleprice'] != '' && $plan['saleprice']< $plan['price']){?>
                                            <li class="planCost">
                                                <span>
                                                    <small>$</small><?php echo $plan['price']; ?>
                                                </span>
                                                <small>$</small><?php echo $plan['saleprice']; ?>
                                                <p>/Month</p>

                                            </li>
                                        <?php $price = $plan['saleprice']; } else{?>
                                            <li class="planCost">
                                                <small>$</small><?php echo $plan['price']; ?>
                                                <p>/Month</p>
                                            </li>
                                        <?php $price = $plan['price']; } ?>
                                        <li class="planWeek">
                                            <?php echo $plan['plan_highlight']; ?>  
                                        </li>
                                    </ul>
                                </div>
                                <div class="memInfo">
                                    <div class="memInfoLeft">
                                        <div class="memInfoInnerLeft">
                                            <img src="<?php echo $plan['img_url']; ?>" alt="" />
                                        </div>
                                        <div class="memInfoLeftBottom">
                                            <h3><?php echo $plan['bottom_quote']; ?></h3>
                                        </div>
                                    </div>
                                    <div class="memInfoRight">
                                        <div class="memInfoInnerRight">
                                            <h3>TOP BENEFITS</h3>
                                            <?php if (!empty($plan['top_benefits'])){ ?>
                                                <ul>
                                                <?php $count = 0 ;
                                                foreach($plan['top_benefits'] as $benefits){
                                                ?>
                                                    <li>
                                                        <?php echo $benefits['benefits'];?>
                                                    </li>
                                                <?php } ?>
                                                </ul>
                                            <?php } ?>
                                            <!-- <a href="javascript:void(0);" class="btnView more">view more</a>
                                            <a href="javascript:void(0);" class="btnView less" style="display:none;">view less</a> -->
                                        </div>
                                        <div class="memInfoRightBottom">
                                            <a href="<?php echo get_permalink(get_option( 'auth_checkout_page_id'));?>?data-id=<?php echo $plan['id']?>" class="btnbyNow" data-id="<?php echo $plan['id']?>" data-title="<?php echo $plan['title']?>" data-price="$<?php echo $price;?>">
                                                Buy Now
                                                <span>></span>
                                            </a>
                                            <!-- <a href="javascript:void(0);" class="btnPromo" alt="' +data.id+ '"> Have a Promo Code? </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="memBottomProcess">
                        <h4><?php echo $plans['option'][0]['membership_title']; ?></h4>
                        <?php if(!empty($plans['option'][0]['member_option'])){?>
                            <ul>
                            <?php foreach($plans['option'][0]['member_option'] as $value) { ?>
                                <li><?php print_r($value['option_note']); ?></li>
                            <?php }?>
                            </ul>
                        <?php } ?>
                        <div class="memCharge">
                        <h4>Recommended Plan</h4>
                        <?php foreach($plans['result'] as $plan){ ?>
                            <div class="memchargeList">
                                <div class="memcharInner">
                                    <h4><?php echo $plan['title']?></h4>
                                    <?php if($plan['saleprice'] != '' && $plan['saleprice'] < $plan['price']){?>
                                        <h5>
                                            <span class="memPrice"><?php echo $plan['price']; ?></span> 
                                            $<?php echo $plan['saleprice']; ?>
                                            <span class="memMonth">/Month</span>
                                        </h5>
                                    <?php $price = $plan['saleprice']; } else{ ?>
                                        <h5>
                                            $<?php echo $plan['price']; ?>
                                            <span class="memMonth">/Month</span>
                                        </h5>
                                    <?php $price = $plan['saleprice']; } ?>            
                                    <!-- <span class="notCnt"> not contract </span> -->
                                </div>
                                <a href="<?php echo get_permalink(get_option( 'auth_checkout_page_id'));?>?data-id=<?php echo $plan['id']?>" class="btnbyNow" data-id="<?php echo $plan['id']?>" data-title="<?php echo $plan['title']?>" data-price="$<?php echo $price;?>">
                                    Buy Now
                                    <span>></span>
                                </a>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>
<script type="text/javascript">
    jQuery('.btnView.more').click(function(){
        jQuery(this).parent().find('li.top_benifits_more').show();
        jQuery(this).hide();
        jQuery(this).parent().find('.btnView.less').show();
    });
    jQuery('.btnView.less').click(function(){
        jQuery(this).parent().find('li.top_benifits_more').hide();
        jQuery(this).hide();
        jQuery(this).parent().find('.btnView.more').show();
    });

</script>