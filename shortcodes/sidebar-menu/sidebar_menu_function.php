<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function sidebar_menu_function ($atts){
		extract(shortcode_atts(array(
			'type' => 'For Scientists',
			'item' => 'HBI for Scientists'
		), $atts));
		
		$html = '';
/*
		$html .= 'type = ' . $type . '<br>';
		$html .= 'item = ' . $item . '<br>';
*/

		if ($type == 'About HBI') {
			
			$about 				= '<li class="item top"><a href="' . site_url() .'/about/">ABOUT HBI</a></li>';
			$leadership 		= '<li class="item"><a href="' . site_url() .'/leadership">Our Leadership</a></li>';
			$scientists 		= '<li class="item"><a href="' . site_url() .'/scientists">Our Scientists</a></li>';
			$contact 			= '<li class="item"><a href="' . site_url() .'/contact">Contact HBI</a></li>';
			$participate 		= '<li class="item"><a href="' . site_url() .'/participate">Participate</a></li>';
			$hbi_mailing_list 	= '<li class="item"><a href="' . site_url() .'/hbi-mailing-list/">HBI Mailing List</a></li>';
			
			switch ($item) { 
				
				case ('About HBI'):
					$about = '<li class="item top selected"><a class="selected" href="' . site_url() .'/about/">ABOUT HBI</a></li>';
					break;
				
				case ('Our Leadership'):
					$leadership = '<li class="item selected"><a class="selected" href="' . site_url() .'/leadership">Our Leadership</a></li>';
					break;
				
				case ('Our Scientists'):
					$scientists = '<li class="item selected"><a class="selected" href="' . site_url() .'/scientists">Our Scientists</a></li>';
					break;
				
				case ('Contact HBI'):
					$contact = '<li class="item selected"><a class="selected" href="' . site_url() .'/contact">Contact HBI</a></li>';
					break;
				
				case ('Participate'):
					$participate = '<li class="item selected"><a class="selected" href="' . site_url() .'/participate/">Participate</a></li>';
					break;
				
				case ('HBI Mailing List'):
					$hbi_mailing_list = '<li class="item selected"><a class="selected" href="' . site_url() .'/hbi-mailing-list/">HBI Mailing List</a></li>';
					break;

			}
			
			$html .= '<div class="left-nav">';
				$html .= '<ul>';
					$html .= $about;
					$html .= $leadership;
					$html .= $scientists;
					$html .= $contact;
					$html .= $participate;
					$html .= $hbi_mailing_list;
				$html .= '</ul>';
			$html .= '</div>';
			
		}

		if ($type == 'For Students') {
			
			$hbi_for_students 	= '<li class="item top selected"><a class="selected" href="' . site_url() .'/neuroscience-education/">HBI for Students</a></li>';
						
			$html .= '<div class="left-nav">';
				$html .= '<ul>';
					$html .= $hbi_for_students;
				$html .= '</ul>';
			$html .= '</div>';

		}

		if ($type == 'For Everyone') {
			
			$hbi_for_everyone 	= '<li class="item top"><a href="' . site_url() .'/hbi-for-everyone/">HBI for Everyone</a></li>';
			$events				= '<li class="item"><a href="' . site_url() .'/calendar/">Events</a></li>';
			$news 				= '<li class="item"><a href="' . site_url() .'/news/">News</a></li>';
			$braintour			= '<li class="item"><a href="http://braintour.harvard.edu">Braintour</a></li>';
			$support			= '<li class="item"><a href="' . site_url() .'/support-brain-research/">Support Brain Research</a></li>';
			
			switch ($item) {
				
				case ('HBI for Everyone'):
					$hbi_for_everyone = '<li class="item top selected"><a class="selected" href="' . site_url() .'/hbi-for-everyone/">HBI for Everyone</a></li>';
					break;
				
				case ('Events'):
					$events = '<li class="item selected"><a class="selected" href="' . site_url() .'/calendar/">Events</a></li>';
					break;
				
				case ('News'):
					$news = '<li class="item selected"><a class="selected" href="' . site_url() .'/news/">News</a></li>';
					break;
				
				case ('Braintour'):
					$news = '<li class="item selected"><a class="selected" href="http://braintour.harvard.edu">Braintour</a></li>';
					break;
				
				case ('Support Brain Research'):
					$support = '<li class="item selected"><a class="selected" href="' . site_url() .'/support-brain-research/">Support Brain Research</a></li>';
					break;
					
			}
			
			$html .= '<div class="left-nav">';
				$html .= '<ul>';
					$html .= $hbi_for_everyone;
					$html .= $events;
					$html .= $news;
					$html .= $braintour;
					$html .= $support;
				$html .= '</ul>';
			$html .= '</div>';

		}

		if ($type == 'For Scientists') {
			
			$hbi_for_scientists 		= '<li class="item top"><a href="' . site_url() .'/hbi-for-scientists/">HBI for Scientists</a></li>';
			$seed_grants 				= '<li class="item dropdown d1"><a href="' . site_url() .'/seed-grants">Seed Grants</a></li>';
			$collaborative_seed_grants 	= '<li class="item"><a href="' . site_url() .'/collaborative-seed-grants">Collaborative Seed Grants</a></li>';
			$als_grants 				= '<li class="item"><a href="' . site_url() .'/winthrop-fund-als">ALS Grants</a></li>';
			$psychiatric_disorders 		= '<li class="item"><a href="' . site_url() .'/psychiatric-disorders">Bipolar Disorder Seed Grants</a></li>';
			$postdocs 					= '<li class="item dropdown d2"><a href="' . site_url() .'/postdocs/">Affinity Groups</a></li>';
			$chronobiology_brain 		= '<li class="item"><a href="' . site_url() .'/chronobiology-brain">Chronobiology & The Brain</a></li>';
			$symposia 					= '<li class="item dropdown d3"><a href="' . site_url() .'/symposia">Symposia</a></li>';
			$abnormal_excitability 		= '<li class="item"><a href="' . site_url() .'/abnormal-excitability-determinant-nervous-system-disease">Abnormal Excitability as Determinant of Nervous System Disease</a></li>';
			$events_calendar 			= '<li class="item"><a href="' . site_url() .'/events-calendar/">Neuroscience Seminars</a></li>';
			$tools_technologies			= '<li class="item"><a href="' . site_url() .'/tools-technologies/">Core Facilities</a></li>';
			$mousekepdia 				= '<li class="item"><a href="' . site_url() .'/mousekepedia">Mousekepedia</a></li>';

			switch ($item) {
				
				case ('HBI for Scientists'):
					$hbi_for_scientists = '<li class="item top selected"><a class="selected" href="' . site_url() .'/hbi-for-scientists/">HBI for Scientists</a></li>';
					break;
				
				case ('Seed Grants'):
					$seed_grants = '<li class="item dropdown selected d1"><a class="selected" href="' . site_url() .'/seed-grants">Seed Grants</a></li>';
					break;
				
				case ('Collaborative Seed Grants'):
					$collaborative_seed_grants = '<li class="item selected"><a class="selected" href="' . site_url() .'/collaborative-seed-grants">Collaborative Seed Grants</a></li>';
					break;
				
				case ('ALS Grants'):
					$als_grants = '<li class="item selected"><a class="selected" href="' . site_url() .'/winthrop-fund-als">ALS Grants</a></li>';
					break;
				
				case ('Bipolar Disorder Seed Grants'):
					$psychiatric_disorders = '<li class="item selected"><a class="selected" href="' . site_url() .'/psychiatric-disorders">Bipolar Disorder Seed Grants</a></li>';
					break;
				
				case ('Affinity Groups'):
					$postdocs = '<li class="item dropdown selected d2"><a class="selected" href="' . site_url() .'/postdocs/">Affinity Groups</a></li>';
					break;
				
				case ('Chronobiology and The Brain'):
					$chronobiology_brain = '<li class="item selected"><a class="selected" href="' . site_url() .'/chronobiology-brain">Chronobiology & The Brain</a></li>';
					break;
				
				case ('Symposia'):
					$symposia = '<li class="item dropdown selected d3"><a class="selected" href="' . site_url() .'/symposia">Symposia</a></li>';
					break;
				
				case ('Abnormal Excitability as Determinant of Nervous System Disease'):
					$abnormal_excitability = '<li class="item selected"><a class="selected" href="' . site_url() .'/abnormal-excitability-determinant-nervous-system-disease">Abnormal Excitability as Determinant of Nervous System Disease</a></li>';
					break;

				case ('Neuroscience Seminars'):
					$events_calendar = '<li class="item selected"><a class="selected" href="' . site_url() .'/events-calendar/">Neuroscience Seminars</a></li>';
					break;
				
				case ('Core Facilities'):
					$tools_technologies = '<li class="item selected"><a class="selected" href="' . site_url() .'/tools-technologies/">Core Facilities</a></li>';
					break;
				
				case ('Mousekepedia'):
					$mousekepdia = '<li class="item selected"><a class="selected" href="' . site_url() .'/mousekepedia">Mousekepedia</a></li>';
					break;
				
			}
	    		    
			$html .= '<div class="left-nav">';
				$html .= '<ul>';
					$html .= $hbi_for_scientists;
					$html .= $seed_grants;
						$html .= '<ul class="sub-menu ul1">';
							$html .= $collaborative_seed_grants;
							$html .= $als_grants;
							$html .= $psychiatric_disorders;
						$html .= '</ul>';
					$html .= $postdocs;
						$html .= '<ul class="sub-menu ul2">';
							$html .= $chronobiology_brain;
						$html .= '</ul>';
					$html .= $symposia;
						$html .= '<ul class="sub-menu ul3">';;
							$html .= $abnormal_excitability;
						$html .= '</ul>';
					$html .= $events_calendar;
					$html .= $tools_technologies;
					$html .= $mousekepdia;
				$html .= '</ul>';
			$html .= '</div>';
		    
		}
		
		$html .= '<style>';
			$html .= 'ul1 { display: none; }';
			$html .= 'ul2 { display: none; }';
			$html .= 'ul3 { display: none; }';
		$html .= '</style>';
		
		$html .= '<script>';
			$html .= 'jQuery(document).ready(function( $ ) {';
				$html .= "$('.d1').hover(function(){";
		            $html .= "$('.ul1').fadeIn('slow');";
				$html .= '});';
				$html .= "$('.d2').hover(function(){";
		            $html .= "$('.ul2').fadeIn('slow');";
				$html .= '});';
				$html .= "$('.d3').hover(function(){";
		            $html .= "$('.ul3').fadeIn('slow');";
				$html .= '});';
			$html .= '});';
		$html .= '</script>';

		return $html;

	}
?>