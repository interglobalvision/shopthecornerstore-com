<ul id="menu-list" class="u-inline-list <?php echo is_front_page() ? 'font-nav-splash' : 'font-nav'; ?>">

  <li class="menu-item <?php echo is_post_type_archive('product') || (is_singular('product') && has_category('vintage')) ? 'active' : ''; ?>">
    <a href="<?php echo home_url('shop'); ?>">The Corner Store</a>
  </li>

  <li class="menu-item <?php echo is_page('stacey-nishimoto') || (is_singular('product') && has_category('stacey-nishimoto')) ? 'active' : ''; ?>">
    <a href="<?php echo home_url('stacey-nishimoto'); ?>">Stacey Nishimoto</a>
  </li>

</ul>
