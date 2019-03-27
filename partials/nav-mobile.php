<?php
$instagram = IGV_get_option('_igv_socialmedia_instagram');
?>

<ul id="mobile-menu-list" class="padding-top-basic <?php echo is_front_page() ? 'font-nav-splash' : 'font-nav'; ?> text-align-center">

  <li class="menu-item margin-bottom-basic <?php echo is_post_type_archive('product') || (is_singular('product') && has_category('corner-store')) ? 'active' : ''; ?>">
    <a href="<?php echo home_url('shop'); ?>">The Corner Store</a>
  </li>

  <li class="menu-item margin-bottom-basic <?php echo is_page('stacey-nishimoto') || (is_singular('product') && has_category('stacey-nishimoto')) ? 'active' : ''; ?>">
    <a href="<?php echo home_url('stacey-nishimoto'); ?>">Stacey Nishimoto</a>
  </li>

  <li class="menu-item margin-bottom-basic <?php echo is_page('contact') ? 'active' : ''; ?>">
    <a href="<?php echo home_url('contact'); ?>">Contact</a>
  </li>

  <li class="menu-item margin-bottom-basic flex-grow <?php echo is_page('shipping') ? 'active' : ''; ?>">
    <a href="<?php echo home_url('shipping'); ?>">Shipping</a>
  </li>

<?php
  if (!empty($instagram)) {
?>
  <li class="menu-item margin-bottom-basic">
    <a href="https://instagram.com/<?php echo $instagram; ?>"><img class="social-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/img/dist/instagram_icon.svg"></a>
  </li>
<?php
  }
?>
</ul>
