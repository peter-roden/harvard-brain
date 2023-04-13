<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function connectome_search_all_function (){
		
		$html .= '<style>.filter-results {display:none;}</style>';
		
		$count = 0;
		
		$args = array(
			'post_type'			=> 'hbi_connectome',
			'posts_per_page'	=> -1,
			'post_status' 		=> 'publish'
		);

		
		$the_query = new WP_Query($args);
	
		if( $the_query->have_posts() ) {			
			while( $the_query->have_posts() ) {
				$the_query->the_post(); 
				$count++;
			}
		}
		
		// $html .= '<div class="count">Displaying all ' . $count . ' Connectome members below.</div>';
		$html .= '<div class="count"></div>';
		
		$args = array(
			'post_type'			=> 'hbi_connectome',
			'posts_per_page'	=> -1,
			'post_status' 		=> 'publish',
			'meta_key'			=> 'lname',
			'orderby'			=> 'meta_value',
			'order'				=> 'ASC'
		);
		
		$the_query = new WP_Query($args);
	
		if( $the_query->have_posts() ) {
			
			$html .= '<div id="connectome-display-row">';
			
			while( $the_query->have_posts() ) {
				$the_query->the_post(); 
												
				$id 		= get_the_id();
				$permalink 	= get_the_permalink();
				if (strlen($permalink) == 0) { $permalink = "https://brain.harvard.edu/hbi_connectome/" . get_field('fname') . '-' . get_field('lname'); }
				$image 		= get_field('image',$id);
				$size 		= array("150","150");						
				$thumbnail 	= get_the_post_thumbnail_url ($id, $size);
				$image		= '<span class="et_pb_image_wrap">' . 
								  '<a ' . 'href="' . $permalink . '">' . 
									  '<img src="' . $thumbnail . '">' . 
								  '</a>' . 
							  '</span>';
				$name		= get_field('fname',$id) . ' ' . get_field('lname',$id);
				$job_title 	= get_field('job_title',$id);
				$lab 		= '<a href="' . get_field('lab_url',$id) . '">' . get_field('lab_name',$id) . '</a>';
				$title_lab 	= $job_title . ' / ' . $lab;
				$excerpt 	= strip_tags(substr(get_field('about_me',$id), 0, 300));
				$pos	    = strrpos($excerpt, " ");
				if ($pos>0) { $excerpt = substr($excerpt, 0, $pos); }
				$excerpt 	= $excerpt . '...';
					
				$html .= connectome_display_row ($image, $name, $title_lab, $excerpt, $permalink);			
					
			}
			
			$html .= '</div>';
			
			$html .= paginate_landing_rows ('connectome-display-row');
			
		}

		
		wp_reset_query();

	return $html;

	}
?>