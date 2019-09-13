<?php 
$carousel_style=isset($attribute['style'])?$attribute['style']:'style-1';
$ev_post_img='';
if(isset($attribute['columns'])&& $attribute['columns']>2){
    $size='medium';
}else{
    $size='large';
}
$feat_img_url=tribe_event_featured_image( $event_id,$size, false,false );
if($feat_img_url) {
    $ev_post_img=$feat_img_url;
}
else {
    $ev_post_img=ECT_PLUGIN_URL."assets/images/event-template-bg.png";
}


/*
* carousel view style-1
*/
if($style=="style-1" || $style=="") {
    $events_html.='
    <div id="event-'. $event_id .'" class="ect-carousel-event style-1 '.$event_type.'" itemscope itemtype="http://schema.org/Event">
        <div class="style-1">
		    <meta itemprop="image" content="'.$ev_post_img.'">
            <meta itemprop="description" content="'.esc_attr(wp_strip_all_tags( tribe_events_get_the_excerpt($event_id), true )).'">
            <div class="ect-carousel-image">
                <a title="'.get_the_title($event_id) .'"  href="'.tribe_get_event_link($event_id).'">
                <img src="'.$ev_post_img.'"  alt="'.get_the_title($event_id) .'">
                </a>';
                if($socialshare=="yes") { $events_html.=ect_share_button($event_id); }
            $events_html.=
			'</div>
				<div class="ect-carousel-title"><h4 class="title_a">'.$event_title.'</h4></div>
				<div class="ect-carousel-date">'.$event_schedule.'
			</div>';

            if (tribe_has_venue($event_id) && $attribute['hide-venue']!="yes") {
                $events_html.='<div class="ect-carousel-venue">'.$venue_details_html.'</div>';
            }
            else {
                $events_html.='';
            }

            if ( tribe_get_cost($event_id, true ) ) {
                $events_html.= '<div class="ect-carousel-cost">'.$ev_cost.'</div>
                            <div class="ect-carousel-readmore">
                            <a href="'.tribe_get_event_link($event_id).'" title="'.get_the_title($event_id) .'" rel="bookmark">'.__('Find out more','the-events-calendar').'</a>
                            </div>';
            }
            else {
                $events_html.= '<div class="ect-carousel-readmore full-view">
                            <a href="'.tribe_get_event_link($event_id).'" title="'.get_the_title($event_id) .'" rel="bookmark">'.__('Find out more','the-events-calendar').'</a>
                            </div>';
            }

        $events_html.='</div>
    </div>';
}


/*
* carousel view style-2, 3
*/
else {
    $events_html.='
    <div id="event-'. $event_id .'" class="ect-carousel-event '.$carousel_style.' '.$event_type.' zebra" itemscope itemtype="http://schema.org/Event">
        <div class="style-2">
            <meta itemprop="image" content="'.$ev_post_img.'">
            <meta itemprop="description" content="'.esc_attr(wp_strip_all_tags( tribe_events_get_the_excerpt($event_id), true )).'">
            <div class="ect-carousel-image">
                <a href="'.tribe_get_event_link($event_id).'">
                <img src="'.$ev_post_img.'" title="'.get_the_title($event_id) .'" alt="'.get_the_title($event_id) .'">
                </a>';
                if($socialshare=="yes") { $events_html.=ect_share_button($event_id); }
            $events_html.=
			'</div>
				<div class="ect-carousel-title"><h4 class="title_a">'.$event_title.'</h4></div>
				<div class="ect-carousel-date">'.$event_schedule.'
			</div>';

            if (tribe_has_venue($event_id) && $attribute['hide-venue']!="yes") {
                $events_html.='<div class="ect-carousel-venue">'.$venue_details_html.'</div>';
            }
            else {
                $events_html.='';
            }

            if ( tribe_get_cost($event_id, true ) ) {
                $events_html.= '<div class="ect-carousel-cost">'.$ev_cost.'</div>
                            <div class="ect-carousel-readmore">
                            <a href="'.tribe_get_event_link($event_id).'" title="'.get_the_title($event_id) .'" rel="bookmark">'.__('Find out more','the-events-calendar').'</a>
                            </div>';
            }
            else {
                $events_html.= '<div class="ect-carousel-readmore full-view">
                            <a href="'.tribe_get_event_link($event_id).'" title="'.get_the_title($event_id) .'" rel="bookmark">'.__('Find out more','the-events-calendar').'</a>
                            </div>';
            }

        $events_html.='</div>
    </div>';
}