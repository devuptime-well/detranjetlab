<?php
/**
 * View: Week View Mobile Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/views/v2/week/mobile-events.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 4.7.5
 *
 * @var array $days An array of all the days in the Week; the array has shape `[ <Y-m-d> => [ ...<day_data> ] ]`.
 */
?>

<section class="tribe-events-pro-week-mobile-events">

	<?php foreach ( $days as $day_date => $day ) : ?>
		<?php $this->template( 'week/mobile-events/day', [ 'day_date' => $day_date, 'day' => $day ] ); ?>
	<?php endforeach; ?>

	<?php $this->template( 'week/nav', [ 'location' => 'mobile' ] ); ?>

</section>
