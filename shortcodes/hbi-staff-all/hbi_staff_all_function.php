<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function hbi_staff_all_function() {		
		
		$html = '';
		
/*
		$html .= '<div class="highlight-columns">';
			echo '<div class="et_pb_section banner et_pb_section_0 et_section_regular">';
				echo '<div class="row et_pb_row et_pb_row_0">';
					echo '<div class="et_pb_column et_pb_column_4_4  et_pb_column_0 et_pb_css_mix_blend_mode_passthrough et-last-child">';
						echo '<div class="et_pb_module et_pb_image et_pb_image_0 et_always_center_on_mobile">';
							echo '<span class="et_pb_image_wrap"><img src="' . site_url() .'/wp-content/uploads/calendar-banner.jpg" alt="" /></span>';
						echo '</div>';
					echo '</div>'; // et_pb_column 				
				echo '</div>'; // .et_pb_row				
			echo '</div>'; // .et_pb_section 
*/

		$html .= '<div class="taxonomy-title">';
			echo '<a class="breadcrumb" href="'. site_url() . '">HOME</a> / <a class="breadcrumb" href="' . site_url() . '/hbi-for-everyone/">FOR EVERYONE</a> / <a class="breadcrumb" href="' . site_url() .'/hbi-staff/">HBI Staff</a>';
			$html .= '<h1>HBI Staff</h1>';
		$html .= '</div>';
		
		$args = array(
		    'post_type' 	=> 'hbi_staff',
		    'posts_per_page'=> -1,
			'post_status' 	=> 'publish',
			'orderby'		=> 'date',
			'order'			=> 'DESC'
		);
				
		$query = new WP_Query( $args );
	
		if ($query->have_posts()) {

			$html .= '<div id="taxonomy-landing-page" class="taxonomy-row">';
			
			while ( $query->have_posts() ) {
				
			    $query->the_post();
			    		    							
				$type = 'humans';
				
				$columns = 5;

				$link = get_permalink();	
						
				$image = get_field('image-square');					
				if( $image ) { $image = '<img src="' . $image . '" style="width:150px;height:auto">'; }

				$title 			= get_the_title();
				$subtitle 		= get_field('title');;
				$excerpt 		=  get_field('excerpt');
				$left_footer 	= '';	
				$read_more 		= 'READ MORE >';	
				
				$html .= display_landing_row ($type, $columns, $link, $image, $title, $subtitle, $excerpt, $left_footer, $read_more);						

			}
			
			$html .= '</div>';

			$html .= paginate_landing_rows ('taxonomy-landing-page');
								
		}
		
		$html .= '</div>';
				
		echo $html;

	}

?>
