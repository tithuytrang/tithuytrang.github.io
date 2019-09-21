<table>
	<tbody class="border-top-2 border-mute-light">
<?php $i = 0; foreach ($tests as $test): $i++; ?>
		<tr class="<?php echo $i % 2 ? '' : 'background-blue-light' ?>">
			<td class="border-bottom border-left border-mute-light"><?php echo $test['name'] ?></td>
			<td class="border-bottom border-right border-mute-light text-right">
			<?php if ($test['success']): ?>
				<span class="fore-green">PASS</span>
			<?php else: ?>
				<div class="fore-red">FAIL</div>
				<div class="text-small no-phone"><?php echo $test['message'] ?></div>
			<?php endif; ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
