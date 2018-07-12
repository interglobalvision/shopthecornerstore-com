<ul id="mobile-menu-list" class="padding-top-basic <?php echo is_front_page() ? 'font-nav-splash' : 'font-nav'; ?> text-align-center">

<?php
  if ( class_exists( 'WooCommerce' ) ) {
?>
  <li class="menu-item margin-bottom-basic <?php echo is_post_type_archive('product') || is_singular('product') ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">Vintage</a>
  </li>
<?php
  }

  $latest_editorial = get_posts('post_type=editorial&numberposts=1');
?>

  <li class="menu-item margin-bottom-basic <?php echo $post->ID === $latest_editorial[0]->ID ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink($latest_editorial[0]->ID); ?>">Collection</a>
  </li>

  <li class="menu-item margin-bottom-basic <?php echo is_home() ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>">Journal</a>
  </li>

  <li class="menu-item margin-bottom-basic <?php echo is_page('contact') ? 'active' : ''; ?>">
    <a href="<?php echo home_url('contact'); ?>">Contact</a>
  </li>

  <li class="menu-item margin-bottom-basic flex-grow <?php echo is_page('shipping') ? 'active' : ''; ?>">
    <a href="<?php echo home_url('shipping'); ?>">Shipping</a>
  </li>

  <li class="menu-item margin-bottom-basic">
    <a href="https://instagram.com/<?php echo $instagram; ?>"><img class="social-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/img/dist/instagram_icon.svg"></a>
  </li>
</ul>
