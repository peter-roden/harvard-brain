<?php
if (!defined('ABSPATH')) die();
function style_parent() { 
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 	
}
add_action( 'wp_enqueue_scripts', 'style_parent' );

/* Enqueue theme scripts */  
function theme_scripts() {	
	wp_enqueue_script( 'easy-pagination', get_stylesheet_directory_uri() . '/js/jquery.easyPaginate.js', array('jquery'), true );
	wp_enqueue_script( 'load-more', get_stylesheet_directory_uri() . '/js/jquery.simpleLoadMore.min.js', array('jquery'), true );
	wp_enqueue_script( 'loadingModal', get_stylesheet_directory_uri() . '/js/jquery.loadingModal.min.js', array('jquery'), true );
	wp_enqueue_script( 'forms', get_stylesheet_directory_uri() . '/js/forms.js', array('jquery'), true );
	wp_enqueue_script( 'ics', 'https://addevent.com/libs/atc/1.6.1/atc.min.js');	
	// wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBdH8woHbAmNbMhn3fri-CFEr3ddnhxM6s', array(), '3', true );
	wp_enqueue_script( 'acf-google-maps', get_stylesheet_directory_uri() . '/js/acf-google-maps.js', array('jquery'), true );
    wp_enqueue_script( 'validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'additional', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js', array( 'jquery' ) );
	wp_localize_script('forms', 'frontEndAjax', array(
		 'ajaxurl' => admin_url( 'admin-ajax.php' ),
		 'nonce' => wp_create_nonce('ajax_nonce')
	));
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'); 
	wp_enqueue_style('add-event',  get_stylesheet_directory_uri() . '/style-AddEvent.css');  
	wp_enqueue_style('loadingModalCSS',  get_stylesheet_directory_uri() . '/js/jquery.loadingModal.min.css'); 	      
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );


add_action('wp_dashboard_setup', 'themeprefix_remove_dashboard_widget' );
function themeprefix_remove_dashboard_widget() {
    remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
}
add_action( 'admin_menu', 'remove_site_health_menu' );	
function remove_site_health_menu(){
  remove_submenu_page( 'tools.php','site-health.php' ); 
}

// Allow editors to see Appearance menu
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );
function hide_menu() {
 
    // Hide theme selection page
    remove_submenu_page( 'themes.php', 'themes.php' );
 
    // Hide widgets page
    remove_submenu_page( 'themes.php', 'widgets.php' );
 
    // Hide customize page
    global $submenu;
    unset($submenu['themes.php'][6]);
 
}
 
add_action('admin_head', 'hide_menu');

function my_custom_css() {
  echo '<style>
	#research_areasdiv {
		display: none;
	}
	#tagsdiv-news_types {
		display: none;
	}
	#event_categoriesdiv {
		display: none;
	}
	#tagsdiv-neurotopics {
		display: none;
	}
	#tagsdiv-neurotopic_tags {
		display: none;
	}
	#tagsdiv-connectome_roles {
		display: none;
	}
	#tagsdiv-connectome_affiliations {
		display: none;
	}
	#tagsdiv-connectome_research_interests {
		display: none;
	}
	#connectome_campusesdiv {
		display: none;
	}
	.acf-field p.description {
		color: red;
	}
  </style>';
}
add_action('admin_head', 'my_custom_css');

/* Include shortcodes */ 
include(get_stylesheet_directory() . '/shortcodes/shortcodes.php');

/* Include ICS */ 
include(get_stylesheet_directory() . '/ics/ICS.php');

/* Include Connectome */ 
include(get_stylesheet_directory() . '/connectome/functions.php');

/* Add PHP to Text Widget */ 
add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}

/* Replace parent mobile menu function to add search form */  
function child_remove_parent_function() {
    remove_action( 'et_header_top', 'et_add_mobile_navigation');
}
add_action( 'wp_loaded', 'child_remove_parent_function' );

function et_add_mobile_navigation_child(){
	if ( is_customize_preview() || ( 'slide' !== et_get_option( 'header_style', 'left' ) && 'fullscreen' !== et_get_option( 'header_style', 'left' ) ) ) {
		printf(
			'<div id="et_mobile_nav_menu">
				<div class="mobile_nav closed">'
		);
		get_search_form();
		printf('<span class="mobile_menu_bar mobile_menu_bar_toggle"></span>
				</div>
			</div>'
		);
	}
}
add_action( 'et_header_top', 'et_add_mobile_navigation_child', 25 );

/* Add page/post name as Body Class */ 
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_name;
		$classes[] = 'page-' . $post->post_name;
	}
	if ( is_page() ) {
        if ( $post->post_parent ) {
            $parent = get_post( $post->post_parent );
            $classes[] = $parent->post_name;
        }
    }
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/* Add Google API to ACF */ 
function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyC_vYm2T-xnT3yjvKWpH6xTZwhAkZ7QEFs');
}
add_action('acf/init', 'my_acf_init');


/* Change Enter Title for People Custom Post Type */ 
function wpb_change_people_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'people' == $screen->post_type ) {
          $title = "Enter Person's Name Here";
     }
  
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_people_title_text' );

/* Change Enter Title for News Custom Post Type */ 
function wpb_change_hbi_news_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'hbi_news' == $screen->post_type ) {
          $title = "Enter News Title Here";
     }
  
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_hbi_news_title_text' );

/* Change Enter Title for Events Custom Post Type */ 
function wpb_change_hbi_events_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'hbi_events' == $screen->post_type ) {
          $title = "Enter Event Name";
     }
  
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_hbi_events_title_text' );


function my_acf_default_date($field) {
  $field['default_value'] = date('m/d/Y');
  return $field;
}
add_filter('acf/load_field/name=publication_date', 'my_acf_default_date');

// Display Landing Rows
function display_landing_row ($type, $columns,$link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more) { 


	if ($columns == 5) { 
		$column_left  = 'et_pb_column_1_5';
		$column_right = 'et_pb_column_4_5';
	}
	if ($columns == 3) { 
		$column_left  = 'et_pb_column_1_3';
		$column_right = 'et_pb_column_2_3';
	}
	
	$html = '';
	$html .= '<div class="et_pb_section et_section_regular">';	
		$html .= '<div class="landing-row">';
			$html .= '<div class="et_pb_section et_section_regular">';
				$html .= '<div class=" et_pb_row">';
					$html .= '<div class="et_pb_column ' . $column_left . '">';
						if ($thumbnail) {
							$html .= '<div class="et_pb_module et_pb_image et_always_center_on_mobile">';
								$html .= '<span class="et_pb_image_wrap">' . '<a ' . 'href="' . $link . '">' . $thumbnail . '</a></span>';
							$html .= '</div>';
						}
					$html .= '</div> <!-- .et_pb_column -->';
					if ($type=="news") {
						$html .= '<div class="et_pb_column ' . $column_right . ' et-last-child" style="margin-left:20px">';
					} else {
						$html .= '<div class="et_pb_column ' . $column_right . ' et-last-child">';
					}
						$html .= '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left">';
							$html .= '<div class="et_pb_text_inner">';
								if ($title) { 
									$html .= '<div class="title">' . '<a ' . 'class="name" href="' . $link . '">' . $title. '</a>' . '</div>';
								}
								if ($subtitle) { 
									if ($type == 'event-highlight') {
										$html .= '<div class="subtitle">' . '<a style="color:white;"' . 'class="name" href="' . $link . '">' . $subtitle. '</a>' . '</div>';
									} else {
										$html .= '<div class="subtitle">' . '<a ' . 'class="name" href="' . $link . '">' . $subtitle. '</a>' . '</div>';
									}
								}
								if ($excerpt) {
									$html .= '<div class="excerpt">' . $excerpt . '</div>';
								}
								$html .= '<div class="links">';
									if ($left_footer) {
										$html .= '<div class="left-footer">' . $left_footer . '</div>';
									}
									$html .= '<div class="read-more">';
										$html .= '<a ' . 'href="' . $link . '">' . $read_more .'</a>';
									$html .= '</div>';
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</div> <!-- .et_pb_text -->';
					$html .= '</div> <!-- .et_pb_column -->';
				$html .= '</div> <!-- .et_pb_row -->';	
			$html .= '</div> <!-- .et_pb_section -->';
		$html .= '</div>';
	$html .= '</div>';

	return $html;

}

// Paginate Landing Rows
function paginate_landing_rows ($div) { 
	
	$html = '';
	
		$html .= '<script>';
			$html .= 'jQuery(document).ready(function( $ ) {';
					
/*
				$html .= "$('#" . $div ."').easyPaginate({";
				    $html .= "paginateElement: 'div.landing-row',";
				    $html .= "elementsPerPage: 10,";
				    $html .= "effect: 'climb',";
				    $html .= "firstButtonText: 'FIRST',";
				    $html .= "lastButtonText: 'LAST',";
				    $html .= "prevButtonText: 'PREV',";
				    $html .= "nextButtonText: 'NEXT'";
				$html .= "});";
*/

				$html .=  "$('#" . $div ."').simpleLoadMore({";
				  $html .=  "item: '.landing-row',";
				  $html .=  "count: 5,";
				  $html .=  "itemsToLoad: 5,";
				  $btnHTML = '<div class="load-more-div"><a href="#" class="load-more__btn">View More</i></a></div>';
				  $html .=  "btnHTML: " . "'" . $btnHTML . "'";
				$html .=  "});";


	
			$html .= '});';
		$html .= '</script>';

	return $html;

}		

// Display People Alphabetical
function display_people_alphabetical(){ 
	
	check_ajax_referer('ajax_nonce', 'nonce');
	
	$html = '';
	$letter = esc_html($_POST['letter']);

	$args = array(
		'post_type'			=> 'people',
		'posts_per_page'	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'search_name',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);
	
	$the_query = new WP_Query($args);

	if( $the_query->have_posts() ) {
		while( $the_query->have_posts() ) {
			$the_query->the_post(); 

			$html .= '<div id="people-alpha">';
			
			$type = 'people';
			
			$columns = 5;

			$link = get_the_permalink ();
						
			$image = get_field('headshot');
			$size = 'thumbnail'; 						
			if($image) { $thumbnail = wp_get_attachment_image( $image, $size ); }

			$rows = get_field('degrees');
			$c = count($rows);							
			if ($c == 0) {
				$degrees = '';
			} else {
				$degrees = ', ';
			}
			$n = 0;
			if($rows) {
				foreach($rows as $row) {
					$n++;
					if ($n == $c) {
						$degrees .= $row['degree'];
					} else {
						$degrees .= $row['degree'] . ', ';
					}
				}
			}
			$title = get_the_title() . $degrees;
			
			$subtitle = get_field('research_interests_title');
			
			$excerpt = get_field('research_interests_excerpt') . '...';
			
			$website = '';
			$rows = get_field('websites');
			if($rows) {
			$website = 	'<a ' . 'href="' . $rows[0]['website_link'] . 
				'" target="_blank">' .
				$rows[0]['website_name'] . ' >' .
			'</a>';
			}
			$left_footer = $website;
			
			$read_more = 'READ MORE >';			
			
			$first_letter = substr(get_field('search_name'),0,1);
			if ($letter == $first_letter) {
				
				$html .= display_landing_row ($type, $columns,$link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more);

			}
			if ($letter == 'ALL') {
				
				$html .= display_landing_row ($type, $columns, $link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more);

			}
		}			
		
		echo '</div>';
	
		$html .= paginate_landing_rows ('people-alpha');

	}
	
	echo $html;
	die();

}
add_action( 'wp_ajax_nopriv_display_people_alphabetical', 'display_people_alphabetical' );
add_action( 'wp_ajax_display_people_alphabetical', 'display_people_alphabetical' );

// Display People Research
function display_people_research_area() { 
	
	check_ajax_referer('ajax_nonce', 'nonce');

$html = '';
$research_area = esc_html($_POST['research_area']);

if ($research_area == 'Select a Neuro Topic') {
	
	echo do_shortcode('[people-search-all]');
	
} else {

	$args = array(
		'post_type'			=> 'people',
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

			$html .= '<div id="people-categories">';
	
			$research_area_found = 'N';
			$term_array = array();
			$terms = get_field('neuro_topics');
			if($terms){
				foreach( $terms as $term ) {
					$neuro_topics_title = get_the_title($term->ID);
					if ($neuro_topics_title == $research_area) {$research_area_found = 'Y'; }
				}
			}

			if ($research_area_found == 'Y') {
			
				$type = 'people';
				
				$columns = 5;
				
				$link = get_the_permalink ();
							
				$image = get_field('headshot');
				$size = 'thumbnail'; 						
				if($image) { $thumbnail = wp_get_attachment_image( $image, $size ); }
	
				$rows = get_field('degrees');
				$c = count($rows);							
				if ($c == 0) {
					$degrees = '';
				} else {
					$degrees = ', ';
				}
				$n = 0;
				if($rows) {
					foreach($rows as $row) {
						$n++;
						if ($n == $c) {
							$degrees .= $row['degree'];
						} else {
							$degrees .= $row['degree'] . ', ';
						}
					}
				}
				$title = get_the_title() . $degrees;
				
				$subtitle = get_field('research_interests_title');
				
				$excerpt = get_field('research_interests_excerpt') . '...';
				
				$website = '';
				$rows = get_field('websites');
				if($rows) {
				$website = 	'<a ' . 'href="' . $rows[0][website_link] . 
					'" target="_blank">' .
					$rows[0][website_name] . ' >' .
				'</a>';
				}
				$left_footer = $website;
				
				$read_more = 'READ MORE >';		
				
				$html .= display_landing_row ($type, $columns, $link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more);

			}
		}			
		
		echo '</div>';
	
		$html .= paginate_landing_rows ('people-categories');
	
	}
	
	echo $html;
	
}

die();
	
	
	
// 	check_ajax_referer('ajax_nonce', 'nonce');
// 	
// 	$html = '';
// 	$research_area = esc_html($_POST['research_area']);
// 
// 	if ($research_area == 'Select a Research Area') {
// 		
// 		echo do_shortcode('[people-search-all]');
// 		
// 	} else {
// 
// 		$args = array(
// 			'post_type'			=> 'people',
// 			'posts_per_page' 	=> -1,
// 			'post_status' 		=> 'publish',
// 			'meta_key'			=> 'search_name',
// 			'orderby'			=> 'meta_value',
// 			'order'				=> 'ASC'
// 		);
// 		$query = new WP_Query($args);
// 		
// 		if ($query->have_posts()) {
// 			while($query->have_posts()) {
// 				$query->the_post();
// 	
// 				$html .= '<div id="people-categories">';
// 		
// 				$research_area_found = 'N';
// 				$term_array = array();
// 				$terms = get_field('research_areas');
// 				if($terms){
// 					foreach( $terms as $term ) {
// 						$term_array = get_term_by('id', $term, 'research_areas');
// 						if ($term_array->name == $research_area) {$research_area_found = 'Y'; }
// 					}
// 				}
// 	
// 				if ($research_area_found == 'Y') {
// 				
// 					$type = 'people';
// 					
// 					$columns = 5;
// 					
// 					$link = get_the_permalink ();
// 								
// 					$image = get_field('headshot');
// 					$size = 'thumbnail'; 						
// 					if($image) { $thumbnail = wp_get_attachment_image( $image, $size ); }
// 		
// 					$rows = get_field('degrees');
// 					$c = count($rows);							
// 					if ($c == 0) {
// 						$degrees = '';
// 					} else {
// 						$degrees = ', ';
// 					}
// 					$n = 0;
// 					if($rows) {
// 						foreach($rows as $row) {
// 							$n++;
// 							if ($n == $c) {
// 								$degrees .= $row['degree'];
// 							} else {
// 								$degrees .= $row['degree'] . ', ';
// 							}
// 						}
// 					}
// 					$title = get_the_title() . $degrees;
// 					
// 					$subtitle = get_field('research_interests_title');
// 					
// 					$excerpt = get_field('research_interests_excerpt') . '...';
// 					
// 					$website = '';
// 					$rows = get_field('websites');
// 					if($rows) {
// 					$website = 	'<a ' . 'href="' . $rows[0][website_link] . 
// 						'" target="_blank">' .
// 						$rows[0][website_name] . ' >' .
// 					'</a>';
// 					}
// 					$left_footer = $website;
// 					
// 					$read_more = 'READ MORE >';		
// 					
// 					$html .= display_landing_row ($type, $columns, $link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more);
// 	
// 				}
// 			}			
// 			
// 			echo '</div>';
// 		
// 			$html .= paginate_landing_rows ('people-categories');
// 		
// 		}
// 		
// 		echo $html;
// 		
// 	}
// 
// 	die();

}
add_action( 'wp_ajax_nopriv_display_people_research_area', 'display_people_research_area' );
add_action( 'wp_ajax_display_people_research_area', 'display_people_research_area' );

// Display Text Search
function display_people_search_text() { 
	
	check_ajax_referer('ajax_nonce', 'nonce');
	
	$html 	= '';
	$search = esc_html($_POST['search']);

	$args = array(
		'post_type'			=> 'people',
		'posts_per_page' 	=> -1,
		'post_status' 		=> 'publish',
		'meta_key'			=> 'search_name',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);

	$query = new WP_Query($args);
	
	$count = 0;
	if ($query->have_posts()) {
		while($query->have_posts()) {
			$query->the_post();

			$html .= '<div id="people-search">';
			
			$found = 'N';
			if (mb_stripos(get_the_title(),$search) > -1) {
				$found = 'Y';
			} elseif (mb_stripos($degrees,$search) > -1) {
				$found = 'Y';
			} elseif (mb_stripos(get_field('research_interests_title'),$search) > -1) {
				$found = 'Y';
			} elseif (mb_stripos(get_field('research_interests_excerpt'),$search) > -1) {
				$found = 'Y';
			} else if (mb_stripos(get_field('research_interests'),$search) > -1) {
				$found = 'Y';
			}			
			
			if ($found == 'Y') { 
		
				$count++;
				
				$type = 'people';
				
				$columns = 5;

				$link = get_the_permalink ();
							
				$image = get_field('headshot');
				$size = 'thumbnail'; 						
				if($image) { $thumbnail = wp_get_attachment_image( $image, $size ); }
	
				$rows = get_field('degrees');
				$c = count($rows);							
				if ($c == 0) {
					$degrees = '';
				} else {
					$degrees = ', ';
				}
				$n = 0;
				if($rows) {
					foreach($rows as $row) {
						$n++;
						if ($n == $c) {
							$degrees .= $row['degree'];
						} else {
							$degrees .= $row['degree'] . ', ';
						}
					}
				}
				$title = get_the_title() . $degrees;
				
				$subtitle = get_field('research_interests_title');
				
				$excerpt = get_field('research_interests_excerpt') . '...';
				
				$website = '';
				$rows = get_field('websites');
				if($rows) {
				$website = 	'<a ' . 'href="' . $rows[0][website_link] . 
					'" target="_blank">' .
					$rows[0][website_name] . ' >' .
				'</a>';
				}
				$left_footer = $website;
				
				$read_more = 'READ MORE >';	

				$html .= display_landing_row ($type, $columns, $link, $thumbnail, $title, $subtitle, $excerpt, $left_footer, $read_more);
	
			}
		}			
		
		echo '</div>';
	
		$html .= paginate_landing_rows ('people-search');

	}

	if ( $count == 0 ) {$html .= '<br><br><span style="color:#000000">No results found for "' . $search . '".</span><br><br><br>';}

	echo $html;
	die();

}
add_action( 'wp_ajax_nopriv_display_people_search_text', 'display_people_search_text' );
add_action( 'wp_ajax_display_people_search_text', 'display_people_search_text' );


/* Admin/Dashboard Styles */  
function admin_css() {
	echo '<style>	
		#footer-thankyou {
		  	display: none;
		}
		.edit-tags-php form.search-form {
		  	width: 100% !important;
		}
		.post-type-regions #edit-slug-box {
			display: none;
		}
		.post-type-biobreak_categories .term-slug-wrap {
			display: none;
		}
		.post-type-biobreak_categories .term-description-wrap {
			display: none;
		}
		.post-type-biobreak_categories .term-name-wrap p {
			display: none;
		}
		.post-type-biobreak_sponsors select#wpseo-filter {
			display: none;
		}
		.post-type-biobreak_sponsors select#wpseo-readability-filter {
			display: none;
		}
		.user-edit-php .yoast {
			display: none;
		}
		.postbox-container .empty-container {
			display: none;
		}
		#wps_dashwidget_1 button, #wps_dashwidget_1 h2 {
			display: none;
		}
		#wps_dashwidget_1 {
			border: none;
			box-shadow: none;
		}
		#wps_dashwidget_1 .inside {
			box-shadow: none;
		}
		.index-php .wrap h1 {
			display: none;
		}
	</style>';
	$user = wp_get_current_user();
	if (in_array( 'editor', (array) $user->roles)) {
		echo '<style>
			#toplevel_page_et_divi_options {
				display: none;
			}
			#toplevel_page_gadwp_settings {
				display: none;
			}
			#wp-admin-bar-updraft_admin_node {
				display: none;
			}
		</style>';	
	}	
}
add_action('admin_head', 'admin_css');

/* Remove "Howdy" from Admin */ 
add_filter('gettext', 'change_howdy', 10, 3);
function change_howdy($translated, $text, $domain) {
    if (!is_admin() || 'default' != $domain)
        return $translated;
    if (false !== strpos($translated, 'Howdy,'))
        return str_replace('Howdy,', '', $translated);
    return $translated;
}


/*
add_action( 'admin_init', 'debug_admin_menu' );
function debug_admin_menu() {
    echo '<pre style="margin:200px;">' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
}
*/

/* Remove some Admin menu pages by Role */ 
add_action( 'admin_menu', 'remove_menu_pages' );
function remove_menu_pages() {
	$user = wp_get_current_user();	
	if (in_array( 'editor', (array) $user->roles)) {
		remove_menu_page ('options-general.php');
		remove_menu_page ('profile.php');
		remove_menu_page ('themes.php');
		remove_menu_page ('tools.php');
		remove_menu_page ('user-new.php');
		remove_menu_page ('users.php');
		remove_menu_page ('layerslider');
		remove_menu_page ('searchandfilter-settings');
		remove_menu_page ('wpshapere-options');
		remove_menu_page ('edit.php?post_type=acf-field-group');
	}
}
?>