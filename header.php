<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php get_template_part('partials/seo'); ?>

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.png">
  <link rel="shortcut" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.ico">
  <link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon-touch.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.png">

  <?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php } ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

  <section id="main-container">

<?php
  if (is_front_page()) {
    get_template_part('partials/splash');
  } else {
?>

  <!-- start content -->
  <nav id="mobile-nav" class="grid-row justify-center align-items-center">
    <?php get_template_part('partials/nav-mobile'); ?>
  </nav>

  <header id="header" class="padding-top-tiny padding-bottom-tiny">
    <div class="container">
      <div class="row align-center">

        <nav id="main-nav" class="col col-l-4 only-desktop">
          <?php get_template_part('partials/nav'); ?>
        </nav>

        <div class="col col-s-1 col-m-2 only-mobile">
          <span id="toggle-menu" class="u-pointer">
            <?php echo '<img class="toggle-menu-icon" src="' . get_bloginfo('stylesheet_directory') . '/img/dist/hamburger.svg">'; ?>
          </span>
        </div>

        <div class="col col-s-2 col-l-1 toggle-sold-holder">
        <?php
          if (is_post_type_archive('product')) {
        ?>
          <span class="toggle-sold u-pointer"><?php get_template_part('partials/teardrop'); ?></span>
        <?php
          }
        ?>
        </div>

        <div id="header-logo" class="col col-s-6 col-m-4 col-l-2">
          <a href="<?php echo home_url(); ?>">
            <?php echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/dist/logo.svg">'; ?>
          </a>
        </div>

        <div class="col col-s-2 col-m-3 col-l-4">
          <?php
            if (is_singular('editorial')) {
          ?>
            <h1 id="editorial-title"><?php the_title(); ?></h1>
          <?php
            }
          ?>
        </div>

        <div class="col col-s-1">
          <a href="<?php echo home_url('cart'); ?>" class="header-cart font-product-price">
            <img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/dist/cart.svg'; ?>">
            <span class="gws-cart-counter">0</span>
          </a>
        </div>

      </div>
    </div>
  </header>

<?php } ?>
