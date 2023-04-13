<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php
		
	function connectome_filters_function (){
						
		$html = '';

// echo 'debug ' . $_SESSION['debug'] . '<br>';
// echo '<pre>'; print_r($_SESSION['debug']); echo '</pre>';
				
		echo '<div id="response"></div>';

		if ($_GET['filter'] == 'Y') { 
			$html .= '<style>';
				$html .= '.filter-results {display:block !important;}';
				$html .= '.not-filter-results {display:none;}';
			$html .= '</style>'; 
		}

		$html .= '<a id="filter-by"><div class="search-type">FILTER BY:</div></a>';

		if ($_GET['reset'] == 'Y') :
			$results  = array();
			$research = '';
			$campus   = '';
			$role     = '';
			$text     = '';
			$ids      = array();
		else:
			global $wpdb;
			$sql = 'SELECT * FROM ' . 
					$wpdb->prefix  . 'filters ' .
					'WHERE SESSION = "' . session_id() . '" ' .
					'ORDER BY DATE DESC LIMIT 1';				
			$results = $wpdb->get_results($wpdb->prepare($sql), ARRAY_A);	
			$research 	= $results[0]['RESEARCH'];
			$campus 	= $results[0]['CAMPUS'];
			$role 		= $results[0]['ROLE'];
			$text 		= $results[0]['TEXT'];
			$ids 		= json_decode($results[0]['IDS']);
			$ids		= array_unique($ids);
		endif;
		
// echo 'research:		' . $research . '<br>';
// echo 'campus:		' . $campus . '<br>';
// echo 'role:			' . $role . '<br>';
// echo 'text:			' . $text . '<br>';
// foreach ($ids as $id) { echo 'id:			' . $id . '<br>'; }

		$html .= '<form id="filters">';
			$html .= '<input type="hidden" id="session" name="session" value="' . session_id() . '">';
		
			$html .= '<div id="filters-form">';
			
				$html .= '<div class="field-container">';
			
					$html .= '<div class="field">';
		
						$html .= '<div class="search-type">NEURO TOPICS</div>';
				    	$html .= '<div class="select">';
							$args = array(
								'post_type' 	=> 'neuro-topics',
								'posts_per_page'=>  -1,
								'post_status' 	=> 'publish',
								'order' 		=> 'ASC',
								'orderby' 		=> 'title'
							);	
							$query = new WP_Query( $args );
							if ($query->have_posts()) :
								$html .= '<select name="search-research" id="search-research" class="search-research">';
								$html .= '<option value="-1">Select a Neuro Topic</option>';
								while ( $query->have_posts() ) :
									$query->the_post();
									$post_id = get_the_id();
									$neuro_topic = get_the_title();									
									if (htmlspecialchars_decode($neuro_topic) == htmlspecialchars_decode($research)) {
										$html .= '<option value="' . $neuro_topic . '" selected>' . $neuro_topic . '</option>';
									} else {
										$html .= '<option value="' . $neuro_topic . '">' . $neuro_topic . '</option>';
									}
								endwhile;
								$html .= '</select>';
							endif;
						$html .= '</div>'; 
							 		
					$html .= '</div>';
					
					$html .= '<div class="field">';
		
						$html .= '<div class="search-type">CAMPUS</div>';
						$html .= '<div class="select">';
							$taxonomies=get_taxonomies('',''); 
							foreach($taxonomies as $taxonomy){
								if ($taxonomy->name == 'connectome_campuses') {
									$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
									$html .= '<select name="search-campuses" id="search-campuses" class="search-campuses">';
										$html .= '<option value="-1">Select a Campus</option>';
										foreach($terms as $term){
											if (htmlspecialchars_decode($term->name) == htmlspecialchars_decode($campus)) {
												$html .= '<option value="' . $term->name . '" selected>' . $term->name . '</option>';
											} else {
												$html .= '<option value="' . $term->name . '">' . $term->name . '</option>';
											}
										}
									$html .= '</select>';
								}
							}
						$html .= '</div>'; 
					
					$html .= '</div>';
					
					$html .= '<div class="field">';
	
						$html .= '<div class="search-type">ROLE</div>';
						$html .= '<div class="select">';
							$taxonomies=get_taxonomies('',''); 
							foreach($taxonomies as $taxonomy){
								if ($taxonomy->name == 'connectome_roles') {
									$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
									$html .= '<select name="search-role" id="search-role" class="search-role">';
										$html .= '<option value="-1">Select a Role</option>';
										foreach($terms as $term){
											if (htmlspecialchars_decode($term->name) == htmlspecialchars_decode($role)) {
												$html .= '<option value="' . $term->name . '" selected>' . $term->name . '</option>';
											} else {
												$html .= '<option value="' . $term->name . '">' . $term->name . '</option>';
											}
										}
									$html .= '</select>';
								}
							}
						$html .= '</div>'; 
					
					$html .= '</div>';
					
					$html .= '<div class="field">';
					
						$html .= '<div class="search-type">TEXT</div>';						
						$html .= '<div class="text-search">';					
							if ($text != "") {
								$html .= '<input type="text" id="search-text" name="search-text" value="' . $text . '">';
							} else {
								$html .= '<input type="text" id="search-text" name="search-text" placeholder="Enter text to search">';
							}
							$html .= '<div class="icon"><i class="fa fa-search"></i></div>';
						$html .= '</div>';
	
					$html .= '</div>';
				
				$html .= '</div>';
				
				$html .= '<div class="submit-container">';
				
					$html .= '<div class="field last">';
					
						$html .= '<div class="apply-filters">';
							$html .= '<div class="submit"><input type="submit" id="submit" name="submit" value="Apply Filters"></div>';
						$html .= '</div>';
						
					$html .= '</div>';
					
					$html .= '<div class="field">';
					
						$html .= '<div class="reset-filters">';
							$html .= '<div class="button"><input type="button" id="reset" name="reset" value="Reset Filters"></div>';
						$html .= '</div>';
						
					$html .= '</div>';
					
				$html .= '</div>';
	
			$html .= '</div>';

		$html .= '</form>';

		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		
		$html .= '<div class="filter-results et_pb_with_border et_pb_section et_pb_section_6 et_section_regular">';
			$html .= '<div id="connectome-search-results" class="et_pb_row et_pb_row_7 load-more">';

				if (count($ids) == 0) {

					$html .= '<div class="count">No results found.</div>';

				} else {

					$html .= '<div class="count">Displaying ' . count($ids) . '  search results below.</div>';

					foreach ($ids as $id) {			
						
						$permalink 	= get_permalink($id);
						$image 		= get_field('image',$id);
						$size 		= array("150","150");						
						$thumbnail 	= get_the_post_thumbnail_url ($id, $size);
						$image		= '<span class="et_pb_image_wrap">' . 
										  '<a ' . 'href="' . $permalink . '">' . 
											  '<img src="' . $thumbnail . '">' . 
										  '</a>' . 
									  '</span>';
						$name		= get_field('fname',$id) . ' ' . get_field('lname',$id);
						$job_title 	= get_field('job_title',$id);
						$lab 		= '<a href="' . get_field('lab_url',$id) . '">' . get_field('lab_name',$id) . '</a>';
						$title_lab 	= $job_title . ' / ' . $lab;
						$about_me = get_field('about_me',$id);
						if (strlen($about_me) > 0) { 
							$excerpt 	= substr(get_field('about_me',$id), 0, 300);
							$pos	    = strrpos($excerpt, " ");
							if ($pos>0) { $excerpt = substr($excerpt, 0, $pos); }
							$excerpt 	= $excerpt . '...';
						}
							
						$html .= connectome_display_row ($image, $name, $title_lab, $excerpt, $permalink);
						
					}
					$html .= paginate_landing_rows ('connectome-search-results');	
				}

			$html .= '</div>';
		$html .= '</div>';
		
		
		return $html;

	}

?>