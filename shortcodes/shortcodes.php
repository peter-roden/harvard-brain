<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php

	include(get_stylesheet_directory() . '/shortcodes/event-highlights/event_highlights_function.php');
	add_shortcode('event-highlights', 'event_highlights_function'); 

	include(get_stylesheet_directory() . '/shortcodes/event-highlights-columns/event_highlights_columns_function.php');
	add_shortcode('event-highlights-columns', 'event_highlights_columns_function'); 

	include(get_stylesheet_directory() . '/shortcodes/event-highlights-category/event_highlights_category_function.php');
	add_shortcode('event-highlights-category', 'event_highlights_category_function'); 

	include(get_stylesheet_directory() . '/shortcodes/hbi-staff-all/hbi_staff_all_function.php');
	add_shortcode('hbi-staff-all', 'hbi_staff_all_function'); 

	include(get_stylesheet_directory() . '/shortcodes/hbi-staff-featured/hbi_staff_featured_function.php');
	add_shortcode('hbi-staff-featured', 'hbi_staff_featured_function'); 

	include(get_stylesheet_directory() . '/shortcodes/hbi-staff-highlights/hbi_staff_highlights_function.php');
	add_shortcode('hbi-staff-highlights', 'hbi_staff_highlights_function'); 

	include(get_stylesheet_directory() . '/shortcodes/humans-all/humans_all_function.php');
	add_shortcode('humans-all', 'humans_all_function'); 

	include(get_stylesheet_directory() . '/shortcodes/humans-featured/humans_featured_function.php');
	add_shortcode('humans-featured', 'humans_featured_function'); 

	include(get_stylesheet_directory() . '/shortcodes/humans-featured-home/humans_featured_home_function.php');
	add_shortcode('humans-featured-home', 'humans_featured_home_function'); 

	include(get_stylesheet_directory() . '/shortcodes/humans-highlights/humans_highlights_function.php');
	add_shortcode('humans-highlights', 'humans_highlights_function'); 

	include(get_stylesheet_directory() . '/shortcodes/news-featured/news_featured_function.php');
	add_shortcode('news-featured', 'news_featured_function'); 
	
	include(get_stylesheet_directory() . '/shortcodes/events-landing-page/events_landing_page_function.php');
	add_shortcode('events-landing-page', 'events_landing_page_function'); 

	include(get_stylesheet_directory() . '/shortcodes/events-featured/events_featured_function.php');
	add_shortcode('events-featured', 'events_featured_function'); 

	include(get_stylesheet_directory() . '/shortcodes/news-highlights-new/news_highlights_new_function.php');
	add_shortcode('news-highlights-new', 'news_highlights_new_function'); 

	include(get_stylesheet_directory() . '/shortcodes/home-events/home_events_function.php');
	add_shortcode('home-events', 'home_events_function');   

	include(get_stylesheet_directory() . '/shortcodes/event-past-events/event_past_events_function.php');
	add_shortcode('event-past-events', 'event_past_events_function');  

	include(get_stylesheet_directory() . '/shortcodes/event-types/event_types_function.php');
	add_shortcode('event-types', 'event_types_function'); 

	include(get_stylesheet_directory() . '/shortcodes/home-news/home_news_function.php');
	add_shortcode('home-news', 'home_news_function'); 

	include(get_stylesheet_directory() . '/shortcodes/news-highlights-category/news_highlights_category_function.php');
	add_shortcode('news-highlights-category', 'news_highlights_category_function');  

	include(get_stylesheet_directory() . '/shortcodes/news-types/news_types_function.php');
	add_shortcode('news-types', 'news_types_function');  

	include(get_stylesheet_directory() . '/shortcodes/news-test/news_test_function.php');
	add_shortcode('news-test', 'news_test_function'); 

	include(get_stylesheet_directory() . '/shortcodes/pubmed-playlist/pubmed_playlist_function.php');
	add_shortcode('pubmed-playlist', 'pubmed_playlist_function'); 

	include(get_stylesheet_directory() . '/shortcodes/people-alpha-search/people_alpha_search_function.php');
	add_shortcode('people-alpha-search', 'people_alpha_search_function'); 

	include(get_stylesheet_directory() . '/shortcodes/people-neurotopics-search/people_neurotopics_search_function.php');
	add_shortcode('people-neurotopics-search', 'people_neurotopics_search_function'); 
	
	include(get_stylesheet_directory() . '/shortcodes/people-category-search/people_category_search_function.php');
	add_shortcode('people-category-search', 'people_category_search_function'); 

	include(get_stylesheet_directory() . '/shortcodes/people-featured/people_featured_function.php');
	add_shortcode('people-featured', 'people_featured_function');

	include(get_stylesheet_directory() . '/shortcodes/people-featured-home/people_featured_home_function.php');
	add_shortcode('people-featured-home', 'people_featured_home_function');  

	include(get_stylesheet_directory() . '/shortcodes/people-search-all/people_search_all_function.php');
	add_shortcode('people-search-all', 'people_search_all_function'); 

	include(get_stylesheet_directory() . '/shortcodes/people-search-text/people_search_text_function.php');
	add_shortcode('people-search-text', 'people_search_text_function');

	include(get_stylesheet_directory() . '/shortcodes/sidebar-menu/sidebar_menu_function.php');
	add_shortcode('sidebar-menu', 'sidebar_menu_function'); 

	include(get_stylesheet_directory() . '/shortcodes/neurotopics/neurotopics_function.php');
	add_shortcode('neurotopics', 'neurotopics_function');  

	include(get_stylesheet_directory() . '/shortcodes/test/test.php');
	add_shortcode('test', 'test_function'); 

		
?>