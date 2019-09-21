<script>
function showCategory( obj ) {
	var cat = $( obj ).val();
	if ( cat !== "" )
		window.location.href = '<?php echo basename($_SERVER['PHP_SELF']) ?>?category=' + encodeURIComponent(cat.replace(/ /g, '_'));
	else
		window.location.href = '<?php echo basename($_SERVER['PHP_SELF']) ?>';
}

function showPost( obj, objcat ) {
	var post = $( obj ).val(),
		cat = $( objcat ).val();
	if ( post !== "" && cat !== "" )
		window.location.href = '<?php echo basename($_SERVER['PHP_SELF']) ?>?category=' + encodeURIComponent(cat.replace(/ /g, '_')) + '&post=' + post;
	else
		window.location.href = '<?php echo basename($_SERVER['PHP_SELF']) ?>';	
}
</script>
<div class="margin-bottom-2">
	<select class="border border-mute-light background-transparent" name="category" id="category" onchange="showCategory(this)">
		<option value=""><?php echo l10n("admin_category_select") ?></option>
<?php foreach($categories as $category => $post): ?>
		<option value="<?php echo $category ?>"<?php echo str_replace(" ", "_", $category) == $selectedCategory ? " selected" : "" ?>><?php echo str_replace("_", " ", $category) ?></option>
<?php endforeach; ?>
	</select>
<?php if (strlen($selectedCategory)): ?>
	<select class="border border-mute-light background-transparent" name="post" id="post" onchange="showPost(this, '#category')">
		<option value=""><?php echo l10n("admin_post_select") ?></option>
<?php foreach($categoryPosts as $post): ?>
		<option value="<?php echo $post ?>"<?php echo $post == $selectedPost ? " selected" : "" ?>><?php echo $posts[$post]['title'] ?></option>
<?php endforeach; ?>
	</select>
<?php endif; ?>
</div>
