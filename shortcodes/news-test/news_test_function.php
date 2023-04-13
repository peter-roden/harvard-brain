<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function news_test_function () {		
		
		$html = '';
		
		$args = array(
		    'post_type' 	=> 'hbi_events',
		    'posts_per_page'=> -1,
			'post_status' 	=> 'publish'
		);
				
		$query = new WP_Query( $args );
	
		if ($query->have_posts()) {
				
				while ( $query->have_posts() ) {
					
				    $query->the_post();  		    
					
					$title = get_the_title();
					$html .= '<br><br>' . $title . '<br>-----------------------------------<br><br>';
					
					$banner_image = get_field('banner_image');					
					if( $banner_image ) {
						$html .= 'HAS A BANNER IMAGE ' . $banner_image;
					} else {
						$html .= 'NO BANNER IMAGE<br>';
					}
					$large_image = get_field('large_image');	
					if( $large_image ) {
						$html .= 'HAS A LARGE IMAGE' . $large_image;
					} else {
						$html .= 'NO LARGE IMAGE<br>';
					}
					$thumbnail_image = get_field('thumbnail_image');					
					if( $thumbnail_image ) {
						$html .= 'HAS A THUMBNAIL IMAGE<img src="' . $thumbnail_image . '">';
					} 
					
				}
						
		}
				
		echo $html;

	}

?>
