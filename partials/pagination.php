<?php
if( get_next_posts_link() || get_previous_posts_link() ) {
?>
  <!-- post pagination -->
  <nav id="pagination" class="container">
    <div class="row">
      <div class="col col-s-12 text-align-right">
<?php
$previous = get_previous_posts_link('<img src="' . get_bloginfo('stylesheet_directory') . '/img/dist/prev.svg">');
$next = get_next_posts_link('<img src="'. get_bloginfo('stylesheet_directory') . '/img/dist/next.svg">');
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