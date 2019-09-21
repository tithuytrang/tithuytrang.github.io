<script>
function showGb( obj ) {
	var val = $( obj ).val();
	if (val !== "")
		window.location.href = "guestbook.php?id=" + val;
	else
		window.location.href = "guestbook.php";
}
</script>
<div class="margin-bottom-2">
	<label for="category"><?php echo l10n("admin_guestbook_select") ?></label>
	<select class="border border-mute-light background-transparent" name="category" id="category" onchange="showGb(this)">
		<option value="">-</option>
<?php foreach($guestbooks as $gbid => $gb): ?>
		<option value="<?php echo $gbid?>"<?php echo ($gbid == $id ? " selected" : "") ?>><?php echo $gb['pagetitle'] . " - " . (strlen($gb['celltitle']) ? $gb['celltitle'] : $gbid) ?></option>
<?php endforeach; ?>
	</select>
</div>
