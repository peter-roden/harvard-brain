<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
	
	function test_function () {		
		
		$html = '';			
		

		$html .= 
		$html .= '<form id="test" enctype="multipart/form-data">';
											
					
/*
					$html .= '<div class="one-quarter">';											
						$html .= '<div class="label">Upload Headshot*<span class="instructions">(JPG or PNG)</span></div>';
						$html .= '<div class="field"><input type="file" id="image" name="image" size="25" /></div>';
						$html .= '<div class="instructions">One Square Image.  Minimum size is 500px by 500px.</div>';											
					$html .= '</div>';
*/


			$html .= '<div class="label">First Name*</div>';
			$html .= '<div class="field"><input type="text" class="fname" id="fname" name="fname"></div>';
			
			$html .= '<div class="label">Last Name*</div>';
			$html .= '<div class="field"><input type="text" id="lname" name="lname"></div>';					
			
			$html .= '<div class="submit"><input type="submit" value="Submit"></div>';
		
		
		$html .= '</form>';	
				
/*
		$html .= '<form id="connectome-member-mobile" class="connectome-member" enctype="multipart/form-data">';

			$html .= '<div class="mobile">';
	
				$html .= '<div class="label">Choose a Category*</div>';
				$html .= '<div class="field">'; 
					$html .= '<select id="category" name="category">';
						$html .= '<option value="select">Select a Category:</option>';
						$html .= '<option value="artwork">Artwork</option>';
						$html .= '<option value="heroes">Heroes</option>';
						$html .= '<option value="humor">Humor</option>';
						$html .= '<option value="music">Music</option>';
						$html .= '<option value="poetry">Poetry</option>';
						$html .= '<option value="video">Video</option>';
						$html .= '<option value="in-memoriam">In Memoriam</option>';
					$html .= '</select>';
				$html .= '</div>';
					
				$html .= '<div class="label">Date*</div>';
				$html .= '<div class="field"><input type="date" class="submission-date-mobile" id="submission_date" name="submission_date"></div>';
						
				$html .= '<div class="label">Location*</div>';
				$html .= '<div class="field"><input type="text" id="location" name="location"></div>';
						
				$html .= '<div class="label">By*</div>';
				$html .= '<div class="field"><input type="text" id="submitted_by" name="submitted_by"></div>';
						
				$html .= '<div class="label">Email*</div>';
				$html .= '<div class="field"><input type="email" id="email" name="email"></div>';			
				
				$html .= '<div class="label">Title*</div>';
				$html .= '<div class="field"><input type="text" id="title" name="title"></div>';						
						
				$html .= '<div class="label">Message*</div>';
				$html .= '<div class="field"><textarea id="message" name="message"></textarea></div>';
						
				$html .= '<div class="label">Image*</div>';
				$html .= '<div class="field"><input type="file" id="image" name="image" size="25" /></div>';
						
				$html .= '<div class="label">Video URL</div>';
				$html .= '<div class="field"><input type="url" id="video_url" name="video_url" /></div>';
				
				$html .= '<div class="submit"><input type="submit" value="Submit to Quilt"></div>';
			
			$html .= '</div>';	

		$html .= '</form>';	
	
*/	
		$html .= '<div id="errors"></div>';	
		$html .= '<div id="response" class="response" style="display:none">';
			$html .= '<p>Your submission is uploading.  Please wait.</p>';
		$html .= '</div>';	
		$html .= '<div id="member-results"></div>';	 		
		
	
		$html .= '<script type="text/javascript">'; 
			
			$html .= 'jQuery(document).ready(function($){'; 
	
				$html .= '$.uploadPreview({';
					$html .= 'input_field: "#image-upload",';
					$html .= 'preview_box: "#image-preview",';
					$html .= 'label_field: "#image-label",';
					$html .= 'label_default: "Choose File",'; 
					$html .= 'label_selected: "<br>Change Image",';
					$html .= 'no_label: false'; 
				$html .= '});';
		
				$html .= '$.validator.addMethod("filesize", function (value, element, param) {';
					$html .= 'return this.optional(element) || (element.files[0].size <= param)';
				$html .= '}, function(size){';
					$html .= 'return "Please enter a smaller image. Maximum size is " + filesize(size,{exponent:2,round:1}) + ".";';
				$html .= '});';
    
			    $html .= '$("#test").validate({';
			        $html .= 'rules: {';
/*
			            $html .= 'image: {';
			                $html .= 'required: true,';
							$html .= 'extension: "png|jpg|jpeg",';
							$html .= 'filesize: 5000 * 1024';
			            $html .= '},';
*/
			            $html .= 'fname: {';
			                $html .= 'required: true';
			            $html .= '},';
			            $html .= 'lname: {';
			                $html .= 'required: true';
			            $html .= '}';
			        $html .= '},';
			        $html .= 'messages: {';
/*
			            $html .= 'image: {';
			                $html .= 'required: "Please enter your headshot.",';
			                $html .= 'extension: "Please enter a PNG or JPEG image.",';
			                $html .= 'filesize: "Please enter a smaller image.  Maximum size is 5MB."';
			            $html .= '},';
*/
			            $html .= 'fname: {';
			                $html .= 'required: "Please enter your first name."';
			            $html .= '},';
			            $html .= 'lname: {';
			                $html .= 'required: "Please enter your last name."';
			            $html .= '},';      
			        $html .= '},';
			        $html .= 'errorElement : "div",';
				    $html .= 'errorLabelContainer: "#errors",';	    
					$html .= 'submitHandler: function(form) {';
						$html .= '$("#response").show();';
					    $html .= 'var formData = new FormData(form);';
 						$html .= 'formData.append("action", "member_form");';
 						$html .= 'formData.append("nonce", frontEndAjax.nonce);';
// 						$html .= 'formData.append("image", $("#image")[0].files[0]);';
					    $html .= '$.ajax({';
					    	$html .= 'url: frontEndAjax.ajaxurl,';
					        $html .= 'type: "POST",';
					        $html .= 'data:  formData,';
						    $html .= 'mimeType: "multipart/form-data",';
						    $html .= 'contentType: false,';
						    $html .= 'processData: false,';
					        $html .= 'success: function(data){';
					            $html .= '$("#member-results").html(data);';
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
