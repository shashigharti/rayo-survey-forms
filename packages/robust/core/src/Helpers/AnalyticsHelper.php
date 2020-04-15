<?php

namespace Robust\Core\Helpers;

use Analytics;
use Spatie\Analytics\Period;

/**
 * Class AnalyticsHelper
 * @package Robust\Core\Helpers
 */
class AnalyticsHelper extends Analytics
{

    /**
     * @param $url
     * @return mixed
     */
    public function getPageViews($url)
    {
        $page_views = Analytics::performQuery(Period::days(30), 'ga:pageviews', [
            'filters' => 'ga:pagePath==' . $url
        ]);
        return $page_views->totalsForAllResults['ga:pageviews'];
    }
}