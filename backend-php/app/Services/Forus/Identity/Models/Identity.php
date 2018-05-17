<?php

namespace App\Services\Forus\Identity\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Identity
 * @property mixed $id
 * @property string $pin_code
 * @property string $type
 * @property Collection $types
 * @property Collection $proxies
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */
class Identity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pin_code', 'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function types() {
        return $this->hasManyThrough(
            IdentityType::class,
            IdentityActiveType::class
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proxies() {
        return $this->hasMany(IdentityProxy::class);
    }
}
