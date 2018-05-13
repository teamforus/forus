<?php

namespace App\Services\MailBus\Facades;

use Illuminate\Support\Facades\Facade;

class MailBus extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mail_bus';
    }
}
