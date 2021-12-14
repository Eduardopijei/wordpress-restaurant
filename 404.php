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
