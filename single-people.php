<?php 
	
	get_header(); 

	echo '<div id="main-content">';
		
		echo '<div class="container">';
		
			echo '<div id="content-area" class="clearfix">';
	
				while ( have_posts() ) : the_post();
	
					$rows = get_field('degrees');
					$c = count($rows);				
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
	
	
					$rows = get_field('titles');
					$c = count($rows);							
					$titles = '';
					$affilitations_title = 'Affiliation';
					$n = 0;
					if($rows) {
						foreach($rows as $row) {
							$n++;
							
							if ($row['affiliation'] == '[blank]') {
							
								if ($n == $c) {
									$titles .= '<span>' .
													$row['title'] . 
												'</span>';
								} else {
									$titles .= '<span>' .
													$row['title'] .
												'</span>' .
												'<br>';
								}
						
							} else {
								
								if ($n == $c) {
									$titles .= '<span>' .
													$row['title'] . ', ' . 
												'</span>' .
												'<span>' . 
												$row['affiliation'] . 
												'</span>';
								} else {
									$titles .= '<span>' .
													$row['title'] . ', ' . 
												'</span>' .
												'<span>' . 
												$row['affiliation'] . 
												'</span>' .
												'<br>';
								}
								if ($n > 1) { $affilitations_title = 'Affiliations'; }
								$affilitations .= '<span>' . 
												  $row['affiliation'] . 
												  '</span>' .
												  '<br>';								
																
							}
						
						}
					}
	
					$image = get_field('headshot');
					$size = 'thumbnail'; 						
					if( $image ) {
						$headshot = wp_get_attachment_image( $image, $size );
					}
					
					$image = get_field('large_image');
					$size = 'full'; 						
					if($image) {
						$large_image = wp_get_attachment_image($image, $size);
					} 
					
					$research_areas = '';
					$research_areas_title = 'Neuro Topic';
					$term_array = array();
					$terms = get_field('neuro_topics');
					if($terms){
						if (count($terms) > 1) { $research_areas_title = 'Neuro Topics'; }
						foreach( $terms as $term ) {
							$neuro_topics_title = get_the_title($term->ID);
							$research_areas .= $neuro_topics_title .'<br>';
						}
					}
	
					$websites = '';
					$websites_title = 'Website';
					$rows = get_field('websites');
					if($rows) {					
						$c = 0;
						if (count($rows) > 1) {$websites_title = 'Websites';}
						foreach($rows as $row) {
							$c++;
							if ($c > 1) {
								$websites .= '<a ' . 'href="' . $row[website_link] . 
													'" target="_blank">' .
													 $row[website_name] .
										 '</a><br>';
							} else {
								$websites .= '<a ' . 'href="' . $row[website_link] . 
													'" target="_blank">' .
													 $row[website_name] .
										 '</a>';
							}
						}
					}
	
					$address = '';
					$contact = get_field('contact');	
					if($contact) {
						$address .= $contact[organization] .'<br>';
						$address .= $contact[address1] . '<br>';
						if ($contact[address2]) { $address .= $contact[address2] . '<br>'; }
						if ($contact[address3]) { $address .= $contact[address3] . '<br>'; }
						$address .= $contact[city] . ', ' . $contact[state] . ' ' . $contact[zip] . '<br><br>';
						if ($contact[email]) { 
							$address .= '<a href="mailto:' . $contact[email] . '">' . $contact[email] . '</a><br>';
						}
						if ($contact[phone]) { 
							$address .= '<a href="tel:' . $contact[phone] . '">' . 
											substr($contact[phone],0,3) . '-' .
											substr($contact[phone],3,3) . '-' .
											substr($contact[phone],6,4) .
										'</a><br><br>';
						}
						$location = $contact[map];
						if($location) {
							$address .= '<i class="fa fa-map-marker" aria-hidden="true"></i>' .
										'<a href="https://www.google.com/maps/search/?api=1&query=' . 
											$location['lat'] . ','  . $location['lng'] . '" ' .
											'target="_blank">' .
											'View Map' .
										'</a>';
						}
				
					}
				
					if ($large_image) {
						echo '<div class="title">';
							echo the_title() . ', ' . $degrees;
						echo '</div>';									
						echo '<div class="subtitle">';
							echo $titles;
						echo '</div>';								
					} 

					echo '<div class="et_pb_section  et_section_regular">';
						echo '<div class=" et_pb_row et_pb_gutters1 et_pb_row_fullwidth content-container">';

						
							echo '<div class="et_pb_column et_pb_column_2_3  et_pb_css_mix_blend_mode_passthrough content-left">';
								echo '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left">';
									echo '<div class="et_pb_text_inner">';
									
																			
										if ($large_image) {							
											echo '<div class="large-image">';
												echo $large_image;
											echo '</div>';
											echo '<div class="description">';
												echo '<div class="description-title">';
													echo the_field('research_interests_title');
												echo '</div>';
												echo the_field('research_interests');
											echo '</div>';	
											
										} else {
											echo '<div class="no-large-image">';
												echo '<div class="thumbnail">';
													echo $headshot;
												echo '</div>';
												echo '<div class="text">';
													echo '<div class="title">';
														echo the_title() . ', ' . $degrees;
													echo '</div>';									
													echo '<div class="subtitle">';
														echo $titles;
													echo '</div>';
													echo '<div class="description-title">';
														echo the_field('research_interests_title');
													echo '</div>';
													echo the_field('research_interests');
												echo '</div>';
											echo '</div>';											
										}

									echo '</div>';
								echo '</div> <!-- .et_pb_text -->';
							echo '</div> <!-- .et_pb_column -->';
							
							echo '<div class="et_pb_column et_pb_column_1_3  et_pb_css_mix_blend_mode_passthrough et-last-child content-right">';
								echo '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left ">';
									echo '<div class="et_pb_text_inner">';
									
										echo '<div class="sidebar">';
										
											echo '<div class="label">';
												echo 'Contact';
											echo '</div>';
											echo '<div class="item">';
												echo $address;
												echo $map;
											echo '</div>';
										
											if ($websites) {
												echo '<div class="label">';
													echo $websites_title;
												echo '</div>';
												echo '<div class="item">';
													echo $websites;
												echo '</div>';
											}
										
											if ($research_areas) {
												echo '<div class="label">';
													echo $research_areas_title;
												echo '</div>';
												echo '<div class="item">';
													echo $research_areas;
												echo '</div>';
											}
										
											if ($affilitations) {
												echo '<div class="label">';
													echo $affilitations_title;
												echo '</div>';
												echo '<div class="item">';
													echo $affilitations;
												echo '</div>';
											}

										echo '</div>';

									echo '</div>';
								echo '</div> <!-- .et_pb_text -->';
							echo '</div> <!-- .et_pb_column -->';
						
						
						echo '</div> <!-- .et_pb_row -->';
					echo '</div> <!-- .et_pb_section -->';
	
				endwhile;			
			
			echo '</div> <!-- #content-area -->';
		
		echo '</div> <!-- .container -->';
	
	echo '</div> <!-- #main-content -->';

	get_footer(); 

?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_vYm2T-xnT3yjvKWpH6xTZwhAkZ7QEFs"></script>
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {
	
	// var
	var $markers = $el.find('.marker');
	
	
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};
	
	
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
	
	
	// add a markers reference
	map.markers = [];
	
	
	// add markers
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	
	// center map
	center_map( map );
	
	
	// return
	return map;
	
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);
</script>
