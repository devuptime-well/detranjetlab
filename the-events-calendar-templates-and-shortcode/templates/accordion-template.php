<?php
$size           =   'medium';
$feat_img_url   =   tribe_event_featured_image( $event_id, $size, false, false );
$start_date     =   tribe_get_start_date($event_id, false, 'F j (l) g:i a' );
$end_date       =   tribe_get_end_date( $event_id, false, 'F j (l) g:i a' );
$map            =   tribe_get_embedded_map($event_id);
$ev_post_img    =   '';
if($feat_img_url) {
    $ev_post_img=$feat_img_url;
}
else {
    $ev_post_img=ECT_PLUGIN_URL."images/event-template-bg.png";
}


/*---Accordion STYLE 1, STYLE 2, STYLE 3 START---*/
if($style=='style-1' || $style=='style-2' || $style=='style-3'){
    $events_html .='
    <div id = "ect-accordion-event-'. $event_id.'" class="ect-accordion-event '.$style.' '.$event_type.'" itemscope itemtype="http://schema.org/Event">
        <meta itemprop="name" content="'.get_the_title($event_id).'">
        <meta itemprop="image" content="'.$ev_post_img.'">
        <div class="ect-accordion-header">
            <div class="ect-accordion-header-left">
                <div class="ect-accordion-date">'.$event_schedule.'</div>
            </div>
            <div class="ect-accordion-header-right">
                '.$event_title;
                if (tribe_has_venue($event_id)) {
                    $events_html .='<div class="ect-accordion-venue">'.$venue_details_html.'</div>';
                }
            $events_html .='</div>';
            if($socialshare=="yes") {
                $events_html.=ect_share_button($event_id);
            }
        $events_html .='</div>


        <div class="ect-accordion-footer">';
            if(tribe_has_venue($event_id) && $feat_img_url) {
                $events_html .='<div class="ect-accordion-image">
                    <img src="'.$ev_post_img.'" title="'.get_the_title($event_id) .'" alt="'.get_the_title($event_id) .'">';
                    if ( tribe_get_cost($event_id, true ) ) {
                        $events_html.= '<div class="ect-accordion-image-top">
                        <div class="ect-accordion-cost">'.$ev_cost.'</div>
                        <div class="ect-accordion-date-full">
                            '.$start_date.' - '.$end_date.'
                        </div>
                        </div>';
                    }
                    else {
                        $events_html.= '<div class="ect-accordion-image-top">
                        <div class="ect-accordion-date-full">
                            '.$start_date.' - '.$end_date.'
                        </div>
                        </div>';
                    }
                $events_html .='</div>
                <div class="ect-accordion-map">
                    '.$map.'
                </div>
                <div class="ect-accordion-content">
                '.$event_content.'
                </div>';
            }
            else if(tribe_has_venue($event_id) && !$feat_img_url) {
                $events_html .='<div class="ect-accordion-map">
                '.$map.'
                </div>
                <div class="ect-accordion-content half-area">';
                    if ( tribe_get_cost($event_id, true ) ) {
                        $events_html.= '<div class="ect-accordion-cost no-image">'.$ev_cost.'</div>
                        <div class="ect-accordion-date-full no-image">
                            '.$start_date.' - '.$end_date.'
                        </div>';
                    }
                    else {
                        $events_html.= '<div class="ect-accordion-date-full no-image">
                            '.$start_date.' - '.$end_date.'
                        </div>';
                    }
                    $events_html .=$event_content.'
                </div>';
            }
            else if(!tribe_has_venue($event_id) && $feat_img_url) {
                $events_html .='<div class="ect-accordion-image">
                    <img src="'.$ev_post_img.'" title="'.get_the_title($event_id) .'" alt="'.get_the_title($event_id) .'">';
                    if ( tribe_get_cost($event_id, true ) ) {
                        $events_html.= '<div class="ect-accordion-image-top">
                        <div class="ect-accordion-cost">'.$ev_cost.'</div>
                        <div class="ect-accordion-date-full">
                            '.$start_date.' - '.$end_date.'
                        </div>
                        </div>';
                    }
                    else {
                        $events_html.= '<div class="ect-accordion-image-top">
                        <div class="ect-accordion-date-full">
                            '.$start_date.' - '.$end_date.'
                        </div>
                        </div>';
                    }
                $events_html .='</div>
                <div class="ect-accordion-content half-area">
                '.$event_content.'
                </div>';
            }
            else {
                if ( tribe_get_cost($event_id, true ) ) {
                    $events_html.= '<div class="ect-accordion-cost no-image">'.$ev_cost.'</div>
                    <div class="ect-accordion-date-full no-image">
                        '.$start_date.' - '.$end_date.'
                    </div>';
                }
                else {
                    $events_html.= '<div class="ect-accordion-date-full no-image">
                        '.$start_date.' - '.$end_date.'
                    </div>';
                }
                $events_html .='<div class="ect-accordion-content">
                '.$event_content.'
                </div>';
            }          
        $events_html .='</div>
    </div>';
}
/*---Accordion STYLE 1, STYLE 2, STYLE 3 END---*/


/*---Accordion STYLE 4 START---*/
/*else if($style=='style-4'){
    if( $ect_compare != $events_date_header && $count>0){
    
        $events_html .='</div><!--close div!-->';
        $ect_compare=$events_date_header;
   }
  
    if($events_date_header !==''){
       
        $events_html .= '<div class="ect-accordion-event-year ect-accordion-view"><!--open year div!-->'. $events_date_header;
        $count++;  
    }
  
    $events_html .='
    <div id = "ect-accordion-event-'. $event_id.'" class="ect-accordion-event '.$style.' '.$event_type.'" itemscope itemtype="http://schema.org/Event">
        <div class="ect-accordion-header">
            <div class="ect-accordion-header-left">
                <div class="ect-accordion-date">'.$event_schedule.'</div>
            </div>
            <div class="ect-accordion-header-right">
                '.$event_title;
                if (tribe_has_venue($event_id)) {
                    $events_html .='<div class="ect-accordion-venue">'.$venue_details_html.'</div>';
                }
                if($socialshare=="yes") {
                    $events_html.=ect_share_button($event_id);
                }
            $events_html .='</div>
        </div>


        <div class="ect-accordion-footer">
            <div class="ect-accordion-image">
                <img src="'.$ev_post_img.'" title="'.get_the_title($event_id) .'" alt="'.get_the_title($event_id) .'">';
                if ( tribe_get_cost($event_id, true ) ) {
                    $events_html.= '<div class="ect-accordion-image-top">
                    <div class="ect-accordion-cost">'.$ev_cost.'</div>
                    <div class="ect-accordion-date-full">
                        '.$start_date.' - '.$end_date.'
                    </div>
                    </div>';
                }
                else {
                    $events_html.= '<div class="ect-accordion-image-top">
                    <div class="ect-accordion-date-full">
                        '.$start_date.' - '.$end_date.'
                    </div>
                    </div>';
                }
            $events_html .='</div>
            <div class="ect-accordion-map">
                '.$map.'
            </div>
            <div class="ect-accordion-content">
                '.$event_content.'
            </div>
        </div>
    </div>'; 
}
/*---Accordion STYLE 4 END---*/


else{
    $events_html .='
    <div id = "ect-accordion-event-'. $event_id.'" class="ect-accordion-event style-1 '.$event_type.'" itemscope itemtype="http://schema.org/Event">
        <meta itemprop="name" content="'.get_the_title($event_id).'">
        <meta itemprop="image" content="'.$ev_post_img.'">
        <div class="ect-accordion-header">
            <div class="ect-accordion-header-left">
                <div class="ect-accordion-date">'.$event_schedule.'</div>
            </div>
            <div class="ect-accordion-header-right">
                '.$event_title;
                if (tribe_has_venue($event_id)) {
                    $events_html .='<div class="ect-accordion-venue">'.$venue_details_html.'</div>';
                }
            $events_html .='</div>';
            if($socialshare=="yes") {
                $events_html.=ect_share_button($event_id);
            }
        $events_html .='</div>


        <div class="ect-accordion-footer">';
            if(tribe_has_venue($event_id) && $feat_img_url) {
                $events_html .='<div class="ect-accordion-image">
                    <img src="'.$ev_post_img.'" title="'.get_the_title($event_id) .'" alt="'.get_the_title($event_id) .'">';
                    if ( tribe_get_cost($event_id, true ) ) {
                        $events_html.= '<div class="ect-accordion-image-top">
                        <div class="ect-accordion-cost">'.$ev_cost.'</div>
                        <div class="ect-accordion-date-full">
                            '.$start_date.' - '.$end_date.'
                        </div>
                        </div>';
                    }
                    else {
                        $events_html.= '<div class="ect-accordion-image-top">
                        <div class="ect-accordion-date-full">
                            '.$start_date.' - '.$end_date.'
                        </div>
                        </div>';
                    }
                $events_html .='</div>
                <div class="ect-accordion-map">
                    '.$map.'
                </div>
                <div class="ect-accordion-content">
                '.$event_content.'
                </div>';
            }
            else if(tribe_has_venue($event_id) && !$feat_img_url) {
                $events_html .='<div class="ect-accordion-map">
                '.$map.'
                </div>
                <div class="ect-accordion-content half-area">';
                    if ( tribe_get_cost($event_id, true ) ) {
                        $events_html.= '<div class="ect-accordion-cost no-image">'.$ev_cost.'</div>
                        <div class="ect-accordion-date-full no-image">
                            '.$start_date.' - '.$end_date.'
                        </div>';
                    }
                    else {
                        $events_html.= '<div class="ect-accordion-date-full no-image">
                            '.$start_date.' - '.$end_date.'
                        </div>';
                    }
                    $events_html .=$event_content.'
                </div>';
            }
            else if(!tribe_has_venue($event_id) && $feat_img_url) {
                $events_html .='<div class="ect-accordion-image">
                    <img src="'.$ev_post_img.'" title="'.get_the_title($event_id) .'" alt="'.get_the_title($event_id) .'">';
                    if ( tribe_get_cost($event_id, true ) ) {
                        $events_html.= '<div class="ect-accordion-image-top">
                        <div class="ect-accordion-cost">'.$ev_cost.'</div>
                        <div class="ect-accordion-date-full">
                            '.$start_date.' - '.$end_date.'
                        </div>
                        </div>';
                    }
                    else {
                        $events_html.= '<div class="ect-accordion-image-top">
                        <div class="ect-accordion-date-full">
                            '.$start_date.' - '.$end_date.'
                        </div>
                        </div>';
                    }
                $events_html .='</div>
                <div class="ect-accordion-content half-area">
                '.$event_content.'
                </div>';
            }
            else {
                if ( tribe_get_cost($event_id, true ) ) {
                    $events_html.= '<div class="ect-accordion-cost no-image">'.$ev_cost.'</div>
                    <div class="ect-accordion-date-full no-image">
                        '.$start_date.' - '.$end_date.'
                    </div>';
                }
                else {
                    $events_html.= '<div class="ect-accordion-date-full no-image">
                        '.$start_date.' - '.$end_date.'
                    </div>';
                }
                $events_html .='<div class="ect-accordion-content">
                '.$event_content.'
                </div>';
            }          
        $events_html .='</div>
    </div>';
}