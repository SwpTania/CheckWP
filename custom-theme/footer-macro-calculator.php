<footer>
  <div class="container-fluid">
    <div class="logoMain">
      <a href="<?php echo get_site_url();?>">
        <noscript><img
            src="<?php echo get_field('logo', 'option'); ?>"
            alt="" /></noscript><img class=" ls-is-cached lazyloaded"
          src="https://cdn.shortpixel.ai/client/q_glossy,ret_img/<?php echo get_field('logo', 'option'); ?>"
          data-src="https://cdn.shortpixel.ai/client/q_glossy,ret_img/<?php echo get_field('logo', 'option'); ?>"
          alt="">
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
            <input type="text" name="username" id="username" class="required" placeholder="" data-placeholder="" value="" maxlength="100" autocomplete="off">
        </div>
         <div class="listInput">
            <label>Password*</label>
            <input type="password" name="password" id="password"  class="required" placeholder="" data-placeholder="" value=""  maxlength="100" autocomplete="off">
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

<?php
$template_directory = get_template_directory_uri() . '/';
$site_url = get_site_url();
?>
</main>
<script type='text/javascript' src="<?php echo $template_directory ?>assets/js/jquery.min.js"></script>
<script type='text/javascript' src="<?php echo $template_directory ?>assets/js/bootstrap.min.js"></script>
<script type='text/javascript' src="<?php echo $template_directory ?>assets/js/bootstrap-select.js"></script>
<script type='text/javascript' src="<?php echo $template_directory ?>assets/js/owl.carousel.min.js"></script>
<script type='text/javascript' src="<?php echo $template_directory ?>assets/js/parallax.min.js"></script>

<script type='text/javascript' src="<?php echo $template_directory ?>assets/js/range-slider.js"></script>

<script type='text/javascript' src="<?php echo $template_directory ?>assets/js/custom.js"></script>
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

</body>
</html>
<?php wp_footer(); ?>