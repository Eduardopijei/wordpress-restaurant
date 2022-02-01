<?php
/**
 * View: List View - Single Event Title
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event/title.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */
?>
<h3 class="tribe-events-calendar-list__event-title tribe-common-h6 tribe-common-h4--min-medium">
	<?php $additional_fields = tribe_get_custom_fields();
	$tag = ( $additional_fields['Is clickable'] == 'Yes' ) ? 'a' : 'span'; ?>
	<<?php echo $tag; ?>
		href="<?php echo esc_url( $event->permalink ); ?>"
		title="<?php echo esc_attr( $event->title ); ?>"
		rel="bookmark"
		class="tribe-events-calendar-list__event-title-link tribe-common-anchor-thin"
	>
		<?php
		// phpcs:ignore
		echo $event->title;
		?>
	</<?php echo $tag; ?>>
</h3>