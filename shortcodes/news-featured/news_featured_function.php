<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function news_featured_function () {

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

			$count = 0;

			while ( $query->have_posts() ) {
				
				$query->the_post();
							
				$featured = get_field ('featured');

				if ($featured == 'yes') {

					$count++;
					
					if ($count == 1) {

						$html .= '<div class="featured">';
						
							// $link = get_field('link');
							// if ($link) {
							// 	$link = get_field('link') . '" target="_blank';
							// } else {
							// 	$link = get_post_permalink($id);
							// }
							$link = get_post_permalink($id);
																
							$image = get_field('featured_image');					
							if( $image ) { $featured_image = '<a href="' . $link . '"><img src="' . $image . '"></a>'; }
			
							$title = get_the_title();
							
							$date = get_field('publication_date',false,false);
							$date = new DateTime($date);
							$date = $date->format('F j, Y');
							
							$excerpt = get_field('excerpt');
							
							$read_more = '<a href="' . $link . '">READ MORE ></a>';	
							
							$neuroscience_tags = get_field('neuroscience_tags');
							if ($neuroscience_tags) :
								$tags = '';
								foreach ($neuroscience_tags as $neuroscience_tag) : 
									$tag_post = get_post($neuroscience_tag);
									$title = get_the_title( $tag_post->ID );
									$tags .= '<a href="' . site_url() . '/hbi-news?type=tag&slug=' . $tag_post->post_name . '"><span>' . $title . '</span></a>';
								endforeach;
							endif; 
							
							$html .= '<div class="col1">';
								$html .= $featured_image;
							$html .= '</div>';
							
							$html .= '<div class="col2">';
								$html .= '<div class="featured-news">Featured Story:</div>';
								$html .= '<div class="featured-title">' . get_the_title() . '</div>';
								$html .= '<div class="featured-subtitle">' . $date . '</div>';
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