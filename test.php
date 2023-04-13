<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
/**
* Template Name: Neuro Science Tags - TEST
*/
// $terms = get_terms([
// 	'taxonomy' => 'neurotopic_tags',
// 	'hide_empty' => false,
// ]);
// 
// foreach ($terms as $term) :
// 	echo $term->slug." : ";
// 	echo $term->name;
// 	$post_data = array(
// 		'post_title' 	=> $term->name,
// 		'post_type' 	=> 'neuroscience_tags',
// 		'post_name' 	=> $term->slug,
// 		'post_status'   => 'publish'
// 	);
// 	$post_id = wp_insert_post( $post_data );
// 	echo "<br>";
// endforeach;
		
// $args = array(
// 	'post_type' 	=> 'hbi_connectome',
// 	'posts_per_page'=>  -1,
// 	'post_status' 	=> 'publish'
// );	
// $query = new WP_Query( $args );
// if ($query->have_posts()) :
// 	while ( $query->have_posts() ) :
// 		$query->the_post();
// 		$post_id = get_the_id();
// 		$terms   = get_field('research_interests',$post_id);
// 		echo get_the_title($post_id) . '<br>';
// 		if ($terms): 					
// 			$neuro_topics_array = array();
// 			foreach ($terms as $term) :
// 				$t = get_term_by('id', $term->term_id, 'connectome_research_interests');
// 				$t_name_old = str_replace('&', 'and', htmlspecialchars_decode($t->name));				
// 				$t_name = '';
// 				switch ($t_name_old) {
// 					case 'Cellular and Molecular':
// 						$t_name = 'Cellular and Molecular Neuroscience';
// 						break;
// 					case 'Cognitive Neuroscience':
// 						$t_name = 'Cognitive and Behavioral Neuroscience';
// 						break;
// 					case 'Developmental Neuroscience':
// 						$t_name = 'Developmental Neuroscience';
// 						break;
// 					case 'Mental Health and Illness':
// 						$t_name = 'Mental Health and Illness';
// 						break;
// 					case 'Neurodegenerative Disease':
// 						$t_name = 'Neurodegenerative Disease';
// 						break;
// 					case 'Neurodevelopmental Disorders':
// 						$t_name = 'Neurodevelopmental Disorders';
// 						break;
// 					case 'Sensory and Motor Systems':
// 						$t_name = 'Sensory and Motor Systems';
// 						break;
// 					case 'Theoretical and Computational Neuroscience':
// 						$t_name = 'Theory and Computation';
// 						break;
// 					case 'Tools and Technology':
// 						$t_name = 'Tools and Technology';
// 						break;
// 				}
// 				
// 				$neuro_topics_args = array(
// 					'post_type' 	=> 'neuro-topics',
// 					'posts_per_page'=>  -1,
// 					'post_status' 	=> 'publish'
// 				);	
// 				$neuro_topics_query = new WP_Query( $neuro_topics_args );
// 				if ($neuro_topics_query->have_posts()) :
// 					while ( $neuro_topics_query->have_posts() ) :
// 						$neuro_topics_query->the_post();
// 						$neuro_topics_title = get_the_title(get_the_id($neuro_topics_query->ID));
// 						if ($neuro_topics_title == $t_name) :
// 							array_push ($neuro_topics_array, get_the_id($neuro_topics_query->ID));
// 						endif;
// 					endwhile;
// 				endif;
//  			endforeach;
// 		endif;	
// 		$neuro_topics_array = array_unique($neuro_topics_array);
// 		echo '<pre>';print_r($neuro_topics_array);echo '</pre>';
// 	update_field ('neuro_topics', $neuro_topics_array, $post_id);
// endwhile;
// endif;

// $args = array(
// 	'post_type' 	=> 'hbi_neuro_topic_tags',
// 	'posts_per_page'=>  -1,
// 	'post_status' 	=> 'publish'
// );		
// $query = new WP_Query( $args );
// if ($query->have_posts()) :
// 	while ( $query->have_posts() ) :
// 		$query->the_post();
// 		$science_args = array (			
// 			'post_type' 	=> 'neuroscience_tags',
// 			'post_status' 	=> 'publish',
// 			'post_title'	=> get_the_title(),
// 			'post_name'		=> $query->post_name
// 		);
// 		echo get_the_title() . ' : ' . $query->post_name . '<br>';
// 		wp_insert_post($science_args);
// 	endwhile;
// endif;
	
	global $wp;
	$url = home_url( add_query_arg( array(), $wp->request ) );
  	$key = 'hbi-staging';
  	if (strpos($url, $key) != false) :	  
		echo 'hello';
  	endif;

?>		