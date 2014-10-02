<?php
define('WP_USE_THEMES', false);
	require_once( '../../../../wp-load.php' );
if ($_POST['do'] == 1) {

	

	$options = get_option("pt_pressespiegel");
	
	$data_date = strtotime($_POST['date']);
	$source_s = $_POST['source'];
	if ($source_s === "0") {
		$data_source = $_POST['source0'];
	} else {
		$data_source = $source_s;
	}
	$title_s = $_POST['title'];
	if ($title_s === "0") {
		$data_title = $_POST['title0'];
	} else {
		$data_title = $title_s;
	}
	$data_url = $_POST['url'];
	
	$newar = array(
		"date"		=>		$data_date,
		"title"		=>		stripslashes($data_title),
		"source"	=>		$data_source,
		"url"		=>		$data_url,
	);
	$options['queue'][] = $newar;
	update_option("pt_pressespiegel", $options);
	?>
	<html>
	<head>
	</head>
	<body onload="window.close()"><pre>
	</pre></body>
	</html>
	
	<?php

} else {

$sources = array(
	"swp.de/goeppingen"	=>	"NWZ Göppingen",
	"swp.de/geislingen"	=>	"Geislinger Zeitung",
	"stuttgarter-zeitung.de"	=>	"Stuttgarter Zeitung",
);

$url = $_GET['url'];

foreach ($sources as $key => $val) {
	if (strpos(".".$url, $key)) {
		$source = $val;
		break;
	}
}
$ttitle = $_GET['title'];
$titles = $_GET['t'];
$titles[] = $ttitle;
foreach ($titles as $k => $v) {
	//$titles[$k] = utf8_encode($v);
	//echo mb_detect_encoding($v, 'UTF-8', true);
	if (mb_detect_encoding($v, 'UTF-8', true) != 'UTF-8') {
		$titles[$k] = utf8_encode($v);
	}
}
if (strpos($ttitle, " - ")) {
	$titles[] = substr($ttitle, 0, strpos($ttitle, " - "));
}
if (strpos($ttitle, " | ")) {
	$titles[] = substr($ttitle, 0, strpos($ttitle, " | "));
}

$date0 = strtotime($_GET['time']);
$date = date("d.m.Y", $date0);

?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css">
	body {
		font-family: sans-serif;
	}
	table {
		border-collapse: collapse;
		background-color: #ddd;
	}
	table td {
		border: 1px solid black;
		padding: 5px;
		
	}
	input[type=text] {
		width: 80%;
	}
	</style>
	</head>
	<body>
	<h1><?php bloginfo( 'name' ); ?></h1>
<form method="post">
<table>
<tr>
<td><strong>Datum</strong></td>
<td><input type="text" name="date" value="<?=$date;?>" /></td>
</tr>
<tr>
<td><strong>Quelle</strong></td>
<td>
<?php if ($source != "") { ?>
<input id="source1" checked="checked" type="radio" name="source" value="<?=$source;?>" /> <label for="source1"><?=$source;?></label><br>
<input id="source0" type="radio" name="source" value="0" /> <input type="text" name="source0" />
<?php } else { ?>
<input id="source0" checked="checked" type="radio" name="source" value="0" /> <input type="text" name="source0" />
<?php } ?>
</td></tr>
<tr>
<td><strong>Titel</strong></td>
<td><?php
$et = "checked=\"checked\"";
foreach ($titles as $k => $t) {
	?>
	<input id="title<?=$k;?>" <?=$et;?> type="radio" name="title" value="<?=htmlspecialchars($t);?>" /> <label for="title<?=$k;?>"><?=$t;?></label><hr>
	<?php
	$et = "";
}
?>
<input id="titlea" <?=$et;?> type="radio" name="title" value="0" /> <input type="text" name="title0" /></td></tr>
<tr>
<td><strong>URL</strong></td>
<td><small><?=$url;?></small></td>
</tr>
</table><p>
<input type="submit"/>
<input type="hidden" name="do" value="1">
<input type="hidden" name="url" value="<?=$url;?>"></p>
</form>
</body>
</html>
<?php } ?>