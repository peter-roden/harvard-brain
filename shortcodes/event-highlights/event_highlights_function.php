<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function event_highlights_function () {

		$html = '';

		$today = date('Ymd');
		$args = array(
		    'post_type' 	=> 'hbi_events',
		    'posts_per_page'=> -1,
			'post_status' 	=> 'publish',
		    'meta_query' => array(
			     array(
			        'key'		=> 'event_date',
			        'compare'	=> '>=',
			        'value'		=> $today
			    )),
			'meta_key'			=> 'event_date',
			'orderby'			=> 'meta_value',
			'order'				=> 'ASC'
		);
		
		$query = new WP_Query( $args );


		if ($query->have_posts()) {

			$html .= '<div class="landing-events">';

			$count = 0;

			while ( $query->have_posts() ) {
				
			    $query->the_post();
			    		    
			    $highlight = get_field ('highlight');

				if ($highlight == 'yes') {
					
					$count++;
					
					if ($count <= 2) {						
											
						$type = 'events';
						
						$columns = 5;

						$link = get_permalink();	
								
						$image = get_field('thumbnail_image');					
						if( $image ) { $thumbnail = '<img src="' . $image . '"' . ' class="highlights" >'; }
		
						$title = get_field('event_date') . ' from ' . get_field('event_start') . ' to ' . get_field('event_end');

						$subtitle = get_the_title();
						
						$terms = get_field('location');
						if($terms){
							foreach( $terms as $term ) {
								$term_array = get_term_by('id', $term, 'locations');
								$location 	= $term_array->name .'<br>' . get_field('address','locations' . '_'.$term_array->term_id);
							}
						}
						$excerpt =  get_field('excerpt') . 
									'<div class="location">' . $location . '</div>';

						
						$left_footer = '';
						
						$read_more = 'REGISTER AND LEARN MORE >';	
						
						$html .= display_landing_row ('event-highlight', $columns, $link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more);				
					
					}

				
				}
			}
			
			$html .= '</div>';			
			
		}

		return $html;

	}
	
	function display_event_html ($id, $banner_image, $date, $excerpt, $location, $link) {
		
		$html = '';

		$html .= '<div id="event-highlights">';

			$html .= '<div class="event-image">';
				$html .= '<a href="' . $link . '">' . '<img src="' . $banner_image . '">' .'</a>';
			$html .= '</div>';					
			
			$html .= '<div class="event-title">';
				$html .= '<a href="' . $link . '">' . get_the_title($id). '</a>';
			$html .= '</div>';				
			
			$html .= '<div class="event-date">';
				$html .= $date;
			$html .= '</div>';				
			
			$html .= '<div class="event-excerpt">';
				$html .= $excerpt;
			$html .= '</div>';				
			
			$html .= '<div class="event-location">';
				$html .= $location;
			$html .= '</div>';				
			
			$html .= '<div class="event-read-more">';
				$html .= '<a href="' . $link . '">' . 'READ MORE ' . '<i class="fa fa-caret-right" aria-hidden="true"></i></a>';
			$html .= '</div>';
		
		$html .= '</div>';		

		return $html;

	}
?>