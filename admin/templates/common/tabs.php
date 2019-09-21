<div class="tabs-container noprint">
	<div class="tabs border-bottom-2 fore-white <?php echo $borderColorClass ?>">
<?php foreach ($entries as $entry): ?>
		<a class="tab fore-color-inherit <?php echo $status == $entry['status'] ? $selectedBgColorClass : $unselectedBgColorClass ?>" href="<?php echo $entry['url'] ?>" title="<?php echo $entry['text'] ?>">
<?php if (isset($entry['icon'])): ?>
			<span class="fa fa-<?php echo $entry['icon'] ?>"></span>
<?php endif; ?>
			<span class="text text-center no-phone no-tablet"><?php echo $entry['text'] ?></span>
		</a>
<?php endforeach; ?>
	</div>
</div>
