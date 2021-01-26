<?php
// Logo Image
$brand_logo_default = cs_get_option('brand_logo_default');
$brand_logo_retina  = cs_get_option('brand_logo_retina');

// Logo Size
$retina_width  = cs_get_option('retina_width');

// Logo Spacings
$brand_logo_top    = cs_get_option('brand_logo_top');
$brand_logo_bottom = cs_get_option('brand_logo_bottom');

// Logo Style
$logo_style  = '';
$logo_style .= ($brand_logo_top) ? 'padding-top:'.seese_check_px($brand_logo_top).';' : '';
$logo_style .= ($brand_logo_bottom) ? 'padding-bottom:'.seese_check_px($brand_logo_bottom).';' : '';
$logo_style .= ($retina_width) ? 'max-width:'.seese_check_px($retina_width).';' : '';

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

// Menubar Layout - ThemeOptions & Metabox
if ($seese_meta) {
  $menu_bar  = $seese_meta['menu_bar'];
  if ($menu_bar === 'custom') {
    $menubar_rcnt  = $seese_meta['menubar_right_content'];
    $menubar_infos = $seese_meta['menubar_infos'];
    $search_icon   = $seese_meta['search_icon'];
		$heart_icon    = $seese_meta['heart_icon'];
		$cart_widget   = $seese_meta['cart_widget'];
    $login_account = $seese_meta['login_my_account'];
		$menubar_bg    = $seese_meta['menubar_bg'];
  } else {
    $menubar_rcnt  = cs_get_option('menubar_right_content');
    $menubar_infos = cs_get_option('menubar_infos');
    $search_icon   = cs_get_option('search_icon');
		$heart_icon    = cs_get_option('heart_icon');
		$cart_widget   = cs_get_option('cart_widget');
    $login_account = cs_get_option('login_my_account');
    $menubar_bg    = '';
	}
} else {
  $menubar_rcnt  = cs_get_option('menubar_right_content');
  $menubar_infos = cs_get_option('menubar_infos');
  $search_icon   = cs_get_option('search_icon');
  $heart_icon    = cs_get_option('heart_icon');
	$cart_widget   = cs_get_option('cart_widget');
	$login_account = cs_get_option('login_my_account');
  // $seese_wpml = cs_get_option('wpml');
  $wpml_shortcode = cs_get_option('wpml_shortcode');
  $menubar_bg    = '';
}

if ($seese_meta) {
  $top_bar  = $seese_meta['top_bar'];
  if ($top_bar === 'custom') {
    $search_icon_topbar   = $seese_meta['topbar_search_icon'];
    $heart_icon_topbar    = $seese_meta['topbar_heart_icon'];
    $cart_widget_topbar   = $seese_meta['topbar_cart_widget'];
    $login_account_topbar = $seese_meta['topbar_login_my_account'];
  } else { 
    $search_icon_topbar   = cs_get_option('topbar_search_icon');
    $heart_icon_topbar    = cs_get_option('topbar_heart_icon');
    $cart_widget_topbar   = cs_get_option('topbar_cart_widget');
    $login_account_topbar = cs_get_option('topbar_login_my_account');
  }
} else {
  $search_icon_topbar   = cs_get_option('topbar_search_icon');
  $heart_icon_topbar    = cs_get_option('topbar_heart_icon');
  $cart_widget_topbar   = cs_get_option('topbar_cart_widget');
  $login_account_topbar = cs_get_option('topbar_login_my_account');
}

$logo_column = cs_get_option('logo_column_layout');
$menu_column = cs_get_option('menu_column_layout');
$right_icon_column = cs_get_option('icon_column_layout');

if ($seese_meta) {
  $menu_bar  = $seese_meta['menu_bar'];
  if ($menu_bar === 'custom') {
    $seese_wpml = $seese_meta['wpml'];
    if($seese_wpml) {
      $wpml_shortcode = $seese_meta['wpml_shortcode'];
    } else {
      $seese_wpml = cs_get_option('wpml');
      $wpml_shortcode = cs_get_option('wpml_shortcode');
    }
  } else {
    $seese_wpml = cs_get_option('wpml');
    $wpml_shortcode = cs_get_option('wpml_shortcode');
  }
} else {
  $seese_wpml = cs_get_option('wpml');
  $wpml_shortcode = cs_get_option('wpml_shortcode');
}

if($logo_column === '1/12'){
  $logo_col_class = 'col-lg-1 col-md-1 col-sm-1 col-xs-6 seese-logo-actual';
} elseif($logo_column === '1/5'){
  $logo_col_class = 'col-lg-2 col-md-2 col-sm-2 col-xs-6 seese-logo-actual';
} elseif($logo_column === '1/4'){
  $logo_col_class = 'col-lg-3 col-md-3 col-sm-3 col-xs-6 seese-logo-actual';
} elseif($logo_column === '1/3'){
  $logo_col_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-6 seese-logo-actual';
} elseif($logo_column === '5/12'){
  $logo_col_class = 'col-lg-5 col-md-5 col-sm-5 col-xs-6 seese-logo-actual';
} elseif($logo_column === '1/2'){
  $logo_col_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-6 seese-logo-actual';
} elseif($logo_column === '7/12'){
  $logo_col_class = 'col-lg-7 col-md-7 col-sm-7 col-xs-6 seese-logo-actual';
} elseif($logo_column === '2/3'){
  $logo_col_class = 'col-lg-8 col-md-8 col-sm-8 col-xs-6 seese-logo-actual';
} elseif($logo_column === '3/4'){
  $logo_col_class = 'col-lg-9 col-md-9 col-sm-9 col-xs-6 seese-logo-actual';
} elseif($logo_column === '5/6'){
  $logo_col_class = 'col-lg-10 col-md-10 col-sm-10 col-xs-6 seese-logo-actual';
} elseif($logo_column === '11/12'){
  $logo_col_class = 'col-lg-11 col-md-11 col-sm-11 col-xs-6 seese-logo-actual';
} elseif($logo_column === '12/12'){
  $logo_col_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-6 seese-logo-actual';
} else {
  $logo_col_class = 'col-lg-2 col-md-2 col-sm-2 col-xs-6 site-logo';
}

if($menu_column === '1/12'){
  $menu_col_class = 'col-lg-1 col-md-1 col-sm-1 col-xs-6 seese-menu-actual';
} elseif($menu_column === '1/5'){
  $menu_col_class = 'col-lg-2 col-md-2 col-sm-2 col-xs-6 seese-menu-actual';
} elseif($menu_column === '1/4'){
  $menu_col_class = 'col-lg-3 col-md-3 col-sm-3 col-xs-6 seese-menu-actual';
} elseif($menu_column === '1/3'){
  $menu_col_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-6 seese-menu-actual';
} elseif($menu_column === '5/12'){
  $menu_col_class = 'col-lg-5 col-md-5 col-sm-5 col-xs-6 seese-menu-actual';
} elseif($menu_column === '1/2'){
  $menu_col_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-6 seese-menu-actual';
} elseif($menu_column === '7/12'){
  $menu_col_class = 'col-lg-7 col-md-7 col-sm-7 col-xs-6 seese-menu-actual';
} elseif($menu_column === '2/3'){
  $menu_col_class = 'col-lg-8 col-md-8 col-sm-8 col-xs-6 seese-menu-actual';
} elseif($menu_column === '3/4'){
  $menu_col_class = 'col-lg-9 col-md-9 col-sm-9 col-xs-6 seese-menu-actual';
} elseif($menu_column === '5/6'){
  $menu_col_class = 'col-lg-10 col-md-10 col-sm-10 col-xs-6 seese-menu-actual';
} elseif($menu_column === '11/12'){
  $menu_col_class = 'col-lg-11 col-md-11 col-sm-11 col-xs-6 seese-menu-actual';
} elseif($menu_column === '12/12'){
  $menu_col_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-6 seese-menu-actual';
} else {
  $menu_col_class = 'col-lg-8 col-md-8 col-sm-8 col-xs-6 site-menu';
}

if($right_icon_column === '1/12'){
  $icon_col_class = 'col-lg-1 col-md-1 col-sm-1 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '1/5'){
  $icon_col_class = 'col-lg-2 col-md-2 col-sm-2 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '1/4'){
  $icon_col_class = 'col-lg-3 col-md-3 col-sm-3 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '1/3'){
  $icon_col_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '5/12'){
  $icon_col_class = 'col-lg-5 col-md-5 col-sm-5 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '1/2'){
  $icon_col_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '7/12'){
  $icon_col_class = 'col-lg-7 col-md-7 col-sm-7 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '2/3'){
  $icon_col_class = 'col-lg-8 col-md-8 col-sm-8 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '3/4'){
  $icon_col_class = 'col-lg-9 col-md-9 col-sm-9 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '5/6'){
  $icon_col_class = 'col-lg-10 col-md-10 col-sm-10 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '11/12'){
  $icon_col_class = 'col-lg-11 col-md-11 col-sm-11 col-xs-6 seese-icon-actual';
} elseif($right_icon_column === '12/12'){
  $icon_col_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-6 seese-icon-actual';
} else {
  $icon_col_class = 'col-lg-2 col-md-2 col-sm-2 col-xs-6 site-header-icon';
}

$menubar_bg = ($menubar_bg) ? $seese_meta['menubar_bg'] : '';
$menubar_bg = ($menubar_bg) ? 'background-color: '. $menubar_bg .';' : ''; 
$menubar_cls = ($menubar_rcnt == "infos") ? 'seese-menubar-layout-two' : 'seese-menubar-layout-one'; ?>


<!-- Menubar Starts -->
<div class="seese-menubar <?php echo esc_attr($menubar_cls); ?>" style="<?php echo esc_attr($menubar_bg); ?>">
  <div class="container ">
    <div class="row">

      <?php if ($menubar_rcnt == "infos") { ?>

        <div class="seese-menubar-left col-lg-6 col-md-12 col-sm-12 col-xs-5">
          <div class="seese-menubar-left-control row">
            <div class="seese-logo col-lg-12 col-md-3 col-sm-3 col-xs-12" style="<?php echo esc_attr($logo_style); ?>">
              <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                if ($brand_logo_default != '') {
                  if ($brand_logo_retina){
                    echo '<img src="'.esc_attr(wp_get_attachment_url($brand_logo_default)).'" alt="', esc_attr(bloginfo('name')).'" class="default-logo" />
                        <img src="'.esc_attr(wp_get_attachment_url($brand_logo_retina)).'"  alt="', esc_attr(bloginfo('name')).'" class="retina-logo" />';
                  } else {
                    echo '<img src="'.esc_attr(wp_get_attachment_url($brand_logo_default)).'" alt="', esc_attr(bloginfo('name')).'" class="default-logo" />';
                  }
                } else {
                  echo  get_bloginfo('name');
                }
                ?>
              </a>
            </div>
            <div class="seese-mainmenu col-lg-12 col-md-9 col-sm-9 col-xs-12 seese-mainmenu-small-screen">
              <?php
              wp_nav_menu(
                array(
                  'menu'           => 'primary',
                  'menu_id'        => 'seese-menu',
                  'fallback_cb'    => 'Walker_Nav_Menu_Custom::fallback',
                  'walker'         => new Walker_Nav_Menu_Custom(),
                  'theme_location' => 'primary',
                )
              );
              ?>
            </div>
          </div>
        </div>

        <div class="seese-topright col-lg-6 col-md-12 col-sm-12 col-xs-7" id="seese-topright">

          <?php echo do_shortcode($menubar_infos); ?>

          <ul class="seese-topright-icons">
            <?php
            if ($search_icon_topbar) {
              if ( class_exists( 'WooCommerce' ) ) { ?><li>
                  <a data-toggle="modal" data-target="#seese-search-modal"><img src="<?php echo esc_url(SEESE_IMAGES); ?>/search_icon.png" alt="search_icon" width="18" height="18" /></a>
                </li><?php
              }
            }

            if ($cart_widget_topbar) {
              if ( class_exists( 'WooCommerce' ) ) {
                global $woocommerce;
                $cart_url = wc_get_cart_url(); ?><li>
                  <a href="javascript:void(0);" id="seese-cart-trigger-child">
                    <?php if ( $woocommerce->cart->get_cart_contents_count() != '0') { ?>
                    <span class="seese-cart-count"><?php echo $woocommerce->cart->get_cart_contents_count(); ?></span>
                    <?php } ?>
                    <img src="<?php echo esc_url(SEESE_IMAGES); ?>/cart_icon.png" alt="cart_icon" width="18" height="20" />
                  </a>
                </li><?php
              }
            }

            if ($heart_icon_topbar) {
              if ( class_exists( 'WooCommerce' ) && function_exists( 'yith_wishlist_install' ) ) { ?><li>
                  <a href="<?php echo get_the_permalink(get_option( 'yith_wcwl_wishlist_page_id')); ?>"><img src="<?php echo esc_url(SEESE_IMAGES); ?>/heart_icon.png" alt="heart_icon" width="20" height="20" /></a>
                </li><?php
              }
            }

            if ($login_account_topbar) {
              if ( class_exists( 'WooCommerce' ) ) {
                $account_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );  ?><li>
                  <a href="<?php echo esc_url($account_url); ?>"><img src="<?php echo esc_url(SEESE_IMAGES); ?>/user_icon.png" alt="user_icon" width="20" height="20" /></a>
                </li><?php
              }
            } ?>

            <?php if ($seese_wpml) { ?><li class="seese-wpml"><?php echo do_shortcode($wpml_shortcode); ?></li><?php } ?>
          </ul>

        </div>

        <div class="seese-mainmenu col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-mainmenu-desktop-screen">
          <?php
          wp_nav_menu(
            array(
              'menu'           => 'primary',
              'menu_id'        => 'seese-menu',
              'fallback_cb'    => 'Walker_Nav_Menu_Custom::fallback',
              'walker'         => new Walker_Nav_Menu_Custom(),
              'theme_location' => 'primary',
            )
          );
          ?>
        </div>

      <?php } else { ?>

        <div class="seese-logo <?php echo $logo_col_class; ?>" style="<?php echo esc_attr($logo_style); ?>">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php
            if ($brand_logo_default != '') {
              if ($brand_logo_retina){
                echo '<img src="'.esc_attr(wp_get_attachment_url($brand_logo_default)).'" alt="', esc_attr(bloginfo('name')).'" class="default-logo" />
          	        <img src="'.esc_attr(wp_get_attachment_url($brand_logo_retina)).'"  alt="', esc_attr(bloginfo('name')).'" class="retina-logo" />';
              } else {
                echo '<img src="'.esc_attr(wp_get_attachment_url($brand_logo_default)).'" alt="', esc_attr(bloginfo('name')).'" class="default-logo" />';
              }
            } else {
              echo  get_bloginfo('name');
            }
            ?>
          </a>
        </div>

        <div class="seese-mainmenu <?php echo $menu_col_class; ?>">
          <?php
          wp_nav_menu(
            array(
              'menu'           => 'primary',
              'menu_id'        => 'seese-menu',
              'fallback_cb'    => 'Walker_Nav_Menu_Custom::fallback',
              'walker'         => new Walker_Nav_Menu_Custom(),
              'theme_location' => 'primary',
            )
          );
          ?>
        </div>

        <div class="seese-topright <?php echo $icon_col_class; ?>" id="seese-topright">
          <ul>
            <?php
            if ($search_icon) {
              if ( class_exists( 'WooCommerce' ) ) { ?><li>
                  <a data-toggle="modal" data-target="#seese-search-modal"><img src="<?php echo esc_url(SEESE_IMAGES); ?>/search_icon.png" alt="search_icon" width="18" height="18" /></a>
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
                    <img src="<?php echo esc_url(SEESE_IMAGES); ?>/cart_icon.png" alt="cart_icon" width="18" height="20" />
                  </a>
                </li><?php
              }
            }

            if ($heart_icon) {
              if ( class_exists( 'WooCommerce' ) && function_exists( 'yith_wishlist_install' ) ) { ?><li>
                  <a href="<?php echo get_the_permalink(get_option( 'yith_wcwl_wishlist_page_id')); ?>"><img src="<?php echo esc_url(SEESE_IMAGES); ?>/heart_icon.png" alt="heart_icon" width="20" height="20" /></a>
                </li><?php
              }
            }

            if ($login_account) {
              if ( class_exists( 'WooCommerce' ) ) {
                $account_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );  ?><li>
                  <a href="<?php echo esc_url($account_url); ?>"><img src="<?php echo esc_url(SEESE_IMAGES); ?>/user_icon.png" alt="user_icon" width="20" height="20" /></a>
                </li><?php
              }
            } ?>
            <?php if ($seese_wpml) { ?><li class="seese-wpml"><?php echo do_shortcode($wpml_shortcode); ?></li><?php } ?>
          </ul>
        </div>

      <?php } ?>

    </div>
  </div><div class="container" id="seese-mobilemenu"></div>
</div>
<!-- Menubar End -->