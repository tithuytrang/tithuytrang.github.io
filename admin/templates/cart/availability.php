<?php if (count($results)): // Available data
		foreach ($results as $category => $data): ?>
	<div class="store-product-category border-bottom text-large"><?php echo $category; ?></div>
				<?php for ($i = 0; $i < count($data); $i++): ?><div class="store-product-card">
	<div class="store-product-card-image" data-bg-image="<?php echo $data[$i]['image'] ?>"></div>
	<div class="store-product-card-text">
		<div style="margin-left: 6px;"><b><?php echo $data[$i]['name']; ?></b></div>
		<span class="availability <?php echo $data[$i]['status'] ?>"></span>
		<span class="text-small"><?php echo l10n("cart_quantity", "Quantity:") . " " . $data[$i]['availableQuantity'] ?></span>
	</div>
</div><?php	endfor; ?>
<?php endforeach; ?>
<script>
$(document).ready(function () {
	$( ".store-product-card-image" ).each(function () {
		var div = $( this ),
			url = div.attr( "data-bg-image" ),
			body = $( "body" ),
			img = new $( "<img style=\"position: absolute; top: -1000px; left: -1000px;\"/>" );

		// Usage of background-cover does not suit us. Let's load the image and get its size, then decide what to do.
		img.one( "load", function () {
			// Attach the image to the DOM or the width and height won't work
			body.append( img );
			// Get the image size
			var imageWidth = img.width(),
				imageHeight = img.height(),
				containerWidth = div.innerWidth(),
				containerHeight = div.innerHeight();

			// Make sure the image fits inside the container
			if ( imageWidth > containerWidth ) {
				imageHeight = containerWidth / imageWidth * imageHeight;
				imageWidth = containerWidth;
			}
			if ( imageHeight > containerHeight ) {
				imageWidth = containerHeight / imageHeight * imageWidth;
				imageHeight = containerHeight;	
			}

			div.css({
				'background-image': "url('" + url + "')",
				'background-position': Math.floor( (containerWidth - imageWidth) / 2 ) + "px " + Math.floor( (containerHeight - imageHeight) / 2 ) + "px",
				'background-size': imageWidth + "px " + imageHeight + "px"
			});

			img.remove(); // Puff!
		}).attr( "src", url );
	});
});
</script>
<?php else: // Else available data ?>
	<div class="clearfix"></div>
	<div class="text-center" style="padding: 20px;">
		<?php echo l10n('search_empty', 'Empty results') ?>
	</div>
<?php endif; // End available data ?>
