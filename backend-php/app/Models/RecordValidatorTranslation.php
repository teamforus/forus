<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RecordValidatorTranslation
 * @property mixed $id
 * @property integer $record_validator_id
 * @property string $locale
 * @property string $name
 * @property RecordValidator $record_validator
 * @package App\Models
 */
class RecordValidatorTranslation extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function record_validator() {
        return $this->belongsTo(RecordValidator::class);
    }
}
