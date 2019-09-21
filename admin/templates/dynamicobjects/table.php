<div class="text-large uppercase fore-mute-dark margin-bottom"><?php echo $title ?></div>
<table class="margin-bottom-2">
	<thead>
		<th class="no-phone fore-color-1 border-bottom-2 border-mute-light"><?php echo $page ? l10n("dynamicobj_page", "Page") : l10n("dynamicobj_template", "Header/Footer") ?></th>
		<th class="fore-color-1 border-bottom-2 border-mute-light"><?php echo l10n("dynamicobj_object", "Object") ?></th>
		<th class="no-phone fore-color-1 border-bottom-2 border-mute-light"><?php echo l10n("dynamicobj_content", "Content") ?></th>
		<th class="fore-color-1 border-bottom-2 border-mute-light"></th>
	</thead>
<?php if (count($dynamicobjects) == 0) : ?>
	<tr>
		<td colspan="4" class="text-center"><?php echo l10n('search_empty', 'Empty results') ?></td>
	</tr>
<?php else: ?>
<?php $i = 0; foreach ($dynamicobjects as $objId => $obj): $i++; ?>
	<tr class="<?php echo $i % 2 == 0 ? "background-blue-light" : "" ?>">
		<td class="no-phone border-left border-bottom border-mute-light"><?php echo $page ? $obj['PageTitle'] : ucwords(strtolower($obj['type'])) ?></td>
		<td class="border-bottom border-mute-light"><?php echo (strlen($obj['ObjectTitle']) ? $obj['ObjectTitle'] : $obj['ObjectId']) ?></td>
		<td class="no-phone border-bottom border-mute-light text-ellipsis"><?php echo Configuration::getDynamicObject($obj['FileId'])->getContent() ?></td>
		<td class="border-right border-bottom border-mute-light text-right">
			<?php
				// App redirect code
				if (Configuration::getControlPanel()->isWsx5Manager()) {
					$redirectJs = " onclick=\"parent.postMessage('{&quot;code&quot;: 301, &quot;location&quot;: &quot;" . $obj['Page'] . "#" . $obj['ObjectId'] . "&quot;}', '*'); return false;\"";
				}
			?>
			<a href="<?php echo $obj['Page'] . "#" . $obj['ObjectId'] ?>"<?php echo isset($redirectJs) ? $redirectJs : "" ?> target="_blank" class="fa icon-large fa-search fore-mute"></a>
		</td>
	</tr>
<?php endforeach; ?>
<?php endif; ?>
</table>

