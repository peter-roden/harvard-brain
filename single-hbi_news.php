<?php 
	
	get_header(); 

	echo '<div id="main-content">';
		
		echo '<div class="container">';
		
			echo '<div id="content-area" class="clearfix">';

				while ( have_posts() ) : the_post();

					$image = get_field('banner_image');					
					if( $image ) {
						$banner_image = $image;
						echo '<div class="et_pb_section banner et_pb_section_0 et_section_regular">';
							echo '<div class="row et_pb_row et_pb_row_0">';
								echo '<div class="et_pb_column et_pb_column_4_4  et_pb_column_0 et_pb_css_mix_blend_mode_passthrough et-last-child">';
									echo '<div class="et_pb_module et_pb_image et_pb_image_0 et_always_center_on_mobile">';
										echo '<span class="et_pb_image_wrap">' . '<img src="' . $banner_image . '">' . '</span>';
									echo '</div>';
								echo '</div>'; // et_pb_column 				
							echo '</div>'; // .et_pb_row				
						echo '</div>'; // .et_pb_section 
					} 
											
					echo '<div class="breadcrumb">';
						echo '<a class="breadcrumb" href="'. site_url() . '">HOME</a> / <a class="breadcrumb" href="' . site_url() . '/hbi-for-everyone/">FOR EVERYONE</a> / <a class="breadcrumb" href="' . site_url() .'/news/">NEWS</a>';
					echo '</div>';

					
					$image = get_field('thumbnail_image');					
					$hide_thumbnail = get_field('hide_thumbnail');	
					if( !$hide_thumbnail ) { $thumbnail = '<img src="' . $image . '">'; }

					$image = get_field('large_image');
					$size = 'full'; 						
					if($image) {
						$large_image = wp_get_attachment_image($image, $size);
					} 

					$date = get_field('publication_date',false,false);
					$date = strtotime($date);
					$date = date("F j, Y", $date);
					
					$description = get_field('description');;
					$link = get_field('link');
					
					if ($large_image) {
						echo '<div class="title">';
							echo the_title();
						echo '</div>';																
					} 
					
					$categories = '';
					$news_types	= get_field('news_types');
					if ($news_types) {
						$i = 0;
						foreach( $news_types as $term ) {
							$i++;
							$categories .= '<a class="breadcrumb" href="' . site_url() . '/news/news-types?id=' . $term->term_id . '">' . $term->name . '</a>, ';
						}
					}

					echo '<div class="et_pb_section  et_section_regular">';
						echo '<div class=" et_pb_row et_pb_gutters1 et_pb_row_fullwidth">';
						
							echo '<div class="et_pb_column et_pb_css_mix_blend_mode_passthrough">';
								echo '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left">';
									echo '<div class="et_pb_text_inner">';
													
										if ($large_image) {							
											echo '<div class="large-image-news">';
												echo $large_image;
											echo '</div>';
										} elseif (!$hide_thumbnail) {
											echo '<div class="no-large-image">';
												echo '<div class="thumbnail">';
													echo $thumbnail;
												echo '</div>';
												echo '<div class="text">';
													echo '<div class="title">';
														echo the_title();
													echo '</div>';				
											echo '</div>';							
										} else {
											echo '<div class="no-large-image">';
												echo '<div class="text">';
													echo '<div class="title">';
														echo the_title();
													echo '</div>';				
											echo '</div>';												
										}

										echo '<div class="description">';
											echo get_field('description');
										echo '</div>';	
										
										echo '<div class="categories">';
											echo '<p>News Types:&nbsp;&nbsp;' . substr($categories, 0, -2) . '</p>';
										echo '</div>';
											
											echo '<div class="social-row">';													
												echo '<table class="social">';
													echo '<tr>';
														echo '<td style="width:80px;padding:0px;color:#000000;vertical-align:top;padding-top:15px;">';
															echo 'Share with: ';
														echo '</td>';
														echo '<td>';
															echo '<a  class="twitter" href="http://twitter.com/share?url=' . get_the_permalink() . '"target="_blank"></a>';
														echo '</td>';
														echo '<td>';
															echo '<a  class="email" href="mailto:?subject=' . htmlspecialchars(get_the_title()) . '&body=' . get_the_permalink() .'" target="_blank"></a>';
														echo '</td>';
														echo '<td>';
															echo '<a  class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink() . '" target="_blank"></a>';
														echo '</td>';
													echo '</tr>';
												echo '</table>';									
											echo '</div>';
										echo '</div>';									

									echo '</div>';
								echo '</div> <!-- .et_pb_text -->';
							echo '</div> <!-- .et_pb_column -->';						
						
						echo '</div> <!-- .et_pb_row -->';
					echo '</div> <!-- .et_pb_section -->';
					
			endwhile; 
		?>			
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>