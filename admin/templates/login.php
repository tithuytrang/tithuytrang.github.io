<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width">
	<title><?php echo $pagetitle ?> - <?php echo $sitetitle ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&subset=cyrillic,greek" rel="stylesheet">
	<link rel="stylesheet" href="../style/reset.css">
	<link rel="stylesheet" href="css/template.css">
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="css/theme-<?php $settings = Configuration::getSettings(); echo $settings['admin']['theme'] ?>.css">
</head>
<body onload="document.getElementById('uname').focus();">
	<div class="login-margin">
		<div class="login-box background-blue-light">
			<div class="header fore-mute-dark">
				<?php if (strlen($logo)): ?>
				<img class="logo" src="<?php echo $logo ?>" alt="<?php echo $sitetitle ?>">
				<?php endif; ?>
				<div class="text">
					<div class="text-extralarge"><?php echo $sitetitle ?></div>
					<div class="text-small text-light"><?php echo str_replace(array("/", "-"), array("/<wbr>", "-<wbr>"), $sitesubtitle) ?></div>
				</div>	
			</div>		
			<div class="login-form">			
				<form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="post">
					<input type="text" id="uname" name="uname" placeholder="<?php echo str_replace(":", "", l10n('blog_email')); ?>" class="border-bottom border-mute-dark"/>
					<input type="password" name="pwd" placeholder="<?php echo str_replace(":", "", l10n('blog_password')); ?>" class="border-bottom border-mute-dark"/>
					<div class="error text-right text-small"><?php echo $error ?></div>
					<div class="text-right"><input type="submit" class="button fore-white background-color-1" value="<?php echo l10n('blog_login'); ?>" /></div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
