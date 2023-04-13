<?php if(!isset($_SESSION)) { session_start(); } ?>
<?php

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome_count_function.php');
	add_shortcode('connectome-count', 'connectome_count_function'); 
	
	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome_member_function.php');
	add_shortcode('connectome-member', 'connectome_member_function');  
	
	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome_top_buttons_function.php');
	add_shortcode('connectome-top-buttons', 'connectome_top_buttons_function'); 

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-alpha-search/connectome_alpha_search_function.php');
	add_shortcode('connectome-alpha-search', 'connectome_alpha_search_function'); 

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-category-search/connectome_category_search_function.php');
	add_shortcode('connectome-category-search', 'connectome_category_search_function'); 

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-display-name_degrees/connectome_display_name_degrees_function.php');
	add_shortcode('connectome-display-name-degrees', 'connectome_display_name_degrees_function'); 

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-display-publications/connectome_display_publications_function.php');
	add_shortcode('connectome-display-publications', 'connectome_display_publications_function');  

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-featured/connectome_featured_function.php');
	add_shortcode('connectome-featured', 'connectome_featured_function');  

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-research-search/connectome_research_search_function.php');
	add_shortcode('connectome-research-search', 'connectome_research_search_function'); 

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-role-search/connectome_role_search_function.php');
	add_shortcode('connectome-role-search', 'connectome_role_search_function');

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-affiliation-search/connectome_affiliation_search_function.php');
	add_shortcode('connectome-affiliation-search', 'connectome_affiliation_search_function');

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-search-all/connectome_search_all_function.php');
	add_shortcode('connectome-search-all', 'connectome_search_all_function'); 

	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-search-text/connectome_search_text_function.php');
	add_shortcode('connectome-search-text', 'connectome_search_text_function');
	 
	include(get_stylesheet_directory() . '/connectome/shortcodes/connectome-filters/connectome_filters_function.php');
	add_shortcode('connectome-filters', 'connectome_filters_function'); 
		
?>