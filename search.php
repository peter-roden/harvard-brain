<?php
if(isset($_GET['search-type'])) {
    $type = $_GET['search-type'];
    if($type == 'normal') {
        load_template(get_stylesheet_directory(). '/search-normal.php');
    } elseif($type == 'neuro') {
        load_template(get_stylesheet_directory() . '/search-neuro.php');
    }
}
?>