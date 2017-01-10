<?php
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