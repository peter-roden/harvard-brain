<?php 
	
	get_header(); 

	echo '<div id="main-content">';
		
		echo '<div class="container">';
		
			echo '<div id="content-area" class="clearfix">';

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
	
				while ( have_posts() ) : the_post();

					$terms = get_field('categories');
					if($terms){
						foreach( $terms as $term ) {
							$term_array = get_term_by('id', $term, 'event_categories');
							if (($term_array->slug != 'highlights') && ($term_array->slug != 'home')) { 
								$category = '<a class="breadcrumb" href="' . site_url() . '/event-categories/' . $term_array->slug . '/">' . $term_array->name . '</a>'; 
							}
						}
					}
					echo '<div class="breadcrumb">';
						echo '<a class="breadcrumb" href="'. site_url() . '">HOME</a> / <a class="breadcrumb" href="' . site_url() . '/hbi-for-everyone/">FOR EVERYONE</a> / <a class="breadcrumb" href="' . site_url() .'/hbi-events/">EVENTS</a>' . ' / ' . $category;
					echo '</div>';

					$image = get_field('thumbnail_image');					
					$hide_thumbnail = get_field('hide_thumbnail');	
					if( !$hide_thumbnail ) { $thumbnail = '<img src="' . $image . '">'; }

					$image = get_field('large_image');
					$size = 'full'; 						
					if($image) {
						$large_image = wp_get_attachment_image($image, $size);
					} 

					$categories = '';
					$event_types	= get_field('categories');
					if ($event_types) {
						$i = 0;
						foreach( $event_types as $term ) {
							$i++;
							$categories .= '<a class="breadcrumb" href="' . site_url() . '/hbi-events/event-types?id=' . $term->term_id . '">' . $term->name . '</a>, ';
						}
					}

					$event_date 	= get_field('event_date');
					$event_start 	= get_field('event_start');
					$event_end		= get_field('event_end');
					$event_day		= date("l", strtotime($event_date));
					$start 			= date('Y-m-d H:i:s', strtotime("$event_date $event_start"));
					$end		 	= date('Y-m-d H:i:s', strtotime("$event_date $event_end"));

					$location_title = 'Location';
					$terms = get_field('location');
					if($terms){
						foreach( $terms as $term ) {
							$term_array 	= get_term_by('id', $term, 'locations');
							$location 		= $term_array->name .'<br>' . get_field('address','locations' . '_'.$term_array->term_id);
							$ics_location 	= $term_array->name;
							$map 			= get_field('map','locations' . '_'.$term_array->term_id);
						}
					}

					$display_map = get_field('display_map');
							
					$contact_title = 'Contact';
					$contact = get_field('contact');
										
					$contact_name  = $contact['contact_name'];
					$contact_email = $contact['contact_email'];	
					$contact_phone = $contact['contact_phone'];							

					$contact_filled = TRUE;
					if (empty($contact_name) && empty($contact_email) && empty($contact_phone)) {
						$contact_filled = FALSE;
					}
		
					$register_link = get_field('reservation_link');	

					echo '<div class="et_pb_section  et_section_regular">';
						echo '<div class=" et_pb_row et_pb_gutters1 et_pb_row_fullwidth content-container">';
						
							echo '<div class="et_pb_column et_pb_column_2_3  et_pb_css_mix_blend_mode_passthrough">';
								echo '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left">';
									echo '<div class="et_pb_text_inner">';
													
										echo '<div class="no-hero-banner">';											

										if ($large_image) {
											echo '<div class="title">';
												echo the_title();
											echo '</div>';								
											echo '<div class="large-image-news">';
												echo $large_image;
											echo '</div>';
											echo '<div class="description">';
												echo get_field('description');
											echo '</div>';
											if (get_field('video')) :
												the_field('video');
											endif;	
										} elseif (!$hide_thumbnail) {
											echo '<div class="no-large-image">';
												echo '<div class="thumbnail">';
													echo $thumbnail;
												echo '</div>';
												echo '<div class="text">';
													echo '<div class="title">';
														echo the_title();
													echo '</div>';
													echo '<div class="description">';
														echo get_field('description');
													echo '</div>';	
													if (get_field('video')) :
														the_field('video');
													endif;	
												echo '</div>';	
											echo '</div>';							
										} else {
											echo '<div class="no-large-image">';
												echo '<div class="text">';
													echo '<div class="title">';
														echo the_title();
													echo '</div>';
													echo '<div class="description">';
														echo get_field('description');
													echo '</div>';	
													if (get_field('video')) :
														the_field('video');
													endif;	
												echo '</div>';	
											echo '</div>';												
										}

										echo '<div class="categories">';
											echo '<p>Event Types:&nbsp;&nbsp;' . substr($categories, 0, -2) . '</p>';
										echo '</div>';	
													
											echo '<div class="social-row">';
												echo '<div class="social-column-left">';
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

											
											echo '<div class="social-column-right">';
												echo '<div title="Add to Calendar" class="addeventatc">';
													echo 'Add to Calendar';
													echo '<span class="start">' . $start .'</span>';
													echo '<span class="end">' . $end . '</span>';
													echo '<span class="timezone">America/New_York</span>';
													echo '<span class="title">' . get_the_title() . '</span>';
													echo '<span class="description">' . get_field('excerpt') . '</span>';
													echo '<span class="location">' . $ics_location . '</span>';
												echo '</div>';
											echo '</div>';
											
										echo '</div>';
											
										if ($display_map == 'yes') {
											echo '<div class="acf-map">';
												echo '<div class="marker" data-lat="' . $map['lat'] . '" data-lng="' . $map['lng'] .'"></div>';
											echo '</div>';
										}
											
									echo '</div>';

									echo '</div>';
								echo '</div> <!-- .et_pb_text -->';
							echo '</div> <!-- .et_pb_column -->';
							
							echo '<div class="et_pb_column et_pb_column_1_3  et_pb_css_mix_blend_mode_passthrough et-last-child">';
								echo '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left ">';
									echo '<div class="et_pb_text_inner">';
									
										echo '<div class="sidebar">';
										
											echo '<div class="title">';
												echo $event_day . '<br>';
												echo $event_date;
												echo '<div class="times">';
													echo $event_start . ' - ' . $event_end;
												echo '</div>';
											echo '</div>';

											echo '<div class="label">';
												echo 'Location';
											echo '</div>';
											echo '<div class="item">';
												echo $location;
											echo '</div>';
										
											if ($contact_filled) {
												echo '<div class="label">';
													echo 'Contact';
												echo '</div>';
												echo '<div class="item">';
													if ($contact_email) {
														echo '<a href="mailto:' . $contact_email . '">' . $contact_name . '</a><br>';
													} else {
														echo $contact_name . '<br>';
													}
													if ($contact_phone) {
														echo '<a href="tel:' . $contact_phone . '">' . $contact_phone . '</a>';
													}
												echo '</div>';
											}
										
											if ($register_link) {
												echo '<div class="label">';
													echo 'Register';
												echo '</div>';
												echo '<div class="item">';
													echo '<a class="register" href="' . $register_link . '" target="_blank">Event Registration</a>';
												echo '</div>';
											}

										echo '</div>';

									echo '</div>';
								echo '</div> <!-- .et_pb_text -->';
							echo '</div> <!-- .et_pb_column -->';
						
						
						echo '</div> <!-- .et_pb_row -->';
					echo '</div> <!-- .et_pb_section -->';

				endwhile;			
			
			echo '</div> <!-- #content-area -->';
		
		echo '</div> <!-- .container -->';
	
	echo '</div> <!-- #main-content -->';

	get_footer(); 

?>
