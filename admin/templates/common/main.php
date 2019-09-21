<!DOCTYPE html>
<html lang="en" class="fore-mute-dark background-mute-light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $pagetitle ?> - <?php echo $sitetitle ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&subset=cyrillic,greek" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/reset.css?v=<?php echo md5($imSettings['general']['version']) ?>"/>
    <link rel="stylesheet" href="../style/style.css?v=<?php echo md5($imSettings['general']['version']) ?>"/>
    <link rel="stylesheet" href="../style/print.css?v=<?php echo md5($imSettings['general']['version']) ?>" media="print"/>
    <link rel="stylesheet" href="css/template.css?v=<?php echo md5($imSettings['general']['version']) ?>">
<?php if (isset($stylesheets) && is_array($stylesheets)):?>
<?php     foreach ($stylesheets as $sheet): ?>
    <link rel="stylesheet" href="<?php echo $sheet ?>?v=<?php echo md5($imSettings['general']['version']) ?>">
<?php endforeach; ?>
<?php endif; ?>
    <link rel="stylesheet" href="css/theme-<?php echo strtolower($theme) ?>.css?v=<?php echo md5($imSettings['general']['version']) ?>">
    <link rel="stylesheet" href="css/print.css?v=<?php echo md5($imSettings['general']['version']) ?>" media="print">
    <script src="../res/jquery.js?v=<?php echo md5($imSettings['general']['version']) ?>"></script>
    <script src="../res/modernizr-custom.js?v=<?php echo md5($imSettings['general']['version']) ?>"></script>
    <script src="../res/x5engine.js?v=<?php echo md5($imSettings['general']['version']) ?>"></script>
    <script>x5engine.settings.currentPath = '../';</script>
    <script src="js/Chart.min.js?v=<?php echo md5($imSettings['general']['version']) ?>"></script>
    <script src="js/controlpanel.js?v=<?php echo md5($imSettings['general']['version']) ?>"></script>
<?php if (isset($scripts) && is_array($scripts)):?>
<?php     foreach ($scripts as $script): ?>
    <script src="<?php echo $script ?>"></script>
<?php endforeach; ?>
<?php endif; ?>
</head>
<body class="fore-mute-dark background-mute-light">
    <div class="main-container">
        <div class="sidebar background-mute-dark fore-white border-right-3 border-color-1 noprint">
            <div class="header">
                <?php if (strlen($logo)): ?>
                <img class="logo" src="<?php echo $logo ?>" alt="<?php echo $sitetitle ?>">
                <?php endif; ?>
                <div class="text">
                    <?php
                        // App redirect code
                        if (Configuration::getControlPanel()->isWsx5Manager()) {
                            $redirectJs = " onclick=\"parent.postMessage('{&quot;code&quot;: 301, &quot;location&quot;: &quot;" . $imSettings['general']['url'] . "&quot;}', '*'); return false;\"";
                        }
                    ?>
                    <div class="site-title text-extralarge">
                        <a href="<?php echo $imSettings['general']['url'] ?>"<?php echo isset($redirectJs) ? $redirectJs : "" ?> class="fore-color-inherit" target="_blank"><?php echo $sitetitle ?></a>
                    </div>
                    <div class="site-subtitle">
                        <a href="<?php echo $imSettings['general']['url'] ?>"<?php echo isset($redirectJs) ? $redirectJs : "" ?> class="fore-color-inherit" target="_blank"><?php echo str_replace(array("/", "-"), array("/<wbr>", "-<wbr>"), $sitesubtitle) ?></a>
                    </div>
                    <div class="separator fore-color-1"></div>
                    <div class="username semibold"><?php echo $username ?></div>
<?php if (!Configuration::getControlPanel()->isWsx5Manager()): ?>
                    <a href="login.php?logout" class="logout button fore-white background-color-1"><?php echo strtoupper(l10n("admin_logout", "Logout")) ?></a>
<?php endif; ?>
                </div>
            </div>
            <ul class="menu">
<?php
    $itemT = new Template("templates/common/menu-entry.php");
    foreach ($menu as $entry) {
        $itemT->url = $entry['url'];
        $itemT->image = $entry['image'];
        $itemT->text = $entry['text'];
        $itemT->selected = $entry['selected'];
        echo "\t\t\t\t" . str_replace("\n", "\n\t\t\t\t", $itemT->render()) . "\n";
    }
?>
            </ul>
        </div>
        <div class="content">
            <div class="text-extralarge toolbar background-mute-vary noprint">
                <div class="hamburger">
                    <div class="bar background-mute-dark"></div>
                    <div class="bar background-mute-dark"></div>
                    <div class="bar background-mute-dark"></div>
                </div>
<?php if (strlen($pagetitle)): ?>
                <div class="pagetitle uppercase fore-color-1"><?php echo $pagetitle ?></div>
<?php endif; ?>
<?php if (strlen($logo)): ?>
                <img class="logo" src="<?php echo $logo ?>" alt="<?php echo $sitetitle ?>">
<?php endif; ?>
            </div>
            <?php echo $content ?>
        </div>
    </div>
</body>
</html>

