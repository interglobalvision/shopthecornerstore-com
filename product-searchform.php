<form role="search" method="get" id="searchform" class="searchform font-size-h3" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="row">
    <input type="text" class="col col-s-10 text-align-right font-serif" value="<?php echo get_search_query(); ?>" name="s" id="s" />
    <input type="submit" class="col col-s-2" value="0" />
    <input type="hidden" name="post_type" value="product" />
  </div>
</form>