<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function connectome_display_publications_function () {
				
		$html = '';

		$args = array(
			'p'         => get_the_id(), 
			'post_type' => 'hbi_connectome'
		);		
		$the_query = new WP_Query($args);
		
		if( $the_query->have_posts() ) {
			while( $the_query->have_posts() ) {
				$the_query->the_post();

				if (have_rows('key_publications')) {
				    while (have_rows('key_publications')) {
					    the_row();
				        $html .= '<p>';
					        $html .= '<strong>' . get_sub_field('title') . '</strong><br>';
					        $html .= get_sub_field('authors') . '<br>';
					        $html .= '<em>' . get_sub_field('pmcid') . '</em><br>';
				        $html .= '</p>';
					}
				}	
			}
		}
		

		return $html;

	}
?>