<?php

namespace Robust\Core\Helpers;

use Carbon\Carbon;
use Robust\Core\Models\UserActivity;

/**
 * Class UserActivityHelper
 * @package Robust\Admin\Helpers
 */
class UserActivityHelper
{

    /**
     * @var UserActivity
     */
    protected $model;


    /**
     * UserActivityHelper constructor.
     * @param UserActivity $model
     */
    public function __construct(UserActivity $model)
    {
        $this->model = $model;
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getAll($user)
    {
        return $this->model->where('user_id',$user)->orderBy('created_at','desc')->get();
    }

    /**
     * @param $user
     * @param $slug
     * @return mixed
     */
    public function bySlug($user, $slug)
    {
        return $this->filter($user,$slug)->get();
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getLastLogin($user)
    {
        $activity = $this->filter($user,'logged-in')->first();
        if($activity){
            return $activity->created_at->diffForHumans();
        }
        return '-';
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getLoginCount($user)
    {
        return $this->filter($user,'logged-in')->count();
    }

    /**
     * @param $user
     * @param $month
     * @return mixed
     */
    public function getLastLoginByDate($user)
    {
        return  [
            'current_month' => $this->filter($user,'logged-in')->whereBetween('created_at',[
                Carbon::now()->firstOfMonth(),Carbon::now()
            ])->count(),
            'past_month' =>  $this->filter($user,'logged-in')->whereBetween('created_at',[
                Carbon::now()->subMonth()->firstOfMonth(),Carbon::now()->subMonth()->lastOfMonth()
            ])->count(),
            'current_year' => $this->filter($user,'logged-in')->whereBetween('created_at',[
                Carbon::now()->firstOfYear(),Carbon::now()
            ])->count(),
        ];
    }

    /**
     * @param $user
     * @param $slug
     * @return mixed
     */
    public function filter($user, $slug)
    {
        return $this->model->where('user_id',$user)->where('slug',$slug);
    }


    /**
     * @param $slug
     * @return mixed
     */
    public function getRecentByslug($slug)
    {
        return $this->model
            ->where('slug',$slug)
            ->orderBy('created_at','desc')
            ->limit(5)->get();
    }

    /**
     * @param $slug
     * @return array
     */
    public function getActiveUsersByDate($slug)
    {
        return [
            'today' => $this->model->where('slug',$slug)->whereDate('created_at',Carbon::today())->count(),
            'week' => $this->model->where('slug',$slug)->whereDate('created_at','>',Carbon::today()->subWeek())->count(),
            'month' => $this->model->where('slug',$slug)->whereDate('created_at','>',Carbon::today()->subMonth())->count()
        ];
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getCountBySlug($slug)
    {
        return $this->model->where('slug',$slug)->count();
    }
}
