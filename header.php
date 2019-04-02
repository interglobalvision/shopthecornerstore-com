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

  <header id="header" class="padding-top-tiny padding-bottom-tiny font-nav">
    <div class="container">
      <div class="row align-center padding-top-micro">

        <nav id="main-nav" class="col col-no-gutter flex-grow only-desktop row">
          <div class="col">
            <a href="<?php echo home_url(); ?>">Home</a>
          </div>

          <div class="col <?php echo is_post_type_archive('product') || (is_singular('product') && has_category('vintage')) ? 'active' : ''; ?>">
            <a href="<?php echo home_url('shop'); ?>">The Corner Store</a>
          </div>

          <div class="col <?php echo is_page('stacey-nishimoto') || (is_singular('product') && !has_category('stacey-nishimoto')) ? 'active' : ''; ?>">
            <a href="<?php echo home_url('stacey-nishimoto'); ?>">Stacey Nishimoto</a>
          </div>
        </nav>

        <div class="col flex-grow only-mobile">
          <span id="toggle-menu" class="u-pointer">
            <?php echo '<img class="toggle-menu-icon" src="' . get_bloginfo('stylesheet_directory') . '/img/dist/hamburger.svg">'; ?>
          </span>
        </div>

        <div class="col row">
          <?php if (is_post_type_archive('product') || is_page('shop')) { ?>
          <div class="col">
            <span class="toggle-sold u-pointer"><?php get_template_part('partials/teardrop'); ?></span>
          </div>
          <?php } ?>

          <div id="header-cart-holder" class="col col-no-gutter">
            <a href="<?php echo home_url('cart'); ?>" class="header-cart font-product-price">
              <img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/dist/cart.svg'; ?>">
              <span class="gws-cart-counter">0</span>
            </a>
            <div id="cart-update-notice"></div>
          </div>

        </div>
      </div>
    </div>
  </header>

<?php } ?>
