<?php
namespace Robust\Core\Helpers\Reports;

use Carbon\Carbon;
use Robust\Admin\Models\User;

/**
 * Class UserHelper
 * @package Robust\Core\Helpers\Reports
 */
class UserHelper
{
    private $users = null;


    /**
     * @return array
     */
    public function users()
    {
        $this->users = User::all();

        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->users->all();
    }

    /**
     * @return array
     */
    public function groupedByRole()
    {
        return $this->users()->groupBy('role_id');
    }

    /**
     * @return array
     */
    public function thisWeek()
    {
        return $this->users()->where('created_at','>=',Carbon::getWeekStartsAt());
    }

    /**
     * @return array
     */
    public function weekly()
    {
        return $this->users()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('W');
        });
    }

    /**
     * @return array
     */
    public function monthly()
    {
        return $this->users()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('M');
        });
    }

    /**
     * @return array
     */
    public function yearly()
    {
        return $this->users()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y');
        });
    }


}