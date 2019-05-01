<?php
// Create list short code for theme

//Create Button
function beau_hugoButton($atts, $content=''){
	$defaults =  array(
		'class' 			=> '',
		'id' 				=> '',
		'background_color'	=>'',
		'background_image' 	=>'',
		'button_type' 		=>'',
		'link_to'			=>'',
		'button_text'		=>'Button Text',
		"is_container" 		=> true,
	);
	$atts = shortcode_atts( $defaults, $atts );
	$html = '<a id="'.$atts['id'].'" class="book-button '.$atts['class'].'" href="'.$atts['link_to'].'">'.$atts['button_text'].'</a>';
	return $html;
}
add_shortcode('book_button','beau_hugoButton');


?>