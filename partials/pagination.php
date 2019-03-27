<?php
$previous = get_previous_posts_link('<img src="' . get_bloginfo('stylesheet_directory') . '/img/dist/arrow_left.svg">');
$max_pages = 0;
if ($shop_query) {
  $max_pages = $shop_query->max_num_pages;
}
$next = get_next_posts_link('<img src="'. get_bloginfo('stylesheet_directory') . '/img/dist/arrow_right.svg">', $max_pages);
if( $next || $previous ) {
?>
  <!-- post pagination -->
  <nav id="pagination" class="container">
    <div class="row">
      <div class="col col-s-12 text-align-right">
<?php
if ($previous) {
?>
  <span class="pagination-button"><?php echo $previous; ?></span>
<?php
}
if ($next) {
?>
  <span class="pagination-button"><?php echo $next; ?></span>
<?php
}
?>
      </div>
    </div>
  </nav>
<?php
}
?>
