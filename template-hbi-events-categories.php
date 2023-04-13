<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
/**
* Template Name: HBI Events Categories
*/	
	get_header(); 

	$type = $_GET['type'];
	$slug = $_GET['slug'];

	echo '<div id="main-content">';
		
		echo '<div class="container" style="width:100%">';
		
			echo '<div id="content-area" class="clearfix">';

				echo '<div class="neurotopics-landing">';
	

					echo '<div class="et_pb_section  et_section_regular">';

						echo '<div class="et_pb_row et_pb_row_0 row">';						

						
							echo '<div class="et_pb_column et_pb_column_3_4 et_pb_css_mix_blend_mode_passthrough">';
								echo '<div class="et_pb_module et_pb_text et_pb_text_align_left">';
									echo '<div class="et_pb_text_inner">';


										if ($type == 'tag') {
											$terms = get_terms( array(
												'taxonomy' => 'event_categories',
												'hide_empty' => false,
											));
											foreach ($terms as $term) {
												if ($term->slug == $slug) {
													$page_name = $term->name;
												}
											}
										}
										
										echo '<div class="breadcrumb">';
											echo '<a class="breadcrumb" href="'. site_url() . '">HOME</a> / <a class="breadcrumb" href="' . site_url() . '/hbi-for-everyone/">FOR EVERYONE</a> / ' . '<a class="breadcrumb" href="' . site_url() . '/events/">EVENTS</a>';
										echo '</div>';
										
										
										echo '<div class="label">';
											echo 'Events - ' . $page_name;
										echo '</div>';	

									echo '</div>';
								echo '</div>'; 
							echo '</div>';

						echo '</div>';
					echo '</div>';
	
					$today = current_time('Ymd');
					$args = array(
						'post_type' 	=> 'hbi_events',
						'posts_per_page'=> -1,
						'post_status' 	=> 'publish',
						'meta_query' => array(
							 array(
								'key'		=> 'event_date',
								'compare'	=> '>=',
								'value'		=> $today
							)),
						'meta_key'			=> 'event_date',
						'orderby'			=> 'meta_value',
						'order'				=> 'ASC'
					);
							
					$query = new WP_Query( $args );
				
					if ($query->have_posts()) {
									
						while ( $query->have_posts() ) {
						
							$query->the_post();	    
		
							$found = FALSE;
							
							if ($type == 'tag') {
								$categories = get_field('categories');
								if ($categories) :
									foreach ($categories as $category) : 
										if ($category->slug == $slug) { $found = TRUE; }
									endforeach;
								endif; 
							}
/*
	
	
	echo 'found: '  . $found . '<br>';
	echo 'slug: '  . $slug . '<br>';
	echo 'get_field("neurotopic"): ' . get_field('neurotopic') . '<br>';
	
	
*/
		
							if ($found) {
							
								echo '<div class="event-landing">';
							
									$link = get_field('link');
									if ($link) {
										$link = get_field('link') . '" target="_blank';
									} else {
										$link = get_post_permalink($id);
									}
											
									$image = get_field('thumbnail_image');					
									if( $image ) { $featured_image = '<img src="' . $image . '">'; }
									
									$title = get_the_title();
								
									$subtitle = get_field('event_date') . ' from ' . get_field('event_start') . ' to ' . get_field('event_end');
									
									$terms = get_field('location');
									if($terms){
										foreach( $terms as $term ) {
											$term_array = get_term_by('id', $term, 'locations');
											$location 	= $term_array->name .'<br>' . get_field('address','locations' . '_'.$term_array->term_id);
										}
									}
									$excerpt =  get_field('excerpt') . 
												'<div class="location">' . $location . '</div>';
									$categories = get_field('categories');
									if ($categories) :
										$tags = '';
										foreach ($categories as $category) : 
											$tags .= '<a href="' . site_url() . '/hbi-events-categories?type=tag&slug=' . $category->slug . '"><span>' . $category->name . '</span></a>';
										endforeach;
									endif; 
									$read_more = '<a href="' . $link . '">REGISTER AND LEARN MORE ></a>';	
									
									echo '<div class="col1">';
										echo '<a href=" ' . $link . '">' . $featured_image . '</a>';
									echo '</div>';
									
									echo '<div class="col2">';
										echo '<div class="title">' . '<a href=" ' . $link . '">' . $title . '</a></div>';
										echo '<div class="subtitle">' . $subtitle . '</div>';
										echo '<div class="excerpt">' . $excerpt . '</div>';
										echo '<div class="readmore">' . $read_more . '</div>';
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