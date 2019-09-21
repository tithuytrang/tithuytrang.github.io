<table class="langs-table">
	<tr>
		<th class="border-bottom-2 border-mute-light <?php echo $colorClass ?>"><?php echo l10n('admin_analytics_language', 'Language') ?></th>
		<th class="border-bottom-2 border-mute-light <?php echo $colorClass ?>"><?php echo l10n('admin_analytics_count', 'Count') ?></th>
	</tr>
	<tr>
		<td class="border-bottom border-left border-mute-light"></td>
		<td class="border-bottom border-right border-mute-light"><big><?php echo $data['total_count'] ?></big></td>
	</tr>
<?php $i = 0; ?>
<?php foreach ($data['data'] as $lang => $count): $i++; ?>
	<tr class="<?php echo ($i % 2 != 0) ? "background-blue-light": "" ?>">
		<td class="border-bottom border-left border-mute-light"><?php echo $lang ?></td>
		<td class="border-bottom border-right border-mute-light"><?php echo $count['count'] . sprintf(" <small>(%.1f%%)</small>", $count['perc'] * 100) ?></td>
	</tr>
<?php endforeach; ?>
</table>
