<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function connectome_count_function () {	
		
		$html = '';
		
		
		$args = array(
			'post_type' 	=> 'hbi_connectome',
			'posts_per_page'=> -1,
			'post_status' 	=> 'publish'
		);		
		$query = new WP_Query( $args );
		$count = $query->post_count;
		
		$html .= '<div class="connectome-count">';
			$html .= 'CONNECTOME MEMBERSHIP: ' . $count;
		$html .= '</div>';
		
		return $html;

	}
?>
