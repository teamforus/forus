<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IdentityProxy
 * @property mixed $id
 * @property integer $identity_id
 * @property string $access_token
 * @property string $validation_token
 * @property string $state
 * @property integer $expires_in
 * @property Identity $identity
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */
class IdentityProxy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity_id', 'access_token', 'validation_token', 'state',
        'expires_in'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity() {
        return $this->belongsTo(Identity::class);
    }
}
