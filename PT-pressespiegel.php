<?php
/*
Plugin Name: Piraten-Tools / Pressespiegel
Plugin URI: https://github.com/PiratenGP/PT-pressespiegel
Description: Piraten-Tools / Pressespiegel
Version: 0.1.0
Author: @stoppegp
Author URI: http://stoppe-gp.de
License: CC-BY-SA 3.0
*/

global $PT_infos;
$PT_infos[] = array(
	'name'		=>		'Pressespiegel',
	'desc'		=>		'Infos tbd',
);

require('mainmenu.php');

if (!function_exists("piratentools_main_menu")) {
	add_action( 'admin_menu', 'piratentools_main_menu');
	function piratentools_main_menu() {
		add_menu_page( "Piraten-Tools", "Piraten-Tools", 0, "piratentools" , "PT_main_menu");
	}
}

add_action( 'admin_menu', 'PT_pressespiegel_main_menu' );
function PT_pressespiegel_main_menu() {
	add_submenu_page( "piratentools", "Pressespiegel", "Pressespiegel", "manage_options", "pt_pressespiegel", array("PT_pressespiegel", "adminmenu") );
}

require('pressespiegel/pressespiegel.php');
?>