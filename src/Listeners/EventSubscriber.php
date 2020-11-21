<?php

namespace AwemaPL\Chromator\Listeners;

use AwemaPL\Auth\Facades\Auth as AwemaAuth;
use AwemaPL\Chromator\Sections\Tokens\Models\Token;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class EventSubscriber
{
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Registered',
            static::class.'@handleRegistered'
        );
    }

    public function handleRegistered($event)
    {

    }
}
