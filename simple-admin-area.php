<?php
/* ==============================================================================
Plugin Name: Simple Admin Area
Plugin URI: http://justinestrada.com/wordpress-products?plugin=simple-admin-area
Description: Change the Admin Area color scheme and add custome css. Change Admin login form and add custom css to the wordpress login screen.
Version: 1.0
Text Domain: simple_admin_area
Author: Justin Estrada
Author URI: http://justinestrada.com/wordpress-products

==============================================================================
License: GNU General Public License, version 2, as published by the Free Software Foundation.
*/
function simple_admin_area_vars() {
  $vars = array();
  $vars['plugin_title'] = __('Simple Admin Area');
  $vars['version'] = '1.0';
  $vars['unique_id'] = 'simple-admin-area';
  $vars['path'] = plugin_dir_path(__FILE__);
  $vars['plugin'] = plugin_basename(__FILE__);
  $vars['url'] = plugin_dir_url(__FILE__);
  $vars['min_php'] = '5.2.4';
  $vars['min_wp'] = '4.0';
  return $vars;
}

function simple_admin_area_css() {
  extract( simple_admin_area_vars() );
  wp_register_style( 'simple_admin_area_col_css', $url . 'css/simple-admin-area-col.css', false, '1.0.0' );
  wp_enqueue_style( 'simple_admin_area_col_css' );
  wp_register_style( 'simple_admin_area_css', $url . 'css/simple-admin-area.css', false, '1.0.0' );
  wp_enqueue_style( 'simple_admin_area_css' );
}
add_action( 'admin_head', 'simple_admin_area_css' );

/******************************
Creates Simple Admin Area Styling Settings
*******************************/
function simple_admin_area_settings_page_init(){
  register_setting('simple-admin-area_settings-group', 'enable_custom_admin_css');
  register_setting('simple-admin-area_settings-group', 'color1');
  register_setting('simple-admin-area_settings-group', 'color2');
  register_setting('simple-admin-area_settings-group', 'color3');
  register_setting('simple-admin-area_settings-group', 'color4');
  register_setting('simple-admin-area_settings-group', 'add_admin_area_css');
  add_settings_section(
    'simple-admin-area_setting-section',
    'Simple Admin Area Styling Settings',
    'simple_admin_area_setting_section_callback',
    'simple-admin-area_settings'
  );
  add_settings_field(
    'enable_custom_admin_css',
    'Enable Custom Admin CSS',
    'enable_admin_area_css_callback',
    'simple-admin-area_settings',
    'simple-admin-area_setting-section'
  );
  add_settings_field(
    'preset_color_schemes',
    'Preset Color Schemes',
    'preset_color_schemes_callback',
    'simple-admin-area_settings',
    'simple-admin-area_setting-section'
  );
  add_settings_field(
    'color1',
    'Primary Background',
    'color1_callback',
    'simple-admin-area_settings',
    'simple-admin-area_setting-section'
  );
  add_settings_field(
    'color2',
    'Secondary Background',
    'color2_callback',
    'simple-admin-area_settings',
    'simple-admin-area_setting-section'
  );
  add_settings_field(
    'color3',
    'Highlight Color',
    'color3_callback',
    'simple-admin-area_settings',
    'simple-admin-area_setting-section'
  );
  add_settings_field(
    'color4',
    'Hover Color',
    'color4_callback',
    'simple-admin-area_settings',
    'simple-admin-area_setting-section'
  );
  add_settings_field(
    'add_admin_area_css',
    'Additional Admin Area CSS',
    'add_admin_area_css_callback',
    'simple-admin-area_settings',
    'simple-admin-area_setting-section'
  );
}
add_action('admin_init', 'simple_admin_area_settings_page_init');

function simple_admin_area_setting_section_callback(){
  $html =  '<ul>
  				<li>Choose a color scheme</li>
  			</ul>';
  echo $html;
}
function enable_admin_area_css_callback(){
  $option = get_option('enable_custom_admin_css');
  $html = '<label for="enable_custom_admin_css"><span class="dashicons dashicons-admin-appearance"></span></label>&nbsp;<input type="checkbox" id="enable_custom_admin_css" name="enable_custom_admin_css" value="1"';
  if ($option){
    $html .= ' checked/>';
  } else {
    $html .= ' />';    
  }
  echo $html;
}
function preset_color_schemes_callback(){
  extract( simple_admin_area_vars() );
  require_once( $path.'inc/preset-color-schemes.php' );
}
function color1_callback(){
  $option = get_option('color1');
  $html = '<div class="color-input-wrap color1-input-wrap"><label for="color1"><span class="dashicons dashicons-admin-appearance"></span></label>&nbsp;<input class="add-color-picker" type="text" id="color1" name="color1" value="'.$option.'"/></div>';
  echo $html;
}
function color2_callback(){
  $option = get_option('color2');
  $html = '<div class="color-input-wrap color2-input-wrap"><label for="color2"><span class="dashicons dashicons-admin-appearance"></span></label>&nbsp;<input class="add-color-picker" type="text" id="color2" name="color2" value="'.$option.'"/></div>';
  echo $html;
}
function color3_callback(){
  $option = get_option('color3');
  $html = '<div class="color-input-wrap color3-input-wrap"><label for="color3"><span class="dashicons dashicons-admin-appearance"></span></label>&nbsp;<input class="add-color-picker" type="text" id="color3" name="color3" value="'.$option.'"/></div>';
  echo $html;
}
function color4_callback(){
  $option = get_option('color4');
  $html = '<div class="color-input-wrap color4-input-wrap"><label for="color4"><span class="dashicons dashicons-admin-appearance"></span></label>&nbsp;<input class="add-color-picker" type="text" id="color4" name="color4" value="'.$option.'"/></div>';
  echo $html;
}
function add_admin_area_css_callback(){
  $option = get_option('add_admin_area_css');
  if (!$option){
    $option = ' \* Put Additional Admin Area CSS Here, example: *\ #welcome-panel > div > h2 { color: #ff0000; }';
  }
  $html = '<textarea id="add_admin_area_css" name="add_admin_area_css" cols="80" rows="10" class="large-text" style="margin-top: 0px; margin-bottom: 0px; height: 196px;">'.$option.'</textarea>';
  echo $html;
}
/*=========================*/

function simple_admin_area_customization(){
	extract( simple_admin_area_vars() );
	$option = get_option('enable_custom_admin_css');
	if ($option) {
		?>
		<style type="text/css">
		.profile-php tr.user-admin-color-wrap {
		    display: none;
		}
		</style>
		<?php
		require_once( $path.'inc/dynamic-admin-area-css.php' );
	}
  ?>
  <style type="text/css">
  <?php echo get_option('add_admin_area_css'); ?>
  </style>
  <?php
}
add_action( 'admin_head', 'simple_admin_area_customization' );

function simple_admin_area_js() {
  extract( simple_admin_area_vars() );
  wp_enqueue_script( 'simple_admin_area_js', $url . 'js/simple-admin-area.js' );
}
add_action( 'admin_enqueue_scripts', 'simple_admin_area_js' );

/******************************
Creates Simple Admin Area Login Settings
*******************************/
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
				<li>Link WordPress Login Form Logo to '.get_current_theme().'</li>
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

function colpick_scripts() {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('iris', admin_url('js/iris.min.js'),array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false, 1);
    wp_enqueue_script('wp-color-picker', admin_url('js/color-picker.min.js'), array('iris'), false,1);
    $colorpicker_l10n = array('clear' => __('Clear'), 'defaultString' => __('Default'), 'pick' => __('Select Color'));
    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n ); 
}
add_action('admin_enqueue_scripts', 'colpick_scripts');

function media_selector_print_scripts() {

	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

	?><script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
			jQuery('#upload_image_button').on('click', function( event ){
				event.preventDefault();
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}
				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#login_logo' ).val( attachment.id );
					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});
					// Finally, open the modal
					file_frame.open();
			});
			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});
	</script><?php
}
add_action( 'admin_footer', 'media_selector_print_scripts' );

function simple_admin_area_login_customization() {
    $loginLogoID = get_option('login_logo');
    $imgSRC = wp_get_attachment_image_src($loginLogoID);
    $loginFormBGClr = get_option('login_form_bg_clr');
    $loginFormTxtClr = get_option('login_form_text_clr');
	?>
	<style type="text/css">
	.login h1 a {
	    <?php if ($imgSRC['0']):
	        echo 'background-image: url("'.$imgSRC['0'].'") !important;';
	    else:
	        echo 'background-image: url(images/w-logo-blue.png?ver=20131202);';
	    endif; ?>
	}
	.login form {
	    <?php if ($loginFormBGClr):
	        echo 'background: '.$loginFormBGClr.' !important;';
	    else:
	        echo 'background: #fff;';
	    endif; ?>
	}
	.login label {
	    <?php if ($loginFormTxtClr):
	        echo 'color: '.$loginFormTxtClr.' !important;';
	    else:
	        echo 'color: #72777c;';
	    endif; ?>
	}
  <?php echo get_option('add_login_area_css'); ?>
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'simple_admin_area_login_customization' );
function simple_admin_area_login_link_customization() {
    return home_url();
}
add_filter( 'login_headerurl', 'simple_admin_area_login_link_customization' );
function simple_admin_area_login_title_customization() {
    return wp_title();
}
add_filter( 'login_headertitle', 'simple_admin_area_login_title_customization' );

function set_login_logo_to_favicon_func() {
	$setLoginLogoToFavicon = get_option('set_login_logo_to_favicon');
	$loginLogoID = get_option('login_logo');
	$imgSRC = wp_get_attachment_image_src($loginLogoID);

	if($setLoginLogoToFavicon) {
	  echo '<link rel="Favicon Icon" href="'.$imgSRC['0'].'" type="image/ico" sizes="32x32"/>';
	}
}
add_action( 'login_enqueue_scripts', 'set_login_logo_to_favicon_func' );
add_action('admin_head', 'set_login_logo_to_favicon_func'); 

/* ===================================================== 
=============== Create Simple Admin Area Page ==============
======================================================== */
function simple_admin_area_options_page(){
  extract( simple_admin_area_vars() ); ?>
  <div class="wrap">
    <h2>Simple Admin Area Settings | <?php echo get_current_theme(); ?></h2>
    <table class="form-table"><tbody>
	    <tr valign="top">
		<td scope="row">
			<form method="post" action="options.php" id="simple_admin_area_styling_settings_form" class="simple-admin-area-settings-form" style="width: 100%;">
		      <?php 
		      settings_fields('simple-admin-area_settings-group'); 
		      do_settings_sections('simple-admin-area_settings');
		      submit_button();
		      ?>
		    </form>
		</td>
		<td>
		    <form method="post" action="options.php" id="simple_admin_area_login_settings_form" class="simple-admin-area-settings-form" style="width: 100%;">
		      <?php 
		      settings_fields('simple-admin-area_login-settings-group'); 
		      do_settings_sections('simple-admin-area_login-settings');
		      submit_button();
		      ?>
		    </form>
			<button class="button toggle-login-form-preview show">Show Preview</button>
			<div class="login-form-preview">
				<?php require_once( $path.'inc/dynamic-login-area-preview.php' ); ?>
			</div>
		</td>
		</tr>
    </tbody></table>
  </div>
<?php
}
function simple_admin_area_add_theme_page(){
  add_theme_page(
    __('Simple Admin Area', 'wpsettings'),
    __('Simple Admin Area', 'wpsettings'),
    'edit_theme_options',
    'simple-admin-area_settings',
    'simple_admin_area_options_page'
  );
}
add_action('admin_menu', 'simple_admin_area_add_theme_page');