  <?php
    if (!is_front_page()) {

    $facebook = IGV_get_option('_igv_socialmedia_facebook_url');
    $twitter = IGV_get_option('_igv_socialmedia_twitter');
    $instagram = IGV_get_option('_igv_socialmedia_instagram');

    $contact_id = get_id_by_slug('contact');
    $shipping_id = get_id_by_slug('shipping');
  ?>
    <footer id="footer" class="only-desktop">
      <div class="container">
        <div class="row align-center padding-top-tiny padding-bottom-tiny">
          <div class="col col-no-margin-bottom col-s-12 text-align-right">
            <?php if (!empty($contact_id) || !empty($shipping_id)) { ?>
            <nav>
              <ul class="u-inline-list font-nav">
                <?php if (!empty($contact_id)) { ?>
                <li class="menu-item">
                  <a href="<?php echo get_the_permalink($contact_id); ?>">Contact</a>
                </li>
                <?php } if (!empty($shipping_id)) { ?>
                <li class="menu-item">
                  <a href="<?php echo get_the_permalink($shipping_id); ?>">Shipping</a>
                </li>
                <?php } ?>
              </ul>
            </nav>
            <?php } ?>
          </div>
        </div>
      </div>
    </footer>
<?php } ?>

  </section>

  <?php
    get_template_part('partials/newsletter-popup');
    get_template_part('partials/scripts');
    get_template_part('partials/schema-org');
  ?>

  </body>
</html>
