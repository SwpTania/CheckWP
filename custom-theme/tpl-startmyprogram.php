<?php
/*
* Template Name: Start My Program
*/
get_header('startmyprogram');
$popup_img = get_field('popup_image', 'option');
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
?>
<section class="myAgesteps startPro" style="background:url('<?php echo $background_image; ?>'); background-size: cover; background-position: top center; background-repeat: no-repeat;">
    <div class="processSteps">
        <div class="container">
            <ul>
                <li class="ageRangeLi active">
                    <span>1</span>Age
                </li>
                <li class="bodyTypeLi">
                    <span>2</span>Body Type
                </li>
                <li class="goalTypeLi">
                    <span>3</span>Goal
                </li>
                <li class="resultsLi">
                    <span>4</span>Results
                </li>
            </ul>
        </div>
    </div>
    <div class="innerCustom">
        <div class="container">
            <div class="innerPro processStep1">
                <h2 class="titleH2">My <span>Age Range</span></h2>
                <h5 class="sub_title"></h5>
                <ul class="ageRange">
                    <?php
                    $args = array(
                        'post_type' => 'program_age ',
                        'post_status' => 'publish',
                        'order' => 'ASC',
                    );
                    $the_query = new WP_Query($args);
                    $data['result'] = array();
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            echo '<li data-id = "'. get_the_ID() .'" data-title ="'. get_the_title() .'">' . get_the_title() . '</li>';
                        }
                    }
                    ?>
                </ul>
                <ul class="bodyType" style="display:none"></ul>
                <ul class="goalType" style="display:none"></ul>
                <div class="results" style="display:none"></div>
            </div>
            <div class="innerPro startProInner memBership">
                <h2><span>Start</span> My Program</h2>
                <ul class="gender">
                    <?php 
                    $args = array(
                        'post_type' => 'program_gender',
                        'post_status' => 'publish',
                        'order' => 'DESC',
                    );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post(); ?>
                            <li class="btnMain" data-value="<?php echo get_the_ID();?>">I'm <?php echo get_the_title();?></li>
                    <?php }
                    }
                    ?>
                
                </ul>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" style="">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div calss="modal-image">
                    <img src= "<?php echo $popup_img;?>" />
                </div>
                <h4 class="modal-title">Where Should We Send the Results? </h4>
            </div>
            <div class="modal-body">
                <form method="post" onsubmit="return false;" class="form-inline" id="start_my_program">
                    <div class="form-group">
                        <input type="text" name="start_my_program_email" id="coupon_email" class="form-control" placeholder="E-Mail" value="" autocomplete="off" autofocus />
                    </div>
                    <button type="submit" class="btn default-btn check_coupon" id="check_coupon">SEND ME MY RESULTS NOW!</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var formData = {};
    jQuery(document).ready(function(){
        var gender = localStorage.getItem("program_gender");
        localStorage.removeItem("program_gender");
        if(gender != '' && gender !== null)
        {
            formData.gender = gender;
            jQuery('.startProInner').hide();
        } else {
            jQuery('.processStep1').hide();
            jQuery('.processSteps').hide();
        }
    });
    jQuery('.gender li').click(function (e) {
        e.preventDefault();
        formData.gender = jQuery(this).data('value');
        jQuery('.processStep1').show();
        jQuery('.processSteps').show();
        jQuery('.startProInner').hide();   
    });
    jQuery(document).on('click','.ageRange li', function(e){
        e.preventDefault();
        formData.age = jQuery(this).data('title');
        formData.ageId = jQuery(this).data('id');
        jQuery.ajax({
            url: ajaxUrl,
            dataType : 'JSON',
            type: 'POST',
            data: ({ action: 'get_body_type', age_range: formData.ageId, gender: formData.gender }),
            success: function (response) {
                if (response.result.length > 0) {
                    jQuery('.ageRange').hide();
                    jQuery('.ageRangeLi').removeClass('active');
                    var html = '';
                    jQuery.each(response.result, function(index,value) {
                        html += getBodyTypeHtml(value);
                    });
                    jQuery('.bodyType').show();
                    jQuery('.bodyTypeLi').addClass('active');
                    jQuery('.titleH2').html('My <span>Body Type</span>');
                    jQuery('.bodyType').html(html);
                }
            }
        });
        
    });
    jQuery(document).on('click','.bodyType li', function(e){
        e.preventDefault();
        formData.body = jQuery(this).data('title');
        formData.body_id = jQuery(this).data('id');
        jQuery.ajax({
            url: ajaxUrl,
            dataType : 'JSON',
            type: 'POST',
            data: ({ action: 'get_goal_type', body_type: formData.body_id, gender: formData.gender, age_id:formData.ageId }),
            success: function (response) {
                if (response.result.length > 0) {
                    jQuery('.bodyType').hide();
                    jQuery('.bodyTypeLi').removeClass('active');
                    var html = '';
                    jQuery.each(response.result, function(index,value) {
                        html += getGoalHtml(value);
                    });
                    jQuery('.goalType').show();
                    jQuery('.goalTypeLi').addClass('active');
                    jQuery('.titleH2').html('My <span>Goal</span>');
                    jQuery('.goalType').html(html);
                }
            }
        });
    });
    jQuery(document).on('click','.goalType li', function(e){
        e.preventDefault();
        formData.goal = jQuery(this).data('title');
        formData.goal_id = jQuery(this).data('id');
        jQuery("#myModal").modal('show');
    });
    jQuery(document).on('click', '.btnView.more',function(){
        jQuery('.toggle').toggle(500,'swing',viewMoreChangeText);
    });
    function viewMoreChangeText(){
        var text = jQuery('.btnView.more').text();
        if(text == 'view more'){
            jQuery('.btnView.more').text('view less');
            jQuery("html body").animate({ scrollTop:  jQuery(document).height() }, 500);
        } else {
            jQuery('.btnView.more').text('view more');
        }
    }
    jQuery(document).on('click','.btnbyNow', function(e){ 
        var checkout_page = "<?php echo get_permalink(get_option( 'auth_checkout_page_id'));?>"; 
        formData.plan = jQuery(this).data('title');
        formData.plan_id = jQuery(this).data('id');
        formData.plan_price = jQuery(this).data('price');
        formData.plan_slug = jQuery(this).data('name');
        localStorage.setItem("program_plan", formData.plan_slug);
        //var form = '<form id="checkout_form" action="'+checkout_page+'"></form>';
        //jQuery("#checkout_form").submit(); 
        //jQuery.redirect(checkout_page, formData);
        //window.location.href = checkout_page"?data=" + formData;
    });
    // jQuery(document).on('click','.btnAll', function(e){
    //     e.preventDefault();
    //     formData.plan = jQuery(this).data('title');
    //     formData.plan_id = jQuery(this).data('id');
    //     formData.plan_price = jQuery(this).data('price');
    // });
    function getBodyTypeHtml(data) {
        var html = '';
        html += '<li data-id="' + data.id + '" data-title="' + data.title + '" >' + data.title + '</li>';
        return html;
    }
    function getGoalHtml(data) {
        var html = '';
        html += '<li data-id="' + data.id + '" data-title="' + data.title + '">' + data.title + '</li>';
        return html;
    }
    function getPlansHtml(data) {
        var html = '';
        var price = '';
        html += '    <div class="listMemberPlan">';
        html += '        <div class="memList">';
        html += '            <div class="memListParent">';
        html += '                <span class="planName">' + data.title + '</span>';
        html += '                <ul class="memListUl">';
        if ((data.saleprice != '' && data.saleprice < data.price) && (data.saleprice !== null && data.saleprice != 'null')){
            html += '               <li class="disPrice"><span>$</span>' + data.price + '</li>';
            html += '               <li class="actPrice"><span>$</span>' + data.saleprice + '</li>';
            html += '               <li class="monDay">/Month</li>';
            price = data.saleprice;
        }
        else{
            html += '                        <li class="planCost"><small>$</small>' + data.price ;
            html += '                            <p>/Month</p>';
            html += '                        </li>';
            price = data.price;
        }
        html += '                </ul>';
        html += '            </div>';
        html += '            <div class="memInfo">';
        html += '                <div class="memInfoLeft">';
        html += '                    <div class="memInfoInnerLeft">';
        html += '                        <img src="'+ data.img_url+'" alt="" />';
        html += '                    </div>';
        html += '                    <div class="memInfoLeftBottom">';
        html += '                        <h3>' + data.bottom_quote + '</h3>';   
        html += '                    </div>';
        html += '                </div>';
        html += '                <div class="memInfoRight">';
        html += '                    <div class="memInfoInnerRight">';
        html += '                        <h3>TOP BENEFITS</h3>';
        var count = 0 ;
        if (data.top_benefits.length != ''){
            html += '                            <ul>';
            for(var i = 0; i < data.top_benefits.length ; i++){
                html += '                            <li>' + data.top_benefits[i].benefits + '</li>';
            }
            html += '                            </ul>';
        }
        html += '                    </div>';
        html += '                    <div class="memInfoRightBottom">';
        html += '                        <a href="<?php echo get_permalink(get_option( 'auth_checkout_page_id'));?>" class="btnbyNow" data-id="' + data.id + '" data-title="' + data.title + '" data-price="$' + price + '" data-name="' +data.slug+ '">Buy Now<span>></span></a>';
        html += '                    </div>';
        html += '                </div>';
        html += '            </div>';
        html += '        </div>';
        html += '    </div>';

        return html;
    }
    function getMiddlePlansHtml(data) {
        var html = '';
        html += '<h4>' + data["0"].membership_title + '</h4>';
        if( data["0"].member_option.length > 0 ){
            html += '<div>';
            for (var i = 0; i < data["0"].member_option.length ; i++) {
                html += '<span>' + data["0"].member_option[i].option_note + '</span>';   
                html += '<p>' + data["0"].member_option[i].option_detail + '</p>';   
            }
            html += '</div>';
        }
        return html;
    }

    function roundToTwo(num) {    
        return +(Math.round(num + "e+2")  + "e-2");
    }

    function getBuySectionHtml(data){
        var html = '';
        var save_percent = roundToTwo((1 - (data[0].saleprice/data[0].price))*100);
        html += '<p class="price">Regular Price: $'+data[0].price+' <span>Today only $'+data[0].saleprice+'</span></p>';
        html += '<p class="offer">Limited time offer – Save <span>'+save_percent+'%!!</sapn></p>';
        html += '                    <div class="memInfoRightBottom">';
        html += '                        <a href="<?php echo get_permalink(get_option( 'auth_checkout_page_id'));?>" class="btnbyNow" data-id="' + data[0].id + '" data-title="' + data[0].title + '" data-price="$' + data[0].saleprice + '" data-name="' +data[0].slug+ '">Buy the '+ data[0].title +' Plan Now<span>></span></a>';
        html += '                    </div>';
        return html;
    }

    function getTestimonialSectionHtml(data){
        var html = '';
        html +=     '<div class="ourlists">';
        html +=         '<div class="listImg">';
        html +=             '<img src="'+data.img_url+'" alt="<?php the_title();?>" />';
        html +=         '</div>';
        html +=         '<div class="listCnt">';
        html +=             '<h4>'+data.title+'</h4>';
        html +=             '<p>'+data.content+'</p>';
        html +=         '</div>';
        html +=     '</div>';
        return html;
    }

    function getBottomPlansHtml(data) {
        var html = '';
        html += '    <div class="listMemberPlan">';
        html += '        <div class="memList">';
        html += '            <div class="memListParent">';
        html += '                <span class="planName">' + data.title + '</span>';
        html += '                <ul class="memListUl">';
        if ((data.saleprice != '' && data.saleprice < data.price) && (data.saleprice !== null && data.saleprice != 'null')){
            html += '               <li class="disPrice"><span>$</span>' + data.price + '</li>';
            html += '               <li class="actPrice"><span>$</span>' + data.saleprice + '</li>';
            html += '               <li class="monDay">/Month</li>';
            price = data.saleprice;
        }
        else{
            html += '                        <li class="planCost"><small>$</small>' + data.price ;
            html += '                            <p>/Month</p>';
            html += '                        </li>';
            price = data.price;
        }
        html += '                </ul>';
        html += '            </div>';
        html += '            <div class="memInfo">';
        html += '                <div class="memInfoLeft">';
        html += '                    <div class="memInfoInnerLeft">';
        html += '                        <img src="'+ data.img_url+'" alt="" />';
        html += '                    </div>';
        html += '                    <div class="memInfoLeftBottom">';
        html += '                        <h3>' + data.bottom_quote + '</h3>';
        html += '                    </div>';
        html += '                </div>';
        html += '                <div class="memInfoRight">';
        html += '                    <div class="memInfoInnerRight">';
        html += '                        <h3>TOP BENEFITS</h3>';
        var count = 0 ;
        if (data.top_benefits.length != ''){
            html += '                            <ul>';
            for(var i = 0; i < data.top_benefits.length ; i++){
                html += '                            <li>' + data.top_benefits[i].benefits + '</li>';
            }
            html += '                            </ul>';
        }
        html += '                    </div>';
        html += '                    <div class="memInfoRightBottom">';
        html += '                        <a href="<?php echo get_permalink(get_option( 'auth_checkout_page_id'));?>" class="btnbyNow" data-id="' + data.id + '" data-title="' + data.title + '" data-price="$' + price + '" data-name="' +data.slug+ '">Buy Now<span>></span></a>';
        html += '                    </div>';
        html += '                </div>';
        html += '            </div>';
        html += '        </div>';
        html += '    </div>';

        return html;
    }
    jQuery("#start_my_program").validate({
            rules: {
                start_my_program_email: {
                    required: true,
                    email: true,
                    maxlength: 100
                }
            },
            // Specify the validation error messages
            messages: {
                start_my_program_name: "First Name is required",
                start_my_program_email: {
                    required: "E-mail is required",
                    email: "Invalid E-mail format"
                }
            },
            errorPlacement: function (error, element) {
                    error.insertAfter(jQuery(element).parent());
            },
            submitHandler: function (form) {
                jQuery("#myModal").modal('hide');
                var email = jQuery('#coupon_email').val();
                jQuery.ajax({
                    url: ajaxUrl,
                    dataType : 'JSON',
                    type: 'POST',
                    data: ({ action: 'get_result_type', goal_type: formData.goal_id, gender: formData.gender, age: formData.ageId, formData: formData , email: email}),
                    success: function (response) {
                        if (response.result.length > 0) {
                            jQuery('.goalType').hide();
                            jQuery('.goalTypeLi').removeClass('active');
                            var html = '';
                            // html += '<div class="plan_details">';
                            // html += '   <div class="gender_plan">';
                            // html += '	  <label>Gender</label>';
                            // html += '	  <span>'+response.gender+'</span>';
                            // html += '   </div>';
                            // html += '   <div class="age_plan">';
                            // html += '	  <label>Age</label>';
                            // html += '	  <span>'+formData.age+'</span>';
                            // html += '   </div>';
                            // html += '   <div class="body_plan">';
                            // html += '	  <label>Body Type</label>';
                            // html += '	  <span>'+formData.body+'</span>';
                            // html += '   </div>';
                            // html += '   <div class="goal_plan">';
                            // html += '	  <label>Goal Type</label>';
                            // html += '	  <span>'+formData.goal+'</span>';
                            // html += '   </div>';
                            // html += '</div>';
                            jQuery.each(response.result, function(index,value) {
                                html += getPlansHtml(value);
                            });
                            html += '    <div class="memBottomProcess">';
                            html += getMiddlePlansHtml(response.option);
                            html += '    </div>';
                            html += '    <div class="buy_sec">';
                            html += '       <h4>'+ response.option[0].buy_section1 +'</h4>';
                            html += getBuySectionHtml(response.result);
                            html += '    </div>';

                            html += '    <div class="video_section">';
                            html += '<iframe id="iframe1" src="'+ response.option[0].vimeo_video +'" width="100%" height="500" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                            html += '    </div>';

                            html += '    <div class="buy_sec">';
                            html += '       <h4>'+ response.option[0].buy_section2 +'</h4>';
                            html += getBuySectionHtml(response.result);
                            html += '    </div>';

                            html += '    <div class="testimonial_section">';
                            html += '       <h4>Our Results Can Be Your Results!</h4>';
                            jQuery.each(response.testimonial, function(index,value) {
                                html += getTestimonialSectionHtml(value);
                            });
                            html += '    </div>';

                            html += '    <div class="buy_sec">';
                            html += '       <h4>'+ response.option[0].buy_section3 +'</h4>';
                            html += getBuySectionHtml(response.result);
                            html += '    </div>';


                            if(response.recomended_plan.length > 0){
                                html += '       <div class="memCharge">';
                                html += '           <h4>All Plans</h4>'
                                jQuery.each(response.recomended_plan, function(index,value) {
                                    html += getBottomPlansHtml(value);
                                });
                                html += '       </div>';
                            }
                            jQuery('.results').show();
                            jQuery('.resultsLi').addClass('active');
                            jQuery('.titleH2').html('<span>RECOMMENDED</span> Plan to Hit Your Goal');
                            jQuery('.sub_title').html(formData.goal);
                            jQuery('.startPro').addClass('step-results');
                            jQuery('.results').append(html);
                            jQuery('.less').hide();
                            jQuery('.toggle').hide();
                            localStorage.setItem("gender", formData.gender);
                            localStorage.setItem("age", formData.ageId);
                            localStorage.setItem("body_type", formData.body_id);
                            localStorage.setItem("goal", formData.goal_id);
                            var iframe = document.getElementById('iframe1');
                            var player = $f(iframe);
                            jQuery(window).scroll(function() {
                                if (jQuery('#iframe1').is(":in-viewport")) {
                                    player.api("play");
                                } else {
                                    player.api("pause");
                                }
                            });
                        }
                    }
                });
            }
        });
</script>