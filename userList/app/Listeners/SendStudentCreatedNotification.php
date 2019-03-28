<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use App\Mail\StudentCreated as StudentCreatedMail;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendStudentCreatedNotification
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
     * @param  StudentCreated  $event
     * @return void
     */
    public function handle(StudentCreated $event)
    {
       Mail::to($event->student->owner->email)->send(
                new StudentCreatedMail($event->student)
            );
    }
}
