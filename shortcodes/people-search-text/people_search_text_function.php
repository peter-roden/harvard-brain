<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function people_search_text_function (){
				
		$html = '';
		
		$html .= '<form id="search-text">';
			$html .= '<div id="search-text">';
				$html .= '<div class="search-type">FILTER BY SEARCH TERM</div>';
				$html .= '<table>';
					$html .= '<tr>';
						$html .= '<td class="input"><input type="text" id="search-term" name="search-term"></td>';
						$html .= '<td class="button"><button type="submit"><i class="fa fa-search"></i></button></td>';
					$html .= '</tr>';
				$html .= '</table>';
			$html .= '</div>';
		$html .= '</form>';
		

		return $html;

	}
?>