<?php
  $args = array(
    'posts_per_page'   => 2,
    'post_type'        => 'editorial',
  );
  $editorial_posts = get_posts( $args );

  if ($editorial_posts) {
    $recent_id = $editorial_posts[0]->ID;
  }
?>
<ul id="menu" class="u-inline-list <?php echo is_front_page() ? 'font-nav-splash' : 'font-nav'; ?>">
<?php if ( class_exists( 'WooCommerce' ) ) { ?>
  <li class="menu-item <?php echo is_post_type_archive('product') || is_singular('product') ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">Shop</a>
  </li>
<?php }

  if ($editorial_posts) {
?>
  <li class="menu-item <?php echo is_singular('editorial') && $post->ID === $recent_id ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink($editorial_posts[0]->ID); ?>">Editorial</a>
  </li>
<?php
    if (count($editorial_posts) > 1) {
?>
  <li class="menu-item <?php echo is_post_type_archive('editorial') || is_singular('editorial') && $post->ID !== $recent_id ? 'active' : ''; ?>">
    <a href="<?php echo get_post_type_archive_link( 'editorial' ); ?>">Archive</a>
  </li>
<?php
    }
  }
?>
  <li class="menu-item <?php echo is_home() ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>">Journal</a>
  </li>
</ul>