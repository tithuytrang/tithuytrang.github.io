<?php

// -------------------------------
// Load the generic tabs template
// specifying the cart entries
// -------------------------------

$tabsT = new Template("templates/common/tabs.php");
$tabsT->entries = array(
	array(
		"url"    => "cart-orders.php?status=inbox",
		"status" => "inbox",
		"text"   => l10n('cart_inbox', 'Inbox'),
		"icon"   => "cart-plus"
	),
	array(
		"url"    => "cart-orders.php?status=evaded",
		"status" => "evaded",
		"text"   => l10n('cart_evaded', 'Evaded'),
		"icon"   => "paper-plane"
	),
	array(
		"url"    => "cart-orders.php?status=waiting",
		"status" => "waiting",
		"text"   => l10n('cart_waiting', 'Waiting'),
		"icon"   => "hourglass-half"
	),
	array(
		"url"    => "cart-availability.php",
		"status" => "availability",
		"text"   => l10n('cart_availability', 'Availability'),
		"icon"   => "exclamation-triangle"
	),
	array(
		"url"    => "cart-charts.php",
		"status" => "charts",
		"text"   => l10n('cart_order_charts', 'Charts'),
		"icon"   => "bar-chart"
	)
);
$tabsT->status = $status;
$tabsT->borderColorClass = $borderColorClass;
$tabsT->selectedBgColorClass = $selectedBgColorClass;
$tabsT->unselectedBgColorClass = $unselectedBgColorClass;
echo $tabsT->render();
