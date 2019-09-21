<div class="clearfix"></div>
<div class="no-phone box add-site-box padding border border-color-1">
	<img src="<?php echo $url ?>" alt="" />
	<div class="text-light qr-description">
		<?php
			echo str_replace("[WEBSITENAME]", $sitename, l10n("admin_manager_site_connect_info", "Open WebSite X5 Manager and scan this QR Code for adding your website \"[WEBSITENAME]\"."))
		?>
	</div>
	<div class="clearfix"></div>
</div>
