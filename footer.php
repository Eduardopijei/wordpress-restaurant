  <!-- <section class="instagram-feed">
    <?php echo do_shortcode('[instagram-feed]'); ?>
  </section> -->
  <section class="newsletter">
    <div class="container">
      <div class="newsletter-inner">
        <?php if( $heading = get_field( 'n_heading', 'options' ) ): ?>
          <h3 class="newsletter-heading a-up"><?php echo $heading; ?></h3>
        <?php endif; ?>
        <div class="newsletter-form a-up a-delay-1">
          <input type="text" class="form-control" placeholder="Your Email">
          <input type="submit" class="btn btn--accent form-submit" value="Stay Connected">
        </div>
      </div>
    </div>
  </section>
</main>
<!-- Footer -->
<footer class="footer">
  <div class="footer-top">
    <div class="container">
      <?php if( $logo = get_field( 'f_logo', 'options' ) ): ?>
        <a href="<?php echo esc_url( home_url( ) ); ?>" class="footer-logo a-up">
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
        <img src="<?php echo $logo; ?>" alt="">
      </a>
      <?php if (get_row_index() == $count - 2) : ?>
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

<!-- Global Popup -->
<div class="popup">
  <button class="popup-close">
    <svg width="31" height="32" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
      <line x1="29.5772" y1="30.9914" x2="1.29292" y2="2.70714" stroke="white" stroke-width="2"/>
      <line x1="1.29302" y1="29.5772" x2="29.5773" y2="1.29292" stroke="white" stroke-width="2"/>
    </svg>
  </button>
  <div class="popup-inner">
    <div class="popup-header"></div>
    <div class="popup-body"></div>
  </div>
</div>
<!-- Booking Popup -->
<!-- <div class="booking-popup">
  <div class="booking-popup__inner">
    <div class="booking-popup__links">
      <a href="#" class="booking-popup__link cta cta-reverse active">Stay</a>
      <a href="#" class="booking-popup__link cta cta-reverse">Dine</a>
      <a href="#" class="booking-popup__link cta cta-reverse">Events</a>
      <a href="https://trp23455.na.book4time.com/onlinebooking" class="booking-popup__link cta cta-reverse" target="_blank">Spa</a>
    </div>
    <div class="booking-popup__selects">
      <select name="" id="" class="booking-popup__select">
        <option value="">Stay</option>
        <option value="">Dine</option>
        <option value="">Events</option>
      </select>
    </div>

    <div class="booking-popup__content">
      <div class="form-row">
        <div class="form-col">
          <label for="booking_check_in">Check in</label>
          <div class="event-date">
            <input type="text" id="booking_check_in" class="form-control form-date" placeholder="Select Date">
          </div>
        </div>
        <div class="form-col">
          <label for="booking_check_out">Check out</label>
          <div class="second-event-date">
            <input type="text" id="booking_check_out" class="form-control form-date" placeholder="Select Date">
          </div>
        </div>
        <div class="form-col">
          <label for="booking_people_number">Number of people</label>
          <select name="" id="booking_people_number" class="form-control">
            <option value="1">1 Adult</option>
            <option value="2">2 Adults</option>
            <option value="3">3 Adults</option>
            <option value="4">4 Adults</option>
          </select>
        </div>
        <div class="form-col">
          <label for="booking_promo">Promo</label>
          <input type="text" class="form-control" id="booking_promo" placeholder="Enter Code">
        </div>
      </div>
    </div>
    <div class="booking-popup__btns">
      <a href="https://www.hilton.com/en/book/reservation/rooms/?ctyhocn=SJDWAWA" class="btn btn--accent" id="booking_submit" target="_blank">Check Availability</a>
      <a href="#" class="link" id="booking_cancel">Modify or Cancel</a>
    </div>
  </div>
</div> -->
<?php wp_footer(); ?>

