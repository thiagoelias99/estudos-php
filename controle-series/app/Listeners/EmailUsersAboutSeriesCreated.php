<?php

namespace App\Listeners;

use App\Events\SeriesCreated;

use App\Mail\SeriesCreated as SeriesCreatedMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
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
    public function handle(SeriesCreated $event): void
    {
        $userList = User::all();
        foreach ($userList as $index => $user) {
            $email = new SeriesCreatedMail(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason,
            );
            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email);
        }
    }
}
