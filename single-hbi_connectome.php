<?php 

get_header(); 

$id_searches = get_posts( array(
	'post_type'			=> 'hbi_connectome',
	'posts_per_page'	=> -1,
	'post_status' 		=> array('publish', 'pending')         
));
foreach ( $id_searches as $id_search ) {
	if (get_field('email',$id_search->ID) == $_SESSION['login']) {
		$_SESSION['profile'] = $id_search->ID;
	}
}

echo '<div id="main-content">';
	
	echo '<div class="container">';
	
		echo '<div id="content-area" class="clearfix">';
?>

	<div class="et_pb_section et_pb_section_0 et_section_regular">
		<div class="et_pb_row et_pb_row_0">
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_0  et_pb_css_mix_blend_mode_passthrough et-last-child">
			<div class="et_pb_module et_pb_image et_pb_image_0">
					<span class="et_pb_image_wrap ">
						<img loading="lazy" src="https://brain.harvard.edu/wp-content/uploads/connectome-banner.png" alt="" title="connectome-banner" height="auto" width="auto" srcset="https://brain.harvard.edu/wp-content/uploads/connectome-banner.png" class="wp-image-5926">
					</span>
			</div>
		</div>
		</div>
	</div>
	
	<div class="et_pb_section et_pb_section_2 et_section_regular">
		<!-- <div class="et_pb_row et_pb_row_1">
			<div class="et_pb_column et_pb_column_1_2 et_pb_column_1  et_pb_css_mix_blend_mode_passthrough">
				<div class="et_pb_module et_pb_code et_pb_code_0">
					<div class="et_pb_code_inner">
						<?php echo do_shortcode ("[connectome-count]"); ?>
					</div>
				</div>
			</div> 
			<div class="et_pb_column et_pb_column_1_2 et_pb_column_2  et_pb_css_mix_blend_mode_passthrough et-last-child et_pb_column_empty">
			</div>
		</div> -->
		<div class="et_pb_row et_pb_row_2">
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_3  et_pb_css_mix_blend_mode_passthrough et-last-child">
				<div class="et_pb_module et_pb_text et_pb_text_0  et_pb_text_align_left et_pb_bg_layout_light">
					<div class="et_pb_text_inner"><h1>HBI Connectome<h1></div>
				</div> 
			</div>
		</div> 
	</div>

	<?php
		while ( have_posts() ) : the_post();
			if ($_SESSION['login']) {				
				$shortcode = '[connectome-top-buttons ' .
					'b1_label="LOGOUT" b1_link="https://brain.harvard.edu/connectome/logout/"' . ' ' .
					'b2_label="EDIT MY PROFILE" b2_link="https://brain.harvard.edu/connectome/member?id=' . $_SESSION['profile'] . '"' . ' ' .
			   ']';
			   $profile_link = "https://brain.harvard.edu/connectome/member?id=" . get_the_id();	   
			} else {
				// $_SESSION['profile'] = get_the_id();
				$shortcode = '[connectome-top-buttons ' .
					'b1_label="PROFILE" b1_link="https://brain.harvard.edu/connectome/login/"' . ' ' .
					'b2_label="LOGIN/JOIN CONNECTOME" b2_link="https://brain.harvard.edu/connectome/login/"' .
			   ']';
			}
		endwhile; 
	?>	
	
	<div class="et_pb_section et_pb_section_4 et_section_regular">
		<div class="et_pb_row et_pb_row_4">
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_5  et_pb_css_mix_blend_mode_passthrough et-last-child">
				<div class="et_pb_module et_pb_code et_pb_code_2">
					<div class="et_pb_code_inner">					
						<?php echo do_shortcode ($shortcode); ?>					
					</div>
				</div>
			</div>
		</div>
	</div>	

<?php
			while ( have_posts() ) : the_post();
										
				$image = wp_get_attachment_image_url( get_post_thumbnail_id( get_the_id() ), $full);		
				if( $image ) { $image = '<img src="' . $image . '">'; }
				
				$name = get_field('fname') . ' ' . get_field('lname');
				
				$pros = '';
				if (get_field('pronoun') || get_field('pronunciation')) { 
					$pros .= '(';
					if (get_field('pronoun')) { $pros .= get_field('pronoun'); }
					if (get_field('pronoun') && get_field('pronunciation')) { $pros .= ' — '; }
					if (get_field('pronunciation')) { $pros .= '"' . get_field('pronunciation') . '"'; }
					$pros .= ')';
				} 
				
				$job_title = get_field('job_title');
				$lab_name = get_field('lab_name');
				
				$about_me = get_field('about_me');
				
				$email = '<a href="mailto:' . get_field('email') . '">' . get_field('email') . '</a>';
				
				$lab_location = get_field('lab_location');
				
				$websites_found = FALSE;
				if (get_field('pubmed_link')) {	
					$pubmed = '<a href="' . get_field('pubmed_link')  . '" target="_blank">' . 'PubMed' . '</a>'; 
					$websites_found = TRUE;
				}
				if (get_field('lab_website')) { 
					$lab_website .= '<a href="' . get_field('lab_website') . '" target="_blank">' . 'Lab/Office Website' . '</a>';
					$websites_found = TRUE;
				}
				if (get_field('personal_website')) { 
					$personal_website .= '<a href="' . get_field('personal_website') . '" target="_blank">' . 'Personal Website' . '</a>';
					$websites_found = TRUE;
				}
				
				$terms = wp_get_object_terms (get_the_id(), 'connectome_campuses');
				if (count($terms) > 0) {
					foreach ($terms as $term) {	
						 $campuses .= '<div class="area">' . $term->name . '</div>';
					}		
				}
				
				$interests_found = FALSE;
				$terms = get_field('neuro_topics');
				if (count($terms) > 0) {
					$interests_found = TRUE;
					foreach ($terms as $term) {	
						 $research_interests .= '<div class="area">' . get_the_title($term) . '</div>';
					}		
				}
				
				echo '<div class="connectome-post">';
				
					echo '<div class="full-width">';
					
						echo '<div class="two-thirds">';
						
							echo $image;
						
							echo '<div class="heading">'  . $name . '</div>';
							
							if (strlen($pros) > 2 ) { echo '<div class="sub-heading">' . $pros . '</div>'; }
							
							echo '<div class="sub-heading">' . $job_title . ' / ' . $lab_name . '</div>';
							
							echo '<div class="text extra-padding">' . $about_me . '</div>';
						
						echo '</div>';
	
						echo '<div class="one-third et_column_last">';
						
							echo '<div class="category first">Email</div>';
							echo '<div class="text">' . $email . '</div>';
							
							echo '<div class="category">Location</div>';
							echo '<div class="text">' . $lab_location . '</div>';
						
							if ($websites_found) {
								echo '<div class="category">Website(s)</div>';
								if ($pubmed) 			{ echo '<div class="text">' . $pubmed . '</div>'; }
								if ($lab_website) 		{ echo '<div class="text">' . $lab_website . '</div>'; }
								if ($personal_website) 	{ echo '<div class="text">' . $personal_website . '</div>'; }
							}
							
							echo '<div class="category">Affiliations</div>';
							echo '<div class="text">' . $campuses . '</div>';
											
							if ($interests_found) {
								echo '<div class="category">Neuro Topics</div>';
								echo '<div class="text">' . $research_interests . '</div>';
							}
							
						echo '</div><div class="clear"></div>';
	
					echo '</div>';

				echo '</div>';

				echo '<div id="connectome-top-buttons" class="connectome-post-return">';
					echo '<a href="https://brain.harvard.edu/connectome/">BACK TO CONNECTOME</a>'; 
				echo '</div>';
				
				echo '<div class="flex-box">';
					echo '<div class="one_third">';
						echo '&nbsp;';
					echo '</div>';
					echo '<div class="two_third et_column_last">';
						$prev = get_permalink( get_adjacent_post(false,'',false)->ID );
						$next = get_permalink( get_adjacent_post(false,'',true)->ID );					
						echo '<div class="connectome-post-nav">';
							if ($prev != get_the_permalink()) {
								echo '<div class="prev"><a class="nav" href="' . $prev . '">' . '< PREVIOUS' . '</a></div>';
							}
							if ($next != get_the_permalink()) {
								echo '<div class="next"><a class="nav" href="' . $next . '">' . 'NEXT >' . '</a></div>';
							}
						echo '</div>';
					echo '</div>';
				echo '<div>';
				
				
			endwhile; 
	?>			
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>