<?php

namespace Robust\Core\Helpage;

use Illuminate\Support\Str;
use Robust\Core\Helpage\Traits\SingletonTrait;

/**
 * Class Breadcrumb
 * @package Robust\Core\Helpage
 */
class Breadcrumb
{
    use SingletonTrait;

    /**
     * @var array
     */
    public $crumbs = array();

    /**
     * Create Breadcrumb class and loop through and create crumbs
     */
    public function __construct()
    {
        $current = \Route::currentRouteName();
        $pieces = explode('.', $current);

        foreach ($pieces as $piece) {
            $route_name = implode($pieces, '.');
            if (\Route::getRoutes()->hasNamedRoute($route_name)) {
                $this->crumbs[$route_name] = [
                    'name' => $this->getName($route_name),
                    'route' => $route_name,
                    'parameters' => [],
                    'has_link' => $current !== $route_name,
                    'is_url' => null,
                ];
            }

            $route_name = "{$route_name}.index";

            if (\Route::getRoutes()->hasNamedRoute($route_name)) {
                $this->crumbs[$route_name] = [
                    'name' => $this->getName($route_name),
                    'route' => $route_name,
                    'parameters' => [],
                    'has_link' => $current !== $route_name,
                    'is_url' => null,
                ];
            }

            array_pop($pieces);
        }

        $this->crumbs = array_reverse($this->crumbs);
    }

    /**
     * Insert a new crumb
     *
     * @param  integer $position
     * @param  string $route
     * @param  string $name
     * @param  array $parameters
     * @param  string $url
     * @return Breadcrumb
     */
    public function insertCrumb($position, $route, $name = null, $parameters = [], $has_link = false, $url = null)
    {
        $crumbs = $this->crumbs;
        $current = \Route::currentRouteName();

        $insert_array = [
            $name ?: $this->getName($route) => [
                'name' => $name ?: $this->getName($route),
                'route' => $route,
                'parameters' => $parameters,
                'has_link' => ($has_link) ?: $current !== $route,
                'is_url' => $url ?: null,
            ],
        ];

        $first_array = array_splice($crumbs, 0, $position);
        $this->crumbs = array_merge($first_array, $insert_array, $crumbs);
        return $this;
    }

    /**
     * @param $route
     * @return $this
     */
    public function deleteCrumb($route)
    {
        if (isset($this->crumbs[$route])) {
            unset($this->crumbs[$route]);
        }

        return $this;
    }

    /**
     * Get the breadcrumb name
     *
     * @param  string $route_name
     * @return string
     */
    public function getName($route_name)
    {
        $action = \Route::getRoutes()->getByName($route_name)->getAction();

        if (isset($action['name'])) {
            return $action['name'];
        }

        $key = last(explode('.', $route_name));
        $key = ($key == 'create') ? 'add' : $key;

        if ($key == 'index' && isset($action['group'])) {
            return $action['group'];
        }

        if (in_array($key, ['add', 'edit', 'delete'])) {
            return ucwords($key);
        }

        return Str::plural(ucwords(str_replace('_', ' ', $key)));
    }

    /**
     * Update a crumbs name
     *
     * @param  string $route_name
     * @param  string $name
     * @return Breadcrumb
     */
    public function setName($route_name, $name)
    {
        if (isset($this->crumbs[$route_name])) {
            $this->crumbs[$route_name]['name'] = $name;
        }

        return $this;
    }

    /**
     * Update a crumbs route
     *
     * @param  string $route_name
     * @param  string $route
     * @return Breadcrumb
     */
    public function setRoute($route_name, $route)
    {
        if (isset($this->crumbs[$route_name])) {
            $this->crumbs[$route_name]['route'] = $route;
        }

        return $this;
    }

    /**
     * @param $route_name
     * @param $parameters
     * @return $this
     */
    public function setParameters($route_name, $parameters)
    {
        if (isset($this->crumbs[$route_name])) {
            $this->crumbs[$route_name]['parameters'] = $parameters;
        }

        return $this;
    }

    /**
     * Render the breadcrumbs on the page
     *
     * @return View
     */
    public function render($admin = true)
    {
        if ($admin) {
            return \View::make('core::admin.partials.breadcrumb', ['crumbs' => $this->crumbs]);
        } else {
            return view(\Site::templateResolver('core::website.partials.breadcrumb'), ['crumbs' => $this->crumbs]);
        }
    }
}
