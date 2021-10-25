  <section class="instagram-feed">
    <?php echo do_shortcode('[instagram-feed]'); ?>
  </section>
</main>
<?php $bg = get_field('background', 'option'); ?>
<footer class="footer" <?php if ($bg) : ?>style="background-image: url(<?php echo $bg; ?>)"<?php endif; ?>>
  
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
<div class="booking-popup">
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
</div>
<?php wp_footer(); ?>

