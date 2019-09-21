<!-- Dektop/Tablet mode -->
<table>
    <tbody class="border-top-2 border-mute-light">
<?php $i = 0; foreach ($comments as $comment): $i++; ?>
<?php
    // ---------
    // Username
    // ---------
    
    $user = "";
    // User name (with link to its url if available)
    // Prepare the url
    if (isset($comment['url']) && strlen($comment['url']) > 0) {
        if (strpos($comment['url'], "http://") !== 0 && strpos($comment['url'], "https://") !== 0) {
            $comment['url'] = "http://" . $comment['url'];
        }
        $user = "<a class=\"text-underline fore-color-inherit\" href=\"${comment['url']}\" target=\"_blank\" " . (strpos($comment['url'], $siteUrl) === false ? 'rel="nofollow"' : '') . "\">${comment['name']}</a>";
    } else {
        $user = $comment['name'];
    }
    if (isset($comment['email'])) {
        $user .= "<span class=\"no-small-phone\">(<a class=\"fore-color-inherit\" href=\"mailto:${comment['email']}\">${comment['email']}</a>)</span>";
    }

    // -----
    // Links
    // -----

    $links = "";    
    if ($comment['abuse'] == "1") {
        $links .= "<span class=\"bottom icon-large fa fa-exclamation-triangle fore-yellow\" title=\"" . l10n('admin_comment_abuse') . "\"></span> |";
    }
    if ($comment['abuse'] == "1") {
        $links .= "<a class=\"fa icon-large fa-level-up fore-green\" href=\"${posturl}unabuse=${comment['id']}\" title=\"" . l10n("blog_abuse_remove", "Remove abuse")  . "\"></a>";
    }
    if ($comment['approved'] == "1") {
        $links .= "<a class=\"fa icon-large fa-thumbs-down fore-yellow\" onclick=\"return confirm('" . str_replace("'", "\\'", l10n('blog_unapprove_question'))  . "')\" href=\"${posturl}disable=${comment['id']}\" title=\"" . l10n('blog_unapprove') . "\"></a>";
    } else {
        $links .= "<a class=\"fa icon-large fa-thumbs-up fore-green\" onclick=\"return confirm('" . str_replace("'", "\\'", l10n('blog_approve_question')) . "')\" href=\"${posturl}enable=${comment['id']}\" title=\"" . l10n('blog_approve') . "\"></a>";
    }
    $links .= "<a class=\"fa icon-large fa-close fore-red\" onclick=\"return confirm('" . str_replace("'", "\\'", l10n('blog_delete_question')) . "')\" href=\"${posturl}delete=${comment['id']}\" title=\"" . l10n('blog_delete') . "\"></a>";

    // ---------
    // CSS Class
    // ---------
    
    $cssClass = ($comment['abuse'] == "1" ? "background-yellow-light" : ($i % 2 ? '' : 'background-blue-light'));

    // ---------
    // Stars
    // ---------
    
    $rating = "";
    if ($rating && isset($comment['rating']) && $comment['rating'] > 0) {
        $rating .= "<div class=\"rating margin-bottom\">";
        for ($s = 0; $s < 5; $s++) {
            if ($comment['rating'] > $s + 1) {
                $rating .= "<span class=\"fa icon-large fa-star fore-yellow\"></span>";
            }
            else if ($comment['rating'] > $s + 0.5) {
                $rating .= "<span class=\"fa icon-large fa-star-half fore-yellow\"></span><span style=\"letter-spacing: -2px;\" class=\"fa fa-star-half fa-flip-horizontal fore-mute-dark\"></span>";
            } else {
                $rating .= "<span class=\"fa icon-large fa-star fore-mute-dark\"></span>";
            }
        }
        $rating .= "</div>";
    }
?>
    <!-- Desktop Row -->
    <tr class="no-phone comment <?php echo $cssClass ?>">
        <td class="text-small border-left border-mute-light border-bottom">
            <div class="margin-bottom"><?php echo $user ?></div>
            <?php echo $rating; ?>
            <div>IP: <?php echo $comment['ip'] ?></div>
        </td>
        <td class="text-small border-bottom border-mute-light"><?php echo $comment['timestamp'] ?></td>
        <td class="text-small border-bottom border-mute-light"><?php echo $comment['body'] ?></td>
        <td class="border-bottom border-right border-mute-light"><?php echo $links ?></td>
    </tr>

    <!-- Phone Row -->
    <tr class="no-tablet no-desktop comment <?php echo $cssClass ?>">
        <td colspan="4">
            <div class="margin-bottom float-left"><?php echo $user ?></div>
            <div class="margin-bottom float-right">
                <?php echo date("Y-m-d", strtotime($comment['timestamp'])) ?>
                <span class="no-small-phone"><?php echo date("H:i", strtotime($comment['timestamp'])) ?></span>
            </div>
            <?php if (strlen($rating)): ?>
            <div class="margin-bottom clearfix"><?php echo $rating ?></div>
            <?php endif; ?>
            <div class="margin-bottom clearfix">IP: <?php echo $comment['ip'] ?></div>
            <div class="margin-bottom"><?php echo $comment['body'] ?></div>
            <div class="text-right"><?php echo $links ?></div>
        </td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
