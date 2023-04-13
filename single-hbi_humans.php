<?php 
	
	get_header(); 

	echo '<div id="main-content">';
		
		echo '<div class="container">';
		
			echo '<div id="content-area" class="clearfix">';

				while ( have_posts() ) : the_post();
											
					echo '<div class="breadcrumb" style="padding-bottom:30px">';
						echo '<a class="breadcrumb" href="'. site_url() . '">HOME</a> / <a class="breadcrumb" href="' . site_url() . '/hbi-for-everyone/">FOR EVERYONE</a> / <a class="breadcrumb" href="' . site_url() .'/humans-of-hbi/">Humans of HBI</a>';
					echo '</div>';

					
					$image = get_field('image-16x9');						
					if( $image ) { $image = '<a href="' . $link . '"><img src="' . $image . '"></a>'; }
					
					$title = get_the_title(); 
					$subtitle = get_field('program') . '<br>' . get_field('location');
					
					echo '<div class="image-title flex-box">';

						echo '<div class="two_third">';
							echo $image;
						echo '</div>';
	
						echo '<div class="one_third et_column_last">';
							echo '<a href="' . $link . '"><div class="title">' . $title . '</div></a>';
							echo '<a href="' . $link . '"><div class="subtitle">' . $subtitle . '</div></a>';
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
		
										echo '<div class="return">';
											echo '<a href="' . site_url() . '/humans-of-hbi/">RETURN TO HUMANS OF HBI</a>';
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