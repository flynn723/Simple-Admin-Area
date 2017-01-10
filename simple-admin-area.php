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

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

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

function simple_admin_area_action_links ( $links ) {
	$simpleAdminAreaLinks = array(
		'<a href="' . admin_url( 'themes.php?page=simple-admin-area_settings' ) . '" title="Simple Admin Area Settings">Settings</a>',
	);
	return array_merge( $links, $simpleAdminAreaLinks );
}
function simple_admin_area_plugin_row_meta( $links, $file ) {
	if ( strpos( $file, 'simple-admin-area.php' ) !== false ) {
		$new_links = array(
				'email' => '<a href="mailto:justin@justinestrada.com" target="_blank" title="Email Plugin Author">Email Plugin Author</a>',
                'donation' => '<a href="http://justinestrada.com/wordpress-products?action=donate" target="_blank" title="Donate">Donate</a>'
				);	
		$links = array_merge( $links, $new_links );
	}
	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'simple_admin_area_action_links' );
add_filter( 'plugin_row_meta', 'simple_admin_area_plugin_row_meta', 10, 2 );

function simple_admin_area_css() {
	extract( simple_admin_area_vars() );
	parse_str($_SERVER['QUERY_STRING'], $query_AR);
	if ($query_AR['page'] == 'simple-admin-area_settings'){
		wp_register_style( 'simple_admin_area_col_css', $url . 'css/simple-admin-area-col.css', false, '1.0.0' );
		wp_enqueue_style( 'simple_admin_area_col_css' );
		wp_register_style( 'simple_admin_area_css', $url . 'css/simple-admin-area.css', false, '1.0.0' );
		wp_enqueue_style( 'simple_admin_area_css' );
	}
}

	add_action( 'admin_head', 'simple_admin_area_css' );

/******************************
Creates Simple Admin Area Styling Settings
*******************************/
require_once( $path.'styling-settings.php' );

/******************************
Creates Simple Admin Area Login Settings
*******************************/
require_once( $path.'login-settings.php' );

function simple_admin_area_colpick_scripts() {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('iris', admin_url('js/iris.min.js'),array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false, 1);
    wp_enqueue_script('wp-color-picker', admin_url('js/color-picker.min.js'), array('iris'), false,1);
    $colorpicker_l10n = array('clear' => __('Clear'), 'defaultString' => __('Default'), 'pick' => __('Select Color'));
    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n ); 
}
add_action('admin_enqueue_scripts', 'simple_admin_area_colpick_scripts');

function simple_admin_area_media_selector_print_scripts() {

	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

	parse_str($_SERVER['QUERY_STRING'], $query_AR);
	if ($query_AR['page'] == 'simple-admin-area_settings'){
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
	} //** end of if query_AR['page'] == 'simple-admin-area_settings'
}
add_action( 'admin_footer', 'simple_admin_area_media_selector_print_scripts' );

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

function simple_admin_area_set_login_logo_to_favicon_func() {
	$setLoginLogoToFavicon = get_option('set_login_logo_to_favicon');
	$loginLogoID = get_option('login_logo');
	$imgSRC = wp_get_attachment_image_src($loginLogoID);

	if($setLoginLogoToFavicon) {
	  echo '<link rel="Favicon Icon" href="'.$imgSRC['0'].'" type="image/ico" sizes="32x32"/>';
	}
}
add_action( 'login_enqueue_scripts', 'simple_admin_area_set_login_logo_to_favicon_func' );
add_action('admin_head', 'simple_admin_area_set_login_logo_to_favicon_func'); 

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