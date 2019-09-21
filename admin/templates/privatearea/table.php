<table>
	<thead>
		<tr>
			<th class="border-bottom-2 border-mute-light fore-color-1 no-phone"></th>
			<th class="border-bottom-2 border-mute-light fore-color-1 no-phone"><?php echo l10n("private_area_email", "Email") ?></th>
			<th class="border-bottom-2 border-mute-light fore-color-1 no-phone"><?php echo l10n("private_area_realname", "Full name") ?></th>
			<th class="border-bottom-2 border-mute-light fore-color-1 no-phone no-tablet"><?php echo l10n("private_area_ip", "IP Address") ?></th>
			<th class="border-bottom-2 border-mute-light fore-color-1"><?php echo l10n("private_area_ts", "Registration date") ?></th>
			<th class="border-bottom-2 border-mute-light fore-color-1 no-phone no-tablet"><?php echo l10n("private_area_status", "Status") ?></th>
			<th class="border-bottom-2 border-mute-light fore-color-1"></th>
		</tr>
	</thead>
	<tbody>
<?php if (count($users) <= 0): ?>
	<tr>
		<td colspan="6" class="text-center"><?php echo l10n('search_empty', 'Empty results') ?></td>
	</tr>
<?php else:?>
	<?php $i = 0; foreach ($users as $user): $i++ ?>
		<tr id="id_<?php echo $user['id']?>" class="<?php echo $i % 2 == 0 ? 'background-blue-light' : '' ?>">
			<td class="no-phone"><?php echo $user['orderscount'] > 0 ? '<i class="fa fa-shopping-cart fore-color-1 icon-large"></i>' : "" ?></td>
			<td class="no-phone"><?php echo $user['email'] ?></td>
			<td class="no-phone"><?php echo $user['realname'] ?></td>
			<td class="no-phone no-tablet"><?php echo $user['ip'] ?></td>
			<td><?php echo $user['ts'] ?></td>
			<?php if ($user['validated']): ?>
			<td class="green no-phone no-tablet"><?php echo l10n("private_area_status_validated", "Validated") ?></td>
			<?php else: ?>
			<td class="no-phone no-tablet"><?php echo l10n("private_area_status_not_validated", "Not validated") ?></td>
			<?php endif; ?>
			<td class="<?php echo $i % 2 ? 'even-dark' : 'odd-dark' ?>">
				<?php if (!$user['validated']): ?>
				<a class="fa margin-left icon-large fa-check fore-green" href="privatearea.php?validate=<?php echo $user['id'] ?>" onclick="return confirm('<?php echo str_replace("'", "\\'", l10n("private_area_confirm_validation", "Do you want to validate this user?")) ?>');" title="<?php echo l10n("private_area_validate_user", "Manually validate this user") ?>"></a>
				<a class="fa margin-left icon-large fa-send fore-green" href="privatearea.php?validationemail=<?php echo $user['id'] ?>" title="<?php echo l10n("private_area_send_validate", "Resend the validation email") ?>"></a>
				<?php endif; ?>
				<a class="fa margin-left icon-large fa-key fore-yellow" href="privatearea.php?passwordemail=<?php echo urlencode($user['email']) ?>" title="<?php echo l10n("private_area_send_password", "Email the password to this user") ?>"></a>
				<a class="fa margin-left icon-large fa-times fore-red" href="privatearea.php?delete=<?php echo urlencode($user['email']) ?>" onclick="return confirm('<?php echo str_replace("'", "\\'", l10n("private_area_confirm_remove", "Do you want to remove this user?")) ?>');" title="<?php echo l10n("private_area_remove_user", "Remove this user") ?>"></a>
			</td>
		</tr>
	<?php endforeach; ?>
<?php endif; ?>
	</tbody>
</table>

