<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function connectome_top_buttons_function ($atts){
		extract(shortcode_atts(array(
			'b1_label' => '',
			'b1_link' => '',
			'b2_label' => '',
			'b2_link' => '',
			'b3_label' => '',
			'b3_link' => '',
		), $atts));
	
		$html = '';
				
		$html .= '<div id="connectome-top-buttons">';
			if ($b1_label) { $html .= '<a id="b1" href="' . $b1_link . '">' . $b1_label . '</a>'; }
			if ($b2_label) { $html .= '<a id="b2" href="' . $b2_link . '">' . $b2_label . '</a>'; }
			if ($b3_label) { $html .= '<a id="b3" href="' . $b3_link . '">' . $b3_label . '</a>'; }
		$html .= '</div>';
		
		return $html;

	}
?>
