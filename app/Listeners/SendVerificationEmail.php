<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail
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
    public function handle(UserRegistered $even): void
    {
        $user = $even->user;


        //Generate code
        $code = Str::random(6);
        $user->code = '' . $code;
        $user->save();
        //send verfication email
        // Mail::raw("Your verfication code : $code", function ($message) use ($user) {
        //     $message->to($user->email);
        //     $message->subject("Email Verfication");
        // });
    }
}
