<?php if (! session_id()) { session_start(); }	?>
<?php	
require_once($_SERVER["DOCUMENT_ROOT"] . "/wp-blog-header.php");

if(!empty($_POST)) {
	
echo 'we are here';

	$fname			= trim(htmlentities(strip_tags($_POST['fname'])));
	$lname			= trim(htmlentities(strip_tags($_POST['lname'])));
	
	$title = $fname . ' ' . $lname;
	$post = array(
		'post_title'    => $title,
		'post_status'   => 'pending',
		'post_type'   	=> 'hbi_connectome'
	);
    $post_id = wp_insert_post($post);
    
	update_field('fname', $fname, $post_id );
	update_field('lname', $lname, $post_id );
	

	
/*
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload('image', $post_id);
	update_post_meta($post_id,'_thumbnail_id',$attach_id);
	set_post_thumbnail($post_id, $attach_id);
*/

	$post_link = admin_url( 'post.php?post='. $post_id .'&action=edit', 'https' ); 
	
	$to = 'peter.roden@gmail.com';
	$subject = 'Submission Uploaded for Review';
	$body = $title . ' was submitted for review (' . $post_link . ')';	
	$headers[] = 'From: test <info@brain.harvard.edu>';
	$headers[] = 'bcc: peter.roden@gmail.com';
	wp_mail($to, $subject, $body, $headers );

	echo '<div class="response">';
		echo '<p>Thank you.  Your submission will be reviewed and posted.</p>';
	echo '</div>';	
	
}	
	
?>