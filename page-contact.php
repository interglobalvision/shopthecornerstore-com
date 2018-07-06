<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">
  <!-- main posts loop -->
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $mailchimp_url = IGV_get_option('_igv_mailchimp_url');
?>
  <section id="page">
    <div class="row">
      <div class="col col-s-12 col-m-6">
        <h1 class="font-product-price margin-bottom-micro"><?php the_title(); ?>:</h1>
        <?php the_content(); ?>
      </div>
<?php
    if (!empty($mailchimp_url)) {
?>
      <div class="col col-s-12 col-m-6">
        <h1 class="font-product-price margin-bottom-micro font-uppercase">Newsletter</h1>
        <span>Sign up to our newsletter to receive weekly updates on new items:</span>
        <form class="newsletter-form">
          <input class="newsletter-email" type="email" />
          <button type="submit">Subscribe</button>
          <span class="newsletter-reply"></span>
        </form>
      </div>
<?php
    }
?>
    </div>
  </section>
<?php
  }
} else {
?>
  <div class="row">
    <article class="col col-s-12 u-alert"><?php _e('Sorry, no page matched your criteria'); ?></article>
  </div>
<?php
} ?>
<!-- end main-content -->
</main>

<?php
get_footer();
?>
