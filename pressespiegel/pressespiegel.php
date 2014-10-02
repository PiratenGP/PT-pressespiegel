<?php
wp_enqueue_style( "pt-stimm", plugin_dir_url(__FILE__)."style.css" );


class PT_stimm {


	static public function shortcode($atts) {
		return "";
	}
	


	static public function adminmenu() {
		
		
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		if ($_GET['reset'] == "1") update_option("PT_pressespiegel", null);
		
		$options = get_option("pt_pressespiegel");
		
	}

	
}

add_shortcode( "pt-pressespiegel", array("PT_pressespiegel", "shortcode"));
?>