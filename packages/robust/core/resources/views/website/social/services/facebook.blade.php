<?php
$share = 'https://www.facebook.com/v2.5/dialog/share';
$params = \Robust\Core\Helpage\URL::query([
    'href' => $url,
    'sdk' => 'joey',
    'display' => 'popup',
    'src' => 'share_button',
    "app_id" => settings('fb-analytics', 'app_id'),

]);
?>

@if(settings('fb-analytics', 'app_id'))
    <a class="social__link social__facebook facebook" href="{{ htmlentities(urldecode($share.'?'.$params)) }}"
       title="{{ $title }}">
        <i class="fa fa-facebook-square fa-2x"></i>
    </a>
@endif