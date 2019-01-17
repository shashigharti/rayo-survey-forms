<?php

namespace Robust\Core\Helpage;

use Robust\Core\Helpage\Traits\SingletonTrait;

class Meta
{
    use SingletonTrait;

    public function render($model = null)
    {
        if ($model != '') {
            $meta_title = ($model->meta_title != '') ? $model->meta_title : settings('general-setting', 'company_name');
            $meta_description = ($model->meta_description != '') ? $model->meta_description : settings('general-setting', 'description');

            return sprintf('<title>%s</title>
    <meta name="description" content="%s">', $meta_title, $meta_description);
        } else {
            return sprintf('<title>%s</title>
        <meta name="description" content="%s">
        <meta property="og:title" content="%s">
        <meta property="og:description" content="%s">
        ', settings('general-setting', 'company_name'), settings('general-setting', 'description'), settings('general-setting', 'company_name'), settings('general-setting', 'description'));
        }
    }

    /**
     * Get the canonical url for the current page
     *
     * @param  boolean $meta
     * @return string
     */
    public function getCanonical($meta)
    {
        if (!isset($meta['paginate']) || !$meta['paginate']) {
            return null;
        }
        $paginate = $meta['paginate'];
        $current = $paginate->currentPage();

        if ($current == 1) {
            return \Request::url();
        }
        return null;
    }

    /**
     * Get the previous paginate URL for the page
     *
     * @param  array $meta
     * @return string
     */
    public function getPaginatePrevious($meta)
    {
        if (!isset($meta['paginate']) || !$meta['paginate']) {
            return null;
        }

        $paginate = $meta['paginate'];
        $previous = $paginate->currentPage() - 1;

        if ($previous < 1) {
            return null;
        }
        return $paginate->url($previous);
    }

    /**
     * Get the next paginate URL for the page
     *
     * @param  array $meta
     * @return string
     */
    public function getPaginateNext($meta)
    {
        if (!isset($meta['paginate']) || !$meta['paginate']) {
            return null;
        }
        $paginate = $meta['paginate'];
        $next = $paginate->currentPage() + 1;

        if ($next > $paginate->lastPage()) {
            return null;
        }

        return $paginate->url($next);
    }

    private function iif($if, $else)
    {
        return isset($this->settings[$if]) && $this->settings[$if]
            ? $this->settings[$if]
            : $else;
    }

}
