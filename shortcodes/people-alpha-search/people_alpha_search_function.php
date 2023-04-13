<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function people_alpha_search_function (){
				
		$html  = '';
		$html .= '<form>';
		$html .= '<div id="search-alpha">';
		$html .= '<div class="search-type">FILTER ALPHABETICALLY</div>';

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
			$search = array();
			$i=-1;
			while( $the_query->have_posts() ) {
				$the_query->the_post(); 
				$first_letter = substr(get_field('search_name'),0,1);
				$i++;
				foreach (range('A', 'Z') as $letter){
				    if ($letter == $first_letter) {
					    $search[$i]['letter']  	= $letter;
					    $search[$i]['id']		= get_the_id();
				    }
				}
			}
		}
		
		$alpha_search = array();
		$a=-1;
		foreach (range('A', 'Z') as $letter) {
			$i=-1;
			$a++;
			$alpha_search[$a] = 0;
			while ($i <= count($search)) {			
				$i++;
				if ($search[$i]['letter'] === $letter ) { $alpha_search[$a] = 1; }
			}
		}
			
		$i=-1;
		foreach (range('A', 'Z') as $letter) {
			$i++;
			if ($alpha_search[$i] === 0) {
				$html .= '<div class="letter">' . $letter . '</div>';
			} else {
				$html .= '<div class="letter">' . '<button type="button" class="alphabet-' . $letter .'" value="' . $letter . '">' . $letter . '</button>' . '</div>';
			}		
		}
		$html .= '<div class="letter">' . '<button type="button" class="alphabet-ALL" value="ALL">ALL</button>' . '</div>';

		$html .= '</div>';
		$html .= '</form>';
		
		wp_reset_query();

		return $html;

	}
?>