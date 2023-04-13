<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php
		
	function connectome_affiliation_search_function (){
						
		$html = '';

		$html .= '<form id="search-affiliation-form">';

			$html .= '<div id="search-affiliation-group">';

				$html .= '<div class="search-type">FILTER BY AFFILIATION</div>';
		
				$html .= '<div class="search-affiliation-container">';  

			    	$html .= '<div class="column">';
						$taxonomies=get_taxonomies('',''); 
						foreach($taxonomies as $taxonomy){
							if ($taxonomy->name == 'connectome_affiliations') {
								$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
								$html .= '<select name="search-affiliation" id="search-affiliation" class="search-affiliation">';
									$html .= '<option value="-1">Select an Affiliation</option>';
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