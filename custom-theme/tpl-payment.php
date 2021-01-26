<?php
/*
 * Template Name: Payment page
 *
 */

get_header('checkout');
$site_url = get_site_url();
global $pay_msg;
$args = [
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'tpl-payment.php'
];
$pages = get_posts($args);
$background_image = get_field('page_background_image', $pages[0]);

// set the month array
$formattedMonthArray = array(
    "01" => "01", "02" => "02", "03" => "03", "04" => "04",
    "05" => "05", "06" => "06", "07" => "07", "08" => "08",
    "09" => "09", "10" => "10", "11" => "11", "12" => "12",
);
?> 
<section class="myAgesteps startPro noParallax" style="background:url('<?php echo $background_image; ?>');">
    <div class="container">
        <div class="innerPro customHead">
            <h2><span>CHECKOUT</span></h2>
            <div class="choosePlan">
                <div class="rowPlan">
                    <div class="chooseLeft">
                        <h4></h4>
                        <h5></h5>
                    </div>
                    <div class="chooseRight">
                        <h3></h3>
                        <div class="monthChoose">/Month</div>
                    </div>
                </div>
            </div>
            <div class="formCheckOut">
                <?php
                if ($pay_msg != '') {
                    echo $pay_msg;
                }
                ?>
                <form  id='checkout_form' method="post">
                    <div class="innerForm">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="headingTop">
                                    <h4>Personal <span>Information</span></h4>
                                    <div class="checkout_full_name">
                                        <div class="listInput">
                                            <label>First Name*</label>
                                            <input type="text" name="au_firstname" placeholder="" data-placeholder="" value="<?= @$_POST['au_firstname']; ?>" maxlength="50" autocomplete="off" `>
                                        </div>
                                        <div class="listInput">
                                            <label>Last Name*</label>
                                            <input type="text" name="au_lastname" placeholder="" data-placeholder="" value="<?= @$_POST['au_lastname']; ?>" maxlength="50" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="listInput">
                                        <label>Email Address*</label>
                                        <input type="email" name="au_emailaddress" placeholder="" data-placeholder="" value="<?= @$_POST['au_emailaddress']; ?>" maxlength="100" autocomplete="off">
                                    </div>
                                    <div class="listInput termsNote">
                                        <label>Choose a Plan</label>
                                        <div class="termsNote autorenewdiv">
                                            <input type="checkbox" name="autoRevew" id="test2" value="1" checked>
                                            <label for="test2">Autorenew</label>
                                        </div>
                                        <div class="btn-group bootstrap-select">
                                            <select class="selectpicker" name="plan_type" id="plan_type" title="Select your plan">
                                                <!-- <option value="auto" <?php if (@$_POST["plan_type"] == 'auto') echo "selected='true'";if (empty($_POST)) echo "selected='true'"; ?>>Auto Renewal</option> -->
                                                <!-- <option data-subtext="$<?php echo $price;?>/mo" value="1" <?php if (@$_POST["plan_type"] == 1) echo "selected='true'"; if (empty($_POST)) echo "selected='true'"; ?>>1 month</option>
                                                <option data-subtext="$<?php echo $sale_price3;?>/mo" value="2" <?php if (@$_POST["plan_type"] == 2) echo "selected='true'"; ?>>3 month</option>
                                                <option data-subtext="$<?php echo $sale_price6;?>/mo" value="3" <?php if (@$_POST["plan_type"] == 3) echo "selected='true'"; ?>>6 month</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="totalPrice">
                                    <input type="hidden" id="plan_gender" name="gender" value="">
                                    <input type="hidden" id="plan_age" name="age" value="">
                                    <input type="hidden" id="plan_body_type" name="body_type" value="">
                                    <input type="hidden" id="plan_goal" name="goal" value="">
                                    <input type="hidden" id="plan_price" name="price" value="">
                                    <input type="hidden" id="plan_ID" name="plan_ID" value="<?php echo $planId; ?>">
                                    <input type="hidden" id="promo_code" name="promo_code" value="">
                                    <label>&nbsp;</label>
                                    <p>Total Price</p>
                                    <span id="totalprice"></span>
                                </div>    
                                <div class="termsNote">
                                    <input type="checkbox" name="term_condition" id="test1" value="1" <?php echo (@$_POST['term_condition'] == 1 ? 'checked' : ''); ?>/>
                                    <label for="test1">Please accept the <a href="<?= get_permalink(312); ?>" target="_blank">Terms and Conditions</a> Before Continuing.</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="headingTop">
                                    <h4>Card<span>details</span></h4>
                                    <div class="listInput">
                                        <label>Card Holder Name*</label>
                                        <input type="text" name="card_holder_name" placeholder="" data-placeholder="" value="<?= @$_POST['card_holder_name']; ?>" maxlength="100" autocomplete="off">
                                    </div>
                                    <div class="listInput">
                                        <label>Card Number*</label>
                                        <input type="text" name="card_number" class="allow-numeric" maxlength="16" placeholder="" data-placeholder="" value="<?= @$_POST['card_number']; ?>" autocomplete="off">
                                    </div>
                                    <div class="listInput">
                                        <div class="exDate">
                                            <div class="exDateIn">
                                                <label>Expiration Date*</label>
                                                <select class="selectpicker" name="card_exp_month" title="Month">
                                                    <option value="">Select Month</option>
                                                    <?php foreach ($formattedMonthArray as $key => $value) { ?>
                                                        <option value="<?php echo $key; ?>" <?php if (@$_POST["card_exp_month"] == $key) echo "selected"; ?>><?php echo $value; ?></option>   
                                                    <?php }
                                                    ?>
                                                </select>
                                                <select class="selectpicker" name="card_exp_year" title="Year">
                                                    <option value="">Select Year</option>
                                                    <?php
                                                    $starting_year = date('Y');
                                                    $ending_year = date('Y', strtotime('+10 year'));

                                                    for ($starting_year; $starting_year <= $ending_year; $starting_year++) {
                                                        $year = substr($starting_year, -2);
                                                        ?>
                                                        <option value="<?php echo $year; ?>" <?php if (@$_POST["card_exp_year"] == $year) echo "selected"; ?>><?php echo $starting_year; ?></option>                                                
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="cvvNo">
                                                <label>CVV*</label>
                                                <input type="text" name="card_cvv" maxlength="4" placeholder="" autocomplete="off" data-placeholder="">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="listInput">
                                        <label>Promo Code</label>
                                        <div class="col-md-6 col-sm-6" style="padding-left: 0px;">
                                            <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter Promo Code" value="" autocomplete="off" />
                                        </div>
                                        <div class="col-md-6 col-sm-6" style="padding-left: 0px;">
                                            <button  class="btn default-btn check_coupon" id="check_coupon">Apply Now</button>
                                        </div>
                                        <span id="coupon_msg"></span>
                                        <!-- <h4 class="modal-title">Coupon Code</h4> -->
                                    </div>
                                    <!-- <div class="listInput">
                                        <label>Zip Code</label>
                                        <input type="text" name="zip_code" class="allow-numeric" placeholder="" value="<?= @$_POST['zip_code']; ?>" maxlength="8" autocomplete="off">
                                    </div> -->
                                    <!-- <a href="javascript:void(0);" class="btnPromo"> Have a Promo Code? </a> -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                
                            </div>
                            <div class="col-md-12">
                                <div class="btnCheckOut">
                                    <input type="submit" class="btnbyNow checkOutBtn" name="checkout" value="PAY NOW">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="myModal" class="modal fade days_delay_popup" role="dialog" style="" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div calss="modal-image">
                    <img src= "<?php echo get_field('logo', 'option'); ?>" />
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Your promocode entitles you to a free trial for <strong><span class="delay_days"></span> days</strong> after which you will be charged.You must cancel beforehand to avoid charges. Simply call Zack at 727-543-4114.
                Thank you!
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap-select.js"></script>

<style type="text/css">
    .default-btn {background: #e1b30d none repeat scroll 0 0;border-radius: 7px;color: #000;font-family: roboto slab;font-size: 20px;font-weight: 600;padding: 3px 10px;text-transform: uppercase;}
    .modal-sm {width: 400px;}
    #coupon_msg {display: block;margin-bottom: 15px;}
    .errorMsg {color: red;}
    .successMsg {color: green;}
    .modal {text-align: center;padding: 0!important;}
    .modal:before {content: '';display: inline-block;height: 100%;vertical-align: middle;margin-right: -4px;}
    .modal-dialog {display: inline-block;text-align: left;vertical-align: middle;}
    label.error{color: #FF0000;display: block;font-weight: 400;margin-top: 4px;}
    .bootstrap-select.btn-group .dropdown-menu li a span.text {width: 100%;}
    .bootstrap-select.btn-group .dropdown-menu li small {padding-left: .5em;float: right;padding: 0;margin-top: 4px;    font-weight: 500;color:#333;}
    .days_delay_popup .modal-body{
        min-height: 125px;
        font-size: 18px;
        padding: 20px!important;
        color:#000;
    }
    .days_delay_popup .modal-header button.close {
        z-index: 9999;
        color: #fff;
        top: 14px;
    }
    .days_delay_popup .modal-content{
        border-radius: 0;
    }
    .days_delay_popup .modal-header{
        background: linear-gradient(to bottom, #000 0, #242424 100%);
        border-bottom: 6px solid #e2b30d!important;
        padding:15px!important;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        jQuery('textarea, input[type="text"], input[type="password"], input[type="email"]').on('focus', function () {
            jQuery(this).attr('placeholder', '');
        }).on('blur', function () {
            jQuery(this).attr('placeholder', jQuery(this).data('placeholder'));
        });

        var planurl = new RegExp('[\?&]data=([^&#]*)').exec(window.location.href);
        if(planurl !== '' && planurl !== null){
            console.log('jQuery');
            localStorage.setItem("program_plan", planurl[1]);
            var url = window.location.href;
            url = url.slice( 0, url.indexOf('?') );
            window.history.pushState("", "", url);
        }
        var program_plan = localStorage.getItem("program_plan");
        localStorage.removeItem("program_plan");
        if(program_plan === '' || program_plan === null){
            window.location.href = '<?php echo $site_url; ?>';
        }
        var gender = localStorage.getItem("gender");
        var age = localStorage.getItem("age");
        var body_type = localStorage.getItem("body_type");
        var goal = localStorage.getItem("goal");
        localStorage.removeItem("gender");
        localStorage.removeItem("age");
        localStorage.removeItem("body_type");
        localStorage.removeItem("goal");
        jQuery('#plan_gender').val(gender);
        jQuery('#plan_age').val(age);
        jQuery('#plan_body_type').val(body_type);
        jQuery('#plan_goal').val(goal);
        var plan_ID = '';
        var option = '';
        jQuery.ajax({
            url: ajaxUrl,
            type: 'POST',
            dataType: 'JSON',
            data: {action: 'get_plans_details', program_plan: program_plan},
            success: function (response) {
                if (response.success == '1') {
                    plan_ID = response.id;
                    jQuery('.chooseLeft h4').html(response.title);
                    jQuery('.chooseLeft h5').text(response.sub_title);
                    jQuery('.chooseRight h3').html('<span>$</span><label>'+response.sale_price_1+'</label>');
                    jQuery('#totalprice').html('$'+response.sale_price_1);
                    jQuery('#plan_price').val(response.sale_price_1);
                    jQuery('#plan_ID').val(plan_ID);
                    option += '<option data-subtext="$'+response.sale_price_1+'/mo" value="1" selected>1 month</option>';
                    option += '<option data-subtext="$'+response.sale_price_2+'/mo" value="2">3 months</option>';
                    option += '<option data-subtext="$'+response.sale_price_3+'/mo" value="3">6 months</option>';
                    if(response.sale_price_4 != null){
                        option += '<option data-subtext="$'+response.sale_price_4+'/mo" value="4">1 year</option>';
                    }
                    jQuery('#plan_type').html(option);
                    jQuery('#plan_type').selectpicker('refresh');
                    program_plan = '';
                }
            }
        });
        localStorage.removeItem('promo_code');
        jQuery(".btnPromo").click(function () {
            jQuery('#coupon_msg').removeClass('').html('');
            jQuery("#coupon_code").val('').focus();
            //jQuery("#myModal").modal('show');
        });

        jQuery('#plan_type').on('change', function () {
            var plan_type = jQuery(this).val();
            var promo_code = localStorage.getItem('promo_code');
            var checkbox = '';
            if (jQuery('#test2').is(':checked')) {
                checkbox = 'yes';
            } else {
                checkbox = 'no';
            }
            var request_data = {action: 'check_plan_type', plan_type: plan_type, plan_ID: plan_ID, promo_code: promo_code, autorenew: checkbox};

            jQuery.ajax({
                url: ajaxUrl,
                type: 'POST',
                dataType: 'JSON',
                data: request_data,
                success: function (response) {
                    if (response.success == '1') {
                        $('.chooseRight label').text(response.monthly_price);
                        jQuery('#totalprice').html('$' + response.discounted_price);
                        jQuery('#plan_price').val(response.discounted_price);
                        jQuery('#plan_ID').val(plan_ID);
                    }
                }
            });
        });

        jQuery('#coupon_code').blur(function(){
            var coupon_value = jQuery(this).val();
            if(coupon_value == ''){
                $('#promo_code').val('');
            }
        });
        jQuery(document).on('click', "#check_coupon", function (e) {
            e.preventDefault();
            var coupon_code = jQuery("#coupon_code").val();
            var plan_type = $('#plan_type').val();
            var checkbox = '';
            if (jQuery('#test2').is(':checked')) {
                checkbox = 'yes';
            } else {
                checkbox = 'no';
            }
            var request = {action: 'validate_coupon', coupon_code: coupon_code, plan_ID: plan_ID, plan_type: plan_type, autorenew: checkbox};

            if (plan_ID && coupon_code) {
                jQuery.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    dataType: 'JSON',
                    data: request,
                    success: function (response) {
                        if (response.success == '1') {
                            localStorage.setItem('promo_code', coupon_code);
                            jQuery('#coupon_msg').removeClass('').addClass('successMsg').html(response.message);
                            $('#totalprice').text('$' + response.discounted_price);
                            $('.chooseRight label').text(response.discounted_price);
                            jQuery('#plan_price').val(response.discounted_price);
                            $('#promo_code').val(coupon_code);
                            //added by sandeep
                            if(response.billing_days_delay){
                               // alert('test');
                                $('#test2').prop('checked', false);

                                $('#test2').trigger('click');
                                $('#test2').attr('disabled','disabled');
                                inputchek = '<input type="hidden" class="test3" name="autoRevew" id="test3" value="1" /><input type="hidden" class="test3" name="coupon_billing_days_delay" value="'+response.billing_days_delay+'" />';
                                $('.autorenewdiv').append(inputchek);
                                jQuery("#myModal span.delay_days").html(response.billing_days_delay);
                                jQuery("input.checkOutBtn").val('SIGN UP');
                                jQuery("#myModal").modal('show');
                            }else{
                                jQuery("input.checkOutBtn").val('PAY NOW');
                            }
                               
                        } else {
                            jQuery('#coupon_msg').removeClass('').addClass('errorMsg').html(response.message);
                            jQuery("#coupon_code").focus();
                            $('#test2').removeAttr('disabled');
                            jQuery("input.checkOutBtn").val('PAY NOW');
                            if($('.test3').length)
                            {
                                $('.test3').remove();
                            }
                        }
                    }
                });
            } else {
                jQuery('#coupon_msg').removeClass('').addClass('errorMsg').html("Please enter your Promo Code");
                jQuery("#coupon_code").focus();
            }
        });

        jQuery("#checkout_form").validate({
            rules: {
                au_firstname: {
                    required: true,
                    maxlength: 50
                },
                au_lastname: {
                    required: true,
                    maxlength: 50
                },
                au_emailaddress: {
                    required: true,
                    email: true,
                    maxlength: 100
                },
                card_holder_name: {
                    required: true,
                    maxlength: 100
                },
                card_number: {
                    required: true,
                    number: true,
                    minlength: 13
                },
                card_cvv: {
                    required: true,
                    number: true,
                    minlength: 3,
                    maxlength: 4
                },
                zip_code: {
                    required: true,
                    maxlength: 8,
                    number: true
                },
                card_exp_month: "required",
                card_exp_year: "required",
                term_condition: "required"
            },
            messages: {
                au_firstname: "First Name is required",
                au_lastname: "Last Name is required",
                au_emailaddress: {
                    required: "E-mail is required",
                    email: "Invalid E-mail format"
                },
                card_holder_name: "Card Holder Name is required",
                card_number: {
                    required: "Card Number is required",
                    number: "Please enter valid Card Number",
                    minlength: "Please enter valid Card Number"
                },
                card_cvv: {
                    required: "CVV is required",
                    number: "Please enter valid CVV",
                    minlength: "Please enter valid CVV",
                    maxlength: "Please enter valid CVV"
                },
                zip_code: "Please enter valid Zip Code",
                card_exp_month: "Select Month",
                card_exp_year: "Select Year",
                term_condition: "Please accept Terms & Conditions"
            },
            errorPlacement: function (error, element) {
                if (element.attr("type") == "checkbox") {
                    error.insertAfter($(element).parents('.termsNote'));
                } else {
                    error.insertAfter($(element));
                }
            },
            submitHandler: function (form) {
                jQuery('.checkOutBtn').attr('disabled','disabled');
                form.submit();
            }
        });

        $(".allow-numeric").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                            (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        jQuery('#test2').click(function(){        
            var autorenew = jQuery(this).val();
            var promocode = localStorage.getItem("promo_code");
            if (jQuery(this).is(':checked')) {
                jQuery.ajax({
                    url: ajaxUrl,
                    dataType : 'JSON',
                    type: 'GET',
                    data: { action: 'get_autorenewprice', planid: plan_ID, code: promocode},
                    success: function (response) {
                        var html = '';
                        var count= 1;
                        jQuery.each(response.sale_price, function(index,value) {
                            html += getrenewHtml(index,value,count);
                            count++;
                        });
                        if(response.discounted_price != ""){
                            $('.chooseRight label').text(response.discounted_price);
                            jQuery('#totalprice').html('$' + response.discounted_price);
                            jQuery('#plan_price').val(response.discounted_price);
                        } else {
                            $('.chooseRight label').text(response.sale_price['1 month']);
                            jQuery('#totalprice').html('$' + response.sale_price['1 month']);
                            jQuery('#plan_price').val(response.sale_price['1 month']); 
                        }
                        jQuery('#plan_type').html(html);
                        jQuery('#plan_type').selectpicker('refresh');
                    }
                });
            } else {
                jQuery.ajax({
                    url: ajaxUrl,
                    dataType : 'JSON',
                    type: 'GET',
                    data: { action: 'get_nonautorenewprice', planid: plan_ID },
                    success: function (response) {
                        var html = '';
                        var count= 1;
                        jQuery.each(response.sale_price, function(index,value) {
                            html += getnonRenewHtml(index,value,count);
                            count++;
                        });
                        if(response.discounted_price != ""){
                            $('.chooseRight label').text(response.discounted_price);
                            jQuery('#totalprice').html('$' + response.discounted_price);
                            jQuery('#plan_price').val(response.discounted_price);
                        } else {
                            $('.chooseRight label').text(response.sale_price['1 month']);
                            jQuery('#totalprice').html('$' + response.sale_price['1 month']);
                            jQuery('#plan_price').val(response.sale_price['1 month']); 
                        }
                        jQuery('#plan_type').html(html);
                        jQuery('#plan_type').selectpicker('refresh');
                    }
                });
            }
        });

    });
    function getrenewHtml(month,data,count){
        var renewHtml = '';
        if(month == '1 month'){
            renewHtml += '<option data-subtext="$'+data+'/mo" value="'+count+'" selected>'+month+'</option>';
        } else {
            renewHtml += '<option data-subtext="$'+data+'/mo" value="'+count+'">'+month+'</option>';
        }
        return renewHtml;
    }
    function getnonRenewHtml(month,data,count){
        var nonRenewHtml = '';
        if(month == '1 month'){
            nonRenewHtml += '<option data-subtext="$'+data+'/mo" value="'+count+'" selected>'+month+'</option>';
        } else {
            nonRenewHtml += '<option data-subtext="$'+data+'/mo" value="'+count+'">'+month+'</option>';
        }
        return nonRenewHtml;
    }

</script>