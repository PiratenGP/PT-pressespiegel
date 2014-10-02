<div class="wrap pt-stimm">
<h2>PT-Pressespiegel</h2>
<hr>
Übersicht | <a href="admin.php?page=pt_pressespiegel&pt-pressespiegel-page=queue">Warteschlange</a>
<hr>
<h3>Übersicht</h3>
<?php
	$entries = $options['entries'];
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
			<input type="hidden" name="pt-pressespiegel-action" value="entry-del" />
			<button type="submit">Löschen</button>
			</form>
			</td>
			</tr>
			<?php
		}
		echo "</table>";
	}
?>
<hr>
<h3>Neuer Eintrag</h3>
<form method="post">
<input name="pt-pressespiegel-date" placeholder="Datum" />
<input name="pt-pressespiegel-source" placeholder="Quelle" />
<input name="pt-pressespiegel-title" placeholder="Titel" />
<input name="pt-pressespiegel-url" placeholder="URL" />
<input type="hidden" name="pt-pressespiegel-page" value="home">
<input type="hidden" name="pt-pressespiegel-action" value="entry-add"><button type="submit">Eintrag hinzufügen</button>

</form>
</div>