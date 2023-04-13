<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function connectome_display_name_degrees_function () {
				
		$html = '';

		$args = array(
			'p'         => get_the_id(), 
			'post_type' => 'hbi_connectome'
		);		
		$the_query = new WP_Query($args);
		
		if( $the_query->have_posts() ) {
			while( $the_query->have_posts() ) {
				$the_query->the_post();
				$html .= '<h2>' . get_the_title() . ', ' . get_field('degrees') . '</h2>';
			}
		}
		
		return $html;

	}
?>