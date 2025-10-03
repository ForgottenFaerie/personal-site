<?php
function makeLinksClickable($text) {
    return preg_replace(
        '/(https?:\/\/[^\s]+)/',
        '<a href="$1" target="_blank">$1</a>',
        $text
    );
}

function sanitizeContent($text) {
    return strip_tags($text, '<b><i><strong><em><a><br>');
}

function parseCodeBlocks($text) {
    return preg_replace_callback('/```(.*?)```/s', function($matches) {
        $code = htmlspecialchars($matches[1], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        return "<pre><code>$code</code></pre>";
    }, $text);
}

function formatPost($text) {
    $text = sanitizeContent($text);
    $text = parseCodeBlocks($text);
    $text = makeLinksClickable($text);
    return nl2br($text);
}
?>
