<?php
$share = 'https://twitter.com/intent/tweet';
$params = \Robust\Core\Helpage\URL::query([
    'url' => $url,
    'text' => $text,
    'original_referer' => \URL::current(),
]);
?>

<a class="social__link social__twitter twitter" href="{{ htmlentities($share.'?'.$params) }}" title="{{ $title }}">
    <i class="fa fa-twitter-square fa-2x"></i>
</a>
