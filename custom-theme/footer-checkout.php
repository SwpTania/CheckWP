</div>
<?php
$template_directory = get_template_directory_uri() . '/';
$site_url = get_site_url();
?>
</main>
<script src="<?php echo $template_directory ?>assets/js/jquery.min.js"></script>
<script src="<?php echo $template_directory ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $template_directory ?>assets/js/bootstrap-select.js"></script>
<script src="<?php echo $template_directory ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo $template_directory ?>assets/js/parallax.min.js"></script>
<script src="<?php echo $template_directory ?>assets/js/custom.js"></script>
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
                                        <input class="form-control" name="exit_popup_email" id="exit_popup_email" placeholder="<?php echo get_option('exit_popup_input_placeholder');?>">
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
//    var _ouibounce = ouibounce(document.getElementById('ouibounce-modal'),{
//        aggressive: true
//    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function(){
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
        jQuery('#ouibounce-modal').on('shown.bs.modal', function (e) {
            jQuery("#myModal").modal('hide');
        })
    });
</script>
</body>

</html>
<?php wp_footer(); ?>