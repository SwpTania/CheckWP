</div>
<?php
global $post;
$page_id = get_queried_object_id();
$template_directory = get_template_directory_uri() . '/';
$site_url = get_site_url();
if ( ! is_page_template( 'tpl-startmyprogram.php') && ! is_page_template( 'tpl-payment.php' ) && ! is_page_template( 'tpl-macro-payment.php' ) ) { ?>
<footer>
    <div class="container-fluid">
        <div class="logoMain">
            <a href="<?php echo $site_url; ?>">
                <img src="<?php echo  get_field('logo', 'option'); ?>" alt="" />
            </a>
        </div>
        <div class="navMain">
            <nav>
                <ul>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'header-menu clearfix',
                            'items_wrap' => '%3$s',
                            'fallback_cb' => false
                        )
                    );
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</footer>
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form id="login" action="login" method="post">        
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="modal-close">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
         <p class="status"></p>
        <div class="listInput">
            <label>Username or E-mail*</label>
            <input type="text" name="username" id="username" placeholder="" data-placeholder="" value="" maxlength="100" class="required" autocomplete="off">
        </div>
         <div class="listInput">
            <label>Password*</label>
            <input type="password" name="password" id="password"  placeholder="" data-placeholder="" value="" class="required" maxlength="100" autocomplete="off">
        </div>     

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <!--<button class="btn btn-default">Login</button>-->
         <input class="submit_button" type="submit" value="Login" name="submit">
      </div>
     <div class="forgot_pwd_link">
      <a class="lost"  id="forgotModal" data-dismiss="modal" data-toggle="modal" data-target="#modalForgotForm">Forgot password?</a>
      </div>
      <!--<a class="lost" href="<?php //echo wp_lostpassword_url(); ?>">Lost your password?</a>-->
       <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
     </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalForgotForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form id="forgot_password" class="ajax-auth" action="forgot_password" method="post">          
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Forgot Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="modal-close">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
         <p class="status"></p>
          <?php wp_nonce_field('ajax-forgot-nonce', 'forgotsecurity'); ?>  
        <div class="listInput">
            <label>Username or E-mail*</label>
            <input id="user_login" type="text" class="required" name="user_login">
        </div>  
      </div>
      <div class="modal-footer d-flex justify-content-center">       
         <input class="submit_button" type="submit" value="SUBMIT" name="submit">
      </div>    
     </form>
    </div>
  </div>
</div>
<?php } ?>
</main>

<!-- <script src="<?php echo $template_directory ?>assets/js/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/js/scripts.js"></script>

<script src="<?php echo $template_directory ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $template_directory ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo $template_directory ?>assets/js/parallax.min.js"></script>
<script src="<?php echo $template_directory ?>assets/js/bootstrap-select.js"></script>
<script src="<?php echo $template_directory ?>assets/js/custom.js"></script>
<script src="<?php echo $template_directory ?>assets/js/jquery_masking.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>-->
<!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script> -->

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1007829362;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1007829362/?guid=ON&amp;script=0"/>
</div>
</noscript>


<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1028592353869778'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1028592353869778&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

<!-- Google Code for Remarketing Tag -->
<!--
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: https://google.com/ads/remarketingsetup
-->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1007829362;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1007829362/?guid=ON&amp;script=0"/>
</div>
</noscript>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103685736-1', 'auto');
  ga('send', 'pageview');

</script>
<!------ Consultation Popup ------>
<?php $show_consultation_popup = get_option('show_consultation_popup');
if ($show_consultation_popup == 1){
    //if(!in_array($page_id, array(266,4))) {  
    if($page_id == '62' || $page_id == '8' || $page_id == '663' || $page_id == '1322' || $page_id == '6' || $post->ID == '46') {  
    ?>    
    <div class="cnsltnPop" style="display: none">
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
                            <!-- <p>Share your short details with us.</p> -->
                            <div class="cpClose">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </div>
                        </div>
                        <form id="form_consultation">
                            <div class="cpSngl">
                                <input type="text" name="cp_name" id="cp_name" placeholder="Name" data-placeholder="Name"/>
                            </div>
                            <div class="cpSngl">
                                <input type="text" name="cp_number" id="cp_number" placeholder="Phone No." data-placeholder="Phone No." />
                            </div>
                            <div class="cpSngl">
                                <input type="text" name="cp_email_id" id="cp_email_id" placeholder="Email Id" data-placeholder="Email Id" />
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
    </div>
    <?php } 
} ?>
<?php 
$show_exit_popup = get_option('show_exit_popup');
if ($show_exit_popup == 1){
?>
    <div class="modal fade sixpackMadule fade bs-example-modal-lg" id="ouibounce-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
        <div class="modal-dialog modal-lg" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?php echo get_template_directory_uri().'/assets/img/crossimg.png'; ?>" alt=""></button>

            <div class="modal-content">
                <div class="modal-body">
                    <div class="popupMain">
                        <div class="leaveRight">
                            <?php echo get_option('exit_popup_heading_text');?>
                        </div>
                        <div class="freegiftMain">
                            <div class="offergift">
                                <?php echo get_option('exit_popup_regular_text');?>
                                <div class="gftMmg">
                                    <img src="<?php echo get_template_directory_uri().'/assets/img/freegift.png'; ?>" alt="">
                                </div>
                                <?php echo get_option('exit_popup_text_after_image');?>
                            </div>

                            <div class="poposbscriber">
                                <form id="exit_popup_form">
                                    <div class="colcustom">
                                        <div class="inptsbscrbr inptLeft">
                                            <input class="form-control" name="exit_popup_email" id="exit_popup_email" data-placeholder="<?php echo get_option('exit_popup_input_placeholder');?>" placeholder="<?php echo get_option('exit_popup_input_placeholder');?>" autofocus tabIndex="-1">
                                        </div>
                                    </div>

                                    <div class="colcustom">
                                        <div class="inptsbscrbr inptRight">
                                            <button type="submit" class="btn-send"><?php echo get_option('exit_popup_button_text');?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
 <script type="text/javascript">
    var _ouibounce = ouibounce(document.getElementById('ouibounce-modal'),{
        aggressive: true,
        callback: function(e) { 
            jQuery('#ouibounce-modal').find(".exit_popup_email").focus();
         }
    });
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
    var is_focus = 1;
    var consultation_popup = 0;
    jQuery("#exit_popup_form").validate({
        rules: {
            exit_popup_email: {
                required: true,
                email: true,
                maxlength: 100
            }
        },
        messages: {
            exit_popup_email: {
                required: "E-mail is required",
                email: "Invalid E-mail format"
            }
        },
        errorPlacement: function (error, element) {
                error.insertAfter(jQuery(element).parent());
        },
        submitHandler: function (form) {
            var email = jQuery('#exit_popup_email').val();
            jQuery.ajax({
                url: ajaxUrl,
                dataType : 'JSON',
                type: 'POST',
                data: ({ action: 'add_email_data', email: email}),
                success: function (response) {
                    if(response.status == 'success'){
                        jQuery("#ouibounce-modal").modal('hide');
                    }
                }
            });
        }
    });
    jQuery("#form_consultation").validate({
        rules: {
            cp_name: {
                required: true,
                maxlength: 50
            },
            cp_number: {
                required: true,
            },
            cp_email_id: {
                required: true,
                email: true,
                maxlength: 100
            }
        },
        messages: {
            cp_name: {
                required: "Name is required.",
                maxlength: "Please enter valid name."
            },
            cp_number: {
                required: "Number is required.",
            },
            cp_email_id:{
                required: "E-mail is required.",
                email: "Please enter valid E-mail.",
                maxlength: "Please enter valid E-mail."
            }
        },
        errorPlacement: function (error, element) {
                error.insertAfter(jQuery(element).parent());
        },
        submitHandler: function (form) {
            var cp_name = jQuery('#cp_name').val();
            var cp_number = jQuery('#cp_number').val();
            var cp_email_id = jQuery('#cp_email_id').val();
            console.log(cp_name, cp_number, cp_email_id);
            jQuery.ajax({
                url: ajaxUrl,
                dataType : 'JSON',
                type: 'POST',
                data: ({ action: 'set_consultation_email_data', email: cp_email_id, name: cp_name, number:cp_number }),
                success: function (response) {
                    console.log(response);
                    if(response == 'success'){
                        jQuery('.cnsltnPop').hide();
                    }
                }
            });
        }
    });
    jQuery("#exit_popup_email").focus(function(){
        jQuery(this).addClass("exitpopup_focua");
        jQuery(this).removeAttr('placeholder');
        is_focus = 0;
    });
    jQuery("#exit_popup_email").blur(function(){
       jQuery(this).removeClass("exitpopup_focua");
       jQuery(this).attr("placeholder", jQuery(this).data('placeholder'));
    });    
    setInterval(function(){  
        if(is_focus == 1){
            jQuery("#exit_popup_email").focus();
        }
    }, 10);
    setInterval(function(){
        var local_consultaion_popup = sessionStorage.getItem("consultation_popup");
        if(consultation_popup == 0 && local_consultaion_popup != 1){
            jQuery('.cnsltnPop').show();
            consultation_popup = 1;
            sessionStorage.setItem("consultation_popup", 1);
        }
    }, 20000);

    jQuery('#cp_name').focus(function(){
        jQuery(this).removeAttr('placeholder');
    });

    jQuery('#cp_number').focus(function(){
        jQuery(this).removeAttr('placeholder');
    });

    jQuery('#cp_email_id').focus(function(){
        jQuery(this).removeAttr('placeholder');
    });

    jQuery('#cp_name').blur(function(){
        jQuery(this).attr('placeholder', jQuery(this).data('placeholder'));
    });

    jQuery('#cp_number').blur(function(){
        jQuery(this).attr('placeholder', jQuery(this).data('placeholder'));
    });

    jQuery('#cp_email_id').blur(function(){
        jQuery(this).attr('placeholder', jQuery(this).data('placeholder'));
    });

});
    jQuery('.cpClose,.cpBtm .noBtn').click(function(){
        jQuery('.cnsltnPop').hide();
    });

    jQuery('.wpcf7-textarea').on('blur',function(){
    	var contact_message = jQuery(this).val();
    	jQuery(this).val(contact_message.trim());
    });
</script>
<style type="text/css">
    .exitpopup_focua{
        border: 4px solid #e1b30d !important;
        border-radius: 4px;
    }
</style>
</body>

</html>
<?php wp_footer(); ?>
