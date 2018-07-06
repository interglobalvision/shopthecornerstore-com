<ul id="menu-list" class="u-inline-list <?php echo is_front_page() ? 'font-nav-splash' : 'font-nav'; ?>">

<?php
  if ( class_exists( 'WooCommerce' ) ) {
?>
  <li class="menu-item <?php echo is_post_type_archive('product') || is_singular('product') ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">Vintage</a>
  </li>
<?php
  }
?>

  <li class="menu-item <?php echo is_singular('editorial') && $post->ID === $recent_id ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink($editorial_posts[0]->ID); ?>">Collection</a>
  </li>

  <li class="menu-item <?php echo is_home() ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>">Journal</a>
  </li>
</ul>
