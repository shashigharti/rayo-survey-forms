<?php
$share = 'https://plus.google.com/share';
$params = \Robust\Core\Helpage\URL::query([
    'url' => $url
]);
?>

<a class="social__link social__google-plus google-plus" href="{{ htmlentities(urldecode($share.'?'.$params)) }}"
   title="{{ $title }}">
    <i class="fa fa-google-plus-square fa-2x"></i>
</a>
