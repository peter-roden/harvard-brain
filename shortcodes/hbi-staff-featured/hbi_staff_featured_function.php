<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function hbi_staff_featured_function () {

		$html = '';

		$args = array(
		    'post_type' 	=> 'hbi_staff',
		    'posts_per_page'=> -1,
			'post_status' 	=> 'publish',
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'meta_query' => array(
			    array(
			      'key' 	=> 'featured',
			      'value' 	=> TRUE,
			      'compare'	=> '=='
			    )
			)
		);
		
		$query = new WP_Query( $args );

		if ($query->have_posts()) {

			$count = 0;

			while ( $query->have_posts() ) {
				
			    $query->the_post();
			    		    
					$html .= '<div class="humans-featured">';
					
						$link = get_post_permalink();
								
						$image = get_field('image-16x9');					
						if( $image ) { $image = '<a href="' . $link . '"><img src="' . $image . '"></a>'; }
		
						$title = get_the_title();
						$subtitle = get_field('title');
						
						$excerpt = get_field('excerpt');
						
						$read_more = '<a href="' . $link . '">READ MORE ></a>';	
						
						$html .= '<div class="col1">';
							$html .= $image;
						$html .= '</div>';
						
						$html .= '<div class="col2">';
							$html .= '<a href="' . $link . '"><div class="title">' . $title . '</div><a/>';
							$html .= '<a href="' . $link . '"><div class="subtitle">' . $subtitle . '</div></a>';
							$html .= '<div class="excerpt">' . $excerpt . '</div>';
							$html .= '<div class="readmore">' . $read_more . '</div>';
						$html .= '</div>';	
						
					$html .= '</div>';					
			
			}			
			
		}

		return $html;

	}
?>