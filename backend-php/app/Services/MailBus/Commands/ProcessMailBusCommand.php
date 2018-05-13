<?php

namespace App\Services\MailBus\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

use App\Services\MailBus\Models\MailBus;
use App\Services\MailBus\MailBusRepository;

class ProcessMailBusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail_bus:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process mail bus queue.';

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

        try {
            $mailBusRepository = new MailBusRepository();

            $time = time();
            
            while($time + 60 > time()) {
                while($mail = MailBus::whereState('pending')->first()) {
                    $mailBusRepository->sendMail($mail);

                    if ($time + 60 < time())
                        break;
                }

                sleep(1);
            }
        } catch (\Exception $e) {
            
        }
    }
}
