<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function events_featured_function () {

		$html = '';

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

			$count = 0;

			while ( $query->have_posts() ) {
				
				$query->the_post();
							
				$featured = get_field ('featured');

				if ($featured == 'yes') {

					$count++;
					
					if ($count == 1) {
						
						$html .= '<div class="featured">';

							$link = get_field('link');
							if ($link) {
								$link = get_field('link') . '" target="_blank';
							} else {
								$link = get_post_permalink($id);
							}
									
							$image = get_field('featured_image');					
							if( $image ) { $featured_image = '<img src="' . $image . '">'; }
							
							$title = get_the_title();
			
							$subtitle = get_field('event_date') . ' from ' . get_field('event_start') . ' to ' . get_field('event_end');
							
							$terms = get_field('location');
							if($terms){
								foreach( $terms as $term ) {
									$term_array = get_term_by('id', $term, 'locations');
									$location 	= $term_array->name .'<br>' . get_field('address','locations' . '_'.$term_array->term_id);
								}
							}
							$excerpt =  get_field('excerpt') . 
										'<div class="location">' . $location . '</div>';
							$categories = get_field('categories');
							if ($categories) :
								$tags = '';
								foreach ($categories as $category) : 
									$tags .= '<a href="' . site_url() . '/hbi-events-categories?type=tag&slug=' . $category->slug . '"><span>' . $category->name . '</span></a>';
								endforeach;
							endif; 
							$read_more = '<a href="' . $link . '">REGISTER AND LEARN MORE ></a>';	
							
							$html .= '<div class="col1">';
								$html .= '<a href=" ' . $link . '">' . $featured_image . '</a>';
							$html .= '</div>';
							
							$html .= '<div class="col2">';
								$html .= '<div class="featured-event">' . 'Featured Event:' . '</div>';
								$html .= '<div class="featured-title">' . '<a href=" ' . $link . '">' . $title . '</a></div>';
								$html .= '<div class="featured-subtitle">' . $subtitle . '</div>';
								$html .= '<div class="excerpt">' . $excerpt . '</div>';
								$html .= '<div class="readmore">' . $read_more . '</div>';
								$html .= '<div class="columns"><div class="tags">' . $tags . '</div></div>';
							$html .= '</div>';
												
						$html .= '</div>';	

					}
				
				}
			}		
			
		}

		return $html;

	}
?>