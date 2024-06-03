<?php

namespace App\Listeners;

use App\Events\LoggingEnded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogEndListener
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
    public function handle(LoggingEnded $event): void
    {
        echo 'Logging ended for event: ' . $event->event . ' on model: ' . get_class($event->model) . ' ID: ' . $event->model->id . PHP_EOL;
    }
}
