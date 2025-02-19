<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Observers\Log\LogObserver;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogEventListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(LogEvent $event)
    {
        //
        info("Event has been handled");
        dispatch(new LogObserver($event->title, $event->url, $event->action));
    }
}
