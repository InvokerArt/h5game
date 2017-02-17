<?php

namespace App\Listeners\Backend\Access\Role;

/**
 * Class RoleEventListener.
 */
class RoleEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Role';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.roles.created") '.$event->role->name,
            $event->role->id,
            'plus',
            'bg-green'
        );
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.roles.updated") '.$event->role->name,
            $event->role->id,
            'save',
            'bg-aqua'
        );
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.roles.deleted") '.$event->role->name,
            $event->role->id,
            'trash',
            'bg-maroon'
        );
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Access\Role\RoleCreated::class,
            'App\Listeners\Backend\Access\Role\RoleEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Access\Role\RoleUpdated::class,
            'App\Listeners\Backend\Access\Role\RoleEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Access\Role\RoleDeleted::class,
            'App\Listeners\Backend\Access\Role\RoleEventListener@onDeleted'
        );
    }
}
