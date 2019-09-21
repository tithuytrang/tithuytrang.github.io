<script>
function updateChart() {
	location.href = $("#chart-type").val() +
				   "&chart_digital=" + ($("#chart-digital-products").prop("checked") ? "true" : "false") +
				   "&chart_physical=" + ($("#chart-physical-products").prop("checked") ? "true" : "false");
}
</script>
<select id="chart-type" onchange="updateChart()" class="border-mute border background-transparent">
	<option value="?plot_type=noncumulative"<?php echo $plotType == 'noncumulative' ? " selected" : "" ?>>1 - <?php echo l10n('cart_plot_noncumulative', 'Non cumulative amounts') ?></option>
	<option value="?plot_type=cumulative"<?php echo $plotType == 'cumulative' ? " selected" : "" ?>>2 - <?php echo l10n('cart_plot_cumulative', 'Cumulative amounts') ?></option>
	<option value="?plot_type=products"<?php echo $plotType == 'products' ? " selected" : "" ?>>3 - <?php echo l10n('cart_plot_productscount', 'Products count') ?></option>
</select>
<div class="checkboxes">
	<div>
		<input type="checkbox" onchange="updateChart()" id="chart-digital-products" <?php if ($includeDigital) echo "checked" ?>>
		<label for="chart-digital-products"><?php echo l10n('cart_plot_digital_products', 'Digital Products') ?></label>
	</div>
	<div>
		<input type="checkbox" onchange="updateChart()" id="chart-physical-products"<?php if ($includePhysical) echo "checked" ?>>
		<label for="chart-physical-products"><?php echo l10n('cart_plot_physical_products', 'Physical Products') ?></label>
	</div>
</div>
