<?php

namespace App\Services\MailBus;

use \App\Services\MailBus\Models\MailBus;

class MailBusRepository
{
    private $storage_path = 'mail_bus/attachments/';

    public function push($view, $scope, $message, $attachments) {
        $attachments = $this->storeAttachments($attachments);
        $payload = compact('view', 'scope', 'message', 'attachments');

        return Models\MailBus::create([
            'state'     => 'pending',
            'payload'   => serialize($payload)
        ]);
    }

    protected function storeAttachments($attachments) {
        return collect($attachments)->map(function($attachment) {
            if (!isset($attachment[0]))
                return false;

            $path = $this->storage_path . app(
                'token_generator'
                )->generate(32);

            app('filesystem')->put($path, $attachment[0]);
            $attachment[0] = $path;
            return $attachment;
        })->filter(function($attachment) {
            return $attachment;
        })->toArray();
    }

    /**
     * @param MailBus $mail_bus
     */
    public function sendMail($mail_bus) {
        $mail_bus->update(['state' => 'processing']);
        $payload = unserialize($mail_bus->payload);

        $message = $payload['message'];
        $attachments = $payload['attachments'];

        app('mailer')->send(
            $payload['view'],
            $payload['scope'],
            function($msg) use ($message, $attachments) {
            foreach ($message as $key => $value) {
                if (gettype($value) != 'array')
                    $value = [$value];

                call_user_func_array([$msg, $key], $value);
            }

            foreach($attachments as $attachment) {
                $attachment[0] = storage_path('app/' . $attachment[0]);
                call_user_func_array([$msg,'attach'], $attachment);
            }
        });

        $mail_bus->update(['state' => 'success']);
    }

    /**
     * Delete attachments older than 1 day
     * @return void
     */
    public function clearOldAttachments() {
        $files = collect(app('filesystem')->allFiles($this->storage_path));

        $files->each(function($file) {
            $createdAt = app('filesystem')->lastModified($file);
            if (strtotime('+1 day', $createdAt) < time()) {
                app('filesystem')->delete($file);
            }
        });
    }
}