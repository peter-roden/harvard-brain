<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function humans_highlights_function () {

		$html = '';

		$args = array(
		    'post_type' 	=> 'hbi_humans',
		    'posts_per_page'=> -1,
			'post_status' 	=> 'publish',
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'meta_query' => array(
			    array(
			      'key' 	=> 'featured',
			      'value' 	=> TRUE,
			      'compare'	=> '!='
			    )
			)
		);
		
		$query = new WP_Query( $args );

		if ($query->have_posts()) {

			$count = 0;

			while ( $query->have_posts() ) {
				
			    $query->the_post();
			    		    
					$count++;
					if ($count <= 5) {
					
						$html .= '<div class="humans-highlights">';
						
							$link = get_post_permalink();
									
							$image = get_field('image-square');					
							if( $image ) { $image = '<a href="' . $link . '"><img src="' . $image . '" style="width:150px;height:auto"><a/>'; }
			
							$title = get_the_title() . '<br>' . get_field('program');
							$subtitle = get_field('location');
							
							$excerpt = get_field('excerpt');
							
							$read_more = '<a href="' . $link . '">READ MORE ></a>';	
							
							$html .= '<div class="col1">';
								$html .= $image;
							$html .= '</div>';
							
							$html .= '<div class="col2">';
								$html .= '<a href="' . $link . '"><div class="title">' . $title . '</div></a>';
								$html .= '<a href="' . $link . '"><div class="subtitle">' . $subtitle . '</div></a>';
								$html .= '<div class="excerpt">' . $excerpt . '</div>';
								$html .= '<div class="readmore">' . $read_more . '</div>';
							$html .= '</div>';	
							
						$html .= '</div>';
					
					}					
			
			}			
			
		}
		
		$html .= '<div class="humans-highlights-see-all">';
			$html .= '<a href="http://brain.harvard.edu/humans-of-hbi/all-humans/">SEE ALL</a>';
		$html .= '</div>';

		return $html;

	}

?>
