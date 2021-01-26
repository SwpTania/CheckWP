<?php
/* Begin Include Files */
require_once(dirname(__FILE__).'/includes/controls.php');
require_once(dirname(__FILE__).'/includes/misc-functions.php');
require_once(dirname(__FILE__).'/includes/coaches-cpt.php');
require_once(dirname(__FILE__).'/includes/transformations-cpt.php');
/* End Include Files */

// include_once( get_template_directory() . '/acf/inc.php' );
include_once( get_template_directory() . '/functions/inc.php' );

add_action('after_setup_theme', 'motors_setup');

function motors_setup() {
    load_theme_textdomain('motors', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    register_nav_menu('primary', __('Header Menu', 'motors'));
    register_nav_menu('footer', __('Footer Menu', 'motors'));
    register_nav_menu('mobile', __('Mobile Menu', 'motors'));
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(560, 200, true);
    add_image_size('service_thumb', 300, 285, true);
    add_filter('use_default_gallery_style', '__return_false');
    //add_theme_support('customize-selective-refresh-widgets');
}

add_action('wp_enqueue_scripts', 'motors_scripts_styles');

function motors_scripts_styles() {
    $asst_url = get_template_directory_uri() . '/assets/';
    $js_url = $asst_url . 'js/';
    // $css_url = $asst_url . 'css/';
        
    wp_enqueue_script('front_jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', array('jquery'), '3.5.1', true);

    wp_enqueue_script('viewport.min', $js_url . 'viewport.js', array('jquery'), '1.0', true);
    wp_enqueue_script('ouibounce', $js_url . 'ouibounce.js', array('jquery'), '1.0');
    wp_enqueue_script('vimeo.min', $js_url . 'vimeo.js', array('jquery'), '1.0', true);
    wp_enqueue_script('jquery-validation', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('additional-methods', 'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js', array('jquery'), '1.0', true);
    wp_enqueue_style('owl_carousel_css', get_template_directory_uri() . '/assets/css/owl.carousel.css');
    wp_enqueue_script('owl_carousel_js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'));
}


add_action('admin_enqueue_scripts', 'monawar_enque_script');

function monawar_enque_script() {
    wp_enqueue_style('data_table_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/assets/css/data_table.css');
    wp_enqueue_script('jquery.validate.min', '//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array('jquery'));
    wp_enqueue_script('data_table_js', get_template_directory_uri() . '/assets/js/data_table.js', array('jquery'));
    wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'));

    wp_enqueue_script('range_slider', get_template_directory_uri() . '/assets/js/range-slider.js', array('jquery'));

    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'));
}

add_action('widgets_init', 'motors_widgets_init');

function motors_widgets_init() {
    register_sidebar(array(
        'name' => __('Main Widget Area', 'twentythirteen'),
        'id' => 'sidebar-1',
        'description' => __('Appears in the footer section of the site.', 'twentythirteen'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Secondary Widget Area', 'twentythirteen'),
        'id' => 'sidebar-2',
        'description' => __('Appears on posts and pages in the sidebar.', 'twentythirteen'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'twentythirteen'),
        'id' => 'sidebar-3',
        'description' => __('Appears on footer in the sidebar.', 'twentythirteen'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-title"><h6>',
        'after_title' => '</h6></div>',
    ));
}

add_action('wp_head', 'monawar_ajaxurl');

function monawar_ajaxurl() {
    ?>
    <script type="text/javascript">
        var ajaxUrl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
        var siteUrl = '<?php echo get_site_url(); ?>';
        var templateUir = '<?php echo get_template_directory_uri(); ?>';
    </script>
    <?php
}

/*************************Function for Coupon Code *********************************/

function rand_code($len)
{
     $min_lenght= 0;
     $max_lenght = 100;
     $bigL = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $smallL = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $number = "0123456789";
     $bigB = str_shuffle($bigL);
     $smallS = str_shuffle($smallL);
     $numberS = str_shuffle($number);
     $subA = substr($bigB,0,5);
     $subB = substr($bigB,6,5);
     $subC = substr($bigB,10,5);
     $subD = substr($smallS,0,5);
     $subE = substr($smallS,6,5);
     $subF = substr($smallS,10,5);
     $subG = substr($numberS,0,5);
     $subH = substr($numberS,6,5);
     $subI = substr($numberS,10,5);
     $RandCode1 = str_shuffle($subA.$subD.$subB.$subF.$subC.$subE);
     $RandCode2 = str_shuffle($RandCode1);
     $RandCode = $RandCode1.$RandCode2;
         if ($len>$min_lenght && $len<$max_lenght)
         {
         $CodeEX = substr($RandCode,0,$len);
         }
         else
         {
         $CodeEX = $RandCode;
         }
         global $wpdb;
        $sql="select * from wp_postmeta where meta_value='".$CodeEX."' and meta_key='coupon_code'";
        $results=$wpdb->get_results($sql);
                  if (empty($results)) {
                     return $CodeEX;
                  }else{
                     rand_code(10);
                  }
   }

add_action('admin_footer','acf_generate_coupon_code');
function acf_generate_coupon_code()
{
  $coupon_code= rand_code(10);
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
          var get_coupon_code =jQuery("#generate_code").find("input").val();
          if(get_coupon_code=="")
          {
            jQuery("#generate_code").find("input").val('<?php echo  $coupon_code;?>');
          }
    });
</script>
<?php
}

/****************************************************************************************/

add_action('admin_head', 'content_textarea_height');
function content_textarea_height() {
	$screen = get_current_screen();
    if($screen->post_type == 'mail-template') {
    	echo'
        <style type="text/css">
                #content{ height:500px !important; }
        		#content_ifr{ height:800px !important; }
        </style>
        ';
    }
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug' => 'theme-options',
        'capability' => 'manage_options',
        'redirect' => false,
        'position' => 30
    ));
}


    add_action('after_setup_theme', 'remove_admin_bar');
    function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
    }
    }
    
    
    // LOGOUT LINK IN MENU

function diww_menu_logout_link( $nav, $args ) {
	$logoutlink = '<li><a href="'.wp_logout_url(home_url() ).'">Logout</a></li>';
	if( $args->theme_location == 'primary' && is_user_logged_in()  ) {
		return $nav.$logoutlink ;
	} else {
	return $nav;
	}
}

add_filter('wp_nav_menu_items','diww_menu_logout_link', 10, 2);

add_filter( 'nav_menu_link_attributes', 'menu_atts', 10, 3 );
function menu_atts( $atts, $item, $args )
{
  // The ID of the target menu item
  $menu_target = 1996;

  // inspect $item
  if ($item->ID == $menu_target) {
    $atts['data-toggle'] = 'modal';
    $atts['data-target'] = '#modalLoginForm';
  }
  return $atts;
}

function ajax_login_init(){

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/assets/js/ajax-login-script.js', array('jquery') );
    wp_enqueue_script('ajax-login-script');
    //$redirecturl =home_url();
    $redirecturl =get_page_link(2031);
    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'redirecturl' => $redirecturl,
    'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
    // Enable the user with no privileges to run ajax_forgotPassword() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxforgotpassword', 'ajax_forgotPassword' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
add_action('init', 'ajax_login_init');
}


function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;
    if(is_email( $_POST['username'] )) {            
        $get_by = 'email';
        $user_data = get_user_by( 'email',$_POST['username'] );                    
    }else {
   // if (validate_username( $_POST['username'] )) {            
        $get_by = 'login';
        $user_data = get_user_by( 'login', $_POST['username'] );                   
    } 
    $user_id = $user_data->ID;
    $user_info = get_user_meta($user_id );   
    $macro_subscription = get_user_meta($user_id,'macro_subscription',true);     
    if($macro_subscription){      
       $user_signon = wp_signon( $info, false );       
       if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
      }else {
         
      echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
      }
    }else{
       
      echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    }     
    
    die();
}

function ajax_forgotPassword(){
    
    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-forgot-nonce', 'security' );
    
    global $wpdb;
    
    $account = $_POST['user_login'];
    
    if( empty( $account ) ) {
        $error = 'Enter an username or e-mail address.';
    } else {
        if(is_email( $account )) {
            if( email_exists($account) ) {
                $get_by = 'email';
                $user_data = get_user_by( 'email', $account );
            }else    {
                $error = 'There is no user registered with that email address.';  
                }          
        }
        else if (validate_username( $account )) {
            if( username_exists($account) ) {
                $get_by = 'login';
                $user_data = get_user_by( 'login', $account );
           } else    {
                $error = 'There is no user registered with that username.';    
                }         
        }
        else
            $error = 'Invalid username or e-mail address.';     
    }   
    
    if(empty ($error)) {

      // Redefining user_login ensures we return the right case in the email.
        $user_id = $user_data->ID;
        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;
        $key = get_password_reset_key( $user_data );
        $reset_url = "";

        $reset_url = esc_url_raw(
          add_query_arg(
            array(
              'somresetpass' => 'true',
              'somfrp_action' => 'rp',
              'key' => $key,
              'uid' => $user_id
            ),
            get_permalink(1988)
          )
        );


        $reset_link = '<a href="' . $reset_url . '">' . $reset_url . '</a>';
        // lets generate our new password
        //$random_password = wp_generate_password( 12, false );
        $random_password = wp_generate_password();

            
        // Get user data by field and data, fields are id, slug, email and login
        $user = get_user_by( $get_by, $account );
            
     //   $update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
            
        // if  update user return true then lets send user an email containing the new password
       // if( $update_user ) {

            $admin_email = get_option( 'admin_email' );
            //$admin_email = "sonamvrm@mailinator.com";
            
            $from = $admin_email ; // Set whatever you want like mail@yourdomain.com
            
            if(!(isset($from) && is_email($from))) {        
                $sitename = strtolower( $_SERVER['SERVER_NAME'] );
                if ( substr( $sitename, 0, 4 ) == 'www.' ) {
                    $sitename = substr( $sitename, 4 );                 
                }
                $from = 'admin@'.$sitename; 
            }
            
            $to = $user->user_email;
            $subject = 'Reset Password';
            $sender = 'From: '.get_option('name').' <'.$from.'>' . "\r\n";
            
         //   $message = 'Your new password is: '.$random_password;
            $message .= '<p>Someone requested that the password be reset for the following account:</p>';
            $message .= '<p>Username :'. $user_login .'</p>';
            $message .= '<p>If this was a mistake, just ignore this email and nothing will happen.</p>';
            $message .= '<p>To reset your password, visit the following address:</p>';
            $message .= '<p>'. $reset_link.'</p>';
            $message .= '<p>Regards,</p>';
            $message .= '<p>All at 6packmacros</p>';
            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = $sender;            
                
            $mail = wp_mail( $to, $subject, $message, $headers );
           
            if( $mail ) 
                $success = 'Check your email address for you new password.';
            else
                $error = 'System is unable to send you mail containg your new password.';                       
        //} else {
        //    $error = 'Oops! Something went wrong while updaing your account.';
        //}
    }
    
    if( ! empty( $error ) )
        //echo '<div class="error_login"><strong>ERROR:</strong> '. $error .'</div>';
        echo json_encode(array('loggedin'=>false, 'message'=>__($error)));
            
    if( ! empty( $success ) )
        //echo '<div class="updated"> '. $success .'</div>';
        echo json_encode(array('loggedin'=>false, 'message'=>__($success)));
                
    die();
}


// add_action('admin_menu', 'add_menu_for_macro_subscriptions');
// function add_menu_for_macro_subscriptions() {
//   add_menu_page( "Subscriptions List", "Subscriptions List", 'publish_posts', 'macro_subscriptions', 'macro_subscriptions_list', 'dashicons-admin-users');  
// }
// function macro_subscriptions_list(){
//   include 'macro_subscriptions_list.php';
// }

add_action('admin_menu', 'add_menu_for_authorize_subscriptions');
function add_menu_for_authorize_subscriptions() {
  add_menu_page( "Auth Subscriptions List", "Auth Subscriptions List", 'publish_posts', 'authorize_subscriptions', 'authorize_subscriptions_list', 'dashicons-admin-users');  
}
function authorize_subscriptions_list(){
  include 'authorizenet_subscriptions_list.php';
}

//add_post_meta(2107, 'promo_code', 'MINH10', true);

// body class for different browser - cross browser fixing 

function mv_browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if($is_lynx) $classes[] = 'lynx';
        elseif($is_gecko) $classes[] = 'gecko';
        elseif($is_opera) $classes[] = 'opera';
        elseif($is_NS4) $classes[] = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE) {
                $classes[] = 'ie';
                if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
                $classes[] = 'ie'.$browser_version[1];
        } else $classes[] = 'unknown';
        if($is_iphone) $classes[] = 'iphone';
        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
                 $classes[] = 'osx';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
                 $classes[] = 'linux';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
                 $classes[] = 'windows';
           }
        // $classes[] = ICL_LANGUAGE_CODE;  //or however you want to name your class based on the language code
        return $classes;
}
add_filter('body_class','mv_browser_body_class');

