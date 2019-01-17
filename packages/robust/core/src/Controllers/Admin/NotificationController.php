<?php
namespace Robust\Core\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Robust\Core\Models\NotificationRepository;

/**
 * Class NotificationController
 * @package Robust\Core\Controllers
 */
class NotificationController extends Controller
{

    /**
     * NotificationController constructor.
     * @param NotificationRepository $notification
     */
    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @return string
     */
    public function getNotificationCountByDate(Request $request)
    {
        $type = $request->get('type');
        $date_range = $request->get('date_range');
        if (isset($date_range['start_date'])) {
            $start_date = $date_range['start_date'];
            $end_date = $date_range['end_date'];
        } else {
            $date_range = $date_range['value'];
            if ($date_range == 'this week') {
                $start_date = Carbon::now()->startOfWeek()->format('Y/m/d');
                $end_date = Carbon::now()->endOfWeek()->format('Y/m/d');
            }
        }
        $params = [
            ['created_at', '>=', $start_date],
            ['created_at', '<=', $end_date],
            ['type', '=', $type]
        ];
        $count = $this->notification->getNotificationCount($params);
        return response()->json([
            'count' => $count,
            'percentage_up' => $count
        ]);
    }

    /**
     * @return string
     */
    public function getNotificationsByDate(Request $request)
    {
        $type = $request->get('type');
        if ($request->get('start_date')) {
            $start_date = $request->get('start_date');
            $end_date = $request->get('start_date');
        } else {
            $date_range = $request->get('date_range');
            if ($date_range['value'] == 'this week') {
                $start_date = Carbon::now()->startOfWeek()->format('Y/m/d');
                $end_date = Carbon::now()->endOfWeek()->format('Y/m/d');
            }
        }

        $params = [
            ['created_at', '>=', $start_date],
            ['created_at', '<=', $end_date],
            ['type', '=', $type]
        ];
        $notifications = $this->notification->getNotifications($params);
        return ($notifications) ? $notifications : [];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNotifications()
    {
        return view('core::admin.notifications.index',
            ['ui' => new \Robust\Core\UI\Notification, 'title' => 'Notifications']);
    }


}