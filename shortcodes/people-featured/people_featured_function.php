<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function people_featured_function (){
		
		$html = '';
		
		$args = array(
			'post_type'			=> 'people',
			'posts_per_page'	=> -1,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
            'order' 			=> 'DESC',
			'meta_query' => array(
				array(
					'key' => 'featured',
					'value' => '1',
					'compare' => '=='
				)
			)
		);
		
		$the_query = new WP_Query($args);
	
		$featured = 0;
		if( $the_query->have_posts() ) {
			while( $the_query->have_posts() ) {
				
				$featured++;
				if ($featured == 1) {
					
					$the_query->the_post(); 
	
					$link = get_the_permalink ();
								
					$image = get_field('featured_image');
					$size = 'thumbnail'; 						
					if($image) { $featured_image = wp_get_attachment_image( $image, $size ); }
	
					$rows = get_field('degrees');
					$c = count($rows);							
					if ($c == 0) {
						$degrees = '';
					} else {
						$degrees = ', ';
					}
					$n = 0;
					if($rows) {
						foreach($rows as $row) {
							$n++;
							if ($n == $c) {
								$degrees .= $row['degree'];
							} else {
								$degrees .= $row['degree'] . ', ';
							}
						}
					}
					$title = get_the_title() . $degrees;
					$featured_text = get_field('featured_text');
					$link = get_the_permalink ();
					
					$html .= '<div id="people-featured">';
						$html .= '<div class="left">';
							$html .= '<a href="' . $link . '">' . $featured_image . '</a><br>';
						$html .= '</div>';
						$html .= '<div class="right">';
							$html .= '<div class="featured-scientist">' . 'Featured Scientist:' . '</div>';
							$html .= '<div class="featured-title"><a href="' . $link . '">' . $title . '</a></div>';
							$html .= '<p>' .$featured_text . '</p>';
						$html .= '</div>';
					$html .= '</div>';
				
				}

			}

		}
		
		wp_reset_query();

	return $html;

	}
?>