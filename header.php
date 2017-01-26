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
  <header id="header" class="container padding-top-tiny padding-bottom-tiny">
    <div class="row align-center">

      <nav class="col col-s-10 col-l-5">
        <?php get_template_part('partials/nav'); ?>
      </nav>

      <div class="col col-s-2 only-mobile">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-cart font-product-price">
          <img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/dist/cart.svg'; ?>">
          <?php echo WC()->cart->get_cart_contents_count() ?>
        </a>
      </div>

      <div id="header-logo" class="col col-s-12 col-l-2">
        <a href="<?php echo home_url(); ?>">
          <?php echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/dist/logo.svg">'; ?>
        </a>
      </div>

      <div class="col col-s-12 col-l-4 text-align-center">
      <?php
        if (is_singular('editorial')) {
      ?>
        <h1 class="font-nav"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <?php
        }
      ?>
      </div>

      <div class="col only-desktop col-l-1">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-cart font-product-price">
          <img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/dist/cart.svg'; ?>">
          <?php echo WC()->cart->get_cart_contents_count() ?>
        </a>
      </div>

    </div>
  </header>

<?php } ?>