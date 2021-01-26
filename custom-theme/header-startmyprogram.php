<?php
$template_directory = get_template_directory_uri() . '/';
$site_url = get_site_url();
$home_Class = is_front_page() ? '' : 'listing-nontransparent-header';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Main Style -->
    <link href="<?php echo $template_directory ?>assets/css/global.css" rel="stylesheet">
    <?php wp_head(); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
    <main>
        <!-- Header Here -->
        <header>
            <div class="container-fluid">
                <div class="logoMain">
                    <a href="<?php echo $site_url; ?>">
                        <img src="<?php echo  get_field('logo', 'option'); ?>" alt="" />
                    </a>
                    <div class="mobile-toggles">
                        <span class="one"></span>
                        <span class="two"></span>
                        <span class="three"></span>
                    </div>
                </div>
                <div class="navMain">
                    <nav>
                        <h2>&nbsp;</h2>
                    </nav>
                </div>
            </div>
        </header>
        <!-- Header End -->