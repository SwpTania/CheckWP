<?php
/*
 * The header for our theme.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo('charset'); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

<?php
// if the `wp_site_icon` function does not exist (ie we're on < WP 4.3)
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
  if (cs_get_option('brand_fav_icon')) {
    echo '<link rel="shortcut icon" href="'. esc_url(wp_get_attachment_url(cs_get_option('brand_fav_icon'))) .'" />';
  } else { ?>
    <link rel="shortcut icon" href="<?php echo esc_url(SEESE_IMAGES); ?>/favicon.png" />
  <?php
  }
  if (cs_get_option('iphone_icon')) {
    echo '<link rel="apple-touch-icon" sizes="57x57" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_icon'))) .'" >';
  }
  if (cs_get_option('iphone_retina_icon')) {
    echo '<link rel="apple-touch-icon" sizes="114x114" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_retina_icon'))) .'" >';
    echo '<link name="msapplication-TileImage" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_retina_icon'))) .'" >';
  }
  if (cs_get_option('ipad_icon')) {
    echo '<link rel="apple-touch-icon" sizes="72x72" href="'. esc_url(wp_get_attachment_url(cs_get_option('ipad_icon'))) .'" >';
  }
  if (cs_get_option('ipad_retina_icon')) {
    echo '<link rel="apple-touch-icon" sizes="144x144" href="'. esc_url(wp_get_attachment_url(cs_get_option('ipad_retina_icon'))) .'" >';
  }
} ?>

<meta name="msapplication-TileColor" content="#ffffff"/>
<meta name="theme-color" content="#ffffff"/>

<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

<?php
// Metabox
global $post;
$seese_id   = ( isset( $post ) ) ? $post->ID : false;
$seese_id   = ( is_home() ) ? get_option( 'page_for_posts' ) : $seese_id;
if ( class_exists( 'WooCommerce' ) ) {
	$seese_id   = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $seese_id;
	$seese_id   = ( !is_product_category() && !is_product_tag() ) ? $seese_id : false;
}
$seese_id   = ( !is_search() && !is_404() && !is_archive() && !is_category() && !is_tag() && !is_single('testimonial') ) ? $seese_id : false;
$seese_meta = get_post_meta( $seese_id, 'page_type_metabox', true );

if ($seese_meta) {
	$top_bar     = $seese_meta['top_bar'];
	$menu_bar    = $seese_meta['menu_bar'];
  $title_bar   = $seese_meta['title_bar'];
  $hide_header = $seese_meta['hide_header'];

  if ($top_bar === 'custom') {
	  $top_bar_show = true;
	} elseif ($top_bar === 'hide') {
	  $top_bar_show = false;
	} else {
		$top_bar_tp   = cs_get_option('top_bar');
		$top_bar_show = ($top_bar_tp) ? true : false;
	}

  if ($menu_bar === 'custom') {
  	$menu_bar_show  = true;
		$sticky_header  = $seese_meta['sticky_header'];
	  $search_icon    = $seese_meta['search_icon'];
	  $cart_widget    = $seese_meta['cart_widget'];
	  $border_color   = $seese_meta['bottom_border_color'];
	  $menubar_rcnt   = $seese_meta['menubar_right_content'];
	} elseif ($menu_bar === 'hide') {
	  $menu_bar_show  = false;
	  $sticky_header  = false;
	  $search_icon    = false;
	  $cart_widget    = false;
	  $border_color   = '';
	  $menubar_rcnt   = '';
	} else {
	  $menu_bar_tp    = cs_get_option('menu_bar');
	  $sticky_header  = cs_get_option('sticky_header');
    $search_icon    = cs_get_option('search_icon');
    $cart_widget    = cs_get_option('cart_widget');
	  $menu_bar_show  = ($menu_bar_tp) ? true : false;
	  $border_color   = '';
	  $menubar_rcnt   = cs_get_option('menubar_right_content');
	}

	if ($title_bar === 'custom') {
	  $title_bar_show = true;
	} elseif ($title_bar === 'hide') {
	  $title_bar_show = false;
	} else {
		$title_bar_tp   = cs_get_option('title_bar');
		$title_bar_show = ($title_bar_tp) ? true : false;
	}
} else {
	$hide_header    = false;
	$top_bar_tp     = cs_get_option('top_bar');
	$menu_bar_tp    = cs_get_option('menu_bar');
	$title_bar_tp   = cs_get_option('title_bar');
	$sticky_header  = cs_get_option('sticky_header');
  $search_icon    = cs_get_option('search_icon');
  $cart_widget    = cs_get_option('cart_widget');
  $menubar_rcnt   = cs_get_option('menubar_right_content');
  $border_color   = '';

  $top_bar_show   = ($top_bar_tp) ? true : false;
	$menu_bar_show  = ($menu_bar_tp) ? true : false;
  $title_bar_show = ($title_bar_tp) ? true : false;
}

$sticky_header_class   = ($sticky_header) ? 'seese-fixed-header' : '';
$bottom_border_color   = ($border_color) ? 'border-bottom: 1px solid '.$border_color.';' : '';
$menubar_header_class  = ($menubar_rcnt == "infos") ? 'seese-header-menubar-infos' : '';
$menubar_wrapper_class = ($menubar_rcnt == "infos") ? 'seese-wrapper-menubar-infos' : '';
$content_right_gototop = cs_get_option('content_right_gototop');
$content_left_link     = cs_get_option('content_left_link');
$woo_singlevrl_nav     = cs_get_option('woo_singlevrl_nav');

wp_head(); ?>
</head>
  <body <?php body_class(); ?>>

	  <?php
	  if (!$hide_header && ($menu_bar_show || $top_bar_show)) {
	    if ( class_exists( 'WooCommerce' ) ) {
	      echo '<div class="seese-aside" id="seese-aside"><h2>'.esc_html__('Shopping Cart', 'seese').'</h2><div class="widget_shopping_cart_content">';
	        woocommerce_mini_cart();
	      echo '</div></div>';
	    }
	  }

	  if (!$hide_header && ($menu_bar_show || $top_bar_show)) {
	  	if ( class_exists( 'WooCommerce' ) ) { ?>
		    <div class="modal fade bs-example-modal-lg" id="seese-search-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			    <div class="modal-dialog modal-lg" role="document">
			      <div class="modal-content">
		          <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="searchform woocommerce-product-search" >
		            <input type="search" name="s" id="seese-prs" placeholder="<?php esc_html_e('Search...', 'seese'); ?>" />
		            <input type="hidden" name="post_type" value="product" />
		          </form>
			      </div>
			    </div>
		      <button type="button" data-dismiss="modal"></button>
		    </div>
		  <?php
		  }
	  }

	  if ($content_right_gototop) {
	    if (class_exists('WooCommerce')) {
	    	if(is_product() && !$woo_singlevrl_nav) {
	        echo '';
	      } else { ?>
	      	<div class="seese-gototop">
	          <a href="javascript:void(0);"><?php esc_html_e('Go to top', 'seese'); ?></a>
	        </div>
	      <?php
	      }
	    } else { ?>
	      <div class="seese-gototop">
	        <a href="javascript:void(0);"><?php esc_html_e('Go to top', 'seese'); ?></a>
	      </div>
	    <?php
	  	}
	  }

	  if ($content_left_link) {
	  	$left_link_title = cs_get_option('left_link_title');
	  	$left_link_title = $left_link_title ? $left_link_title : esc_html__('About Us', 'seese');
		  $left_link_url   = cs_get_option('left_link_url');
	  	if (class_exists('WooCommerce')) {
		    if (is_product() && !$woo_singlevrl_nav) {
		      echo '';
		    } else { ?>
		      <div class="seese-specialPage">
		        <a href="<?php echo esc_url($left_link_url); ?>">
		          <?php echo esc_attr($left_link_title); ?>
		        </a>
		      </div>
		    <?php
		    }
		  } else { ?>
 				<div class="seese-specialPage">
	        <a href="<?php echo esc_url($left_link_url); ?>">
	          <?php echo esc_attr($left_link_title); ?>
	        </a>
	      </div>
	    <?php
		  }
	  } ?>

    <!-- Seese Wrap Start -->
    <div id="seese-wrap" class="<?php echo esc_attr($sticky_header_class); ?>">

	    <?php if (!$hide_header) { ?>
	      <header class="seese-header <?php echo esc_attr($menubar_header_class); ?>" style="<?php echo esc_attr($bottom_border_color); ?>">
	      	<?php if ($top_bar_show)  { /*Top Bar*/ get_template_part( 'layouts/header/top', 'bar' ); } ?>
	        <?php if ($menu_bar_show) { /*Menu Bar*/ get_template_part( 'layouts/header/menu', 'bar' ); } ?>
	      </header>
	    <?php } ?>

	    <!-- Seese Wrapper Start -->
	    <div class="seese-wrapper <?php echo esc_attr($menubar_wrapper_class); ?>">
		    <?php if (!$hide_header && $title_bar_show) { /*Title Bar*/ get_template_part( 'layouts/header/title', 'bar' ); }


