<?php

require_once "includes.php";

$login_error = "";

// Logout
if (isset($_GET['logout'])) {
	$login = Configuration::getPrivateArea();
	$login->logout();
	@header("Location: ../");
	exit(0);
}

// Login Error
if (isset($_GET['error'])) {
	$login_error = $l10n['private_area_login_error'];
}

// Login via form
if (isset($_POST['uname']) && $_POST['uname'] != "" && isset($_POST['pwd']) && $_POST['pwd'] != "") {
	$login = Configuration::getPrivateArea();
	if ($login->login($_POST['uname'], $_POST['pwd']) == 0) {
		$url = $login->getSavedPage() ? $login->getSavedPage() : "index.php";
		exit('<!DOCTYPE html><html><head><title>Loading...</title><meta http-equiv="refresh" content="1; url=' . $url . '"></head><body><p style="text-align: center;">Loading...</p></body></html>');
	} else {
		$login_error = $l10n['private_area_login_error'];
	}
}


// Token request
if (isset($_POST['token_request'])) {
	$hash = $_POST['token_request'];
	$login = Configuration::getPrivateArea();
	$user = $login->getUserByHash($hash);
	$settings = Configuration::getSettings();
	if (is_array($user)) {
		header("Content-type: application/json");
		$token = $login->getUserLoginToken($user['username']);
		echo "{
			\"result\": \"ok\",
			\"token\": " . json_encode($token['token']) . ",
			\"expires\": " . $token['expires'] . ",
			\"image\": " . json_encode($settings['general']['icon']) . ",
			\"sitename\": " . json_encode($settings['general']['sitename']) . ",
			\"supportNotifications\": " . ($settings['admin']['enable_manager_notifications'] ? "true" : "false") . "
		}";
	} else {
		header("HTTP/1.0 403 Forbidden");
		header("Content-type: application/json");
		echo "{ \"result\": \"error\", \"message\": \"user_not_found\" }";
	}
	exit(0);
}

// Login via token
if (isset($_GET['token'])) {
	$login = Configuration::getPrivateArea();
	if ($login->loginByToken($_GET['token']) == 0) {
		Configuration::getControlPanel()->loginWsx5Manager();
		$redirect = Configuration::getControlPanel()->getRedirectFromArray($_GET);
		if (!$redirect) {
			$redirect = "index.php";
		}
		exit('<!DOCTYPE html><html><head><title>Loading...</title><meta http-equiv="refresh" content="0; url=' . $redirect . '"></head><body></body></html>');
	} else {
		header("HTTP/1.0 401 Unauthorized");
		echo '<script>parent.postMessage(\'{"code": 401}\', "*");</script>';
		echo $l10n['private_area_login_error'];
	}
	exit(0);
}


// Redirect to a specific section
$redirect = Configuration::getControlPanel()->getRedirectFromArray($_GET);
if ($redirect) {
	header("Location: " . $redirect);
	exit(0);
}

// If a session is already set, try to redirect to the dashboard
Configuration::getControlPanel()->attemptAutoLogin();

// Show the login form

$loginT = Configuration::getControlPanel()->getTemplate("templates/login.php");
$loginT->pagetitle = "Login";
$loginT->error = $login_error;
echo $loginT->render();
