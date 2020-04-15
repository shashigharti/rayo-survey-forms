<?php
namespace Robust\Core\Repositories\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;

/**
 * Class NotificationRepository
 * @package Robust\Core\Models
 */
class NotificationRepository
{
    use SearchRepositoryTrait;

    /**
     * NotificationRepository constructor.
     * @param Notification $notification
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getNotificationCount($params)
    {
        $params[] = ['notifiable_id','=',\Auth::user()->id];
        return  DB::table('notifications')->where($params)->count();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getNotifications($params)
    {
        return $this->notification->where($params)->get();
    }

    /**
     * @return array
     */
    public function markAsRead($id)
    {
        return $this->notification->find($id)->markAsRead();
    }


}
