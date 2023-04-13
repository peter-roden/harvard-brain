<?php
/*
$form = '<form role="search" id="searchform" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<input type="search" class="search-field"'  . ' value="' . get_search_query() . '" name="s" />
			<input type="submit" id="searchsubmit" class="search-submit" value="'. esc_attr_x( '', 'submit button' ) .'" >
		</form>';
*/
$form = '<form role="search" id="searchform" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<input type="search" class="search-field"'  . ' value="' . get_search_query() . '" name="s" />
			<input type="submit" id="searchsubmit" class="search-submit" value="'. esc_attr_x( '&#xf002;', 'submit button' ) .'" >
		</form>';
echo $form;
?>