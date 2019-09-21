<?php 

require_once "includes.php";

Configuration::getControlPanel()->accessOrRedirect();

// Load the cart
$ecommerce = Configuration::getCart();
$ecommerce->deleteTemporaryFiles("../");

// Load the main template
$mainT = Configuration::getControlPanel()->getMainTemplate();
$mainT->stylesheets = array("css/cart.css");
$mainT->pagetitle = l10n("cart_title", "E-Commerce");
$contentT = new Template("templates/common/box.php");
$contentT->cssClass = "cart";
$contentT->content = "";

// Add the table tabs
$tabsT = new Template("templates/cart/tabs.php");
$tabsT->borderColorClass = "border-mute";
$tabsT->selectedBgColorClass = "background-color-mute";
$tabsT->unselectedBgColorClass = "background-mute";
$tabsT->status = '';
$contentT->content .= $tabsT->render();

if (isset($_GET['id'])) {

	// Evade the order
	if (isset($_GET['evade'])) {
		$ecommerce->evadeOrder($_GET['id']);
		header('Location: cart-order.php?id=' . $_GET['id']);
		exit();
	}

	// Export the CSV file
	if (isset($_GET['exportcsv'])) {
		ob_end_clean(); // Clear the output buffer
		$zip = $ecommerce->zipOrder($_GET['id'], "../");
		if (false !== $zip) {
			header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename=' . substr(basename($zip), 0, strlen(basename($zip)) - 4) . ".zip");
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . readfile($zip)); // Read the file and automatically output it to the output buffer, return the file size
		    exit();
		}
		// As fallback, export the products csv only
		$csv = $ecommerce->getProductsCSV($_GET['id']);
		header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename=' . $_GET['id'] . ".csv");
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . strlen($csv));
	    echo $csv;
	    exit();
	}

	// Download the attachment
	if (isset($_GET['id']) && isset($_GET['download-attachment'])) {
		ob_end_clean(); // Clear the output buffer
		$attachment = $ecommerce->getOrderAttachment($_GET['id'], $_GET['download-attachment']);
		$serverFileName = $attachment["server_file_name"];
		$originalFileName = $attachment["original_file_name"];
		$filePath = pathCombine(array("../", $imSettings['general']['public_folder'], $serverFileName));

		header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $originalFileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit();
	}

	// Show the order table
	$orderArray = $ecommerce->getOrder($_GET['id']);
	if (count($orderArray)) {
		$orderT = new Template("templates/cart/order.php");
		$orderT->publicFolder = $imSettings['general']['public_folder'];
		$orderT->order = $orderArray['order'];
		$orderT->orderArray = $orderArray;
		$contentT->content .= $orderT->render();
	}
}

$mainT->content = $contentT->render();

echo $mainT->render();
