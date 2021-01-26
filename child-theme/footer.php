<?php
/*
 * The template for displaying the footer.
 */

global $post;
$seese_id    = ( isset( $post ) ) ? $post->ID : false;
$seese_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $seese_id;
if ( class_exists( 'WooCommerce' ) ) { $seese_id = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $seese_id; }
$seese_meta  = get_post_meta( $seese_id, 'page_type_metabox', true );

if ($seese_meta) {
  $hide_footer = $seese_meta['hide_footer'];
  $menu_bar    = $seese_meta['menu_bar'];
  if ($menu_bar === 'hide') {
  	$cart_widget = false;
  } elseif ($menu_bar === 'custom') {
    $cart_widget = $seese_meta['cart_widget'];
  } else {
    $cart_widget = cs_get_option('cart_widget');
  }
} else {
  $hide_footer  = false;
  $cart_widget  = cs_get_option('cart_widget');
} ?>

</div>
<!-- Seese Wrapper End -->

<?php
$footer_top_block    = cs_get_option('footer_top_block');
$footer_widget_block = cs_get_option('footer_widget_block');
$need_copyright      = cs_get_option('need_copyright');

// Footer Core Service Block
if( $footer_top_block ) { ?>
  <div class="container-fluid seese-bottomboxes">
    <div class="row">
      <?php if (is_active_sidebar( 'footer-top-block' )) {
        dynamic_sidebar( 'footer-top-block' );
      } ?>
    </div>
  </div>
<?php }

if (!$hide_footer) {
  if ($footer_widget_block || $need_copyright) { ?>
    <!-- Footer Start -->
    <footer class="seese-footer">
      <?php
      if (isset($footer_widget_block)) {
        // Footer Widget Block
        get_template_part( 'layouts/footer/footer', 'widgets' );
      }
      if (isset($need_copyright)) {
        // Copyright Block
        get_template_part( 'layouts/footer/footer', 'copyright' );
      }
      ?>
    </footer>
    <!-- Footer End-->
  <?php
  }
} // Hide Footer Metabox ?>

</div><!-- Seese Wrap End -->

<a href="javascript:void(0)" id="seese-closebtn"><i class="fa fa-times" aria-hidden="true"></i></a>

<?php
// Preloader Options Start
$seese_pre_loader = cs_get_option('need_theme_preloader');
if ($seese_pre_loader) {
  $theme_preloader_options = cs_get_option('theme_preloader_options');
  if(isset($theme_preloader_options)) {
    $preloader_styles_list = array("ball-pulse"=>3,"ball-grid-pulse"=>9,"ball-clip-rotate"=>1,"ball-clip-rotate-pulse"=>2,"square-spin"=>1,
      "ball-clip-rotate-multiple"=>2,"ball-pulse-rise"=>5,"ball-rotate"=>1,"cube-transition"=>2,"ball-zig-zag"=>2,
      "ball-zig-zag-deflect"=>2,"ball-triangle-path"=>3,"ball-scale"=>1,"line-scale"=>5,"line-scale-party"=>4,
      "ball-scale-multiple"=>3,"ball-pulse-sync"=>3,"ball-beat"=>3,"line-scale-pulse-out"=>5,"line-scale-pulse-out-rapid"=>5,
      "ball-scale-ripple"=>1,"ball-scale-ripple-multiple"=>3,"ball-spin-fade-loader"=>8,"line-spin-fade-loader"=>8,"triangle-skew-spin"=>1,
      "pacman"=>5,"ball-grid-beat"=>9,"semi-circle-spin"=>1,"ball-scale-random"=>3);
    ?>
    <div class="seese-preloader-mask">
      <div id="seese-preloader-wrap">
        <div class="seese-preloader-html <?php echo esc_attr($theme_preloader_options); ?>">
          <?php for ($x = 0; $x < $preloader_styles_list[$theme_preloader_options]; $x++) { echo '<div></div>'; } ?>
        </div>
      </div>
    </div>
    <?php
  }
}
//Preloader Options End

wp_footer(); ?>
</body>
</html>