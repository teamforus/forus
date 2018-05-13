<?php

namespace App\Services\MailBus;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Services\UUIDGeneratorService\Facades\UUIDGenerator;

class MailBus
{
    protected $mailBusRepository;

    public function __construct() {
        $this->mailBusRepository = new MailBusRepository();
    }

    public function greetings() {
        return 'Greetings Earth Clan!';
    }

    public function getQueue()
    {
        return Models\MailBus::get();
    }

    public function push($view, $scope, $message, $attachments = []) {
        return $this->mailBusRepository->push(
            $view, $scope, $message, $attachments
        );
    }
}