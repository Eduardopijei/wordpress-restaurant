<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
get_header(); ?>
    <section class="page-error">
        <div class="page-error__content">
            <h1 class="page-error__heading a-up">404</h1>
            <h6 class="page-error__subheading a-up a-delay-1">THIS PAGE COULD NOT BE FOUND</h6>
            <p class="page-error__text a-up a-delay-2">
            The page you are looking for does not exist, has been removed, or is temporarily unavailable.
            </p>
            <a href="<?php echo home_url(); ?>" class="btn btn--primary a-up a-delay-3">
                To Homepage
            </a>
        </div>
        <div class="page-error__image">
            <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'error_image', 'o' => 'o', 'v2x' => false ) ); ?>
        </div>
    </section>
</main>
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
