<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IdentityRecord
 * @mixin Eloquent
 * @property mixed $id
 * @property integer $identity_id
 * @property integer $record_type_id
 * @property integer $identity_record_category_id
 * @property string $value
 * @property integer $order
 * @property Identity $identity
 * @property RecordType $record_type
 * @property IdentityRecordCategory $identity_record_category
 * @property Collection $validations
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */
class IdentityRecord extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity_id', 'record_type_id', 'identity_record_category_id',
        'value', 'order'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity() {
        return $this->belongsTo(Identity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function record_type() {
        return $this->belongsTo(RecordType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity_record_category() {
        return $this->belongsTo(IdentityRecordCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function validations() {
        return $this->belongsTo(IdentityRecordValidation::class);
    }
}
