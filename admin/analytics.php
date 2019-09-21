<?php

include "includes.php";

Configuration::getControlPanel()->accessOrRedirect();

$analytics = Configuration::getAnalytics();
$from = date("Y-m-d H:i:s", strtotime("-1 month"));
if (isset($_GET['from'])) {
	$from = date("Y-m-d H:i:s", intval($_GET['from'], 10) / 1000);
}
$to = date("Y-m-d H:i:s");
if (isset($_GET['to'])) {
	$to = date("Y-m-d H:i:s", intval($_GET['to'], 10) / 1000);
}

// Safely get the type and set the tab color
$type = "";
$color = 1;
switch (@$_GET['type']) {
	case "pageviews"       : $type = "pageviews"; $color = 2; break;
	case "mostvisitedpages": $type = "mostvisitedpages"; $color = 3; break;
	case "langs"           : $type = "langs"; $color = 5; break;
	default                : $type = "visitorscount"; $color = 4; break;
}

// Load the main template
$mainT = Configuration::getControlPanel()->getMainTemplate();
$mainT->pagetitle = l10n("admin_analytics_title", "Statistics");
//$mainT->stylesheets = array("css/analytics.css");
$mainT->content = "";
$contentT = new Template("templates/common/box.php");
$contentT->cssClass = "analytics";
$contentT->content = "";

// Load the tabs
$tabsT = new Template("templates/common/tabs.php");
$tabsT->entries = array(
	array(
		"url"    => "analytics.php?type=visitorscount",
		"text"   => l10n('admin_analytics_visitorscount', 'Visitors Count'),
		"status" => "visitorscount",
		"icon"   => "group"
	),
	array(
		"url"    => "analytics.php?type=pageviews",
		"text"   => l10n('admin_analytics_pageviews', 'Page Views'),
		"status" => "pageviews",
		"icon"   => "eye"
	),
	array(
		"url"    => "analytics.php?type=mostvisitedpages",
		"text"   => l10n('admin_analytics_mostvisitedpages', 'Most visited pages'),
		"status" => "mostvisitedpages",
		"icon"   => "trophy"
	),
	array(
		"url"    => "analytics.php?type=langs",
		"text"   => l10n('admin_analytics_langs', 'Languages'),
		"status" => "langs",
		"icon"   => "globe"
	)
);
$tabsT->borderColorClass = "border-color-$color";
$tabsT->selectedBgColorClass = "background-color-$color";
$tabsT->unselectedBgColorClass = "background-mute";
$tabsT->status = $type;
$contentT->content .= $tabsT->render();

// Load the dates selector
$datePickerT = new Template("templates/common/date-picker.php");
$datePickerT->baseUrl = "analytics.php?type=$type&";
$contentT->content .= $datePickerT->render();

// Load the plot
switch ($type) {
	case "visitorscount":
		$data = $analytics->getTotalSiteVisitors($from, $to);
		$plotT = new Template("templates/common/plot-line.php");
		$plotT->legend = false;
		$plotT->datasets = array(
			l10n('admin_analytics_visitorscount', 'Visitors Count') => $data
		);
		$contentT->content .= $plotT->render();
	break;
	case "pageviews":
		$plotT = new Template("templates/common/plot-line.php");
		$plotT->datasets = array(
			l10n('admin_analytics_pageviews', 'Page Views') => $analytics->getPageViews($from, $to),
			l10n('admin_analytics_uniquepageviews', 'Unique Page Views') => $analytics->getUniquePageViews($from, $to)
		);
		$contentT->content .= $plotT->render();
	break;
	case "mostvisitedpages":
		$tableT = new Template("templates/analytics/pages-table.php");
		$orderByUnique = @$_GET['orderByUnique'] == "true";
		$tableT->data = $analytics->getMostVisitedPages($from, $to, 20, $orderByUnique);
		$tableT->orderByUnique = $orderByUnique;
		$tableT->colorClass = "fore-color-$color";
		$contentT->content .= $tableT->render();
	break;
	case "langs":
		$tableT = new Template("templates/analytics/langs-table.php");
		$tableT->data = $data = $analytics->getBrowserLanguages($from, $to, 20);
		$tableT->colorClass = "fore-color-$color";
		$contentT->content .= $tableT->render();
	break;
}

$mainT->content = $contentT->render();
echo $mainT->render();
