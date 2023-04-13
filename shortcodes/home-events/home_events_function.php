<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function home_events_function ($atts){
		extract(shortcode_atts(array(
			'display' => ''
		), $atts));
				
		$html = '';
	    
	    if (substr(strtolower($display), 0, 1) == 'y') {
				
		    $article 	= array();
	
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
	
				$count = 0;
	
				while ( $query->have_posts() ) {
					
				    $query->the_post();
	
					$home_page = get_field ('home_page');
					
					$excerpt = get_field('excerpt');
	
					$date 	= get_field('event_date');
					$start 	= get_field('event_start');
					$end	= get_field('event_end');
	
					$terms = get_field('location');
					if($terms){
						foreach( $terms as $term ) {
							$term_array = get_term_by('id', $term, 'locations');
							$location = $term_array->name;
						}
					}
	
					$excerpt = get_field('excerpt');
		
					$link = get_permalink();
					
					if ($home_page == 'yes') {
						
						$count++;
						
						if ($count == 1) { $html .= '<h4>Upcoming Events</h4>'; }
						
						if ($count <= 2) {
	
							$html .= '<div class="item">';
								$html .= '<span class="title">' . get_the_title() . '</span>';
								$html .= '<div class="details">';
								    $html .= $date . '<br>';
								    $html .= $start . ' to ' . $end . '<br>';
								    $html .= 'Location: ' . $location;
								$html .= '</div>';
							    $html .= $excerpt;				    
								$html .= '<div class="read-more">';
									$html .= '<a href="' . $link . '">' . 'READ MORE >' . '</a>';
								$html .= '</div>';
							$html .= '</div>';	
	
						}
							
					}
					
				}	
				
			}
		
		}

		return $html;

	}
?>