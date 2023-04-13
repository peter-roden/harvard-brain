<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function connectome_member_function () {		
		
		$html = '';
		
				
		// echo 'profile:' . ' ' . $_SESSION['profile'] . '<br>';
		// echo 'login:  ' . ' ' . $_SESSION['login'] . '<br>';
		// echo 'id:     ' . $_GET['id'] . '<br>';
		
		if ($_SESSION['login']) {
		
			if (empty($_GET['id'])) {
		
				$html .= '<form id="connectome-member-desktop" class="connectome-member" enctype="multipart/form-data">';
							
					$html .= '<div class="desktop">';
						
						$html .= '<div class="row">';	
							
							$html .= '<div class="one-quarter">';
								$html .= '<div class="label">Upload Headshot*</div>';
									$html .= '<div class="field">';
										$html .= '<input type="file" id="image" name="image" onchange="readURL(this);" />';
										$html .= '<img id="image-preview" src="https://brain.harvard.edu/wp-content/uploads/choose-file.png">'; 
									$html .= '</div>';
							$html .= '</div>';								
							
							$html .= '<script type="text/javascript">';
								$html .= 'jQuery(document).ready(function($){'; 
									$html .= 'window.readURL = function(input) {';
										$html .= 'if (input.files && input.files[0]) {';
											$html .= 'var reader = new FileReader();';
											$html .= 'reader.onload = function (e) {';
												$html .= '$("#image-preview").attr("src", e.target.result);';
											$html .= '};';
											$html .= 'reader.readAsDataURL(input.files[0]);';
										$html .= '}';
									$html .= '}';
								$html .= '});';
							$html .= '</script>';
						
							$html .= '<div class="three-quarters">';
		
								$html .= '<div class="one-half extra-padding">';
									$html .= '<div class="label">First Name*</div>';
									$html .= '<div class="field"><input type="text" class="fname" id="fname" name="fname"></div>';
								$html .= '</div>';
										
								$html .= '<div class="one-half extra-padding last">';
									$html .= '<div class="label">Last Name*</div>';
									$html .= '<div class="field"><input type="text" id="lname" name="lname"></div>';
								$html .= '</div>';	
								
							$html .= '</div>';			
	
							$html .= '<div class="three-quarters">';
		
								$html .= '<div class="one-third extra-padding">';
									$html .= '<div class="label">Email*</div>';
									$html .= '<div class="field"><input type="email" id="email" name="email" value="' . $_SESSION['login'] . '" readonly></div>';
								$html .= '</div>';		
								
								$html .= '<div class="one-third extra-padding">';
									$html .= '<div class="label">Job Title*</div>';
									$html .= '<div class="field"><input type="text" id="job_title" name="job_title"></div>';
								$html .= '</div>';		
								
								$html .= '<div class="one-third extra-padding last">';
									$html .= '<div class="label">Role*</div>';
									$taxonomies=get_taxonomies('',''); 
									foreach($taxonomies as $taxonomy){
										if ($taxonomy->name == 'connectome_roles') {
											$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
											$html .= '<select name="role" id="role" class="required">';
												$html .= '<option value="">Select Role...</option>';
												foreach($terms as $term){
													$html .= '<option value="' . $term->name  . '">' . $term->name . '</option>';
												}
											$html .= '</select>';
										}
									}
								$html .= '</div>';
												
							$html .= '</div>';		
							
							$html .= '<div class="three-quarters">';
							
								$html .= '<div class="one-third extra-padding">';						
									$html .= '<div class="label">Personal Website<span class="optional">OPTIONAL</span></div>';
									$html .= '<div class="field"><input type="url" id="personal_website" name="personal_website"></div>';
								$html .= '</div>';
					
								
								$html .= '<div class="one-third extra-padding">';		
									$html .= '<div class="label">Personal Email<span class="optional">OPTIONAL</span></div>';
									$html .= '<div class="field"><input type="email" id="personal_email" name="personal_email"></div>';
								$html .= '</div>';	
								
								$html .= '<div class="one-third extra-padding last">';
									$html .= '<div class="label"><span class="instructions">Personal email is optional, however, we may want to  contact you after you graduate or complete your post-doc. Personal email will not display on your profile.</span></div>';
								$html .= '</div>';
								
							$html .= '</div>';		
	
							$html .= '<div class="three-quarters">';				
		
								$html .= '<div class="one-third extra-padding">';
									$html .= '<div class="label">Lab/Dept/Academic Program*</div>';
									$html .= '<div class="field"><input type="text" id="lab_name" name="lab_name"></div>';
								$html .= '</div>';
										
								$html .= '<div class="one-third extra-padding">';
									$html .= '<div class="label">Lab/Office Location*</div>';
									$html .= '<div class="field"><input type="text" id="lab_location" name="lab_location"></div>';
								$html .= '</div>';
										
								$html .= '<div class="one-third extra-padding last">';
									$html .= '<div class="label">Lab/Office Website<span class="optional">OPTIONAL</span></div>';
									$html .= '<div class="field"><input type="url" id="lab_website" name="lab_website"></div>';
								$html .= '</div>';
		
							$html .= '</div>';
						
							$html .= '<div class="three-quarters">';
								
								$html .= '<div class="one-third extra-padding">';
									$html .= '<div class="label">Personal Pronoun<span class="optional">OPTIONAL</span></div>';
									$html .= '<div class="field"><input type="text" id="pronoun" name="pronoun"></div>';
								$html .= '</div>';
							
								$html .= '<div class="one-third extra-padding">';
									$html .= '<div class="label">Pronunciation<span class="optional">OPTIONAL</span></div>';
									$html .= '<div class="field"><input type="text" id="pronunciation" name="pronunciation"></div>';
								$html .= '</div>';
								
								$html .= '<div class="one-third extra-padding last">';
									$html .= '<div class="label">Pubmed Link<span class="optional">OPTIONAL</span></div>';
									$html .= '<div class="field"><input type="url" id="pubmed_link" name="pubmed_link"></div>';
								$html .= '</div>';
							
							$html .= '</div>';
										
							$html .= '<div class="one-quarter extra-padding mobile-padding">';
								$html .= '<div class="label">Choose Your Neuro Topics</div>';
								
								$neuro_topics_args = array(
									'post_type' 	=> 'neuro-topics',
									'posts_per_page'=>  -1,
									'post_status' 	=> 'publish',
									'orderby' 		=> 'title',
									'order' 		=> 'ASC'
								);	
								$neuro_topics_query = new WP_Query( $neuro_topics_args );
								if ($neuro_topics_query->have_posts()) :
									while ( $neuro_topics_query->have_posts() ) :
										$neuro_topics_query->the_post();
										$neuro_topics_title = get_the_title($neuro_topics_query->ID);
										$html .= '<input type="checkbox" id="research_interests" name="research_interests[]" value="' . $neuro_topics_query->ID . '"><span class="checkbox-name">' . $neuro_topics_title. '</span><br>';
									endwhile;
								endif;
							
							$html .= '</div>';
														
							$html .= '<div class="one-quarter extra-padding ">';
								$html .= '<div class="label">Campus*</div>';
								$taxonomies=get_taxonomies('',''); 
								foreach($taxonomies as $taxonomy){
									if ($taxonomy->name == 'connectome_campuses') {
										$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
										foreach($terms as $term){			
											$html .= '<input type="checkbox" id="campuses" name="campuses[]" value="' . $term->term_id . '"><span class="checkbox-name">' . $term->name . '</span><br>';
										}
									}
								}
							$html .= '</div>';
						
							$html .= '<div class="one-half extra-padding last">';
		
								$html .= '<div class="label">About Me</div>';
								$html .= '<textarea id="about_me" name="about_me"></textarea>';
								$html .= '<div class="extra-padding">';	
									$html .= '<div class="label"><span class="instructions">PLEASE PROVIDE A SHORT, LAY AUDIENCE FRIENDLY DESCRIPTION OF YOUR RESEARCH OR JOB. CONSIDER SHARING YOUR CURRENT PROGAM, CAMPUS GROUPS YOU ARE A PART OF, WHERE YOU GREW UP OR WENT TO SCHOOL, ANY HOBBIES, ETC. PLEASE LIMIT TO 600 WORDS </span></div>';
								$html .= '</div>';
								
							$html .= '</div>';
						
						$html .= '</div>';
						
						$html .= '<div class="row acceptance">';
						
							$html .= '<input type="checkbox" id="acceptance" name="acceptance" value="Y" class="required">';
							$html .= 'I GIVE PERMISSION FOR MY INFORMATION TO BE SHARED PUBLICLY ON THE HARVARD BRAIN SCIENCE INITIATIVE WEBSITE. I UNDERSTAND I CAN CHANGE AND/OR DELETE MY INFORMATION AT ANY TIME. IN ADDITION, I UNDERSTAND THE INFORMATION I ADD IS STORED ONLY IN THE HBI CONNECTOME. CHANGES TO MY CONNECTOME PROFILE, INCLUDING MY NAME, STATUS, AND OTHER DETAILS, DO NOT AFFECT MY HARVARD KEY OR INFORMATION STORED IN ANY OTHER HARVARD DIRECTORY.';
					
						$html .= '</div>';		
									
						$html .= '<div class="row last-row">';
															
							$html .= '<div class="notice">';
								$html .= '<div class="line">All Connectome Profiles need to be approved before publication.</div>';
								$html .= '<div class="line">You will receive an email letting you know when it has been published.</div>';
							$html .= '</div>';
															
							$html .= '<div class="buttons">';
								$html .= '<div class="submit"><input type="submit" value="Submit"></div>';
								$html .= '<div class="submit"><a id="clear" onclick="clearForm(this);">Clear</div>';
								$html .= '<div class="submit grey"><a id="clear">Delete</div>';
							$html .= '</div>';
							
							$html .= '<script type="text/javascript">';
								$html .= 'jQuery(document).ready(function($){'; 
									$html .= '$( "form.connectome-member .desktop .buttons .submit" ).hover(function() {';
										$html .= '$( "form.connectome-member .desktop .notice" ).toggle();';  
									$html .= '});';
									$html .= 'window.clearForm = function(input) {';
										$html .= '$("#connectome-member-desktop").trigger("reset");';
										$html .= '$("#connectome-member-desktop label").removeClass("error");';
										$html .= '$("#connectome-member-desktop label[id*=-error]").text("");';
										$html .= '$("#image-preview").attr("src","https://brain.harvard.edu/wp-content/uploads/choose-file.png");';
									$html .= '}';
								$html .= '});';
							$html .= '</script>';						
						
						$html .= '</div>';			
						
					$html .= '</div>';	
		
				$html .= '</form>';	
				
				$html .= '<div id="errors"></div>';	
				$html .= '<div id="response" class="response" style="display:none">';
					// $html .= '<p>Your submission is uploading.  It may take a few moments.  Please be patient...</p>';
				$html .= '</div>';	
				$html .= '<div id="member-results"></div>';	 
	
			} else {		
							
				$id = $_GET['id'];
				
				$args = array(
					'post_type'			=> 'hbi_connectome',
					'posts_per_page'	=> -1,
					'post_status' 		=> array('publish', 'pending')    
				);
			
				$query = new WP_Query($args);
				
				$count = 0;
				if ($query->have_posts()) {
					while($query->have_posts()) {
						$query->the_post();
												
						if ($_SESSION['login'] === get_field('email')) :
								
						
						$html .= '<form id="connectome-member-desktop" class="connectome-member" enctype="multipart/form-data">';
								
						$html .= '<div class="desktop">';
							
							$html .= '<div class="row">';	
								
								$html .= '<div class="one-quarter">';
									$html .= '<div class="label">Upload Headshot*</div>';
										$html .= '<div class="field">';
											$html .= '<input type="file" id="image" name="image" onchange="readURL(this);" />';
											$html .= '<img id="image-preview" src="' .  get_the_post_thumbnail_url($id,'full') . '">'; 
										$html .= '</div>';
								$html .= '</div>';								
								
								$html .= '<script type="text/javascript">';
									$html .= 'jQuery(document).ready(function($){'; 
										$html .= 'window.readURL = function(input) {';
											$html .= 'if (input.files && input.files[0]) {';
												$html .= 'var reader = new FileReader();';
												$html .= 'reader.onload = function (e) {';
													$html .= '$("#image-preview").attr("src", e.target.result);';
												$html .= '};';
												$html .= 'reader.readAsDataURL(input.files[0]);';
											$html .= '}';
										$html .= '}';
									$html .= '});';
								$html .= '</script>';
							
								$html .= '<div class="three-quarters">';
			
									$html .= '<div class="one-half extra-padding">';
										$html .= '<div class="label">First Name*</div>';
										$html .= '<div class="field"><input type="text" class="fname" id="fname" name="fname" value="' . get_field("fname")  . '"></div>';
									$html .= '</div>';
											
									$html .= '<div class="one-half extra-padding last">';
										$html .= '<div class="label">Last Name*</div>';
										$html .= '<div class="field"><input type="text" class="lname" id="lname" name="lname" value="' . get_field("lname")  . '"></div>';
									$html .= '</div>';	
									
								$html .= '</div>';			
		
								$html .= '<div class="three-quarters">';
			
									$html .= '<div class="one-third extra-padding">';
										$html .= '<div class="label">Email*</div>';
										$html .= '<div class="field"><input type="text" class="email" id="email" name="email" value="' . $_SESSION['login']  . '" readonly></div>';
									$html .= '</div>';		
									
									$html .= '<div class="one-third extra-padding">';
										$html .= '<div class="label">Job Title*</div>';
										$html .= '<div class="field"><input type="text" id="job_title" name="job_title" value="' . get_field("job_title")  . '"></div>';
									$html .= '</div>';		
										
									$html .= '<div class="one-third extra-padding last">';
										$html .= '<div class="label">Role*</div>';
										$taxonomies=get_taxonomies('',''); 
										foreach($taxonomies as $taxonomy){
											if ($taxonomy->name == 'connectome_roles') {
												$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
												$roles = wp_get_object_terms ($id, 'connectome_roles');
												$html .= '<select name="role" id="role" class="required">';
													$html .= '<option value="">Select Role...</option>';
													foreach($terms as $term){
														foreach ($roles as $role) {
															if ($term->name == $role->name) {
																$html .= '<option value="' . $term->name  . '" selected>' . $term->name . '</option>';
															} else {
																$html .= '<option value="' . $term->name  . '">' . $term->name . '</option>';
															}
														}
													}
												$html .= '</select>';
											}
										}
									$html .= '</div>';
			
								$html .= '</div>';		
								
								$html .= '<div class="three-quarters">';
								
									$html .= '<div class="one-third extra-padding">';						
										$html .= '<div class="label">Personal Website<span class="optional">OPTIONAL</span></div>';
										$html .= '<div class="field"><input type="url" id="personal_website" name="personal_website" value="' . get_field("personal_website")  . '"></div>';
									$html .= '</div>';
												
									$html .= '<div class="one-third extra-padding">';
										$html .= '<div class="label">Personal Email<span class="optional">OPTIONAL</span></div>';
										$html .= '<div class="field"><input type="email" id="personal_email" name="personal_email" value="' . get_field("personal_email")  . '"></div>';
									$html .= '</div>';	
									
									$html .= '<div class="one-third extra-padding last">';
										$html .= '<div class="label"><span class="instructions">Personal email is optional, however, we may want to  contact you after you graduate or complete your post-doc. Personal email will not display on your profile.</span></div>';
									$html .= '</div>';
									
								$html .= '</div>';		
		
								$html .= '<div class="three-quarters">';				
			
									$html .= '<div class="one-third extra-padding">';
										$html .= '<div class="label">Lab/Dept/Academic Program*</div>';
										$html .= '<div class="field"><input type="text" id="lab_name" name="lab_name" value="' . get_field("lab_name")  . '"></div>';
									$html .= '</div>';
											
									$html .= '<div class="one-third extra-padding">';
										$html .= '<div class="label">Lab/Office Location*</div>';
										$html .= '<div class="field"><input type="text" id="lab_location" name="lab_location" value="' . get_field("lab_location")  . '"></div>';
									$html .= '</div>';
											
									$html .= '<div class="one-third extra-padding last">';
										$html .= '<div class="label">Lab/Office Website<span class="optional">OPTIONAL</span></div>';
										$html .= '<div class="field"><input type="url" id="lab_website" name="lab_website" value="' . get_field("lab_website")  . '"></div>';
									$html .= '</div>';
			
								$html .= '</div>';
								
								$html .= '<div class="three-quarters">';				
		
									$html .= '<div class="one-third extra-padding">';
										$html .= '<div class="label">Personal Pronoun<span class="optional">OPTIONAL</span></div>';
										$html .= '<div class="field"><input type="text" id="pronoun" name="pronoun" value="' . get_field("pronoun")  . '"></div>';
									$html .= '</div>';
											
									$html .= '<div class="one-third extra-padding">';
										$html .= '<div class="label">Pronunciation<span class="optional">OPTIONAL</span></div>';
										$html .= '<div class="field"><input type="text" id="pronunciation" name="pronunciation" value="' . get_field("pronunciation")  . '"></div>';
									$html .= '</div>';
											
									$html .= '<div class="one-third extra-padding last">';
										$html .= '<div class="label">Pubmed Link<span class="optional">OPTIONAL</span></div>';
										$html .= '<div class="field"><input type="url" id="pubmed_link" name="pubmed_link" value="' . get_field("pubmed_link")  . '"></div>';
									$html .= '</div>';
			
								$html .= '</div>';
											
								$html .= '<div class="one-quarter extra-padding mobile-padding">';
									$html .= '<div class="label">Choose Your Neuro Topics</div>';
										
										$neuro_ids = get_field('neuro_topics');
										$neuro_topics_args = array(
											'post_type' 	=> 'neuro-topics',
											'posts_per_page'=>  -1,
											'post_status' 	=> 'publish',
											'orderby' 		=> 'title',
											'order' 		=> 'ASC'
										);	
										$neuro_topics_query = new WP_Query( $neuro_topics_args );
										if ($neuro_topics_query->have_posts()) :			
											$found = FALSE;
											while ( $neuro_topics_query->have_posts() ) :
												$neuro_topics_query->the_post();
												
												foreach ($neuro_ids as $neuro_id) :
													if ($neuro_topics_query->ID == $neuro_id) {
														$found = TRUE;
														$html .= '<input type="checkbox" id="research_interests" name="research_interests[]" value="' . $neuro_topics_query->ID . '" checked><span class="checkbox-name">' . get_the_title($neuro_topics_query->ID)  . '</span><br>';
													}
													if (!$found) {
														$html .= '<input type="checkbox" id="research_interests" name="research_interests[]" value="' . $neuro_topics_query->ID  . '" ><span class="checkbox-name">' . get_the_title($neuro_topics_query->ID) . '</span><br>';	
													}
												endforeach;
												
											endwhile;
										endif;
									
									$html .= '</div>';
									
									$taxonomies=get_taxonomies('',''); 
									foreach($taxonomies as $taxonomy){
										if ($taxonomy->name == 'connectome_research_interests') {
											$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
											$research_interests = wp_get_object_terms ($id, 'connectome_research_interests');
											foreach($terms as $term){			
												$found = FALSE;
												foreach ($research_interests as $research_interest) {	
													if ($term->name == $research_interest->name) {
														$found = TRUE;
														$html .= '<input type="checkbox" id="research_interests" name="research_interests[]" value="' . $term->term_id . '" checked><span class="checkbox-name">' . $term->name . '</span><br>';
													} 
												}
												if (!$found) {
													$html .= '<input type="checkbox" id="research_interests" name="research_interests[]" value="' . $term->term_id . '" ><span class="checkbox-name">' . $term->name . '</span><br>';												
												}
											}
										}
									}
								$html .= '</div>';
								
								$html .= '<div class="one-quarter extra-padding">';
									$html .= '<div class="label">Campus*</div>';
									$taxonomies=get_taxonomies('',''); 
									foreach($taxonomies as $taxonomy){
										if ($taxonomy->name == 'connectome_campuses') {
											$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=0' );
											$campuses = wp_get_object_terms ($id, 'connectome_campuses');
											foreach($terms as $term){			
												$found = FALSE;
												foreach ($campuses as $campus) {	
													if ($term->name == $campus->name) {
														$found = TRUE;
														$html .= '<input type="checkbox" id="campuses" name="campuses[]" value="' . $term->term_id . '" checked><span class="checkbox-name">' . $term->name . '</span><br>';
													} 
												}
												if (!$found) {
													$html .= '<input type="checkbox" id="campuses" name="campuses[]" value="' . $term->term_id . '" ><span class="checkbox-name">' . $term->name . '</span><br>';												
												}
											}
										}
									}
								$html .= '</div>';
							
								$html .= '<div class="one-half">';
			
									$html .= '<div class="label">About Me</div>';
									$html .= '<textarea id="about_me" name="about_me">' . get_field('about_me') . ' </textarea>';
									$html .= '<div class="extra-padding">';	
										$html .= '<div class="label"><span class="instructions">PLEASE PROVIDE A SHORT, LAY AUDIENCE FRIENDLY DESCRIPTION OF YOUR RESEARCH OR JOB. CONSIDER SHARING YOUR CURRENT PROGAM, CAMPUS GROUPS YOU ARE A PART OF, WHERE YOU GREW UP OR WENT TO SCHOOL, ANY HOBBIES, ETC. PLEASE LIMIT TO 600 WORDS</span></div>';
									$html .= '</div>';
							
								$html .= '</div>';
						
							$html .= '</div>';
														
							$html .= '<div class="row acceptance">';
							
								$html .= '<input type="checkbox" id="acceptance" name="acceptance" value="Y" class="required">';
								$html .= 'I GIVE PERMISSION FOR MY INFORMATION TO BE SHARED PUBLICLY ON THE HARVARD BRAIN SCIENCE INITIATIVE WEBSITE. I UNDERSTAND I CAN CHANGE AND/OR DELETE MY INFORMATION AT ANY TIME. IN ADDITION, I UNDERSTAND THE INFORMATION I ADD IS STORED ONLY IN THE HBI CONNECTOME. CHANGES TO MY CONNECTOME PROFILE, INCLUDING MY NAME, STATUS, AND OTHER DETAILS, DO NOT AFFECT MY HARVARD KEY OR INFORMATION STORED IN ANY OTHER HARVARD DIRECTORY.';
						
							$html .= '</div>';		
										
							$html .= '<div class="row last-row">';
																
								if ($id) { $html .= '<input type="hidden" id="id" name="id" value="' . $id . '">'; }
														
								
								$html .= '<div class="notice">';
									$html .= '<div class="line">All Connectome Profiles need to be approved before publication.</div>';
									$html .= '<div class="line">You will receive an email letting you know when it has been published.</div>';
								$html .= '</div>';
																
								$html .= '<div class="buttons">';
									$html .= '<div class="submit"><input type="submit" value="Submit"></div>';
									$html .= '<div class="submit"><a id="clear" onclick="clearForm(this);">Clear</div>';
									$html .= '<div id="delete" class="submit grey"><a id="clear">Delete</div>';
								$html .= '</div>';
								
								$html .= '<script type="text/javascript">';
									$html .= 'jQuery(document).ready(function($){'; 
										$html .= '$( "form.connectome-member .desktop .buttons .submit" ).hover(function() {';
											$html .= '$( "form.connectome-member .desktop .notice" ).toggle();';  
										$html .= '});';
										$html .= 'window.clearForm = function(input) {';
											$html .= '$("#connectome-member-desktop").trigger("reset");';
											$html .= '$("#connectome-member-desktop label").removeClass("error");';
											$html .= '$("#connectome-member-desktop label[id*=-error]").text("");';
											$html .= '$("#image-preview").attr("src","https://brain.harvard.edu/wp-content/uploads/choose-file.png");';
										$html .= '}';
									$html .= '});';
								$html .= '</script>';	
								
								$html .= '<script type="text/javascript">'; 
									$html .= 'jQuery(document).ready(function($) {';	
										$html .= '$("#delete").click(function() {';
											$html .= 'var c = confirm("Please click OK to confirm that you want to delete your profile.");';
											$html .= 'if (c==true) {';
												$html .= '$("body").loadingModal({'; 
													$html .= 'position: "auto",';
													$html .= 'text: "Deleting your Connectome profile. This may take a moment or so.  Please wait...",';
													$html .= 'color: "#4498AF",';
													$html .= 'opacity: "0.7",';
													$html .= 'backgroundColor: "rgb(0,0,0)",';
													$html .= 'animation: "fadingCircle"';
												$html .= '});';
												$html .= 'var id = "' . $_GET['id'] . '";';
												$html .= 'var data = {';
													$html .= "'action': 'connectome_member_delete',";
													$html .= "'id': id,";
													$html .= "'nonce': frontEndAjax.nonce";
												$html .= '};';
													$html .= '$.post(frontEndAjax.ajaxurl, data, function(result) {';
														$html .= '$("body").loadingModal("destroy");';
														$html .= 'window.location.href = "http://brain.harvard.edu/connectome/";';
												 	$html .= '});';
												$html .= 'return false;';
											$html .= '}';
										$html .= '});';		
									$html .= '});';
								$html .= '</script>'; 													
							
							$html .= '</div>';			
							
						$html .= '</div>';	
			
					$html .= '</form>';	
						
					endif;
					
					$html .= '<div id="errors"></div>';	
					$html .= '<div id="response" class="response" style="display:none">';
						// $html .= '<p>Your submission is uploading.  It may take a few moments.  Please be patient...</p>';
					$html .= '</div>';	
					$html .= '<div id="member-results"></div>';	 
		
					}				
				}				
			}
			
		} else {
			
			$html .= 'Please login using your Harvard Key to create/edit your profile.<br><br>';
			
		}
						
	
		$html .= '<script type="text/javascript">'; 
			
			$html .= 'jQuery(document).ready(function($){'; 
		
				$html .= '$.validator.addMethod("filesize", function (value, element, param) {';
					$html .= 'return this.optional(element) || (element.files[0].size <= param)';
				$html .= '}, function(size){';
					$html .= 'return "Please enter a smaller image. Maximum size is " + filesize(size,{exponent:2,round:1}) + ".";';
				$html .= '});';
	
				$html .= '$("#connectome-member-desktop").validate({';
					$html .= 'rules: {';
						$html .= 'image: {';
							if (empty($_GET['id'])) { $html .= 'required: true,'; }
							$html .= 'extension: "png|jpg|jpeg",';
							$html .= 'filesize: 5000 * 1024';
						$html .= '},';
						$html .= 'fname: {';
							$html .= 'required: true';
						$html .= '},';
						$html .= 'lname: {';
							$html .= 'required: true';
						$html .= '},';
						$html .= 'email: {';
							$html .= 'required: true,';
							$html .= 'email: true';
						$html .= '},';
						$html .= 'job_title: {';
							$html .= 'required: true';
						$html .= '},';
						$html .= 'role: {';
							$html .= 'required: true';
						$html .= '},';
						$html .= 'personal_wesbite: {';
							$html .= 'url: true';
						$html .= '},';
						$html .= 'personal_email: {';
							$html .= 'email: true';
						$html .= '},';
						$html .= 'lab_name: {';
							$html .= 'required: true';
						$html .= '},';
						$html .= 'lab_location: {';
							$html .= 'required: true';
						$html .= '},';
						$html .= 'lab_website: {';
							$html .= 'url: true';
						$html .= '},';
						$html .= 'pubmed_link: {';
							$html .= 'url: true';
						$html .= '},';
						$html .= 'campuses: {';
							$html .= 'required: true';
						$html .= '},';
						$html .= 'acceptance: {';
							$html .= 'required: true';
						$html .= '}';
					$html .= '},';
					$html .= 'messages: {';
						$html .= 'image: {';
							if (empty($_GET['id'])) { $html .= 'required: "Please enter your Headshot.",'; }
							$html .= 'extension: "Please enter a PNG or JPEG image.",';
							$html .= 'filesize: "Please enter a smaller image.  Maximum size is 5MB."';
						$html .= '},';
						$html .= 'fname: {';
							$html .= 'required: "Please enter your First Name."';
						$html .= '},';
						$html .= 'lname: {';
							$html .= 'required: "Please enter your Last Name."';
						$html .= '},';
						$html .= 'email: {';
							$html .= 'required: "Please enter your Email Address.",';
							$html .= 'email: "Please enter a valid Email Address."';
						$html .= '},';
						$html .= 'job_title: {';
							$html .= 'required: "Please enter your Job Title."';
						$html .= '},';
						$html .= 'role: {';
							$html .= 'required: "Please enter your Role."';
						$html .= '},';
						$html .= 'personal_website: {';
							$html .= 'url: "Please enter a valid URL, such as https://example.com"';
						$html .= '},';
						$html .= 'personal_email: {';
							$html .= 'email: "Please enter a valid email address."';
						$html .= '},';
						$html .= 'lab_name: {';
							$html .= 'required: "Please enter your Lab Name."';
						$html .= '},';
						$html .= 'lab_location: {';
							$html .= 'required: "Please enter your Lab Location."';
						$html .= '},';
						$html .= 'lab_website: {';
							$html .= 'url: "Please enter a valid URL, such as https://example.com"';
						$html .= '},';
						$html .= 'pubmed_link: {';
							$html .= 'url: "Please enter a valid URL, such as https://example.com"';
						$html .= '},';
						$html .= 'campuses: {';
							$html .= 'required: "Please enter a Campus."';
						$html .= '},';
						$html .= 'acceptance: {';
							$html .= 'required: "Please indicate your Acceptance of the Terms & Conditions."';
						$html .= '} ';       
					$html .= '},';
					$html .= 'errorPlacement: function(label, element) {';
						$html .= 'label.addClass("error-message");';
						$html .= 'element.parent().append(label);';
					$html .= '},';
					$html .= 'submitHandler: function(form) {';
						$html .= '$("#response").show();';
						$html .= '$("body").loadingModal({'; 
							$html .= 'position: "auto",';
							$html .= 'text: "Submitting your Connectome profile. This may take a moment or so.  Please wait...",';
							$html .= 'color: "#4498AF",';
							$html .= 'opacity: "0.7",';
							$html .= 'backgroundColor: "rgb(0,0,0)",';
							$html .= 'animation: "fadingCircle"';
						$html .= '});';
						$html .= 'var formData = new FormData(form);';
						$html .= 'formData.append("action", "connectome_member_form");';
						$html .= 'formData.append("nonce", frontEndAjax.nonce);';
						$html .= 'formData.append("image", $("#image")[0].files[0]);';
						$html .= '$.ajax({';
							$html .= 'url: frontEndAjax.ajaxurl,';
							$html .= 'type: "POST",';
							$html .= 'data:  formData,';
							$html .= 'mimeType: "multipart/form-data",';
							$html .= 'contentType: false,';
							$html .= 'processData: false,';
							$html .= 'success: function(data){';
								$html .= '$("body").loadingModal("destroy");';
								$html .= 'window.location.href = "https://brain.harvard.edu/connectome/success/";';
							$html .= '}';        
						$html .= '});';
						$html .= 'return false;';
					$html .= '}';		    
				$html .= '});';

			$html .= '});';
		$html .= '</script>';   
	
	return $html;


	}
?>
