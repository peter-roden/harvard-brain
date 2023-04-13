<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function connectome_featured_function (){
		
		$count = 0;
		
		$args = array(
			'post_type'			=> 'hbi_connectome',
			'posts_per_page'	=> -1,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'publish_date',
			'order' 			=> 'ASC'
		);
		
		$the_query = new WP_Query($args);
	
		if( $the_query->have_posts() ) {
			
			$html .= '<div id="connectome-display-row" class="connectome-featured">';
			
			while( $the_query->have_posts() ) {
				$the_query->the_post(); 
														
				$featured = get_field('featured');
				
				if ($featured) {

					$count++;
					
					if ($count == 1) {
						
						$id 		= get_the_id();
						$permalink 	= get_permalink($id);
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
						$about_me = get_field('about_me',$id);
						if (strlen($about_me) > 0) { 
							$excerpt 	= substr(get_field('about_me',$id), 0, 300);
							$pos	    = strrpos($excerpt, " ");
							if ($pos>0) { $excerpt = substr($excerpt, 0, $pos); }
							$excerpt 	= $excerpt . '...';
						}
			
						$html .= '<div class="row" style="margin-bottom: 0px !important; padding-bottom: 20px !important; border-bottom: none !important;">';
						
							$html .= '<div class="et_pb_column et_pb_column_1_5 et_pb_css_mix_blend_mode_passthrough">';
								$html .= '<div class="et_pb_module et_pb_image">';
									$html .= $image;
								$html .= '</div>';
							$html .= '</div>';
							
							$html .= '<div class="et_pb_column et_pb_column_4_5 et_pb_css_mix_blend_mode_passthrough et-last-child">';
								$html .= '<div class="et_pb_module et_pb_text et_pb_text_align_left">';
									$html .= '<div class="et_pb_text_inner">';
										$html .= '<div class="featured-label">Featured Member:</div>';
										$html .= '<div class="name">' . $name  . '</div>';
										$html .= '<div class="lab">' . $title_lab . '</div>';
										$html .= '<div class="excerpt">' . $excerpt  . '</div>';
										$html .= '<div class="learn-more"><a href="' . $permalink . '" target="_blank">LEARN MORE &gt;</a></div>';
									$html .= '</div>';
								$html .= '</div>';
							$html .= '</div>';
						
						$html .= '</div>';
					
					}
				
				}
					
			}
			
			$html .= '</div>';
			
		}

		
		wp_reset_query();

	return $html;

	}
?>