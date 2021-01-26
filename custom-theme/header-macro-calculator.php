<?php
$template_directory = get_template_directory_uri() . '/';
//$site_url = get_site_url();
$home_Class = is_front_page() ? '' : 'macro-calculator-template';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Macro Calculator</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- <link rel="stylesheet"
    href="https://www.6packbyzack.com/wp-content/cache/autoptimize/css/autoptimize_3d20045b9233dde92ab5624328749086.css" /> -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
    <!-- Main Style -->
    <link href="<?php echo $template_directory ?>assets/css/global.css" rel="stylesheet">
    <link href="<?php echo $template_directory ?>assets/css/marco-cal.css" rel="stylesheet">
    <?php wp_head(); ?>

    <style type="text/css">
        body {
            padding-top: 0px !important;
        }
    </style>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

</head>

<body <?php body_class(); ?>>

  <main>

    <header>
      <div class="container-fluid">
        <div class="logoMain">
          <a href="<?php echo get_site_url();?>">
            <noscript><img
                src="<?php echo get_field('logo', 'option'); ?>"
                alt="" />
            </noscript>
            <img class=" ls-is-cached lazyloaded"
              src="https://cdn.shortpixel.ai/client/q_glossy,ret_img/<?php echo get_field('logo', 'option'); ?>"
              data-src="https://cdn.shortpixel.ai/client/q_glossy,ret_img/<?php echo get_field('logo', 'option'); ?>"
              alt="">
          </a>
          <!-- <div class="mobile-toggles">
              <span class="one"></span>
              <span class="two"></span>
              <span class="three"></span>
          </div> -->
        </div>
        <!-- <div class="navMain">
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
        </div> -->
        <div class="centerContent">
          <span> Macro Calculator</span>
        </div>
        <div class="exitBtn">
          <?php
          if ( is_user_logged_in() ) {
              echo '<a href="'.wp_logout_url(home_url() ).'">Logout</a>';
          } else {
             echo'<a href="#login" data-toggle="modal" data-target="#modalLoginForm">Login</a>';
          }
          ?>
         
          <!--<a href="<?php //echo get_site_url();?>">Exit</a>-->
        </div>

      </div>
    </header>