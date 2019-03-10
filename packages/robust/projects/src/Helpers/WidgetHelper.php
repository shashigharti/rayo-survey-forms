<?php
namespace Robust\Projects\Helpers;

use Robust\Projects\Models\Project;


/**
 * Class WidgetHelper
 * @package Robust\Projects\Helpers
 */
class WidgetHelper
{

    /**
     * @return mixed
     */
    public function totalProjects(){
        $projects = Project::all();
        return $projects->count();
    }

    /**
     * @return mixed
     */
    public function projects(){
        $projects = Project::all();
        return $projects;
    }

}