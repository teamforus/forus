<?php

namespace App\Services\MailBus\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MailBus
 * @property mixed $id
 * @property string $payload
 * @property string $state
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Services\MailBus\Models
 */
class MailBus extends Model
{
    protected $fillable = [
        'payload', 'state'
    ];
}
