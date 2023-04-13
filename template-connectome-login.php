<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
/**
* Template Name: CONNECTOME - LOGIN
*/

require_once get_stylesheet_directory() . '/connectome/phpCAS/config.php';
require_once $phpcas_path . '/CAS.php';

phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
 
phpCAS::setDebug(); 
 
phpCAS::setNoCasServerValidation(); 
phpCAS::forceAuthentication(); 

$attributes = phpCAS::getAttributes();
 
$_SESSION['login'] = $attributes['mail'];


$args = array(
    'post_type'			=> 'hbi_connectome',
    'posts_per_page'	=> -1,
    'post_status' 		=> array('publish', 'pending')    
);
$the_query = new WP_Query($args);
if( $the_query->have_posts() ) {
    while( $the_query->have_posts() ) {
        $the_query->the_post(); 
        if (get_field('email') == $_SESSION['login']) {
            $_SESSION['profile'] = get_the_id();	
        }
    }			
}

if ($_SESSION['profile']) {
    $url = 'https://brain.harvard.edu/connectome/member?id=' . $_SESSION['profile'];
    header ("Location: $url");
} else {
    header("Location: https://brain.harvard.edu/connectome/member/");
}

?>