<?php

require_once "includes.php";

Configuration::getControlPanel()->accessOrRedirect();

// Load the cart
$ecommerce = Configuration::getCart();
$ecommerce->deleteTemporaryFiles("../");

// Do some protection
switch (@$_GET['plot_type']) {
	case "cumulative": $plotType = "cumulative"; break;
	case "products": $plotType = "products"; break;
	default: $plotType = "noncumulative"; break;
}

$includeDigital = isset($_GET['chart_digital']) ? $_GET['chart_digital'] == "true" : true;
$includePhysical = isset($_GET['chart_physical']) ? $_GET['chart_physical'] == "true" : true;

if ($includeDigital == false && $includePhysical == false) {
	$includePhysical = $includeDigital = true;
}

// Load the main template
$mainT = Configuration::getControlPanel()->getMainTemplate();
$mainT->stylesheets = array("css/cart.css");
$mainT->pagetitle = l10n("cart_title", "E-Commerce");
$contentT = new Template("templates/common/box.php");
$contentT->cssClass = "cart";
$contentT->content = "";

// Add the table tabs
$tabsT = new Template("templates/cart/tabs.php");
$tabsT->borderColorClass = "border-color-6";
$tabsT->selectedBgColorClass = "background-color-6";
$tabsT->unselectedBgColorClass = "background-mute";
$tabsT->status = "charts";
$contentT->content .= $tabsT->render();

// Show the select
$selectT = new Template("templates/cart/charts-select.php");
$selectT->includeDigital = $includeDigital;
$selectT->includePhysical = $includePhysical;
$selectT->plotType = $plotType;
$contentT->content .= $selectT->render();

// Load the text message template
$textMessageT = new Template("templates/common/text-message.php");
$textMessageT->message = l10n("cart_plot_nodata", "Tere is no data about evaded orders to show.");

/**
 * Convert the raw data to a plottable data
 * 
 * @param  Array $rawData The raw data as array('year' => array('monthNumber' => sellings, ...));
 * 
 * @return Array as array('year' => array('monthName' => sellings, ...));
 */
function rawDataToPlotData($rawData) {
	$data = array();
	$names = l10n("date_full_months", array());
	foreach ($rawData as $id => $dataset) {
		$data[$id] = array();
		foreach($dataset as $month => $count) {
			if (count($names) >= $month) {
				$data[$id][$names[$month - 1]] = $count;
			}
		}
	}
	return $data;
}

// Show the correct plot
switch ($plotType) {
	case "noncumulative":
		$rawData = $ecommerce->getNonCumulativeSellings($includePhysical, $includeDigital);
		if (!count($rawData)) {
			$contentT->content .= $textMessageT->render();
			break;
		}
		$data = rawDataToPlotData($rawData);
		$plotT = new Template("templates/common/plot-line.php");
		$plotT->datasets = $data;
		$contentT->content .= $plotT->render();
	break;	
	case "cumulative":
		$rawData = $ecommerce->getCumulativeSellings($includePhysical, $includeDigital);
		if (!count($rawData)) {
			$contentT->content .= $textMessageT->render();
			break;
		}
		$data = rawDataToPlotData($rawData);
		$plotT = new Template("templates/common/plot-line.php");
		$plotT->datasets = $data;
		$contentT->content .= $plotT->render();
	break;
	case "products":
		$barsNumber = 10;
		$data = $ecommerce->getSoldItemsNumber($barsNumber, $includePhysical, $includeDigital);
		if (!count($data)) {
			$contentT->content .= $textMessageT->render();
			break;
		}
		$plotT = new Template("templates/common/plot-bars.php");
		$plotT->data = $data;
		$contentT->content .= $plotT->render();
	break;
}

$mainT->content = $contentT->render();

echo $mainT->render();
