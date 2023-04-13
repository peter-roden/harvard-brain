<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php
		
	function connectome_role_search_function (){
						
		$html = '';

		$html .= '<form id="search-role-form">';

			$html .= '<div id="search-role-group">';

				$html .= '<div class="search-type">FILTER BY ROLE</div>';
		
				$html .= '<div class="search-affiliation-container">';  

			    	$html .= '<div class="column">';
						$taxonomies=get_taxonomies('',''); 
						foreach($taxonomies as $taxonomy){
							if ($taxonomy->name == 'connectome_roles') {
								$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
								$html .= '<select name="search-role" id="search-role" class="search-role">';
									$html .= '<option value="-1">Select a Role</option>';
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