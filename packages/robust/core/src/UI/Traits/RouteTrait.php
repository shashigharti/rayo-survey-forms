<?php
namespace Robust\Core\UI\Traits;

/**
 * Class RouteTrait
 * @package Robust\Core\UI\Traits
 */
trait RouteTrait
{
    /**
     * @param $option
     * @param $params
     * @return string
     */
    public function getTableRoute($option, $params = [])
    {
        if (is_array($option['url'])) {
            $callback = $option['url']['callback'];
            return $this->$callback($params['id']);
        }
        return route($option['url'], array_merge([$params['id']], $params['params']));
    }


    /**
     * @param array $params
     * @return string
     */
    public function getCreateRoute($type = 'add', $params = [])
    {
        return route($this->right_menu[$type]['url'], $params);
    }

    /**
     * @param $key
     * @param $header
     * @param $row
     * @return mixed
     */
    public function getTableColumns($key, $header, $row)
    {
        if ($key == 'callback') {
            $callback = 'get' . str_replace(' ', '', $header);
            return $this->$callback($row);
        }
        return $row[$key];
    }
}




