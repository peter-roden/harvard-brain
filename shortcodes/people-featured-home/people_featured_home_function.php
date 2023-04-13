<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function people_featured_home_function ($atts){
		extract(shortcode_atts(array(
			'display' => ''
		), $atts));
				
		$html = '';
		$affilitations = '';
		$degrees = '';
	    
	    if (substr(strtolower($display), 0, 1) == 'y') {
		
			$args = array(
				'post_type'			=> 'people',
				'posts_per_page'	=> -1,
				'post_status' 		=> 'publish',
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
						$size = 'full'; 						
						if($image) { $featured_image = wp_get_attachment_image( $image, $size ); }
		
						$rows = get_field('degrees');
						$c = count($rows);				
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

						$rows = get_field('titles');
						$c = count($rows);							
						$titles = '';
						$affilitations_title = 'Affiliation';
						$n = 0;
						if($rows) {
							foreach($rows as $row) {
								$n++;
								
								if ($row['affiliation'] == '[blank]') {
								
									if ($n == $c) {
										$titles .= '<span>' .
														$row['title'] . 
													'</span>';
									} else {
										$titles .= '<span>' .
														$row['title'] .
													'</span>' .
													'<br>';
									}
							
								} else {
									
									if ($n == $c) {
										$titles .= '<span>' .
														$row['title'] . ', ' . 
													'</span>' .
													'<span>' . 
													$row['affiliation'] . 
													'</span>';
									} else {
										$titles .= '<span>' .
														$row['title'] . ', ' . 
													'</span>' .
													'<span>' . 
													$row['affiliation'] . 
													'</span>' .
													'<br>';
									}
									if ($n > 1) { $affilitations_title = 'Affiliations'; }
									$affilitations .= '<span>' . 
													  $row['affiliation'] . 
													  '</span>' .
													  '<br>';								
																	
								}
							
							}
						}

						$title = get_the_title() . $degrees;
						$featured_text = get_field('featured_text');
						$link = get_the_permalink ();
						
						$html .= '<h4>' . 'Featured Scientist' . '</h4>';
						$html .= '<div id="people-featured-home">';
								$html .= '<div class="title">'. get_the_title() . ', ' . $degrees . '</div>';									
								$html .= '<div class="subtitle">' . $titles .'</div>';
								$html .= '<a href="' . $link . '">' . $featured_image . '</a>';
								$html .= '<p>' .$featured_text . '</p>';
								$html .= '<div class="link"><a href="' . get_the_permalink() . '">READ MORE &gt;</a></div>';
						$html .= '</div>';
					
					}
	
				}
	
			}
			
			wp_reset_query();
			
		}

	return $html;

	}
?>