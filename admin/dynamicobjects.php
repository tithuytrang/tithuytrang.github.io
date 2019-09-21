<?php

include "includes.php";

Configuration::getControlPanel()->accessOrRedirect();

// Load the main template
$mainT = Configuration::getControlPanel()->getMainTemplate();
$mainT->pagetitle = l10n("dynamicobj_list", "List of the Dynamic Objects in your Site");
//$mainT->stylesheets = array("css/comments.css");
$mainT->content = "";
$contentT = new Template("templates/common/box.php");
$contentT->cssClass = "dynamicobjects";
$contentT->content = "";

// Show the pages' dynamic objects table
$tableT = new Template("templates/dynamicobjects/table.php");
$tableT->title = l10n("dynamicobj_title_pages", "Page Objects");
$tableT->dynamicobjects = $imSettings['dynamicobjects']['pages'];
$tableT->page = true;
$contentT->content .= $tableT->render();

// Show the header and footer dynamic objects table
$tableT = new Template("templates/dynamicobjects/table.php");
$tableT->title = l10n("dynamicobj_title_template", "Header/Footer Objects");
$tableT->dynamicobjects = $imSettings['dynamicobjects']['template'];
$tableT->page = false;
$contentT->content .= $tableT->render();

$mainT->content = $contentT->render();
echo $mainT->render();
