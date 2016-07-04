  <?php
    $facebook = IGV_get_option('_igv_socialmedia_facebook_url');
    $twitter = IGV_get_option('_igv_socialmedia_twitter');
    $instagram = IGV_get_option('_igv_socialmedia_instagram');

    $contact_id = get_id_by_slug('contact'); 
    $shipping_id = get_id_by_slug('shipping');
  ?>
    <footer id="footer" class="container">
      <div class="row">
        <div class="col col3">
          <?php if (!empty($facebook) || !empty($twitter) || !empty($instagram)) { ?>
          <ul class="u-inline-list">
            <?php if (!empty($facebook)) { ?>
            <li>
              <a href="<?php echo $facebook; ?>"><img class="social-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/img/dist/facebook_icon.svg"></a>
            </li>
            <?php } if (!empty($instagram)) { ?>
            <li>
              <a href="https://instagram.com/<?php echo $instagram; ?>"><img class="social-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/img/dist/instagram_icon.svg"></a>
            </li>
            <?php } if (!empty($twitter)) { ?>
            <li>
              <a href="https://twitter.com/<?php echo $twitter; ?>"><img class="social-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/img/dist/twitter_icon.svg"></a>
            </li>
            <?php } ?>
          </ul>
          <?php } ?>
        </div>
        <div class="col col6 text-align-center font-small-caps">
          &copy; <?php echo date('Y'); ?> The Corner LLC. All Rights Reserved
        </div>
        <div class="col col3 text-align-right">
          <?php if (!empty($contact_id) || !empty($shipping_id)) { ?>
          <nav class="footer-menu">
            <ul class="u-inline-list">
              <?php if (!empty($contact_id)) { ?>
              <li>
                <a href="<?php echo get_the_permalink($contact_id); ?>">Contact</a>
              </li>
              <?php } if (!empty($shipping_id)) { ?>
              <li>
                <a href="<?php echo get_the_permalink($shipping_id); ?>">Shipping</a>
              </li>
              <?php } ?>
            </ul>
          </nav>
          <?php } ?>
        </div>
      </div>
    </footer>

  </section>

  <?php
    get_template_part('partials/scripts');
    get_template_part('partials/schema-org');
  ?>

  </body>
</html>