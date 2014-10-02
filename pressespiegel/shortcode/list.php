<table>
<?php
if (is_array($entries) && (count($entries) > 0)) {
	foreach ($entries as $entry) {
		?>
		<tr>
		<td nowrap="nowrap"><strong><?php echo date("d.m.Y", $entry['date']); ?></strong></td>
		<td><?=$entry['source'];?></td>
		<td>
		<?php
			if ($entry['url']) { ?>
			<a href="<?=$entry['url'];?>"><strong><?=$entry['title'];?></strong></a>
			<?php } else { ?>
			<strong><?=$entry['title'];?></strong>
			<?php
			}
		?>
		</td>
		</tr>
		<?php
	}
}
?>

</table>