<?php

namespace App\Listeners;

use App\Events\LoggingStarted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogStartListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoggingStarted $event): void
    {
        echo 'Logging started for event: ' . $event->event . ' on model: ' . get_class($event->model) . PHP_EOL;
    }
}
