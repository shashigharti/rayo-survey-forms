<?php
namespace Robust\Projects\Helpers;

use Robust\Projects\Models\Project;

/**
 * Class ProjectHelper
 * @package Robust\Projects\Helpers
 */
class ProjectHelper
{

    /**
     * @param $parent_id
     * @return array
     */
    public function getOutcomes($parent_id)
    {
        $project = Project::find($parent_id);
        return ($project) ? $project->outcomes->sortBy('numbering')->pluck('number_name', 'id')->toArray() : [];
    }

    /**
     * @param $parent_id
     * @return mixed
     */
    public function getOutputs($parent_id)
    {
        $project = Project::find($parent_id);
        return ($project) ? $project->outputs->sortBy('numbering')->pluck('number_name', 'id')->toArray() : [];
    }


    /**
     * @param $parent_id
     * @return array
     */
    public function getGoals($parent_id)
    {
        $project = Project::find($parent_id);
        return ($project) ? $project->goals->sortBy('numbering')->pluck('number_name', 'id')->toArray() : [];
    }


    /**
     * @param $parent_id
     * @return array
     */
    public function getActivities($parent_id)
    {
        $project = Project::find($parent_id);
        return ($project) ? $project->activities->sortBy('numbering')->pluck('number_name', 'id')->toArray() : [];
    }

    /**
     * @param $parent_id
     * @return array
     */
    public function getIndicators($parent_id)
    {
        $project = Project::find($parent_id);
        return ($project) ? $project->indicators->pluck('number_name', 'id')->toArray() : [];
    }

    /**
     * @return mixed
     */
    public function getProjects()
    {
        return Project::all()->pluck('name', 'id');
    }
}