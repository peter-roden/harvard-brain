<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function event_past_events_function() {		
		
		$html = '';
		
		$html .= '<div class="highlight-columns">';
			// echo '<div class="et_pb_section banner et_pb_section_0 et_section_regular">';
			// 	echo '<div class="row et_pb_row et_pb_row_0">';
			// 		echo '<div class="et_pb_column et_pb_column_4_4  et_pb_column_0 et_pb_css_mix_blend_mode_passthrough et-last-child">';
			// 			echo '<div class="et_pb_module et_pb_image et_pb_image_0 et_always_center_on_mobile">';
			// 				echo '<span class="et_pb_image_wrap"><img src="' . site_url() .'/wp-content/uploads/calendar-banner.jpg" alt="" /></span>';
			// 			echo '</div>';
			// 		echo '</div>'; // et_pb_column 				
			// 	echo '</div>'; // .et_pb_row				
			// echo '</div>'; // .et_pb_section 

		$term = get_term_by('id', $_GET['id'], 'event_categories');		
		$html .= '<div class="taxonomy-title">';
			$html .= '<a class="breadcrumb" href="'. site_url() . '">HOME</a> / <a class="breadcrumb" href="' . site_url() . '<a class="breadcrumb" href="' . site_url() .'/events/">EVENTS</a> / <span class="breadcrumb-current">' . 'PAST EVENTS' . '</span>';
			$html .= '<h1>' . 'Past Events' . '</h1>';
		$html .= '</div>';
		
		
		$today = date('Ymd');
		$args = array(
		    'post_type' 	=> 'hbi_events',
		    'posts_per_page'=> -1,
			'post_status' 	=> 'publish',
		    'meta_query' => array(
			     array(
			        'key'		=> 'event_date',
			        'compare'	=> '<',
			        'value'		=> $today
			    )),
			'meta_key'			=> 'event_date',
			'orderby'			=> 'meta_value',
			'order'				=> 'DESC'
		);
				
		$query = new WP_Query( $args );
	
		if ($query->have_posts()) {

			$html .= '<div id="taxonomy-landing-page" class="taxonomy-row">';
			
			while ( $query->have_posts() ) {
				
			    $query->the_post();
			    		    							
				$type = 'events';
				
				$columns = 5;

				$link = get_permalink();	
						
				$image = get_field('thumbnail_image');					
				if( $image ) { $thumbnail = '<img src="' . $image . '">'; }

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
				
				$read_more = '';	
				
				$html .= display_landing_row ($type, $columns, $link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more);						

			}
			
			$html .= '</div>';

			$html .= paginate_landing_rows ('taxonomy-landing-page');
								
		}
		
		$html .= '</div>';
				
		echo $html;

	}

?>
