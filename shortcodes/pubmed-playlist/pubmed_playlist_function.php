<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function pubmed_playlist_function ($atts){
		extract(shortcode_atts(array(
			'display' => ''
		), $atts));
				
		$html = '';
	    
	    if (substr(strtolower($display), 0, 1) == 'y') {

		    $article 	= array();
	
			$args = array(
			    'post_type' 	=> 'pubmed_playlist',
			    'posts_per_page'=> -1,
				'post_status' 	=> 'publish',
				'category_name' => 'Home PubMed Playlists'
			);
			
			$query = new WP_Query( $args );
	
			if ($query->have_posts()) {
	
				$html .= '<h4>PubMed Playlist</h4>';
	
				
				while ( $query->have_posts() ) {
					
				    $query->the_post();
				    $article = get_field("article");
				    
					$html .= '<div class="item">';
					    $html .= '<span class="title">' . get_the_title(). '</span><br>';
					    $html .= get_the_content();				    
						$html .= '<div class="read-more">';
							$html .= '<a href="' . $article["url"] . '" target="' . $article["target"] . '">' . 'READ MORE >' . '</a>';
						$html .= '</div>';
					$html .= '</div>';
				
				}					
				
			}
		
		} 		

		return $html;

	}
?>