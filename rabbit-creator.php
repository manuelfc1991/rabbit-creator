<?php  
/* 
Plugin Name: Rabbit Creator: Bulk Pages or Posts Generator
Plugin URI: https://cubebinary.com/
Description: Rabbit Creator, a versatile WordPress plugin, streamlines the process of creating numerous pages or posts effortlessly. With its intuitive functionality, you can effortlessly import CSV data to generate content in bulk, making it a valuable tool for efficiently managing and populating your WordPress website.
Version: 1.0 
Requires at least: 5.8
Requires PHP: 5.6.20
Author: Rabbit Team
Author URI: https://cubebinary.com/rabbit
License: GPLv2 or later
Text Domain: Rabbit Creator
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2022 Automattic, Inc.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

define('RC_VERSION', '1.0');
define('RC_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('RC_SITE_URL', get_bloginfo('url').'/');
define('RC_MINIMUM_WP_VERSION', '5.8' );
define('RC_PLUGIN_BASE_DIR', plugin_dir_path( __FILE__ ));

register_activation_hook( __FILE__, array( 'Rabbit', 'rabbit_activation' ) );
require_once( RC_PLUGIN_BASE_DIR . 'lib/class.rabbit.php' );

add_action( 'init', array( 'Rabbit', 'rabbit_init' ) );
