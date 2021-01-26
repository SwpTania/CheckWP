<?php
// Metabox Options
global $post;
$seese_id   = ( isset( $post ) ) ? $post->ID : false;
$seese_id   = ( is_home() ) ? get_option( 'page_for_posts' ) : $seese_id;
if ( class_exists( 'WooCommerce' ) ) {
  $seese_id   = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $seese_id;
  $seese_id   = ( !is_product_category() && !is_product_tag() ) ? $seese_id : false;
}
$seese_id   = ( !is_search() && !is_404() && !is_archive() && !is_category() && !is_tag() && !is_single('testimonial') ) ? $seese_id : false;
$seese_meta = get_post_meta( $seese_id, 'page_type_metabox', true );

// Topbar Layout - ThemeOptions & Metabox
if ($seese_meta) {
  $top_bar  = $seese_meta['top_bar'];
  if ($top_bar === 'custom') {
	  $left_content   = $seese_meta['topbar_left_content'];
	  $center_content = $seese_meta['topbar_center_content'];
	  $search_icon    = $seese_meta['topbar_search_icon'];
		$heart_icon     = $seese_meta['topbar_heart_icon'];
		$cart_widget    = $seese_meta['topbar_cart_widget'];
		$login_account  = $seese_meta['topbar_login_my_account'];
  } else { 
	  $left_content   = cs_get_option('topbar_left_content');
	  $center_content = cs_get_option('topbar_center_content');
	  $search_icon    = cs_get_option('topbar_search_icon');
		$heart_icon     = cs_get_option('topbar_heart_icon');
		$cart_widget    = cs_get_option('topbar_cart_widget');
		$login_account  = cs_get_option('topbar_login_my_account');
	}
} else {
  $left_content   = cs_get_option('topbar_left_content');
	$center_content = cs_get_option('topbar_center_content');
	$search_icon    = cs_get_option('topbar_search_icon');
	$heart_icon     = cs_get_option('topbar_heart_icon');
	$cart_widget    = cs_get_option('topbar_cart_widget');
	$login_account  = cs_get_option('topbar_login_my_account');
}

$a = ($left_content) ? true : false;
$b = ($center_content) ? true : false;
$c = ($search_icon || $heart_icon || $cart_widget || $login_account) ? true : false;

if ($a && $b && $c) {
  $top_left_class   = 'col-lg-4 col-md-4 col-sm-3 col-xs-12';
  $top_center_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
  $top_right_class  = 'col-lg-4 col-md-4 col-sm-3 col-xs-12';
} else if ($a && ($b || $c)) {
  $top_left_class   = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
  $top_center_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
  $top_right_class  = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
} else if (!$a && $b && $c) {
  $top_left_class  = '';
  $top_center_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
  $top_right_class  = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
} else if (($a && !($b || $c)) || ($b && !($a || $c)) || ($c && !($a || $b))) {
  $top_left_class   = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
  $top_center_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
  $top_right_class  = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
} else {
  $top_left_class   = '';
  $top_center_class = '';
  $top_right_class  = '';
} ?>

<?php if ($a || $b || $c) { ?>

  <!-- Top Bar Start -->
  <div class="seese-topbar">
    <div class="container">
      <div class="row">

        <?php if ($a) { ?>
          <div class="seese-topbar-left <?php echo esc_attr($top_left_class); ?>">
            <?php echo do_shortcode($left_content); // TriumphWP ?>
          </div>
        <?php } ?>

        <?php if ($b) { ?>
          <div class="sesse-topbar-center <?php echo esc_attr($top_center_class); ?>">
            <?php echo do_shortcode($center_content); // TriumphWP ?>
          </div>
        <?php } ?>

        <?php if ($c) { ?>
          <div class="seese-topbar-right <?php echo esc_attr($top_right_class); ?>">
           	<ul>

	            <?php
	            if ($search_icon) {
	              if ( class_exists( 'WooCommerce' ) ) { ?><li>
	                  <a data-toggle="modal" data-target="#seese-search-modal"><img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/search_icon_white.png" alt="search_icon" width="18" height="18" /></a>
	                </li><?php
	              }
	            }

	            if ($cart_widget) {
	              if ( class_exists( 'WooCommerce' ) ) {
	                global $woocommerce;
	                $cart_url = wc_get_cart_url(); ?><li>
	                  <a href="javascript:void(0);" id="seese-cart-trigger">
	                    <?php if ( $woocommerce->cart->get_cart_contents_count() != '0') { ?>
	                    <span class="seese-cart-count"><?php echo $woocommerce->cart->get_cart_contents_count(); ?></span>
	                    <?php } ?>
	                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/cart_icon_white.png" alt="cart_icon" width="18" height="20" />
	                  </a>
	                </li><?php
	              }
	            }

	            if ($heart_icon) {
	              if ( class_exists( 'WooCommerce' ) && function_exists( 'yith_wishlist_install' ) ) { ?><li>
	                  <a href="<?php echo get_the_permalink(get_option( 'yith_wcwl_wishlist_page_id')); ?>"><img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/heart_icon_white.png" alt="heart_icon" width="20" height="20" /></a>
	                </li><?php
	              }
	            }

	            if ($login_account) {
	              if ( class_exists( 'WooCommerce' ) ) {
	                $account_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );  ?><li>
	                  <a href="<?php echo esc_url($account_url); ?>"><img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/user_icon_white.png" alt="user_icon" width="20" height="20" /></a>
	                </li><?php
	              }
	            } ?>
      		
      			<?php if ($seese_wpml) { ?><li class="seese-wpml"><?php echo do_shortcode($wpml_shortcode); ?></li><?php } ?>

            </ul>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
  <!-- Top Bar End -->

<?php } ?>