/*
Custom jQuery for admin page
Created by: Meik - BeauTheme team
Support: support@beautheme.com
*/
jQuery(document).ready(function ($) {
	/**
	 * Metabox custom jquery
	 */
	 $('.cmb_option[name="_beautheme_your_custom_product"]').each(function() {
	 	var atCheck = $(this).attr('checked');
	  	var valShow = $(this).attr('value');
	  	if (atCheck =='checked') {
	  		checkHeader(valShow);
	  		checkProducts(valShow);
	  	};
	 });

	 //On change header
	$('.cmb_option[name="_beautheme_your_custom_product"]').change(function(event) {
		var headerShow = $(this).attr('id');
		checkHeader(headerShow);
		checkProducts(headerShow);
	});

	//Check checkbox checked or no for custom sidebar
	function checkCustomSidebar(str, child){
		if (str) {
			$('.redux-main tr:nth-child('+child+')').show('fast');
		};
		if (!str) {
			$('.redux-main tr:nth-child('+child+')').hide('fast');
		};
	}


	//Hide box archive
	$('#archive_metabox').hide();
	var archiveLoad  =  $('#page_template').val();
	if(archiveLoad == 'templates/template-author.php') {
		$('#archive_metabox').show('slow');
		$('.cmb_id__beautheme_archive_custom').hide();
	}
	if (archiveLoad == 'templates/template-authorletter.php') {
		$('#archive_metabox').show('slow');
		$('.cmb_id__beautheme_archive_custom').hide();
	}
	if (archiveLoad == 'templates/template-blog.php') {
		$('#archive_metabox').show('slow');
		$('.cmb_id__beautheme_archive_custom').removeAttr('style');
	}
	$('#page_template').change(function(event) {
		var vaLueDrop = $(this).val();
		// alert(vaLueDrop)
		if (vaLueDrop == 'templates/template-blog.php') {
			$('#archive_metabox').show('slow');
			$('.cmb_id__beautheme_archive_custom').removeAttr('style');
		}else if(vaLueDrop == 'templates/template-author.php') {
			$('#archive_metabox').show('slow');
			$('.cmb_id__beautheme_archive_custom').hide();
		}else if (vaLueDrop == 'templates/template-authorletter.php') {
			$('#archive_metabox').show('slow');
			$('.cmb_id__beautheme_archive_custom').hide();
		}else{
			$('#archive_metabox').hide();
			$('.cmb_id__beautheme_archive_custom').removeAttr('style');
		}
	});

	//For prefix author name to fillter
});

//Check header to show
function checkHeader(headerToshow){
	jQuery('.cmb_id__beautheme_header_using_cover, .cmb_id__beautheme_header_using_slider, .cmb_id__beautheme_header_using_slider_with_coundown, .cmb_id__beautheme_header_countdown').hide();
	switch(headerToshow){
		case "_beautheme_your_custom_header2":
			jQuery('.cmb_id__beautheme_header_using_cover').show('slow');
		break;
		case "header_imagecover":
			jQuery('.cmb_id__beautheme_header_using_cover').show('slow');
		break;
		case "_beautheme_your_custom_header3":
			jQuery('.cmb_id__beautheme_header_using_slider').show('slow');
		break;
		case "header_slider":
			jQuery('.cmb_id__beautheme_header_using_slider').show('slow');
		break;
	}
}

//Check product postype
function checkProducts(productTypeToshow){
	jQuery(
		'.cmb_id__beautheme_artist, .cmb_id__beautheme_author, .cmb_id__beautheme_product_ISBN, .cmb_id__beautheme_publishing_year, .cmb_id__beautheme_page_count, .cmb_id__beautheme_editorial_reviews, .cmb_id__beautheme_album_title, .cmb_id__beautheme_label, .cmb_id__beautheme_original_release, .cmb_id__beautheme_format, .cmb_id__beautheme_producer, .cmb_id__beautheme_length, .cmb_id__beautheme_product_with_audio,#acf_acf_media-list, .cmb_id__beautheme_product_with_soudcloud, .cmb_id__beautheme_product_with_audio_embed, .cmb_id__beautheme_product_with_video, .cmb_id__beautheme_product_with_video_embed'
	).hide();
	console.log(productTypeToshow);
	switch(productTypeToshow){
		case "_beautheme_your_custom_product1":
			jQuery('.cmb_id__beautheme_author').show('slow');
			jQuery('.cmb_id__beautheme_product_ISBN').show('slow');
			jQuery('.cmb_id__beautheme_publishing_year').show('slow');
			jQuery('.cmb_id__beautheme_page_count').show('slow');
		break;
		case "product_book":
			jQuery('.cmb_id__beautheme_author').show('slow');
			jQuery('.cmb_id__beautheme_product_ISBN').show('slow');
			jQuery('.cmb_id__beautheme_publishing_year').show('slow');
			jQuery('.cmb_id__beautheme_page_count').show('slow');
		break;
		case "_beautheme_your_custom_product2":
			jQuery('.cmb_id__beautheme_artist').show('slow');
			jQuery('.cmb_id__beautheme_album_title').show('slow');
			jQuery('.cmb_id__beautheme_label').show('slow');
			jQuery('.cmb_id__beautheme_original_release').show('slow');
		break;
		case "product_cassette":
			jQuery('.cmb_id__beautheme_artist').show('slow');
			jQuery('.cmb_id__beautheme_album_title').show('slow');
			jQuery('.cmb_id__beautheme_label').show('slow');
			jQuery('.cmb_id__beautheme_original_release').show('slow');
		break;
		case "_beautheme_your_custom_product3":
			jQuery('.cmb_id__beautheme_artist').show('slow');
			jQuery('.cmb_id__beautheme_album_title').show('slow');
			jQuery('.cmb_id__beautheme_label').show('slow');
			jQuery('.cmb_id__beautheme_original_release').show('slow');
		break;
		case "product_vinyl":
			jQuery('.cmb_id__beautheme_artist').show('slow');
			jQuery('.cmb_id__beautheme_album_title').show('slow');
			jQuery('.cmb_id__beautheme_label').show('slow');
			jQuery('.cmb_id__beautheme_original_release').show('slow');
		break;
		case "_beautheme_your_custom_product4":
			jQuery('.cmb_id__beautheme_artist').show('slow');
			jQuery('.cmb_id__beautheme_album_title').show('slow');
			jQuery('.cmb_id__beautheme_label').show('slow');
			jQuery('.cmb_id__beautheme_original_release').show('slow');
		break;
		case "product_audio":
			jQuery('.cmb_id__beautheme_artist').show('slow');
			jQuery('.cmb_id__beautheme_album_title').show('slow');
			jQuery('.cmb_id__beautheme_label').show('slow');
			jQuery('.cmb_id__beautheme_original_release').show('slow');
			break;
		case "_beautheme_your_custom_product5":
			jQuery('.cmb_id__beautheme_producer').show('slow');
			jQuery('.cmb_id__beautheme_format').show('slow');
			jQuery('.cmb_id__beautheme_length').show('slow');
			jQuery('.cmb_id__beautheme_original_release').show('slow');
		break;
		case "product_vcd":
			jQuery('.cmb_id__beautheme_producer').show('slow');
			jQuery('.cmb_id__beautheme_format').show('slow');
			jQuery('.cmb_id__beautheme_length').show('slow');
			jQuery('.cmb_id__beautheme_original_release').show('slow');
		break;
		case "product_sound_cloud":
			jQuery('.cmb_id__beautheme_product_with_soudcloud').show('slow');
		break;
		case "product_video":
			jQuery('.cmb_id__beautheme_product_with_video, .cmb_id__beautheme_product_with_video_embed').show('slow');
		break;
		case "_beautheme_your_custom_product3":
			jQuery('.cmb_id__beautheme_product_with_video, .cmb_id__beautheme_product_with_video_embed').show('slow');
		break;
		case "_beautheme_your_custom_product4":
			jQuery('#acf_acf_media-list').show('slow');
		break;
		case "product_audio":
			jQuery('#acf_acf_media-list').show('slow');
		break;
	}
}

