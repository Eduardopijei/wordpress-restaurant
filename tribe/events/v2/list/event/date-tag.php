<?php
/**
 * View: List View - Single Event Date Tag
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event/date-tag.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post            $event        The event post object with properties added by the `tribe_get_event` function.
 * @var \DateTimeInterface $request_date The request date object. This will be "today" if the user did not input any
 *                                       date, or the user input date.
 * @var bool               $is_past      Whether the current display mode is "past" or not.
 *
 * @see tribe_get_event() For the format of the event object.
 */

use Tribe__Date_Utils as Dates;

/*
 * If the request date is after the event start date, show the request date to avoid users from seeing dates "in the
 * past" in relation to the date they requested (or today's date).
 */
$start_date = empty( $is_past ) && ! empty( $request_date )
	? max( $event->dates->start_display, $request_date )
	: $event->dates->start_display;
$end_date = empty( $is_past ) && ! empty( $request_date )
? max( $event->dates->end_display, $request_date )
: $event->dates->end_display;

$start_event_month  = $start_date->format_i18n( 'F' );
$start_event_month_mobile   = $start_date->format_i18n( 'M' );
$start_event_day_num   = $start_date->format_i18n( 'j' );
$start_event_date_attr = $start_date->format( Dates::DBDATEFORMAT );

if( $end_date ) {
	$end_event_month  = $end_date->format_i18n( 'F' );
	$end_event_month_mobile   = $end_date->format_i18n( 'M' );
	$end_event_day_num   = $end_date->format_i18n( 'j' );
	$end_event_date_attr = $end_date->format( Dates::DBDATEFORMAT );
}
?>
<div class="tribe-events-calendar-list__event-date-tag tribe-common-g-col">
	<time class="tribe-events-calendar-list__event-date-tag-datetime" 
		datetime="<?php echo esc_attr( $start_event_date_attr ); ?>"
		datetime="<?php echo esc_attr( $start_event_date_attr ); ?>">
		<span class="tribe-events-calendar-list__event-date-tag-daynum">
			<?php echo esc_html( $start_event_day_num ); ?>
			<?php 
			if( $end_date && $end_event_day_num != $start_event_day_num ) {
				echo ' - ' . esc_html( $end_event_day_num );
			} ?>
		</span>
		<span class="tribe-events-calendar-list__event-date-tag-month">
			<?php if( $end_date && $end_event_month != $start_event_month ) { ?>
				<span class="mobile"><?php echo esc_html( $start_event_month_mobile ) . ' - ' . esc_html( $end_event_month_mobile ); ?></span>
				<span class="desktop"><?php echo esc_html( $start_event_month_mobile ) . ' - ' . esc_html( $end_event_month_mobile ); ?></span>
			<?php } else { ?>
				<span class="mobile"><?php echo esc_html( $start_event_month_mobile ); ?></span>
				<span class="desktop"><?php echo esc_html( $start_event_month ); ?></span>
			<?php } ?>
		</span>
	</time>
</div>
