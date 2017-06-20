<?php
function simple_admin_area_login_settings_init(){
	register_setting('simple-admin-area_login-settings-group', 'login_logo');
	register_setting('simple-admin-area_login-settings-group', 'set_login_logo_to_favicon');
	register_setting('simple-admin-area_login-settings-group', 'login_form_bg_clr');
	register_setting('simple-admin-area_login-settings-group', 'login_form_text_clr');
	register_setting('simple-admin-area_login-settings-group', 'add_login_area_css');
	add_settings_section(
		'simple-admin-area_login-setting-section',
		'Simple Admin Area Login Settings',
		'simple_admin_area_login_setting_section_callback',
		'simple-admin-area_login-settings'
	);
	add_settings_field(
		'login_logo',
		'Login Logo',
		'login_logo_callback',
		'simple-admin-area_login-settings',
		'simple-admin-area_login-setting-section'
	);
	add_settings_field(
		'set_login_logo_to_favicon',
		'Set Login Logo to Favicon',
		'set_login_logo_to_favicon_callback',
		'simple-admin-area_login-settings',
		'simple-admin-area_login-setting-section'
	);
	add_settings_field(
		'login_form_bg_clr',
		'Login Form Background Color',
		'login_form_bg_clr_callback',
		'simple-admin-area_login-settings',
		'simple-admin-area_login-setting-section'
	);
	add_settings_field(
		'login_form_text_clr',
		'Login Form Text Color',
		'login_form_text_clr_callback',
		'simple-admin-area_login-settings',
		'simple-admin-area_login-setting-section'
	);
	add_settings_field(
		'add_login_area_css',
		'Additional Login Form CSS',
		'add_login_area_css_callback',
		'simple-admin-area_login-settings',
		'simple-admin-area_login-setting-section'
	);
}
add_action('admin_init', 'simple_admin_area_login_settings_init');

function simple_admin_area_login_setting_section_callback(){
	$html =  '<ul>
				<li>Link WordPress Login Form Logo to ' . wp_get_theme() . '</li>
				<li>Change WordPress Login Form Logo.</li>
			</ul>';
	echo $html;
}
function login_logo_callback(){
	wp_enqueue_media();

	$option = get_option('login_logo');
	$imgSRC = wp_get_attachment_image_src($option);

	$html = '<p>Recommended 1x1 Ratio</p>';
	$html .= '<div class="image-preview-wrapper"><img id="image-preview" src="'.$imgSRC[0].'" style="width: 100%; max-width: 100px;"></div>';
	$html .= '<input id="upload_image_button" type="button" class="button" name="upload_image_button" value="Upload image"/>';
	$html .= '<input id="login_logo" type="hidden" name="login_logo" value="'.$option.'">';
	echo $html;
}
function set_login_logo_to_favicon_callback(){
	$option = get_option('set_login_logo_to_favicon');
	$html = '<label for="set_login_logo_to_favicon"><span class="dashicons dashicons-format-image"></span></label>&nbsp;<input type="checkbox" id="set_login_logo_to_favicon" name="set_login_logo_to_favicon" value="1"';
	if ($option){
		$html .= ' checked/>';
	} else {
		$html .= ' />';
	}
	$html .= '<p>Sets favicon on admin login &amp; admin area pages.</p>';
	echo $html;
}
function login_form_bg_clr_callback(){
  $option = get_option('login_form_bg_clr');
  $html = '<label for="login_form_bg_clr"><span class="dashicons dashicons-admin-appearance"></span></label>&nbsp;<input class="add-color-picker" type="text" id="login_form_bg_clr" name="login_form_bg_clr" value="'.$option.'"/>';
  echo $html;
}
function login_form_text_clr_callback(){
  $option = get_option('login_form_text_clr');
  $html = '<label for="login_form_text_clr"><span class="dashicons dashicons-admin-appearance"></span></label>&nbsp;<input class="add-color-picker" type="text" id="login_form_text_clr" name="login_form_text_clr" value="'.$option.'"/>';
  echo $html;
}
function add_login_area_css_callback(){
  $option = get_option('add_login_area_css');
  if (!$option){
    $option = ' \* Put Additional Login Area CSS Here *\ ';
  }
  $html = '<textarea id="add_login_area_css" name="add_login_area_css" cols="80" rows="10" class="large-text" style="margin-top: 0px; margin-bottom: 0px; height: 196px;">'.$option.'</textarea>';
  echo $html;
}