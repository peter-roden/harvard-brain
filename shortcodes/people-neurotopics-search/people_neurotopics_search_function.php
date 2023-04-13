<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
		
	function people_neurotopics_search_function (){
				
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
				$terms = get_field('neuro_topics');
				if($terms){
					foreach( $terms as $term ) {
						$neurotopics_all[] = $term->post_title;
					}
				}
			}
		}
		
		$neurotopics = array_unique($neurotopics_all);
		sort($neurotopics);

		foreach ($neurotopics as $n) {
			$options .= '<option name="' . $n . '">' . $n . '</option>';
		}

		$html .= '<form>';
			$html .= '<div id="search-category">';
				$html .= '<div class="search-type">FILTER BY NEURO TOPICS</div>';
					$html .= '<select name="search-research-areas" id="search-research-areas" class="search-research-areas">';
						$html .= '<option value="-1">Select a Neuro Topic</option>';
						$html .= $options;
					$html .= '</select>';
				$html .= '</div>';
			$html .= '</form>';
		
		wp_reset_query();

		return $html;

	}
?>