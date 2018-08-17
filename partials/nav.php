<ul id="menu-list" class="u-inline-list <?php echo is_front_page() ? 'font-nav-splash' : 'font-nav'; ?>">

<?php
  if ( class_exists( 'WooCommerce' ) ) {
?>
  <li class="menu-item <?php echo is_post_type_archive('product') || is_singular('product') ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">Vintage</a>
  </li>
<?php
  }

  $latest_editorial = get_posts('post_type=editorial&numberposts=1');

  if (!empty($latest_editorial)) {
?>

  <li class="menu-item <?php echo $post->ID === $latest_editorial[0]->ID ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink($latest_editorial[0]->ID); ?>">Collection</a>
  </li>
<?php
  }
?>

  <li class="menu-item <?php echo is_home() ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>">Journal</a>
  </li>
</ul>
