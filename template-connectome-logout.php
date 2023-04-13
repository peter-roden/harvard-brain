<?php if (!isset($_SESSION)) { session_start(); } ?>
<?php
/**
* Template Name: CONNECTOME - LOGOUT
*/

require_once get_stylesheet_directory() . '/connectome/phpCAS/config.php';
require_once $phpcas_path . '/CAS.php';

phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
 
phpCAS::setDebug(); 
 
phpCAS::setNoCasServerValidation(); 
phpCAS::logout();

unset ($_SESSION['login']);
unset ($_SESSION['profile']);

?>