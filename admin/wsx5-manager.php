<?php


include "includes.php";

Configuration::getControlPanel()->accessOrRedirect();

$mainT = Configuration::getControlPanel()->getMainTemplate();
$mainT->pagetitle = l10n("admin_manager_name", "WebSite X5 Manager");
$mainT->stylesheets = array("css/wsx5-manager.css");
$mainT->content = "";
$contentT = new Template("templates/common/box.php");
$contentT->cssClass = "wsx5-manager";
$contentT->content = "";

// Add the header
$headerT = new Template("templates/wsx5-manager/header.php");
$contentT->content .= $headerT->render();

// Add the ads boxes
$boxT = new Template("templates/wsx5-manager/ads-box.php");
// 1
$boxT->image = "images/01.png";
$boxT->text = l10n("admin_manager_ads_01", "A complete tool to manage your websites from your phone");
$contentT->content .= $boxT->render();
// 2
$boxT->image = "images/02.png";
$boxT->text = l10n("admin_manager_ads_02", "Add your sites simply using your access data or scanning a Qr Code");
$contentT->content .= $boxT->render();
// 3
$boxT->image = "images/03.png";
$boxT->text = l10n("admin_manager_ads_03", "Simultaneously connected with all your sites, tap and manage");
$contentT->content .= $boxT->render();
// 4
$boxT->image = "images/04.png";
$boxT->text = l10n("admin_manager_ads_04", "Your business will follow you with push notifications...If you want");
$contentT->content .= $boxT->render();
// 5
$boxT->image = "images/05.png";
$boxT->text = l10n("admin_manager_ads_05", "Begin to manage orders, watch the analisys, reply the comments and much more.");
$contentT->content .= $boxT->render();

// Add the download box
$boxT = new Template("templates/wsx5-manager/download-box.php");
$contentT->content .= $boxT->render();

// Add the "Add site" box with the QR code
$settings = Configuration::getSettings();
$login = Configuration::getPrivateArea()->whoIsLogged();
$username = $login['username'];
$password = $settings['access']['users'][$username]['password'];
$boxT = new Template("templates/wsx5-manager/add-site-box.php");
$url = $settings['general']['url'] . "admin/login.php";
$hash = sha1($username . ":3cea997e06cdfe42f36ba21473ca9b57:" . $password);
$json = '{ "version": "' . $settings['general']['version'] . '", "url": "' . $url . '", "hash": "' . $hash . '"}';
$boxT->url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($json);
$boxT->sitename = $settings['general']['sitename'];
$contentT->content .= $boxT->render();

$mainT->content .= $contentT->render();
echo $mainT->render();

