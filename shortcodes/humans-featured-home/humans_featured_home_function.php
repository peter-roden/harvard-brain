<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function humans_featured_home_function () {

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
			      'compare'	=> '=='
			    )
			)
		);
		
		$query = new WP_Query( $args );

		if ($query->have_posts()) {

			$count = 0;

			while ( $query->have_posts() ) {
				
			    $query->the_post();
			    		    	
					$image = basename(get_field('image-home'), '.png'); 
	
// 					$html .= '<img src="' . $image .'" style="margin: 0px; z-index: auto; width: 100%; height: auto; padding: 0px;" >';
					
			
				$html .= '<img src="http://brain.harvard.edu/wp-content/uploads/' . $image . '" style="width:100%;height:auto;" />';
			
			
			}			
			
		}

		return $html;

	}
?>