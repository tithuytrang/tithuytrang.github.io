<table class="pages-table">
	<thead>
		<tr>
			<th class="border-bottom-2 border-mute-light <?php echo $colorClass ?>">Url</th>
			<th class="border-bottom-2 border-mute-light <?php echo $colorClass ?>">
				<a class="fore-color-inherit" href="?type=mostvisitedpages&amp;orderByUnique=false">
					<?php echo l10n('admin_analytics_views', 'Views') ?>
				</a>
			</th>
			<th class="border-bottom-2 border-mute-light <?php echo $colorClass ?>">
				<a class="fore-color-inherit" href="?type=mostvisitedpages&amp;orderByUnique=true">
					<?php echo l10n('admin_analytics_uniqueviews', 'Unique Views') ?>
				</a>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="border-bottom border-left border-mute-light"></td>
			<td class="border-bottom border-mute-light"><big><?php echo $data['total_count'] ?></big></td>
			<td class="border-bottom border-right border-mute-light"><big><?php echo $data['total_unique_count'] ?></big></td>
		</tr>
<?php $i = 0; ?>
<?php foreach ($data['data'] as $url => $data): $i++; ?>
		<tr class="<?php echo ($i % 2 != 0) ? "background-blue-light": "" ?>">
			<td class="border-bottom border-left border-mute-light"><a href="<?php echo $url ?>" class="fore-color-inherit" target="_blank"><?php echo str_replace(array("/", "-"), array("/<wbr>", "-<wbr>"), $url) ?></a></td>
			<td class="border-bottom border-mute-light"><?php echo $data['count'] . sprintf(" <small class=\"no-phone\">(%.1f%%)</small>", $data['count_perc'] * 100) ?></td>
			<td class="border-bottom border-right border-mute-light"><?php echo $data['unique_count'] . sprintf(" <small class=\"no-phone\">(%.1f%%)</small>", $data['unique_count_perc'] * 100) ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
