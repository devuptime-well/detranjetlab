<?php 
$slider_style=isset($attribute['style'])?$attribute['style']:'style-1';

$ev_post_img='';
$size='large';
$feat_img_url=tribe_event_featured_image( $event_id,$size, false,false );
if($feat_img_url) {
    $ev_post_img=$feat_img_url;
}else {
    $ev_post_img=ECT_PLUGIN_URL."assets/images/event-template-bg.png";
}


/**
* Slider view - style-3
*/
if($style=="style-3"){
    $events_html.='<div id="event-'. $event_id .'" class="ect-slider-event '.$slider_style.' '.$event_type.'" itemscope itemtype="http://schema.org/Event">
                <div class="ect-slider-event-area">
                ';

    $events_html.='<div class="ect-slider-right ect-slider-image">
                <a href="'.tribe_get_event_link($event_id).'">
                <img src="'.$ev_post_img.'" title="'.get_the_title($event_id) .'" alt="'.get_the_title($event_id) .'">
                </a>';
    if($socialshare=="yes") { $events_html.=ect_share_button($event_id); }
    $events_html.='</div>';

    $events_html.='<div class="ect-slider-left">
                <div class="ect-slider-date">
                '.$event_schedule.'
                </div>';

    $events_html.='<div class="ect-slider-title"><h4>'.$event_title.'</h4></div>';

    if (tribe_has_venue($event_id) && $attribute['hide-venue']!="yes") {
        $events_html.='<div class="ect-slider-venue">'.$venue_details_html.'</div>';
    }
    else {
        $events_html.='';
    }
  
    if ( tribe_get_cost($event_id, true ) ) {
        $events_html.= '<div class="ect-slider-cost">'.$ev_cost.'</div>
                        <div class="ect-slider-readmore">
                        <a href="'.tribe_get_event_link($event_id).'" title="'.get_the_title($event_id) .'" rel="bookmark">'.__('Find out more','the-events-calendar').'</a>
                        </div></div>';
    }
    else {
        $events_html.= '<div class="ect-slider-readmore full-view">
                        <a href="'.tribe_get_event_link($event_id).'" title="'.get_the_title($event_id) .'" rel="bookmark">'.__('Find out more','the-events-calendar').'</a>
                        </div></div>';
    }

    $events_html.='</div></div>';
}

    
/**
* Slider view - style-all
*/
else{
    $events_html.='<div id="event-'. $event_id .'" class="ect-slider-event '.$slider_style.' '.$event_type.'" itemscope itemtype="http://schema.org/Event">
                <div class="ect-slider-event-area">
                ';

    $events_html.='<div class="ect-slider-right ect-slider-image">
                <a href="'.tribe_get_event_link($event_id).'">
                <img src="'.$ev_post_img.'" title="'.get_the_title($event_id) .'" alt="'.get_the_title($event_id) .'">
                </a>';
    if($socialshare=="yes") { $events_html.=ect_share_button($event_id); }
    $events_html.='</div>';

    $events_html.='<div class="ect-slider-left">
                <div class="ect-slider-date">
                '.$event_schedule.'
                </div>';

    $events_html.='<div class="ect-slider-title"><h4>'.$event_title.'</h4></div>';

    if (tribe_has_venue($event_id) && $attribute['hide-venue']!="yes") {
        $events_html.='<div class="ect-slider-venue">'.$venue_details_html.'</div>';
    }
    else {
        $events_html.='';
    }

    $events_html.= '<div class="ect-slider-description">
                    '.$event_content.'</div>';
   
    if ( tribe_get_cost($event_id, true ) ) {
        $events_html.= '<div class="ect-slider-cost">'.$ev_cost.'</div>
                        <div class="ect-slider-readmore">
                        <a href="'.tribe_get_event_link($event_id).'" title="'.get_the_title($event_id) .'" rel="bookmark">'.__('Find out more','the-events-calendar').'</a>
                        </div></div>';
    }
    else {
        $events_html.= '<div class="ect-slider-readmore full-view">
                        <a href="'.tribe_get_event_link($event_id).'" title="'.get_the_title($event_id) .'" rel="bookmark">'.__('Find out more','the-events-calendar').'</a>
                        </div></div>';
    }
   
    $events_html.='</div></div>';
}


   