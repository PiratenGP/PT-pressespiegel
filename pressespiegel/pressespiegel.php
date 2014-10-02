<?php
wp_enqueue_style( "pt-pressespiegel", plugin_dir_url(__FILE__)."style.css" );

function esort($a, $b) {
	$d1 = $a['date'];
	$d2 = $b['date'];
	if ($d1 < $d2) {
		return 1;
	} elseif ($d2 < $d1) {
		return -1;
	} else {
		return 0;
	}
}

class PT_pressespiegel {


	static public function shortcode($atts) {
		$options = get_option("pt_pressespiegel");
		$entries = $options['entries'];
		
		uasort($entries, "esort");
		
		ob_start();
		include('shortcode/list.php');
		$content = ob_get_contents();
		ob_end_clean();
		
		return $content;
	}
	


	static public function adminmenu() {
		
		
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		if ($_GET['reset'] == "1") update_option("pt_pressespiegel", null);
		
		$options = get_option("pt_pressespiegel");
		
		$page = $_REQUEST['pt-pressespiegel-page'];
		if (!$page) $page = "home";
		
		if ($_POST['pt-pressespiegel-action'] == "entry-add") {
			
			$data_date = strtotime($_POST['pt-pressespiegel-date']);
			$data_title = htmlspecialchars(trim(stripslashes($_POST['pt-pressespiegel-title'])));
			$data_source = htmlspecialchars(trim(stripslashes($_POST['pt-pressespiegel-source'])));
			$data_url = trim($_POST['pt-pressespiegel-url']);
			
			
			if ($data_title == "") $error[] = "Titel";
			if ($data_source == "") $error[] = "Quelle";
			if (!$data_date) $error[] = "Datum";
			
			if (count($error) == 0) {
				$newar = array(
					"date"		=>		$data_date,
					"title"		=>		$data_title,
					"source"	=>		$data_source,
					"url"		=>		$data_url,
				);
				$options['entries'][] = $newar;
				update_option("pt_pressespiegel", $options);
				
				$success[] = "Eintrag hinzugefügt.";
			}
			$page = "home";
		}

		if ($_POST['pt-pressespiegel-action'] == "entry-del") {
			$data_id = $_POST['pt-pressespiegel-id'];
			if (!$options['entries'][$data_id]) $error[] = "Fehler";
			if (count($error) == 0) {
				unset($options['entries'][$data_id]);
				update_option("pt_pressespiegel", $options);
				
				$success[] = "Eintrag entfernt.";
			}
			$page = "home";
		}
		
		if ($_POST['pt-pressespiegel-action'] == "queue-add") {
					if ($_POST['pt-pressespiegel-queue-add']) {
						$data_id = $_POST['pt-pressespiegel-id'];
						if (!$options['queue'][$data_id]) $error[] = "Fehler";
						if (count($error) == 0) {
							$newar = $options['queue'][$data_id];
							$options['entries'][] = $newar;
							unset($options['queue'][$data_id]);
							update_option("pt_pressespiegel", $options);
							
							$success[] = "Eintrag hinzugefügt.";
						}
					
					} else if ($_POST['pt-pressespiegel-queue-del']) {
						$data_id = $_POST['pt-pressespiegel-id'];
						if (!$options['queue'][$data_id]) $error[] = "Fehler";
						if (count($error) == 0) {
							unset($options['queue'][$data_id]);
							update_option("pt_pressespiegel", $options);
							
							$success[] = "Eintrag entfernt.";
						}
					}
					$page = "queue";
		}
		
		if (count($success) > 0) {
			foreach ($success as $val) {
				?>
				<div class="hinweis updated">
				<?php echo $val; ?>
				</div>
				<?php
			}
		}
		if (count($error) > 0) {
			foreach ($error as $val) {
				?>
				<div class="hinweis error">
				<?php echo $val; ?>
				</div>
				<?php
			}
		}
		
		switch ($page) {
			default:
			case "home":
				include('admin/home.php');
				break;
			case "queue":
				include('admin/queue.php');
				break;
		}
	}

	
}

add_shortcode( "pt-pressespiegel", array("PT_pressespiegel", "shortcode"));
?>