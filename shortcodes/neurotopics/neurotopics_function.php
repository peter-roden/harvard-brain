<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function neurotopics_function ($atts){
		extract(shortcode_atts(array(
			'topic' => '',
			'tag' => ''
		), $atts));
				
		$html = '';


/*
echo 'topic: ' . $topic . '<br>';
echo 'tag:   ' . $tag . '<br>';
*/
		
		if (strlen($topic) > 0) {
			$args = array(
				'post_type' 	=> 'post',
				'posts_per_page'=>  -1,
				'post_status' 	=> 'publish',
				'meta_key'		=> 'publication_date',
				'orderby'		=> 'meta_value',
				'order'			=> 'DESC',
				'tax_query' => array(
					array(
					    'taxonomy' => 'neurotopics',
					    'field'    => 'name',
					    'terms'    => array($topic)
					)
				)
			);
		}
		if (strlen($tag) > 0) {
			$args = array(
				'post_type' 	=> 'post',
				'posts_per_page'=>  -1,
				'post_status' 	=> 'publish',
				'meta_key'		=> 'publication_date',
				'orderby'		=> 'meta_value',
				'order'			=> 'DESC',
				'tax_query' => array(
					array(
					    'taxonomy' => 'neurotopic_tags',
					    'field'    => 'name',
					    'terms'    => array($tag)
					)
				)
			);
		}		

echo '<pre>';
print_r($args);
echo '</pre>';

		
		$query = new WP_Query( $args );

		if ($query->have_posts()) {

			$count = 0;
			
			while ( $query->have_posts() ) {
				
			    $query->the_post();
											
				$link = get_field('link');
				if ($link) {
					$link = get_field('link') . '" target="_blank';
				} else {
					$link = get_post_permalink(get_the_id());
				}
						
				$image = get_field('thumbnail_image');					
				if( $image ) { $thumbnail_image = '<img src="' . $image . '" style="width:150px;height:150px">'; }

				$title = get_the_title();
				
				$date = get_field('publication_date',false,false);
				$date = new DateTime($date);
				$date = $date->format('F j, Y');
				
				$excerpt = get_field('excerpt');
				
				$read_more = '<a href="' . $link . '">READ MORE ></a>';	
				
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
				
			}
		}
		

		return $html;

	}

?>
