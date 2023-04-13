<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function news_types_function () {		
		
		$html = '';
		
		$html .= '<div class="highlight-columns">';

		echo '<div class="et_pb_section banner et_pb_section_0 et_section_regular">';
			echo '<div class="row et_pb_row et_pb_row_0">';
				echo '<div class="et_pb_column et_pb_column_4_4  et_pb_column_0 et_pb_css_mix_blend_mode_passthrough et-last-child">';
					echo '<div class="et_pb_module et_pb_image et_pb_image_0 et_always_center_on_mobile">';
						echo '<span class="et_pb_image_wrap"><img src="' . site_url() .'/wp-content/uploads/news-banner.png" alt="" /></span>';
					echo '</div>';
				echo '</div>'; // et_pb_column 				
			echo '</div>'; // .et_pb_row				
		echo '</div>'; // .et_pb_section 

		$term = get_term_by('id', $_GET['id'], 'news_types');		
		$html .= '<div class="taxonomy-title">';
			$html .= '<a class="breadcrumb" href="'. site_url() . '">HOME</a> / <a class="breadcrumb" href="' . site_url() . '/hbi-for-everyone/">FOR EVERYONE</a> / <a class="breadcrumb" href="' . site_url() .'/news/">NEWS</a> / <span class="breadcrumb-current">' . $term->name . '</span>';
			$html .= '<h1>' . $term->name . '</h1>';
		$html .= '</div>';

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

				$html .= '<div id="taxonomy-landing-page" class="taxonomy-row">';
				
				while ( $query->have_posts() ) {
					
				    $query->the_post();
				    		    
					$is_type = FALSE;					
					$news_types	= get_field('news_types');
					if ($news_types) {
						foreach( $news_types as $term ) {
							if ($term->term_id == $_GET['id']) { $is_type = TRUE; }	
						}
					}
							
					if ($is_type) {
								
						$type = 'news';
						
						$columns = 5;


						$link = get_field('link');
						if ($link) {
							$link = get_field('link') . '" target="_blank';
						} else {
							$link = get_post_permalink($id);
						}
						
						if ($term->slug == 'in-the-news') { 
							if (get_field('source_link')) {
								$link = get_field('source_link') . '" target="_blank'; 
							} else {
								$link = get_field('link') . '" target="_blank'; 
							}
						}

						if ($term->slug == 'community-stories') { 
							$link = get_post_permalink($id);
						}						
		
						$image = get_field('thumbnail_image');					
						if( $image ) { $thumbnail_image = '<img src="' . $image . '">'; }
		
						$title = get_the_title();
						
						$date = get_field('publication_date',false,false);
						$date = new DateTime($date);
						$date = $date->format('F j, Y');
						
						$excerpt = get_field('excerpt');
						
						$read_more = '<a href="' . $link . '">READ MORE ></a>';		
						
						$html .= '<div class="et_pb_section et_section_regular">';	
							$html .= '<div class="landing-row">';
								$html .= '<div class="et_pb_section et_section_regular">';
									$html .= '<div class=" et_pb_row">';
										$html .= '<div class="et_pb_column ' . $column_right . ' et-last-child">';
											$html .= '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left">';
												$html .= '<div class="et_pb_text_inner">';
												
													$html .= '<div class="columns">';
														$html .= '<div class="col1">';
															$html .= '<a href="' . $link . '">' . $thumbnail_image . '</a>';
														$html .= '</div>';
														
														$html .= '<div class="col2">';
															$html .= '<div class="columns-title">' . '<a href="' . $link . '">' .$title . '</a></div>';
															$html .= '<div class="columns-subtitle">' . $date . '</div>';
															$html .= '<div class="excerpt">' . $excerpt . '</div>';
															$html .= '<div class="readmore">' . $read_more . '</div>';
														$html .= '</div>';	
													$html .= '</div>';
																								
												$html .= '</div> <!-- .et_pb_text -->';
										$html .= '</div> <!-- .et_pb_column -->';
									$html .= '</div> <!-- .et_pb_row -->';	
								$html .= '</div> <!-- .et_pb_section -->';
							$html .= '</div>';
						$html .= '</div>';					

					}
				}
				
				$html .= '</div>';

				$html .= paginate_landing_rows ('taxonomy-landing-page');
									
		}
				
		echo $html;

	}

?>
