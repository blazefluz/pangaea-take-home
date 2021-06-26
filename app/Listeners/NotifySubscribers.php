<?php

namespace App\Listeners;

use App\Events\PublishTopic;
use App\Services\NotificationServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifySubscribers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PublishTopic  $event
     * @return void
     */
    public function handle(PublishTopic $event)
    {
        foreach ($event->subscribers as $subcriber) {
            (new NotificationServices)->publish_message($subcriber, $event->payload);
        }
    }
}
