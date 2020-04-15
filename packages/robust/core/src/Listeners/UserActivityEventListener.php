<?php

namespace Robust\Core\Listeners;

use Illuminate\Support\Str;
use Robust\Core\Events\UserActivityEvent;
use Robust\Core\Models\UserActivity;

/**
 * Class UserActivityEventListener
 * @package Robust\Core\Listeners
 */
class UserActivityEventListener
{
    /**
     * @var
     */
    protected $model;

    /**
     * UserActivityEventListener constructor.
     * @param UserActivity $model
     */
    public function __construct(UserActivity $model)
    {
        $this->model = $model;
    }


    /**
     * @param UserActivityEvent $event
     */
    public function handle(UserActivityEvent $event)
    {
        $data = [
            'user_id' => $event->user,
            'title' => $event->title,
            'slug' => Str::slug($event->title),
            'url' => $event->url,
            'description' => $event->description
        ];
        $this->model->create($data);
    }
}
