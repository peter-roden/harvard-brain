<?php 
	
	get_header(); 

	echo '<div id="main-content">';
		
		echo '<div class="container">';
		
			echo '<div id="content-area" class="clearfix">';

				while ( have_posts() ) : the_post();
											
					echo '<div class="breadcrumb" style="padding-bottom:30px">';
						echo '<a class="breadcrumb" href="'. site_url() . '">HOME</a> / <a class="breadcrumb" href="' . site_url() . '/hbi-for-everyone/">FOR EVERYONE</a> / <a class="breadcrumb" href="' . site_url() .'/hbi-staff/">HBI Staff</a>';
					echo '</div>';

					
					$image = get_field('image-16x9');						
					if( $image ) { $image = '<a href="' . $link . '"><img src="' . $image . '"></a>'; }
					
					$title = get_the_title(); 
					$subtitle = get_field('title');
					
					$contact1 = get_field('contact1');	
					if($contact1) {
						$address1 .= $contact1[address1] . '<br>';
						if ($contact1[address2]) { $address1 .= $contact1[address2] . '<br>'; }
						if ($contact1[address3]) { $address1 .= $contact1[address3] . '<br>'; }
						$address1 .= $contact1[city] . ', ' . $contact1[state] . ' ' . $contact1[zip] . '<br>';
						if ($contact1[email]) { 
							$address1 .= '<a href="mailto:' . $contact1[email] . '">' . $contact1[email] . '</a><br>';
						}
						if ($contact1[phone]) { 
							$address1 .= '<a href="tel:' . $contact1[phone] . '">' . 
											substr($contact1[phone],0,3) . '-' .
											substr($contact1[phone],3,3) . '-' .
											substr($contact1[phone],6,4) .
										'</a><br>';
						}
						$location = $contact1[map];
						if($location) {
							$address1 .= '<i class="fa fa-map-marker" aria-hidden="true"></i>' .
										'<a style="padding-left: 7px" href="https://www.google.com/maps/search/?api=1&query=' . 
											$location['lat'] . ','  . $location['lng'] . '" ' .
											'target="_blank">' .
											'View Map' .
										'</a>';
						}
				
					}
					$contact2 = get_field('contact2');	
					if($contact2[address1]) {
						$address2 .= '<br><br>' . $contact2[address1] . '<br>';
						if ($contact2[address2]) { $address2 .= $contact2[address2] . '<br>'; }
						if ($contact2[address3]) { $address2 .= $contact2[address3] . '<br>'; }
						$address2 .= $contact2[city] . ', ' . $contact2[state] . ' ' . $contact2[zip] . '<br>';
						if ($contact2[email]) { 
							$address2 .= '<a href="mailto:' . $contact2[email] . '">' . $contact2[email] . '</a><br>';
						}
						if ($contact2[phone]) { 
							$address2 .= '<a href="tel:' . $contact2[phone] . '">' . 
											substr($contact2[phone],0,3) . '-' .
											substr($contact2[phone],3,3) . '-' .
											substr($contact2[phone],6,4) .
										'</a><br>';
						}
						$location = $contact2[map];
						if($location) {
							$address2 .= '<i class="fa fa-map-marker" aria-hidden="true"></i>' .
										'<a  style="padding-left: 7px" href="https://www.google.com/maps/search/?api=1&query=' . 
											$location['lat'] . ','  . $location['lng'] . '" ' .
											'target="_blank">' .
											'View Map' .
										'</a>';
						}
				
					}
					
					
					echo '<div class="image-title flex-box">';

						echo '<div class="two_third">';
							echo $image;
						echo '</div>';
	
						echo '<div class="one_third et_column_last">';
							echo '<a href="' . $link . '"><div class="title">' . $title . '</div></a>';
							echo '<a href="' . $link . '"><div class="subtitle">' . $subtitle . '</div></a>';
							if($contact1) { echo $address1; }
							if($contact2[address1]) { echo $address2; }
						echo '</div><div class="clear"></div>';

					echo '</div>';
					

					echo '<div class="et_pb_section  et_section_regular">';
						echo '<div class=" et_pb_row et_pb_gutters1 et_pb_row_fullwidth">';
						
							echo '<div class="et_pb_column et_pb_css_mix_blend_mode_passthrough">';
								echo '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left">';
									echo '<div class="et_pb_text_inner">';
										
										echo '<div class="description">';
											echo get_field('description');
										echo '</div>';
		
										echo '<div class="return" style="padding-bottom:30px" >';
											echo '<a href="' . site_url() . '/hbi-staff/">RETURN TO HBI STAFF</a>';
										echo '</div>';										
													
									echo '</div> <!-- .et_pb_text_inner -->';
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