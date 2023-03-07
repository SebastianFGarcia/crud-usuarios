<?php

namespace App\Listeners;

use App\Events\NewUserRegisteredEvent;
use App\Notifications\NewUserRegisteredNotification;
use App\Mail\ReportQuantityUsersCountryMailable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewUserRegisteredListener
{
    public $admins;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->admins = User::where('is_admin', true)->get();
    }

    /**
     * Handle the event.
     */
    public function handle(NewUserRegisteredEvent $event): void
    {
        Notification::send($event->user, new NewUserRegisteredNotification($event->user));
        foreach ($this->admins as $admin) {
            Mail::to($admin)->send(new ReportQuantityUsersCountryMailable());
        }
            
    }
}
