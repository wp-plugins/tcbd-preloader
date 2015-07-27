<?php
/*
Plugin Name: TCBD Preloader
Plugin URI: http://demos.tcoderbd.com/wordpress_plugin/tcbd-preoader
Description: This plugin will enable preloader in your Wordpress theme.
Author: Md Touhidul Sadeek
Version: 1.1
Author URI: http://tcoderbd.com
*/

/*  Copyright 2015 tCoderBD (email: info@tcoderbd.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Define Plugin Directory
define('TCBD_PRELOADER_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

// Add Preloader HTML Element
function tcbd_preloader_html(){
	?>
		<!-- Preloader -->
		<div id="preloader">
			<div class="loader">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>	
		<!-- End -->
	<?php
}
add_action('wp_footer', 'tcbd_preloader_html');

// Add settings page link in before activate/deactivate links.
function tcbd_preloader_plugin_action_links( $actions, $plugin_file ){
	
	static $plugin;

	if ( !isset($plugin) ){
		$plugin = plugin_basename(__FILE__);
	}
		
	if ($plugin == $plugin_file) {
		
		if ( is_ssl() ) {
			$settings_link = '<a href="'.admin_url( 'plugins.php?page=TCBD_preloader_settings', 'https' ).'">Settings</a>';
		}else{
			$settings_link = '<a href="'.admin_url( 'plugins.php?page=TCBD_preloader_settings', 'http' ).'">Settings</a>';
		}
		
		$settings = array($settings_link);
		
		$actions = array_merge($settings, $actions);
			
	}
	
	return $actions;
	
}
add_filter( 'plugin_action_links', 'tcbd_preloader_plugin_action_links', 10, 5 );

// Include Settings page
include( plugin_dir_path(__FILE__).'/settings.php' );

function tcbd_preloader_scripts(){
	// Latest jQuery WordPress
	wp_enqueue_script('jquery');

	// TCBD Preloader JS
	wp_enqueue_script('tcbd-preloader-js', TCBD_PRELOADER_PLUGIN_URL.'js/tcbd-preloader.js', array('jquery'), '1.0', true);

	// TCBD Preloader CSS
	wp_register_style('tcbd-preloader', TCBD_PRELOADER_PLUGIN_URL.'css/tcbd-preloader.css', array(), '1.0');
	wp_enqueue_style('tcbd-preloader');
}
add_action('wp_enqueue_scripts', 'tcbd_preloader_scripts');


// Add CSS
function tcbd_plugin_preloader_css(){
	
	if( get_option('tcbdpreloader_bg_color') ){
		$background_color = get_option('tcbdpreloader_bg_color');
	}else{
		$background_color = '#FFFFFF';
	}
		
	if( get_option('tcbdpreloader_image') ){
		$preloader_image = get_option('tcbdpreloader_image');
	}else{
		$preloader_image = plugins_url( '/img/loader-grey.GIF', __FILE__ );
	}
		
	?>
    	<style type="text/css">
			#preloader{
				background-color:<?php echo $background_color; ?>;
			}
			.loader{
				background:url(<?php echo $preloader_image; ?>);
			}
		</style>
    <?php
	
}
add_action('wp_head', 'tcbd_plugin_preloader_css');

?>