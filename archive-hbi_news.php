<?php 
	
	get_header(); 

	$type = $_GET['type'];
	$slug = $_GET['slug'];

	echo '<div id="main-content">';
		
		echo '<div class="container">';
		
			echo '<div id="content-area" class="clearfix">';

				echo '<div class="neurotopics-landing">';
	

					echo '<div class="et_pb_section  et_section_regular">';

						echo '<div class="et_pb_row et_pb_row_0 row">';						


							if ($type == 'topic') {
								echo '<div class="et_pb_column et_pb_column_4_4 et_pb_column_0  et_pb_css_mix_blend_mode_passthrough banner-row et-last-child">';
									echo '<div class="et_pb_module et_pb_image et_pb_image_0">';
										echo '<span class="et_pb_image_wrap "><img src="https://brain.harvard.edu/wp-content/uploads/neurotopics-banner-' . $slug . '.jpg" alt="" title="" srcset="https://brain.harvard.edu/wp-content/uploads/neurotopics-banner-' . $slug . '.jpg 980w, https://brain.harvard.edu/wp-content/uploads/neurotopics-banner-' . $slug . '.jpg 480w" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) 980px, 100vw"></span>';
									echo '</div>';
								echo '</div>';							
							}
						
							echo '<div class="et_pb_column et_pb_column_3_4 et_pb_css_mix_blend_mode_passthrough">';
								echo '<div class="et_pb_module et_pb_text et_pb_text_align_left">';
									echo '<div class="et_pb_text_inner">';

										if ($type == 'topic') {	
											$neuro_topics_args = array(
												'post_type' 	=> 'neuro-topics',
												'posts_per_page'=>  -1,
												'post_status' 	=> 'publish'
											);	
											$neuro_topics_query = new WP_Query( $neuro_topics_args );
											if ($neuro_topics_query->have_posts()) :
												while ( $neuro_topics_query->have_posts() ) :
													$neuro_topics_query->the_post();
													if (get_post_field( 'post_name', $neuro_topics_query->ID) == $slug) { 
														$page_name = get_the_title($neuro_topics_query->ID);
													}	
												endwhile;
											endif;
										}
										if ($type == 'tag') {
											$args = array(
											  'name'        => $slug,
											  'post_type'   => 'neuroscience_tags',
											  'post_status' => 'publish',
											  'numberposts' => 1
											);
											$query = new WP_Query($args);
											if ($query->have_posts()) {
												while($query->have_posts()) {
													$query->the_post();
													$page_name = get_the_title();
												}
											}
										}
										
										echo '<div class="breadcrumb">';
											echo '<a class="breadcrumb" href="'. site_url() . '">HOME</a> / <a class="breadcrumb" href="' . site_url() . '/neurotopics/">NEURO TOPICS</a> / ' . '<span class="breadcrumb-current">' . $page_name . '</span>';
										echo '</div>';
										
										echo '<div class="label">';
											echo 'Neuro Topics - ' . $page_name;
										echo '</div>';	

									echo '</div>';
								echo '</div>'; 
							echo '</div>';

							echo '<div class="et_pb_column et_pb_column_1_4 et_pb_css_mix_blend_mode_passthrough et-last-child">';
								echo '<div class="et_pb_module et_pb_text et_pb_text_align_right ">';
									echo '<div class="et_pb_text_inner">';
										
										echo '<div class="search-label">';
											echo 'SEARCH OTHER RESEARCH AREAS';
										echo '</div>';

										echo '<div id="neuro-search" class="fwidget et_pb_widget widget_search">';
											echo '<form role="search" id="searchform" method="get" class="search-form" action="http://brain.harvard.edu/">';
												echo '<input type="search" class="search-field" value="" name="s">';
												echo '<input type="hidden" name="search-type" value="neuro" />';
												echo '<input type="hidden" name="post_type" value="hbi_news">';
												echo '<input type="submit" id="searchsubmit" class="search-submit" value="">';
											echo '</form>';
										echo '</div>';
										
								echo '</div>';
							echo '</div>';

						echo '</div>';
					echo '</div>';
	
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
									
						while ( $query->have_posts() ) {
						
							$query->the_post();	    
		
							$found = FALSE;
							if ($type == 'topic') {	
								$neuro_topics = get_field('neuro-topics');
								if ($neuro_topics) :
									foreach ($neuro_topics as $neuro_topic) : 
										if (get_post_field( 'post_name', $neuro_topic) == $slug) { $found = TRUE; }
									endforeach;
								endif; 										
							}							
							if ($type == 'tag') {
								$neuroscience_tags = get_field('neuroscience_tags');
								if ($neuroscience_tags) :
									foreach ($neuroscience_tags as $neuroscience_tag) : 
										$tag_post = get_post($neuroscience_tag);
										if ($tag_post->post_name == $slug) { $found = TRUE; }
									endforeach;
								endif; 
							}

							if ($found) {
							
								$link = get_post_permalink(get_the_id());
										
								$image = get_field('thumbnail_image');					
								if( $image ) { $thumbnail_image = '<img src="' . $image . '" style="width:150px;height:150px">'; }
				
								$title = get_the_title();
								
								$date = get_field('publication_date',false,false);
								$date = new DateTime($date);
								$date = $date->format('F j, Y');
								
// 								if (get_field('lab_name')) { $lab = 'From the lab of ' . get_field('lab_name'); }
								
								$excerpt = get_field('excerpt');
								
								if (get_field('original_article')) { $original_article = 'Original article in: ' . '<a href="' . get_field('link') . '" target="_blank"><span>' . get_field('original_article') .' ></span></a>'; }
								
								$neuroscience_tags = get_field('neuroscience_tags');
								if ($neuroscience_tags) :
									$tags = '';
									foreach ($neuroscience_tags as $neuroscience_tag) : 
										$tag_post = get_post($neuroscience_tag);
										$title = get_the_title( $tag_post->ID );
										$tags .= '<a href="' . site_url() . '/hbi-news?type=tag&slug=' . $tag_post->post_name . '"><span>' . $title . '</span></a>';
									endforeach;
								endif; 
								
								echo '<div class="columns">';								
									
									echo '<div class="col1">';
										echo '<a href="' . $link . '">' . $thumbnail_image . '</a>';
									echo '</div>';
									
									echo '<div class="col2">';
										echo '<div class="columns-title">' . '<a href="' . $link . '">' .get_the_title() . '</a></div>';
										echo '<div class="columns-title">' . $date . '<br>' . $lab . '</div>';
										echo '<div class="excerpt">' . $excerpt . '</div>';
										echo '<div class="original">' . $original_article . '</div>';
										echo '<div class="tags">' . $tags . '</div>';
									echo '</div>';	
								
								echo '</div>';
		
							}
						
						}
					}
			?>			
			</div> <!-- .neurotopics-landing -->		
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>