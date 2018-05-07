<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IdentityRecordValidation
 * @property mixed $id
 * @property integer $record_validator_id
 * @property integer $identity_record_id
 * @property string $state
 * @property RecordValidator $record_validator
 * @property IdentityRecord $identity_record
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */
class IdentityRecordValidation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'record_validator_id', 'identity_record_id', 'state'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function record_validator() {
        return $this->belongsTo(RecordValidator::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity_record() {
        return $this->belongsTo(IdentityRecord::class);
    }
}
