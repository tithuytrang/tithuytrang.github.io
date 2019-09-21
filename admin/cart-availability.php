<?php

require_once "includes.php";

Configuration::getControlPanel()->accessOrRedirect();

// Load the cart
$ecommerce = Configuration::getCart();
$ecommerce->deleteTemporaryFiles("../");
$results = $ecommerce->getDynamicProductsAvailabilityTable(0, 0);

// Load the main template
$mainT = Configuration::getControlPanel()->getMainTemplate();
$mainT->stylesheets = array("css/cart.css");
$mainT->pagetitle = l10n("cart_title", "E-Commerce");
$contentT = new Template("templates/common/box.php");
$contentT->cssClass = "cart";
$contentT->content = "";

// Add the table tabs
$tabsT = new Template("templates/cart/tabs.php");
$tabsT->borderColorClass = "border-color-5";
$tabsT->selectedBgColorClass = "background-color-5";
$tabsT->unselectedBgColorClass = "background-mute";
$tabsT->status = "availability";
$contentT->content .= $tabsT->render();

// Show the products
$availabilityT = new Template("templates/cart/availability.php");
$availabilityT->results = $results;
$contentT->content .= $availabilityT->render();

$mainT->content = $contentT->render();

echo $mainT->render();
