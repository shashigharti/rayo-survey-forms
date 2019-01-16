<?php

namespace Robust\DynamicForms\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 * @package Robust\DynamicForms\Providers
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saving: Robust\DynamicForms\Models\Form' => [
            \Robust\DynamicForms\Listeners\FormSavingEventListener::class
        ],
        'eloquent.saving: Robust\DynamicForms\Models\FormField' => [
            \Robust\DynamicForms\Listeners\FieldEventListener::class
        ],
        'eloquent.saved: Robust\DynamicForms\Models\Form' => [
            \Robust\DynamicForms\Listeners\FormSavedEventListener::class
        ],
    ];
}
