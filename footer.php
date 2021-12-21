  <section class="instagram-feed">
    <?php echo do_shortcode('[instagram-feed]'); ?>
  </section>
  <section class="newsletter">
    <div class="container">
      <div class="newsletter-inner">
        <?php if( $heading = get_field( 'n_heading', 'options' ) ): ?>
          <h3 class="newsletter-heading a-up"><?php echo $heading; ?></h3>
        <?php endif; ?>
        <div class="newsletter-form__wrapper">
          <form class="newsletter-form a-up a-delay-1">
            <input type="email" class="form-control" id="newsletter_email" name="email" placeholder="Your Email">
            <input type="submit" class="btn btn--accent form-submit" id="newsletter_submit" value="Stay Connected">
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- Footer -->
<footer class="footer">
  <div class="footer-top a-up">
    <div class="container">
      <?php if( $logo = get_field( 'f_logo', 'options' ) ): ?>
        <a href="<?php echo esc_url( home_url( ) ); ?>" class="footer-logo">
          <img src="<?php echo $logo; ?>" alt="Boston Harbor">
        </a>
      <?php endif; ?>
    </div>
  </div>
  <div class="container">
    <div class="footer-main">
      <div class="footer-menu a-up">
        <?php 
        wp_nav_menu( array(
          'menu' => 'Footer Menu',
          'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
          'container'       => 'div',
          'container_class' => 'main-menu__wrapper',
          'fallback_cb'     => false,
          'walker'          => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
      </div>
      <?php if ($contact = get_field('contact', 'option')) : ?>
        <div class="footer-contact footer-item a-up a-delay-1">
          <h6 class="footer-item__title">Contact</h6>
          <div class="footer-item__content">
            <?php echo $contact; ?>
          </div>
        </div>
      <?php endif; ?>
      <?php if ($address = get_field('address', 'option')) : ?>
        <div class="footer-address footer-item a-up a-delay-2">
          <h6 class="footer-item__title">Address</h6>
          <div class="footer-item__content">
            <?php echo $address; ?>
          </div>
        </div>
      <?php endif; ?>
      <?php if (have_rows('social', 'option')) : ?>
        <div class="footer-social footer-item a-up a-delay-3">
          <h6 class="footer-item__title">Social</h6>
          <ul class="social-items">
            <?php while (have_rows('social', 'option')) : the_row();  
            if( $link = get_sub_field('link') ) :?>
              <li class="social-item">
                <?php if( get_row_index() % 2 == 0 ): ?>
                  <span class="divider">//</span>
                <?php endif; ?>
                <a href="<?php echo $link['url']; ?>" class="social-link" target="_blank">
                  <?php echo $link['title']; ?>
                </a>
              </li>
            <?php endif;
            endwhile; ?>
          </ul>
          <div class="footer-item__content">
            <?php echo $social; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php 
  $count = count(get_field('partners', 'option'));
  if( have_rows( 'partners', 'option' ) ): ?>
  <div class="footer-partners a-up a-delay-2">
    <?php while( have_rows( 'partners', 'option' ) ): the_row( );
      $link = get_sub_field( 'link' );
      $logo = get_sub_field( 'logo' ); ?>
      <a href="<?php echo $link; ?>" class="footer-partners__link" target="_blank">
        <img class="lazyload" data-src="<?php echo $logo; ?>" alt="">
      </a>
      <?php if ( empty($logo) && empty($link) ) : ?>
        <span class="divider"></span>
      <?php endif; ?>
    <?php endwhile; ?> 
  </div>
  <?php endif; ?>
  <div class="footer-bottom a-up a-delay-3">
      <?php if (have_rows('links', 'option')) : ?>
        <div class="footer-bottom__links">
          <?php while (have_rows('links', 'option')) : the_row(); 
          if ($link = get_sub_field('link')) : ?>
            <a href="<?php echo $link['url']; ?>" 
                class="footer-bottom__link" 
                target="<?php echo $link['target']; ?>">
              <?php echo $link['title']; ?>
            </a>
          <?php endif;
          endwhile; ?>
        </div>
      <?php endif; ?>

      <div class="footer-bottom__copyright">
        <a href="#" class="footer-bottom__link">Website Credit</a> 
        <span class="divider">|</span>
        <p class="copyright">Copyright &copy; <?php echo date('Y'); ?></p>
      </div>
  </div>
</footer>

<!-- Booking Popup -->
<div class="booking-popup">
  <div class="booking-popup__inner">
    <h2 class="booking-popup__heading">Choose Your Dates</h2>
    <div class="booking-popup__content">
      <div class="booking-popup__calendar">
        <input type="text" class="booking-popup__calendar--range" id="booking-popup__calendar--range">
        <div class="booking-popup__calendar--calendar" id="booking-popup__calendar--calendar">
        </div>
      </div>
      <didv class="booking-popup__calendar--mobile">
        <div class="form-col">
            <label for="booking_check_in" class="form-label">Check in</label>
            <div class="event-date">
              <input type="text" id="booking_check_in" class="form-control form-date" placeholder="Select Date">
            </div>
          </div>
          <div class="form-col">
            <label for="booking_check_out" class="form-label">Check out</label>
            <div class="second-event-date">
              <input type="text" id="booking_check_out" class="form-control form-date" placeholder="Select Date">
            </div>
          </div>
      </didv>
      <div class="booking-popup__inputs">
        <div class="row">
          <div class="col">
            <div class="row">
              <div class="col adult-number">
                <label for="booking_adult_number" class="form-label">Number of Adults</label>
                <select name="" id="booking_adult_number" class="form-control">
                  <option value="1">1 Adult</option>
                  <option value="2">2 Adults</option>
                  <option value="3">3 Adults</option>
                  <option value="4">4 Adults</option>
                </select>
              </div>
              <div class="col kids-number">
                <label for="booking_kids_number" class="form-label">Number of Kids</label>
                <select name="" id="booking_kids_number" class="form-control">
                    <option value="0">0 Kid</option>
                    <option value="1">1 Kid</option>
                    <option value="2">2 Kids</option>
                    <option value="3">3 Kids</option>
                    <option value="4">4 Kids</option>
                  </select>
              </div>
            </div>
          </div>
          <div class="col promocode">
            <label for="#booking_promo" class="form-label">Promo Code</label>
            <input type="text" class="form-control" id="booking_promo" placeholder="Enter Promo Code">
          </div>
        </div>
      </div>
      <div class="form-checkbox">
        <input type="checkbox" class="form-control" id="booking_suites_only">
        <label for="booking_suites_only">Suites Only</label>
      </div>
    </div>
    <div class="booking-popup__btns">
      <a href="https://reservations.bostonharborhotel.com/?Hotel=26834&shell=rBOSHA&chain=10237&template=rBOSHA" 
        class="btn btn--primary" id="booking_submit" target="_blank">Check Availability</a>
    </div>
  </div>
</div>
<?php wp_footer(); ?>

