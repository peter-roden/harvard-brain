<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function event_highlights_columns_function () {		
		
		$html = '';
		
		$html .= '<div class="highlight-columns">';

		$today = current_time('Ymd');
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

			$events_unique_temp 	= array();
			$events 				= array();
			$count 		 			= 0;
			
			while ( $query->have_posts() ) {
				
			    $query->the_post();

				$highlight  = get_field('highlight');
				if ($highlight == 'yes') { $highlight_count++; }
				$events_categories	= get_field('categories');
				if ($events_categories) {
					foreach( $events_categories as $term ) {
						$count++;
						$events_unique_temp[$count] = $term->name;
						$events[$count]['name'] 	= $term->name;
						$events[$count]['term_id']	= $term->term_id;
						$events[$count]['id']   	= get_the_id();
						if ($highlight_count <= 2) {
							$events[$count]['highlight']  = $highlight;
						} else {
							$events[$count]['highlight']  = 'no';
						}
					}
				}

			}	
			
		}
	
		function ecompareByName($a, $b) {
		  return strcmp($a["name"], $b["name"]);
		}
		usort($events, 'ecompareByName');	
		$events_unique_temp = array_values(array_unique($events_unique_temp));
		sort ($events_unique_temp);


		$events_unique = array();
		$i=0;
		foreach ($events_unique_temp as $unique) {
			
			$ii=0;	
		
			foreach ($events as $events_item) {
				
				if ($events_item['name'] == $unique) {
					$ii++;
				}
				
			}
			
			$i++;
			$events_unique[$i]['name']  = $unique;
			$events_unique[$i]['count'] = $ii;;

		}

		$cols = 0;
		foreach ($events_unique as $unique) {
			
			$i=0;	
			$cols++;
		
			foreach ($events as $events_item) {
				
				if (($events_item['name'] == $unique['name']) && ($events_item['highlight'] == 'no' )){
					
					$i++;
					
					if ($i == 1) {			
							
						if ($cols % 2 == 0) {
					        $html .= '</div>'; 
							$html .= '<div class="et_pb_column et_pb_column_1_2  et_pb_column_3 et_pb_css_mix_blend_mode_passthrough et-last-child column2">';
						} else {
							$html .= '<div class="et_pb_column et_pb_column_1_2  et_pb_column_3 et_pb_css_mix_blend_mode_passthrough ">';
						}

					    $html .= '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_2 et_pb_with_border type-title">';
				            $html .= '<div class="et_pb_text_inner">';
				               $html .= '<div class="column-title">';
				                  $html .= '<h4>'. $events_item['name'] .'</h4>';
				                  $html .= '<h4 class="see-all"><a href="' . site_url() . '/news/event-types?id=' . $events_item['term_id'] . '">(See All)</a></h4>';
				               $html .= '</div>';
				            $html .= '</div>';
				        $html .= '</div>';
					} 

					if ($i <= 2) {

						$link = get_permalink($events_item['id']);
								
						$image = get_field('thumbnail_image', $events_item['id']);					
						if( $image ) { $thumbnail = '<img src="' . $image . '">'; }

						$title = get_field('event_date', $events_item['id']) . ' from ' . get_field('event_start',$events_item['id']) . ' to ' . get_field('event_end',$events_item['id']);
						
						$subtitle = get_the_title($events_item['id']);
						
						$terms = get_field('location',$events_item['id']);
						if($terms){
							foreach( $terms as $term ) {
								$term_array = get_term_by('id', $term, 'locations');
								$location 	= $term_array->name .'<br>' . get_field('address','locations' . '_'.$term_array->term_id);
							}
						}
						$excerpt =  get_field('excerpt',$events_item['id']) . 
									'<div class="location">' . $location . '</div>';

						$html .= '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_3">';
				            $html .= '<div class="et_pb_text_inner">';
				               $html .= '<div class="landing-news-columns">';
				                  $html .= '<div class="et_pb_section et_section_regular">';
			                        if ($i == 1) {
										$html .= '<div class="landing-row">';
									} else {
										$html .= '<div class="landing-row landing-row-last">';
									}
				                        $html .= '<div class="et_pb_section et_section_regular">';
				                           $html .= '<div class=" et_pb_row">';
				                              $html .= '<div class="et_pb_column et_pb_column_1_3">';
				                                 $html .= '<div class="et_pb_module et_pb_image et_always_center_on_mobile"><span class="et_pb_image_wrap"><a href="'. $link . '" target="_blank">' . $thumbnail . '</a></span></div>';
				                              $html .= '</div>';
				                              $html .= '<div class="et_pb_column et_pb_column_2_3 et-last-child">';
				                                 $html .= '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left">';
				                                    $html .= '<div class="et_pb_text_inner">';
				                                       $html .= '<div class="title"><a class="name" href="'. $link . '" target="_blank">' . $title .'</a></div>';
				                                       $html .= '<div class="subtitle">' . $subtitle .'</div>';
				                                       $html .= '<div class="excerpt">' . $excerpt . '</div>';
				                                       $html .= '<div class="links">';
				                                          $html .= '<div class="read-more"><a href="' . $link . '" target="_blank">READ MORE ></a></div>';
				                                       $html .= '</div>';
				                                    $html .= '</div>';
				                                 $html .= '</div>';
				                              $html .= '</div>';
				                           $html .= '</div>';
				                        $html .= '</div>';
				                     $html .= '</div>';
				                  $html .= '</div>';
				               $html .= '</div>';
				            $html .= '</div>';
				        $html .= '</div>';
							
					}

					if ($i == 2) {
						$html .= '</div>';
					}

				}
				
			}
		}

		$html .= '</div> <!-- .highlight-columns -->';

		return $html;

	}