<?php

$ev_time=$this->ect_tribe_event_time($event_id,false);
$list_style=$style;
if($template=="modern-list") {
	$list_style='style-2';
}
else if($template=="classic-list") {
	$list_style='style-3';
}
$ev_post_img='';
$size='medium';
$feat_img_url=tribe_event_featured_image( $event_id,$size, false,false );
if($feat_img_url) {
    $ev_post_img=$feat_img_url;
}
else {
    $ev_post_img=ECT_PLUGIN_URL."assets/images/event-template-bg.png";
}



/*** Default List Style 3 */
if(($style=="style-3" && $template=="default") || $template=="classic-list") {
	$events_html.='
	<div id="event-'.$event_id.'" class="ect-list-post '.$list_style.' '.$event_type.'" itemscope itemtype="http://schema.org/Event">
		<meta itemprop="name" content="'.get_the_title($event_id).'">
		<meta itemprop="image" content="'.$ev_post_img.'">
		
		<div class="ect-clslist-event-date ect-list-date">
			'.$event_schedule;
			if($socialshare=="yes"){
				$events_html.=ect_share_button($event_id);
			}
		$events_html.='</div>';  
	
		$events_html.='<div class="ect-clslist-event-info"> 
			<div class="ect-clslist-inner-container">
				<h2 class="ect-list-title">'.$event_title.'</h2>
				<div class="ect-clslist-time">
					<span class="ect-icon"><i class="ect-icon-clock"></i></span>
					<span class="cls-list-time">'.$ev_time.'</span>
				</div>';
				
				if (tribe_has_venue($event_id)) {
					$events_html.=$venue_details_html;
				}
				else{
					$events_html.='';
				}
			
			/*	test1 $events_html.= '<div class="ect-list-categoery">';
					$events_html.= get_the_term_list($event_id, 'tribe_events_cat', '<ul class="tribe_events_cat"><li>', ',</li><li>', '</li></ul>' );
					$events_html.= '</div>'; */
			$events_html.='</div>
				<div class="ect-list-cost">'.$ev_cost.'</div>
		</div><div class="ect-clslist-event-details">
			<a href="'.esc_url( tribe_get_event_link($event_id)).'" class="tribe-events-read-more" rel="bookmark">'.esc_html__( 'Find out more', 'the-events-calendar' ).'<i class="ect-icon-right-double"></i></a>
		</div>
	</div>';
}


/*** Default List Style 2 */
else if (($style=="style-2" && $template=="default") || $template=="modern-list") {
	$bg_styles="background-image:url('$ev_post_img');background-size:cover;background-position:bottom center;";
	$events_html.='
	<div id="event-'.$event_id.'" class="ect-list-post '.$list_style.' '.$event_type.'" itemscope itemtype="http://schema.org/Event">
		<meta itemprop="name" content="'.get_the_title($event_id).'">
		<meta itemprop="image" content="'.$ev_post_img.'">
		
		<div class="ect-list-post-left ">
			<div class="ect-list-img" style="'.$bg_styles.'"></div>';
			if($socialshare=="yes"){
				$events_html.=ect_share_button($event_id);
			}
		$events_html.='</div><!-- left-post close -->
		
		<div class="ect-list-post-right">
			<div class="ect-list-post-right-table">
				<div class="ect-list-description">
					<h2 class="ect-list-title">'.$event_title.'</h2>';
					
					if (tribe_has_venue($event_id)) {
					$events_html.=$venue_details_html;
					}
					else{
					$events_html.='';
					}

					$events_html.='<div class="ect-list-cost">'.$ev_cost.'</div>';
					$events_html.=$event_content;
				
				/*	$events_html.= '<div class="ect-list-categoery">';
					$events_html.= get_the_term_list($event_id, 'tribe_events_cat', '<ul class="tribe_events_cat"><li>', ',</li><li>', '</li></ul>' );
					$events_html.= '</div>';
					*/
				$events_html.='</div>
				<div class="modern-list-right-side">
					<div class="ect-list-date">'.$event_schedule.'</div>
				</div>
			</div>
		</div><!-- right-wrapper close -->
	</div><!-- event-loop-end -->';
}


/*** Default List Style 1 */
else{
	$bg_styles="background-image:url('$ev_post_img');background-size:cover;";
	$events_html.='
	<div id="event-'. $event_id .'" class="ect-list-post style-1 '.$event_type.'" itemscope itemtype="http://schema.org/Event">
		<meta itemprop="name" content="'.get_the_title($event_id).'">
		<meta itemprop="image" content="'.$ev_post_img.'">
		
		<div class="ect-list-post-left ">
			<div class="ect-list-img" style="'.$bg_styles.'">
				<a href="'.esc_url( tribe_get_event_link($event_id)).'" alt="'.get_the_title($event_id).'" rel="bookmark">
					<div class="ect-list-date">'.$event_schedule.'</div>
				</a>
			</div>';
			if($socialshare=="yes"){
				$events_html.=ect_share_button($event_id);
			}
		$events_html.='</div><!-- left-post close -->
		
		<div class="ect-list-post-right">
			<div class="ect-list-post-right-table">';	
				if (tribe_has_venue($event_id)) {
				$events_html.='<div class="ect-list-description">';
				}else{
				$events_html.='<div class="ect-list-description" style="width:100%;">';
				}
					$events_html.='<h2 class="ect-list-title">'.$event_title.'</h2>';
					
					$events_html.=$event_content;
					$events_html.='<div class="ect-list-cost">'.$ev_cost.'</div>';
			
			/*		$events_html.= '<div class="ect-list-categoery">';
				$events_html.= get_the_term_list($event_id, 'tribe_events_cat', '<ul class="tribe_events_cat"><li>', ',</li><li>', '</li></ul>' );
				$events_html.= '</div>'; */

				$events_html.= '</div>';
				
				if (tribe_has_venue($event_id)) {				
					$events_html.=$venue_details_html;
				}else{
					$events_html.='';
				}
			
			$events_html.='</div>
		</div><!-- right-wrapper close -->
	</div><!-- event-loop-end -->';
}