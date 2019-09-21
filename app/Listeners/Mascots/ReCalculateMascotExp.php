<?php

namespace App\Listeners\Mascots;

use App\Events\Mascots\LevelChanged;
use App\Events\Tasks\TaskCompleted;
use App\Facades\MascotLifeFacade as MascotLife;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ReCalculateMascotExp
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
     * @param  TaskCompleted  $event
     * @return void
     */
    public function handle(TaskCompleted $event)
    {
        //
    }

    public function onPlusExp($event)
    {
        $mascot = auth()->user()->mascot()->first();
        $mascot->update(['exp' => $mascot->exp + 1]);
        MascotLife::levelUp($mascot);
        event(new LevelChanged($mascot));
    }

    public function onMinusExp($event)
    {
        $mascot = auth()->user()->mascot()->first();
        $mascot->update(['exp' => $mascot->exp - 1]);
        MascotLife::levelDown($mascot);
        event(new LevelChanged($mascot));
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Tasks\TaskCompleted',
            'App\Listeners\Mascots\ReCalculateMascotExp@onPlusExp'
        );

        $events->listen(
            'App\Events\Tasks\TaskUnCompleted',
            'App\Listeners\Mascots\ReCalculateMascotExp@onMinusExp'
        );
    }
}
