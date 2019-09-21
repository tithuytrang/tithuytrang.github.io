<?php
include("../res/x5engine.php");
$nameList = array("dnl","hx7","hh8","jfe","y4e","6mv","83z","5au","m6v","ckj");
$charList = array("X","G","K","N","U","T","H","E","F","C");
$cpt = new X5Captcha($nameList, $charList);
//Check Captcha
if ($_GET["action"] == "check")
	echo $cpt->check($_GET["code"], $_GET["ans"]);
//Show Captcha chars
else if ($_GET["action"] == "show")
	echo $cpt->show($_GET['code']);
// End of file x5captcha.php
