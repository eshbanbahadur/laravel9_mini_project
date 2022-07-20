<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\News;
use Mail;
class NotifyNewsCreated
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
     * @param  \App\Events\NewsCreated  $event
     * @return void
     */
    public function handle(NewsCreated $event)
    {
        
        $news = News::all();
        // Currently i'm just echo the CreateNews Object because the requirement is Create a new event NewsCreated and fire it everytime a new news object is
        // created from the controller
        echo($event->news);
        // foreach($news as $new) {
        //    Mail::to($new)->send('emails.post_created', $event->news);
        // }
    }
}
