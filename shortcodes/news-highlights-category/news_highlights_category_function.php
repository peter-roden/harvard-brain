<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function news_highlights_category_function ($atts){
		extract(shortcode_atts(array(
			'slug' => ''
		), $atts));
				
		$html = '';
		$check_back = TRUE;

		$args = array(
			'post_type' 	=> 'hbi_news',
			'posts_per_page'=>  -1,
			'post_status' 	=> 'publish',
			'meta_key'		=> 'publication_date',
			'orderby'		=> 'meta_value',
			'order'			=> 'DESC'
		);
		
		$query = new WP_Query( $args );

		if ($query->have_posts()) {

			$count = 0;
			
			while ( $query->have_posts() ) {
				
				$query->the_post();
				
				$featured = get_field ('featured');

				if ($featured != 'yes') {
				
					$categories	= get_field('news_types');
					
					if ($categories) {
						
						foreach( $categories as $term ) {
							
							if ($term->slug == $slug) {
								
								$count++;
								
								if ($count == 1) {
									
									$html .= '<div class="columns columns-first columns-heading" style="border:40%">';
										$html .= '<div class="col1" style="width:40%">';
											$html .= '<h4 class="category">' . $term->name . '</h4>';
										$html .= '</div>';
										$html .= '<div class="col2" style="width:40%">';
											$html .= '<h4 class="columns-right">' .' ' . '</a></h4>';
										$html .= '</div>';
	
									$html .= '</div>';
									
								}
							
								if ($slug == "awards-honors") { 
									$item_count = 2;
								} elseif ($slug == "in-the-news") {
									$item_count = 3;
								} elseif ($slug == "community-stories") {
									$item_count = 4;
								}
								
								if ($count <= $item_count) {
									
									$check_back = FALSE;
	
/*
									$link = get_field('link');
									if ($link) {
										$link = get_field('link') . '" target="_blank';
									} else {
										$link = get_post_permalink(get_the_id());
									}
*/
									if ($slug == 'community-stories') { $link = get_post_permalink(get_the_id()); }
									if ($slug == 'in-the-news') { 
										if (get_field('source_link')) {
											$link = get_field('source_link') . '" target="_blank'; 
										} else {
											$link = get_field('link') . '" target="_blank'; 
										}
									}
									if ($slug == 'awards-honors')   { $link = get_post_permalink(get_the_id()); }
											
									$image = get_field('thumbnail_image');					
									if( $image ) { $thumbnail_image = '<img src="' . $image . '" style="width:150px;height:150px">'; }
					
									$title = get_the_title();
									
									$date = get_field('publication_date',false,false);
									$date = new DateTime($date);
									$date = $date->format('F j, Y');
									
									$excerpt = get_field('excerpt');
									
									if (get_field('original_article')) { $original_article = 'Original article in: ' . '<a href="' . get_field('link') . '" target="_blank"><span>' . get_field('original_article') .' ></span></a>'; }
									
									$read_more = '<a href="' . $link . '">READ MORE ></a>';	
									
									$neuroscience_tags = get_field('neuroscience_tags');
									if ($neuroscience_tags) :
										$tags = '';
										foreach ($neuroscience_tags as $neuroscience_tag) : 
											$tag_post = get_post($neuroscience_tag);
											$title = get_the_title( $tag_post->ID );
											$tags .= '<a href="' . site_url() . '/hbi-news?type=tag&slug=' . $tag_post->post_name . '"><span>' . $title . '</span></a>';
										endforeach;
									endif; 
									
									 if ($count < $item_count) {
										$html .= '<div class="columns columns-first">';
									} else {
										$html .= '<div class="columns">';
									}
										
										$html .= '<div class="col1">';
											$html .= '<a href="' . $link . '">' . $thumbnail_image . '</a>';
										$html .= '</div>';
										
										$html .= '<div class="col2">';
											$html .= '<div class="columns-title">' . '<a href="' . $link . '">' .get_the_title() . '</a></div>';
											$html .= '<div class="columns-subtitle">' . $date . '</div>';
											$html .= '<div class="excerpt">' . $excerpt . '</div>';
											$html .= '<div class="original">' . $original_article . '</div>';
											$html .= '<div class="readmore">' . $read_more . '</div>';
											$html .= '<div class="columns"><div class="tags">' . $tags . '</div></div>';
										$html .= '</div>';	
									
									$html .= '</div>';
							
									if ($count == $item_count) {
										$html .= '<div class="columns columns-first columns-heading columns-news">';
											$html .= '<div class="col1">';
												$html .= '<h4>' . ' ' . '</h4>';
											$html .= '</div>';
											$html .= '<div class="col2">';
												$html .= '<h4 class="columns-right"><a href="' . 'http://brain.harvard.edu/news/news-types/?id=' . $term->term_id . '">SEE ALL ' . $term->name .'</a></h4>';
											$html .= '</div>';
										$html .= '</div>';									
									}
									
								}
	
							}
							
						}
					
					}

				}
				
			}
		
		}
		
		if ($check_back) { $html .= '<div style="margin-bottom: 30px;">Please check back later for future events.</div>'; }

		return $html;

	}

?>
