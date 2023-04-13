<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php

// Start Sessions
function register_session() {
	  if (!session_id()) { session_start(); }
	}
add_action('init', 'register_session');

// Enqueue Connectome theme scripts 
function connectome_theme_scripts() {	
	wp_enqueue_script( 'connectomejs',  get_stylesheet_directory_uri() . '/connectome/js/connectome.js', array('jquery'), null, false);
	wp_enqueue_style ('connectomecss',  get_stylesheet_directory_uri() . '/connectome/style.css'); 	      
}
add_action( 'wp_enqueue_scripts', 'connectome_theme_scripts' );

// Connectome shortcodes 
include(get_stylesheet_directory() . '/connectome/shortcodes.php');

// Member Form
function connectome_member_form() { 

	check_ajax_referer('ajax_nonce', 'nonce');

	$html 	= '';

	$id 				= trim(htmlentities(strip_tags($_POST['id'])));
	$fname				= trim(htmlentities(strip_tags($_POST['fname'])));
	$lname				= trim(htmlentities(strip_tags($_POST['lname'])));
	$email				= trim(htmlentities(strip_tags($_POST['email'])));
	$job_title			= trim(htmlentities(strip_tags($_POST['job_title'])));
	$role				= $_POST['role'];
	$personal_website	= trim(htmlentities(strip_tags($_POST['personal_website'])));
	$personal_email		= trim(htmlentities(strip_tags($_POST['personal_email'])));
	$lab_name			= trim(htmlentities(strip_tags($_POST['lab_name'])));
	$lab_location		= trim(htmlentities(strip_tags($_POST['lab_location'])));
	$lab_website		= trim(htmlentities(strip_tags($_POST['lab_website'])));
	$pronoun			= trim(htmlentities(strip_tags($_POST['pronoun'])));
	$pronunciation		= trim(htmlentities(strip_tags($_POST['pronunciation'])));
	$pubmed_link		= trim(htmlentities(strip_tags($_POST['pubmed_link'])));
	$research_interests	= $_POST['research_interests'];
	$campuses			= $_POST['campuses'];
	$about_me			= trim(htmlentities(strip_tags($_POST['about_me'])));
	$acceptance			= trim(htmlentities(strip_tags($_POST['acceptance'])));



	$title = $fname . ' ' . $lname;
	if (!$id) {
		$post = array(
			'post_title'    => $title,
			'post_status'   => 'pending',
			'post_type'   	=> 'hbi_connectome'
		);
		$post_id = wp_insert_post($post);
	} else {
		$post_id = $id;
		wp_update_post(array(
			'ID'    		=>  $post_id,
			'post_status'   =>  'pending'
		));
	}
	$_SESSION['profile'] = $id;
	
	update_field('fname', $fname, $post_id );
	update_field('lname', $lname, $post_id );
	update_field('email', $email, $post_id );	
	update_field('job_title', $job_title, $post_id );
	update_field('personal_website', $personal_website, $post_id );
	update_field('personal_email', $personal_email, $post_id );	
	update_field('lab_name', $lab_name, $post_id );			
	update_field('lab_location', $lab_location, $post_id );		
	update_field('lab_website', $lab_website, $post_id );
	update_field('pronoun', $pronoun, $post_id );
	update_field('pronunciation', $pronunciation, $post_id );	
	update_field('pubmed_link', $pubmed_link, $post_id );
	update_field('about_me', $about_me, $post_id );
	update_field('acceptance', $acceptance, $post_id );
	update_field('neuro_topics', $research_interests, $post_id );
		
	$r = get_term_by('name', $role, 'connectome_roles');
	$r_id = (int) $r->term_id;	
	wp_set_object_terms ($post_id, $r_id,'connectome_roles');
		
	foreach ($campuses as $campus) {
		$c_ids[] = (int) $campus;		
	}
	wp_set_object_terms ($post_id, $c_ids,'connectome_campuses');
	
// echo $affiliation . '<br>';
// echo '<pre>';
// print_r($a_ids);
// echo '</pre>';	
// echo $role . '<br>';
// echo '<pre>';
// print_r($r_ids);
// echo '</pre>';	
// echo '<pre>';
// print_r($research_interests);
// echo '</pre>';	
// echo '<pre>';
// print_r($ri_ids);
// echo '</pre>';	


	if ($_FILES['image']['size'] > 0) {
	
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	
		$attach_id = media_handle_upload('image', $post_id);
		update_post_meta($post_id,'_thumbnail_id',$attach_id);
		set_post_thumbnail($post_id, $attach_id);
	
	}

	$post_link = admin_url( 'post.php?post='. $post_id .'&action=edit', 'https' ); 
	
	$to = 'Parizad_Bilimoria@hms.harvard.edu, Adam_Zajac@hms.harvard.edu, michael@epitomestudio.com';
	// $to = 'peter.roden@gmail.com';
	$subject = 'Connectome Member Uploaded for Review';
	$body = $title . ' was submitted for review (' . $post_link . ')';	
	$headers[] = 'From: Connectome <connectome@brain.harvard.edu>';
	$headers[] = 'bcc: peter.roden@gmail.com';
	wp_mail($to, $subject, $body, $headers );

	echo $html;
	die();

}
add_action( 'wp_ajax_nopriv_connectome_member_form', 'connectome_member_form' );
add_action( 'wp_ajax_connectome_member_form', 'connectome_member_form' );

// Member Delete
function connectome_member_delete() { 

	check_ajax_referer('ajax_nonce', 'nonce');

	$html 	= '';

	if(!empty($_POST)) {
		$id = trim(htmlentities(strip_tags($_POST['id'])));
		$result = wp_delete_post($id);
		unset ($_SESSION['login']);
		unset ($_SESSION['profile']);
	}

	$html .= '<div class="response">';
		$html .= 'Thank you.  Your Connectome profile has been deleted.';
	$html .= '</div>';	

	echo $html;
	die();

}
add_action( 'wp_ajax_nopriv_connectome_member_delete', 'connectome_member_delete' );
add_action( 'wp_ajax_connectome_member_delete', 'connectome_member_delete' );

// Display Connectome Alphabetical
function display_connectome_alphabetical(){ 
	
	check_ajax_referer('ajax_nonce', 'nonce');
	
	$html 	= '';
	
	$letter = esc_html($_POST['letter']);
	$count 	= 0;

	$args = array(
		'post_type'			=> 'hbi_connectome',
		'posts_per_page'	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'lname',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);
	
	$the_query = new WP_Query($args);

	if( $the_query->have_posts() ) {
		while( $the_query->have_posts() ) {
			$the_query->the_post(); 
		
			$first_letter = substr(get_field(lname),0,1);
			if ($letter == $first_letter) {	$count++; }
			if ($letter == 'ALL') { $count++; }			
		}			

	}
	
	$html .= '<div class="count">Displaying ' . $count . ' search results below.</div>';
	
		$args = array(
		'post_type'			=> 'hbi_connectome',
		'posts_per_page'	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'lname',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);
	
	$the_query = new WP_Query($args);

	if( $the_query->have_posts() ) {
		while( $the_query->have_posts() ) {
			$the_query->the_post(); 

			$id 		= get_the_id();
			$permalink 	= get_permalink($id);
			$image 		= get_field('image',$id);
			$size 		= array("150","150");						
			$thumbnail 	= get_the_post_thumbnail_url ($id, $size);
			$image		= '<span class="et_pb_image_wrap">' . 
							  '<a ' . 'href="' . $permalink . '">' . 
								  '<img src="' . $thumbnail . '">' . 
							  '</a>' . 
						  '</span>';
			$name		= get_field('fname',$id) . ' ' . get_field('lname',$id);
			$job_title 	= get_field('job_title',$id);
			$lab 		= '<a href="' . get_field('lab_url',$id) . '">' . get_field('lab_name',$id) . '</a>';
			$title_lab 	= $job_title . ' / ' . $lab;
			$about_me   = get_field('about_me',$id);
			if (strlen($about_me) > 0) { 
				$excerpt 	= substr(get_field('about_me',$id), 0, 150);
				$pos	    = strrpos($excerpt, " ");
				if ($pos>0) { $excerpt = substr($excerpt, 0, $pos); }
				$excerpt 	= $excerpt . '...';
			}
		
			$first_letter = substr(get_field(lname),0,1);
			if ($letter == $first_letter) {		
				$html .= connectome_display_row ($image, $name, $title_lab, $excerpt, $permalink);		
			}
			if ($letter == 'ALL') {
				$html .= connectome_display_row ($image, $name, $title_lab, $excerpt, $permalink);
			}
		}			
		
		echo '</div>';
	
		$html .= paginate_landing_rows ('connectome-search-results');

	}
	
	echo $html;
	die();

}
add_action( 'wp_ajax_nopriv_display_connectome_alphabetical', 'display_connectome_alphabetical' );
add_action( 'wp_ajax_display_connectome_alphabetical', 'display_connectome_alphabetical' );

// Display Connectome Research
function display_connectome_research_area() { 
	
	check_ajax_referer('ajax_nonce', 'nonce');
	
	$html 			= '';
	$research_area 	= esc_html($_POST['research_area']);
	$count 			= 0;

	$args = array(
		'post_type'			=> 'hbi_connectome',
		'posts_per_page' 	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'search_name',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);
	$query = new WP_Query($args);
	
	if ($query->have_posts()) {
		while($query->have_posts()) {
			$query->the_post();
	
			$research_area_found = FALSE;
			$term_array = array();
			$terms = get_field('research_areas');
			if($terms){
				foreach( $terms as $term ) {
					$term_array = get_term_by('id', $term, 'research_areas');
					if ($term_array->name == $research_area) {$research_area_found = TRUE; }
				}
			}

			if ($research_area_found) { $count++; }

		}			

	}
	
	$html .= '<div class="count">Displaying ' . $count . ' search results below.</div>';

	$args = array(
		'post_type'			=> 'hbi_connectome',
		'posts_per_page' 	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'search_name',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);
	$query = new WP_Query($args);
	
	if ($query->have_posts()) {
		while($query->have_posts()) {
			$query->the_post();
	
			$research_area_found = FALSE;
			$term_array = array();
			$terms = get_field('research_areas');
			if($terms){
				foreach( $terms as $term ) {
					$term_array = get_term_by('id', $term, 'research_areas');
					if ($term_array->name == $research_area) {$research_area_found = TRUE; }
				}
			}

			if ($research_area_found) {
			
				$results	= TRUE;
				$image 		= get_field('image');
				$size 		= array("150","150");						
				$thumbnail 	= get_the_post_thumbnail_url (get_the_ID(), $size);
				$image		= '<span class="et_pb_image_wrap">' . 
								  '<a ' . 'href="' . $permalink . '">' . 
									  '<img src="' . $thumbnail . '">' . 
								  '</a>' . 
							  '</span>';
				
				$name	= get_field('fname') . ' ' . get_field('lname');
				$terms = wp_get_object_terms (get_the_id(), 'connectome_roles');
				foreach ($terms as $roles) { $role = $roles->name; }
				$terms = wp_get_object_terms (get_the_id(), 'connectome_affiliations');
				foreach ($terms as $affiliations) { $affiliation = $affiliations->name; }
				$lab = '<a href="' . get_field('lab_url') . '">' . get_field('lab_name') . '</a>';
				$role_lab_affiliation = $role . ' / ' . $lab . ' / ' . $affiliation; 
				$excerpt = substr(get_field('research_message'), 0, 300) . '...';	
			
				$first_letter = substr(get_field(search_name),0,1);
				$html .= connectome_display_row ($image, $name, $role_lab_affiliation, $excerpt, $permalink);
			}
		}
		
		$html .= paginate_landing_rows ('connectome-search-results');			

	}
	
	echo $html;
	die();

}
add_action( 'wp_ajax_nopriv_display_connectome_research_area', 'display_connectome_research_area' );
add_action( 'wp_ajax_display_connectome_research_area', 'display_ connectome_research_area' );


// Display Connectome Research
function display_connectome_research() { 
	
	check_ajax_referer('ajax_nonce', 'nonce');
	
	$html 				= '';
	$research_group 	= $_POST['research_group'];
	$count				= 0;

	$args = array(
		'post_type'			=> 'hbi_connectome',
		'posts_per_page' 	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'lname',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);
	$query = new WP_Query($args);
	
	if ($query->have_posts()) {
		while($query->have_posts()) {
			$query->the_post();

			$research_interests 	= wp_get_object_terms (get_the_id(), 'connectome_research_interests');	
			
			$research_groups_found 	= FALSE;		
			foreach ($research_interests as $research_interest) {
				if (strcmp(htmlspecialchars_decode($research_group), htmlspecialchars_decode($research_interest->name)) == 0) {
					$research_groups_found = TRUE;
				} 
			}
			if ($research_groups_found) { $count++; }
		}			
	}
	wp_reset_query();
		
	if ($count > 0) {
		$html .= '<div class="count">Displaying ' . $count . ' search results below.</div>';
	} else {
		$html .= '<div class="count">No results found.</div>';
	}

	$args = array(
		'post_type'			=> 'hbi_connectome',
		'posts_per_page' 	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'lname',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);
	$query = new WP_Query($args);
	
	if ($query->have_posts()) {
		while($query->have_posts()) {
			$query->the_post();
	
			$research_interests 	= wp_get_object_terms (get_the_id(), 'connectome_research_interests');	
			
			$research_groups_found 	= FALSE;		
			foreach ($research_interests as $research_interest) {
				if (strcmp(htmlspecialchars_decode($research_group), htmlspecialchars_decode($research_interest->name)) == 0) {
					$research_groups_found = TRUE;
				} 
			}
			if ($research_groups_found) { $count++; }

			if ($research_groups_found) {
			
				$permalink 	= get_permalink();
				
				$image 		= get_field('image');
				$size 		= array("150","150");						
				$thumbnail 	= get_the_post_thumbnail_url (get_the_ID(), $size);
				$image		= '<span class="et_pb_image_wrap">' . 
								  '<a ' . 'href="' . $permalink . '">' . 
									  '<img src="' . $thumbnail . '">' . 
								  '</a>' . 
							  '</span>';
				
				$name	= get_field('fname') . ' ' . get_field('lname');
				$terms = wp_get_object_terms (get_the_id(), 'connectome_roles');
				foreach ($terms as $roles) { $role = $roles->name; }
				$terms = wp_get_object_terms (get_the_id(), 'connectome_affiliations');
				foreach ($terms as $affiliations) { $affiliation = $affiliations->name; }
				$lab = '<a href="' . get_field('lab_url') . '">' . get_field('lab_name') . '</a>';
				$role_lab_affiliation = $role . ' / ' . $lab . ' / ' . $affiliation; 
				$excerpt = substr(get_field('research_message'), 0, 300) . '...';	
				
				$first_letter = substr(get_field(search_name),0,1);
				$html .= connectome_display_row ($image, $name, $role_lab_affiliation, $excerpt, $permalink);

			}
		}			

		$html .= paginate_landing_rows ('connectome-search-results');			

	}
	wp_reset_query();
	
	echo $html;
	die();

}
add_action( 'wp_ajax_nopriv_display_connectome_research', 'display_connectome_research' );
add_action( 'wp_ajax_display_connectome_research', 'display_connectome_research' );



// Display Text Search
function display_connectome_search_text() { 
	
	check_ajax_referer('ajax_nonce', 'nonce');
	
	$html 	= '';
	$search = esc_html($_POST['search']);
	$count  = 0;

	$args = array(
		'post_type'			=> 'hbi_connectome',
		'posts_per_page' 	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'lname',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);

	$query = new WP_Query($args);
	
	if ($query->have_posts()) {
		$results = FALSE;
		while($query->have_posts()) {
			$query->the_post();
			
			$found = FALSE;
			if (stripos(get_field('fname'),$search) > -1) 				{ $found = TRUE; }
			if (stripos(get_field('lname'),$search) > -1) 				{ $found = TRUE; }
			if (stripos(get_field('lab_name'),$search) > -1) 			{ $found = TRUE; }
			if (stripos(get_field('lab_location'),$search) > -1) 		{ $found = TRUE; }
			if (stripos(get_field('research_message'),$search) > -1) 	{ $found = TRUE; }
			if (stripos(get_field('biographic_info'),$search) > -1) 	{ $found = TRUE; }
			
			if ($found) { $count++; }
			
		}
		
	}
		
	if ($count > 0) {
		$html .= '<div class="count">Displaying ' . $count . ' search results below.</div>';
	} else {
		$html .= '<div class="count">No results found.</div>';
	}
		
	$args = array(
		'post_type'			=> 'hbi_connectome',
		'posts_per_page' 	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'lname',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);
	
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while($query->have_posts()) {
			$query->the_post();
	
			$found = FALSE;
			if (stripos(get_field('fname'),$search) > -1) 				{ $found = TRUE; }
			if (stripos(get_field('lname'),$search) > -1) 				{ $found = TRUE; }
			if (stripos(get_field('lab_name'),$search) > -1) 			{ $found = TRUE; }
			if (stripos(get_field('lab_location'),$search) > -1) 		{ $found = TRUE; }
			if (stripos(get_field('research_message'),$search) > -1) 	{ $found = TRUE; }
			if (stripos(get_field('biographic_info'),$search) > -1) 	{ $found = TRUE; }
	
			if ($found) {
			
				$permalink 	= get_permalink();
				
				$image 		= get_field('image');
				$size 		= array("150","150");						
				$thumbnail 	= get_the_post_thumbnail_url (get_the_ID(), $size);
				$image		= '<span class="et_pb_image_wrap">' . 
								  '<a ' . 'href="' . $permalink . '">' . 
									  '<img src="' . $thumbnail . '">' . 
								  '</a>' . 
							  '</span>';
				
				$name	= get_field('fname') . ' ' . get_field('lname');
				$terms = wp_get_object_terms (get_the_id(), 'connectome_roles');
				foreach ($terms as $roles) { $role = $roles->name; }
				$terms = wp_get_object_terms (get_the_id(), 'connectome_affiliations');
				foreach ($terms as $affiliations) { $affiliation = $affiliations->name; }
				$lab = '<a href="' . get_field('lab_url') . '">' . get_field('lab_name') . '</a>';
				$role_lab_affiliation = $role . ' / ' . $lab . ' / ' . $affiliation; 
				$about_me = get_field('about_me');
				if (strlen($about_me) > 0)  { $excerpt = substr(get_field('about_me'), 0, 150) . '...';	}
				$first_letter = substr(get_field(search_name),0,1);
				$html .= connectome_display_row ($image, $name, $role_lab_affiliation, $excerpt, $permalink);

			}
		}			
	
		$html .= paginate_landing_rows ('connectome-search-results');			
	
	}
	wp_reset_query();
	// if (!$found) {$html .= '<br><br><span style="color:#000000">No results found for "' . $search . '".</span><br><br><br>';}

	echo $html;
	die();

}
add_action( 'wp_ajax_nopriv_display_connectome_search_text', 'display_connectome_search_text' );
add_action( 'wp_ajax_display_connectome_search_text', 'display_connectome_search_text' );

// Display Text Search
function connectome_display_row ($image, $name, $role_lab_affiliation, $excerpt, $permalink) { 
	
	$html = '';
    
	$html .= '<div class="row">';

		$html .= '<div class="et_pb_column et_pb_column_1_5 et_pb_css_mix_blend_mode_passthrough">';
		    $html .= '<div class="et_pb_module et_pb_image">';
		        $html .= $image;
		    $html .= '</div>';
	    $html .= '</div>';
		
		$html .= '<div class="et_pb_column et_pb_column_4_5 et_pb_css_mix_blend_mode_passthrough et-last-child">';
		    $html .= '<div class="et_pb_module et_pb_text et_pb_text_align_left">';
		        $html .= '<div class="et_pb_text_inner">';
					$html .= '<div class="name">' . $name  . '</div>';
					$html .= '<div class="lab">' . $role_lab_affiliation  . '</div>';
					$html .= '<div class="excerpt">' . $excerpt  . '</div>';
					$html .= '<div class="learn-more"><a href="' . $permalink . '" target="_blank">LEARN MORE &gt;</a></div>';
			    $html .= '</div>';
		    $html .= '</div>';
	    $html .= '</div>';
    
	$html .= '</div>';
	
	return $html;
	
}

// Connectome Single Page - Redirect to correct page for pagination
add_action( 'template_redirect', function() {
	if ( is_singular( 'hbi_connectome' ) ) {
		global $wp_query;
		$page = ( int ) $wp_query->get( 'page' );
		if ( $page > 1 ) {
			$wp_query->set( 'page', 1 );
			$wp_query->set( 'paged', $page );
		}
		remove_action( 'template_redirect', 'redirect_canonical' );
	}
}, 0 ); 

function connectome_pagination_link( $label = NULL, $dir = 'next', WP_Query $query = NULL ) {
	if ( is_null( $query ) ) {
		$query = $GLOBALS['wp_query'];
	}
	$max_page = ( int ) $query->max_num_pages;
	if ( $max_page <= 1 ) {
		return;
	}
	$paged = ( int ) $query->get( 'paged' );
	if ( empty( $paged ) ) {
		$paged = 1;
	}
	$target_page = $dir === 'next' ?  $paged + 1 : $paged - 1;
	if ( $target_page < 1 || $target_page > $max_page ) {
		return;
	}
	if ( null === $label ) {
		$label = __( 'Next Page &raquo;' );
	}

	$label = preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label );
	printf( '<a href="%s">%s</a>', get_pagenum_link( $target_page ), esc_html( $label ) );
}

// Display Connectome Filter
function display_connectome_filter () { 
	
	check_ajax_referer('ajax_nonce', 'nonce');
	
	global $wpdb;	
	$query = 'DELETE FROM '. $wpdb->prefix  . 'filters ' . 'WHERE DATE < (NOW() - INTERVAL 1 DAY)';
	$wpdb->query($wpdb->prepare($query));
	
	$html 		= '';
	$ids 		= array();
	$session 	= $_POST['session'];
	$text 		= esc_html($_POST['text']);
	$taxonomies = 0;
	
	$campus 	= str_replace("\'", '', $_POST['campus']);
	if ($campus == -1) { 
		$campus = '';
		$campus_found = FALSE; 
	} else {
		$taxonomies++;
		$campus_found = TRUE; 
		$term = get_term_by('name', $campus, 'connectome_campuses');	
		$connectome_campus = array($term->term_id);	
		$connectome_campus = $term->term_id;
	}
	
	$role 		= str_replace("\'", '', $_POST['role']);
	if ($role == -1) { 
		$role = '';
		$role_found = FALSE; 
	} else {
		$taxonomies++;
		$role_found = TRUE; 
		$term = get_term_by('name', $role, 'connectome_roles');	
		$connectome_role = array($term->term_id);
	}
	
	$research 	= str_replace("\'", '', $_POST['research']);
	if ($research == -1) { 
		$research = '';
		$research_found = FALSE; 
	} else { 
		$taxonomies++;
		$research_found = TRUE; 
		$neuro = get_page_by_title('Mental Health and Illness', OBJECT, 'neuro-topics');
	}

	if ($_POST['reset'] == 'Y') { 
		$taxonomies = 0; 
		
	}
	
	switch ($taxonomies) {
		case 0:
			$args = array(
				'post_type'			=> 'hbi_connectome',
				'posts_per_page' 	=> -1,
				'post_status' 		=> 'publish',
				'meta_key'			=> 'lname',
				'orderby'			=> 'meta_value',
				'order'				=> 'ASC'
			);
			break;
		case 1:
			if ($campus_found) {
				$args = array(
					'post_type'			=> 'hbi_connectome',
					'posts_per_page' 	=> -1,
					'post_status' 		=> 'publish',
					'meta_key'			=> 'lname',
					'orderby'			=> 'meta_value',
					'order'				=> 'ASC',
					'tax_query' 		=> array (
						array(
							'taxonomy' 	=> 'connectome_campuses',
							'field'     => 'term_id',
							'terms' 	=> $connectome_campus
						)
					)
				);
			}
			if ($role_found) {
				$args = array(
					'post_type'			=> 'hbi_connectome',
					'posts_per_page' 	=> -1,
					'post_status' 		=> 'publish',
					'meta_key'			=> 'lname',
					'orderby'			=> 'meta_value',
					'order'				=> 'ASC',
					'tax_query' 		=> array (
						array(
							'taxonomy' 	=> 'connectome_roles',
							'field'     => 'term_id',
							'terms' 	=> $connectome_role
						)
					)
				);
			}
			if ($research_found) {
				$args = array(
					'post_type'			=> 'hbi_connectome',
					'posts_per_page' 	=> -1,
					'post_status' 		=> 'publish',
					'meta_key'			=> 'lname',
					'orderby'			=> 'meta_value',
					'order'				=> 'ASC',
					'meta_query' 		=> array(
					  	array(
							'key' 		=> 'neuro_topics', 
							'value' 	=> '"' . $neuro->ID . '"',
							'compare' 	=> 'LIKE'
						)
					)
				);
			}
			break;
		case 2:
			if ($campus_found && $role_found) {
				$args = array(
					'post_type'			=> 'hbi_connectome',
					'posts_per_page' 	=> -1,
					'post_status' 		=> 'publish',
					'meta_key'			=> 'lname',
					'orderby'			=> 'meta_value',
					'order'				=> 'ASC',
					'tax_query' 		=> array(
						'relation'		 => 'AND',
						array(
							'taxonomy' 	=> 'connectome_campuses',
							'field'     => 'term_id',
							'terms' 	=> $connectome_campus
						),
						array(
							'taxonomy' 	=> 'connectome_roles',
							'field'     => 'term_id',
							'terms' 	=> $connectome_role
						)
					)
				);
			}
			if ($campus_found && $research_found) {
				$args = array(
					'post_type'			=> 'hbi_connectome',
					'posts_per_page' 	=> -1,
					'post_status' 		=> 'publish',
					'meta_key'			=> 'lname',
					'orderby'			=> 'meta_value',
					'order'				=> 'ASC',
					'tax_query' 		=> array(
						array(
							'taxonomy' 	=> 'connectome_campuses',
							'field'     => 'term_id',
							'terms' 	=> $connectome_campus
						)
					),
					'meta_query' 		=> array(
						  array(
							'key' 		=> 'neuro_topics', 
							'value' 	=> '"' . $neuro->ID . '"',
							'compare' 	=> 'LIKE'
						)
					)
				);
			}
			if ($role_found && $research_found) {
				$args = array(
					'post_type'			=> 'hbi_connectome',
					'posts_per_page' 	=> -1,
					'post_status' 		=> 'publish',
					'meta_key'			=> 'lname',
					'orderby'			=> 'meta_value',
					'order'				=> 'ASC',
					'tax_query' 		=> array(
						array(
							'taxonomy' 	=> 'connectome_roles',
							'field'     => 'term_id',
							'terms' 	=> $connectome_role
						)
					),
					'meta_query' 		=> array(
						  array(
							'key' 		=> 'neuro_topics', 
							'value' 	=> '"' . $neuro->ID . '"',
							'compare' 	=> 'LIKE'
						)
					)
				);
			}
			break;
		case 3:
			$args = array(
				'post_type'			=> 'hbi_connectome',
				'posts_per_page' 	=> -1,
				'post_status' 		=> 'publish',
				'meta_key'			=> 'lname',
				'orderby'			=> 'meta_value',
				'order'				=> 'ASC',
				'tax_query' 		=> array(
					'relation'		 => 'AND',
					array(
						'taxonomy' 	=> 'connectome_campuses',
						'field'     => 'term_id',
						'terms' 	=> $connectome_campus
					),
					array(
						'taxonomy' 	=> 'connectome_roles',
						'field'     => 'term_id',
						'terms' 	=> $connectome_role
					)
				),
				'meta_query' 		=> array(
					  array(
						'key' 		=> 'neuro_topics', 
						'value' 	=> '"' . $neuro->ID . '"',
						'compare' 	=> 'LIKE'
					)
				)
			);
			break;
	}

$_SESSION['debug'] = $args;
	
	$query = new WP_Query($args);
	
	if ($query->have_posts()) {
		$c = -1;
		while($query->have_posts()) {
			$query->the_post();
			
			if (!empty($text)) {
				$found = FALSE;
				if (stripos(get_field('fname'),$text) > -1) 		{ $found = TRUE; }
				if (stripos(get_field('lname'),$text) > -1) 		{ $found = TRUE; }
				if (stripos(get_field('job_title'),$text) > -1) 	{ $found = TRUE; }
				if (stripos(get_field('lab_name'),$text) > -1) 		{ $found = TRUE; }
				if (stripos(get_field('lab_location'),$text) > -1) 	{ $found = TRUE; }
				if (stripos(get_field('about_me'),$text) > -1) 		{ $found = TRUE; }
				if ($found) { 
					$c++;
					$ids[$c] = get_the_id(); 
				}
			} else {
				$c++;
				$ids[$c] = get_the_id(); 
			}
			
		}			
	}
	wp_reset_query();

	$sql = 'INSERT INTO '. $wpdb->prefix  . 'filters ' .
	'(SESSION, DATE, RESEARCH, CAMPUS, ROLE, TEXT, IDS) ' .
	"VALUES ('" . $session .  "','" . current_time('mysql') .  "','" . $research .  "','" . $campus . "','" . $role . "','" . $text .  "','" . json_encode($ids) . "')";
	$wpdb->query($wpdb->prepare($sql));
	
	$html .= 'research: ' . $research . '<br>';
	
	return;

}
add_action( 'wp_ajax_nopriv_display_connectome_filter', 'display_connectome_filter' );
add_action( 'wp_ajax_display_connectome_filter', 'display_connectome_filter' );


