<?php
/**
 * View: Map View - Map
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/views/v2/map/map.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 4.7.7
 *
 */
?>
<div class="tribe-events-pro-map__map tribe-common-g-col">
	<?php $this->template( 'map/map/google-maps', [ 'events' => $events, 'is_premium' => $is_premium, 'map_provider_key' => $map_provider_key ] ); ?>
</div>
