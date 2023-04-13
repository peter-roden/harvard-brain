<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function home_news_function($atts){
		extract(shortcode_atts(array(
			'display' => ''
		), $atts));
				
		$html = '';
	    
	    if (substr(strtolower($display), 0, 1) == 'y') {
				
		    $article 	= array();
	
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

				$c = 0;
	
				while ( $query->have_posts() ) {
					
				    $query->the_post();
				    		    
					$id = get_the_ID();
					
					$home_page = get_field ('home_page');
	
					$excerpt = get_field('excerpt');
	
/*
					$link = get_field('link');
					if ($link) {
						$link = get_field('link') . '" target="_blank';
					} else {
						$link = get_post_permalink($id);
					}
*/
					$link = get_post_permalink($id);

					if ($home_page == 'yes') {
						
						$c++;
						
						if ($c == 1) { $html .= '<h4>Community Stories</h4>'; }
						
						if ($c <= 3) {
	
							$html .= '<div class="item">';
							    $html .= '<span class="title">' . get_the_title(). '</span><br>';
							    $html .= $excerpt;				    
								$html .= '<div class="read-more">';
									$html .= '<a href="' . $link . '">' . 'READ MORE >' . '</a>';
								$html .= '</div>';
							$html .= '</div>';
	
						}
							
					}
					
				}	
				
			}
			
		}

		return $html;

	}
?>