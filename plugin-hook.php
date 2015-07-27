<?php
/*
Plugin Name: TCBD Preloader
Plugin URI: http://demos.tcoderbd.com/wordpress_plugin/tcbd-preoader
Description: This plugin will enable preloader in your Wordpress theme.
Author: Md Touhidul Sadeek
Version: 1.0
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


function tcbd_preloader_scripts(){
	// Latest jQuery WordPress
	wp_enqueue_script('jquery');

	// TCBD Preloader JS
	wp_enqueue_script('tcbd-preloader-js', TCBD_PRELOADER_PLUGIN_URL.'js/tcbd-preloader.js', array('jquery'), '1.0', true);

	// TCBD Preloader CSS
	wp_register_style('tcbd-preloader-css', TCBD_PRELOADER_PLUGIN_URL.'css/tcbd-preloader.css');
	wp_enqueue_style('tcbd-preloader-css');
}
add_action('wp_enqueue_scripts', 'tcbd_preloader_scripts');
