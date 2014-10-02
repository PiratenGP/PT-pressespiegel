<?php
	$url = plugin_dir_url( __FILE__ );
	$url = substr( $url, 0, strrpos( $url, '/'));
	$url = substr( $url, 0, strrpos( $url, '/'));
?>
	

<div class="wrap pt-stimm">
<h2>PT-Pressespiegel</h2>
<hr>
<a href="admin.php?page=pt_pressespiegel&pt-pressespiegel-page=home">Übersicht</a> | Warteschlange (<?php echo count($options['queue']); ?>)
<hr>
<h3>Button</h3>
<a href="javascript:(function(){var%20a=window,enc=document.charset,b=document,c=encodeURIComponent,e=c(document.title),t=document.getElementsByTagName('h1'),tt='';
for (u of t) {
tt += '&t[]='+u.textContent;
}
var ti0 = document.getElementsByTagName('time');
var ti1 = document.getElementsByName('date');
var time = '';
if ((ti0 != null) && (ti0[0] != null))
{
time = ti0[0].textContent;
} else {
if ((ti1 != null) && (ti1[0] != null))
{
time = ti1[0].getAttribute('content');
}
}
var d=a.open('<?=$url;?>/land.php?output=popup&url='+c(b.location)+tt+'&time='+time+'&enc='+enc+'&title='+e,'bkmk_popup','left='+((a.screenX||a.screenLeft)+10)+',top='+((a.screenY||a.screenTop)+10)+',height=400px,width=550px,resizable=1,alwaysRaised=1');a.setTimeout(function(){d.focus()},300);})();">Bookmark</a>
<hr>
<h3>Warteschlange</h3>
<?php
	$entries = $options['queue'];
	if (is_array($entries) && (count($entries) > 0)) {
		echo "<table>";
		foreach ($entries as $key => $entry) {
			?>
			<tr>
			<td><?=$entry['date'];?></td>
			<td><?=$entry['source'];?></td>
			<td><?=$entry['title'];?></td>
			<td><?=$entry['url'];?></td>
			<td>
			<form method="post">
			<input type="hidden" name="pt-pressespiegel-id" value="<?=$key;?>" />
			<input type="hidden" name="pt-pressespiegel-action" value="queue-add" />
			<button type="submit" name="pt-pressespiegel-queue-add" value="1">Hinzufügen</button><br>
			<button type="submit" name="pt-pressespiegel-queue-del" value="1">Löschen</button>
			</form>
			</td>
			</tr>
			<?php
		}
		echo "</table>";

	}
?>

</div>