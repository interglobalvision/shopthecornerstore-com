<ul id="menu-list" class="u-inline-list <?php echo is_front_page() ? 'font-nav-splash' : 'font-nav'; ?>">

<?php
  $shop_page = get_page_by_path('shop');

  if (!empty($shop_page)) {
?>

  <li class="menu-item <?php echo is_post_type_archive('product') || is_singular('product') ? 'active' : ''; ?>">
    <a href="<?php echo get_permalink($shop_page->ID); ?>">Vintage</a>
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
