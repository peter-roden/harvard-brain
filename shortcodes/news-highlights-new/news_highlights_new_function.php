<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function news_highlights_new_function () {

		$html = '';

		$args = array(
		    'post_type' 	=> 'hbi_news',
		    'posts_per_page'=> -1,
			'post_status' 	=> 'publish',
			'meta_key'		=> 'publication_date',
			'orderby'		=> 'meta_value',
			'order'			=> 'DESC'
		);
		
		$query = new WP_Query( $args );


		if ($query->have_posts()) {

			$html .= '<div class="landing-news">';

			$count = 0;

			while ( $query->have_posts() ) {
				
			    $query->the_post();
			    		    
			    $highlight = get_field ('highlight');

				if ($highlight == 'yes') {

					$count++;
					
					if ($count <= 2) {
					
						$type = 'news';
						
						$columns = 5;

						$link = get_field('link');
						if ($link) {
							$link = get_field('link') . '" target="_blank';
						} else {
							$link = get_post_permalink($id);
						}
								
						$image = get_field('thumbnail_image');					
						if( $image ) { $thumbnail = '<img src="' . $image . '"' . ' class="highlights">'; }
		
						$title = get_the_title();
						
						$date = get_field('publication_date',false,false);
						$date = new DateTime($date);
						$subtitle = $date->format('F j, Y');
						
						$excerpt = get_field('excerpt');
						
						$left_footer = '';
						
						$read_more = 'READ MORE >';	
						
						$html .= display_landing_row ($type, $columns, $link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more);

					}
				
				}
			}
			
			$html .= '</div>';			
			
		}

		return $html;

	}
?>