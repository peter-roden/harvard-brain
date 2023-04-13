<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
		
	function people_category_search_function (){
				
		$html  			= '';
		$options 		= '';

		$research_areas		= array();
		$research_areas_all	= array();
		
		$args = array(
			'post_type'			=> 'people',
			'posts_per_page'	=> -1,
			'post_status' 		=> 'publish'
		);
		
		$the_query = new WP_Query($args);
		
		if( $the_query->have_posts() ) {
			while( $the_query->have_posts() ) {
				$the_query->the_post(); 
				$terms = get_field('research_areas');
				if($terms){
					foreach( $terms as $term ) {
						$term_array = get_term_by('id', $term, 'research_areas');
						$research_areas_all[] = $term_array->name;
					}
				}
			}
		}
		
		$research_areas = array_unique($research_areas_all);
		sort($research_areas);

		foreach ($research_areas as $ra) {
			$options .= '<option name="' . $ra . '">' . $ra . '</option>';
		}

		$html .= '<form>';
			$html .= '<div id="search-category">';
				$html .= '<div class="search-type">FILTER BY RESEARCH AREA</div>';
					$html .= '<select name="search-research-areas" id="search-research-areas" class="search-research-areas">';
						$html .= '<option value="-1">Select a Research Area</option>';
						$html .= $options;
					$html .= '</select>';
				$html .= '</div>';
			$html .= '</form>';
		
		wp_reset_query();

		return $html;

	}
?>