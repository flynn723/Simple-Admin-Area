function isEnabledCustomAdminCSSChecked(){
	if (jQuery('input#enable_custom_admin_css').is(':checked')) {
		jQuery('.color-input-wrap').parent().parent().show(500);
	} else {
		jQuery('.color-input-wrap').parent().parent().hide(500);
	}		
}
jQuery(document).ready(function(){
    jQuery('.add-color-picker').wpColorPicker();
    isEnabledCustomAdminCSSChecked();
});
jQuery(document).on('click', 'body', function(){
	isEnabledCustomAdminCSSChecked();
});
jQuery(document).on('click', '.preset-color-scheme-col', function(){
	jQuery('.preset-color-scheme-col').removeClass('selected');
	jQuery(this).addClass('selected');
	var color1 = jQuery(this).attr('data-color1');
	var color2 = jQuery(this).attr('data-color2');
	var color3 = jQuery(this).attr('data-color3');
	var color4 = jQuery(this).attr('data-color4');
	jQuery('input#color1').val(color1);
	jQuery('.color1-input-wrap .wp-color-result').css("background-color", color1);
	jQuery('input#color2').val(color2);
	jQuery('.color2-input-wrap .wp-color-result').css("background-color", color2);
	jQuery('input#color3').val(color3);
	jQuery('.color3-input-wrap .wp-color-result').css("background-color", color3);
	jQuery('input#color4').val(color4);
	jQuery('.color4-input-wrap .wp-color-result').css("background-color", color4);
	console.log(color1);
});
jQuery(document).on('click', '.toggle-login-form-preview', function(){
	if (jQuery(this).hasClass('show')){
		jQuery('.login-form-preview').show(500);
		jQuery(this).removeClass('show').addClass('hide');
		jQuery(this).text('Hide Preview');
	} else {
		jQuery('.login-form-preview').hide(500);		
		jQuery(this).removeClass('hide').addClass('show');
		jQuery(this).text('Show Preview');
	}
});