<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function people_search_all_function (){
		
		$args = array(
			'post_type'			=> 'people',
			'posts_per_page'	=> -1,
			'post_status' 		=> 'publish',
			'meta_key'			=> 'search_name',
			'orderby'			=> 'meta_value',
			'order'				=> 'ASC'
		);
		
		$the_query = new WP_Query($args);
	
		if( $the_query->have_posts() ) {
			while( $the_query->have_posts() ) {
				$the_query->the_post(); 
							
				$html .= '<div id="people-search-all">';

				$type = 'people';
				
				$columns = 5;

				$link = get_the_permalink ();
							
				$image = get_field('headshot');
				$size = 'thumbnail'; 						
				if($image) { $thumbnail = wp_get_attachment_image( $image, $size ); }

				$rows = get_field('degrees');
				$c = count($rows);							
				if ($c == 0) {
					$degrees = '';
				} else {
					$degrees = ', ';
				}
				$n = 0;
				if($rows) {
					foreach($rows as $row) {
						$n++;
						if ($n == $c) {
							$degrees .= $row['degree'];
						} else {
							$degrees .= $row['degree'] . ', ';
						}
					}
				}
				$title = get_the_title() . $degrees;
				
				$subtitle = get_field('research_interests_title');
				
				$excerpt = get_field('research_interests_excerpt') . '...';
				
				$website = '';
				$rows = get_field('websites');
				if($rows) {
				$website = 	'<a ' . 'href="' . $rows[0]['website_link'] . 
					'" target="_blank">' .
					$rows[0]['website_name'] . ' >' .
				'</a>';
				}
				$left_footer = $website;
				
				$read_more = 'READ MORE >';					
				
				$html .= display_landing_row ($type, $columns, $link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more);

			}
			
			echo '</div>';

			echo '<script>';
				echo 'jQuery(document).ready(function( $ ) {';
						
/*
					echo "$('#people-search-all').easyPaginate({";
					    echo "paginateElement: 'div.landing-row',";
					    echo "elementsPerPage: 10,";
					    echo "effect: 'climb',";
					    echo "firstButtonText: 'FIRST',";
					    echo "lastButtonText: 'LAST',";
					    echo "prevButtonText: 'PREV',";
					    echo "nextButtonText: 'NEXT'";
					echo "});";
					echo "$('.easyPaginateNav a').on('click', function() {";
						echo "$('html, body').animate({";
						    echo 'scrollTop: $("#people-search-results").offset().top}, 1000);';
					echo "})";
*/

					echo "$('#people-search-all').simpleLoadMore({";
					  echo "item: '.landing-row',";
					  echo "count: 5,";
					  echo "itemsToLoad: 5,";
					  $btnHTML = '<div class="load-more-div"><a href="#" class="load-more__btn">View More</i></a></div>';
					  echo "btnHTML: " . "'" . $btnHTML . "'";
					echo "});";



				echo '});';
			echo '</script>';
		}
		
		wp_reset_query();

	return $html;

	}
?>