<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function event_highlights_category_function ($atts){
		extract(shortcode_atts(array(
			'slug' => ''
		), $atts));
				
		$html = '';

		$args = array(
		    'post_type' 	=> 'hbi_events',
		    'posts_per_page'=> -1,
			'post_status' 	=> 'publish',
			'meta_key'		=> 'event_date',
			'orderby'		=> 'meta_value',
			'order'			=> 'DESC'
		);
		
		$query = new WP_Query( $args );

		if ($query->have_posts()) {

			$count = 0;
			
			while ( $query->have_posts() ) {
				
			    $query->the_post();
				
				$categories	= get_field('categories');
				
				if ($categories) {
					
					foreach( $categories as $term ) {
						
						if ($term->slug == $slug) {
							
							$count++;
							
							if ($count == 1) {
								
								$html .= '<div class="columns columns-first columns-heading">';
									$html .= '<div class="col1">';
										$html .= '<h4>' . $term->name . '</h4>';
									$html .= '</div>';
									$html .= '<div class="col2">';
										$html .= '<h4 class="columns-right"><a href="' . 'http://brain.harvard.edu/news/event-types/?id=' . $term->term_id . '">SEE ALL</a></h4>';
									$html .= '</div>';

								$html .= '</div>';
								
							}
							
						}
						
					}
					
				}
				
			}
			
		}
			
		$check_back = TRUE;
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
				
				$categories	= get_field('categories');
				
				if ($categories) {
					
					foreach( $categories as $term ) {
						
						if ($term->slug == $slug) {
							
							$count++;
										
							if ($count <= 2) {

								$check_back = FALSE;
								
								$link = get_field('link');
								if ($link) {
									$link = get_field('link') . '" target="_blank';
								} else {
									$link = get_post_permalink($id);
								}
										
								$image = get_field('thumbnail_image');					
								if( $image ) { $thumbnail_image = '<img src="' . $image . '" style="width:150px;height:150px">'; }
				
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
								
								$read_more = '<a href="' . $link . '">REGISTER AND LEARN MORE ></a>';	
								
								if ($count == 1) {
									$html .= '<div class="columns first">';
								} else {
									$html .= '<div class="columns">';
								}
									
									$html .= '<div class="col1">';
										$html .= '<a href="' . $link . '">' . $thumbnail_image . '</a>';
									$html .= '</div>';
									
									$html .= '<div class="col2">';
										$html .= '<div class="columns-subtitle">' . '<a href="' . $link . '">' . $subtitle . '</a></div>';
										$html .= '<div class="columns-title">' . $title . '</div>';
										$html .= '<div class="excerpt">' . $excerpt . '</div>';
										$html .= '<div class="readmore">' . $read_more . '</div>';
									$html .= '</div>';	
								
								$html .= '</div>';
								
							}

						}
						
					}
					
				}
				
			}
		}
		
		if ($check_back) { $html .= '<div style="margin-bottom: 30px;">Please check back later for future events.</div>'; }

		return $html;

	}

?>
