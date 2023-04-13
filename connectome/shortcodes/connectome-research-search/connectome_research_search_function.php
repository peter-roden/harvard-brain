<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php
		
	function connectome_research_search_function (){
						
		$html  			= '';

		$html .= '<form id="search-research-form">';

			$html .= '<div id="search-research-group">';

				$html .= '<div class="search-type">FILTER BY RESEARCH INTERESTS</div>';
		
				$html .= '<div class="search-research-container">';  

			    	$html .= '<div class="column">';
						$taxonomies=get_taxonomies('',''); 
						foreach($taxonomies as $taxonomy){
							if ($taxonomy->name == 'connectome_research_interests') {
								$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
								$html .= '<select name="search-research" id="search-research" class="search-research">';
									$html .= '<option value="-1">Select a Research Area</option>';
									foreach($terms as $term){
										$html .= '<option value="' . $term->name . '">' . $term->name . '</option>';
									}
								$html .= '</select>';
							}
						}
					$html .= '</div>';
				 
				$html .= '</div>'; 
					 		
			$html .= '</div>';

		$html .= '</form>';

		return $html;

	}

?>