<?php

namespace App\Services\MailBus\Commands;

use Illuminate\Console\Command;
use App\Services\MailBus\Models\MailBus;
use App\Services\MailBus\MailBusRepository;

class ClearMailBusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail_bus:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old mail attachments.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $mailBusRepository = new MailBusRepository();
        $mailBusRepository->clearOldAttachments();
    }
}
