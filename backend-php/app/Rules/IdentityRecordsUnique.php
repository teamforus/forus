<?php

namespace App\Rules;

use App\Repositories\Interfaces\IRecordRepo;
use Illuminate\Contracts\Validation\Rule;

class IdentityRecordsUnique implements Rule
{
    private $recordType;
    private $recordRepo;

    /**
     * Create a new rule instance.
     *
     * @param string $recordType
     * @return void
     */
    public function __construct(
        $recordType
    ) {
        $this->recordType = $recordType;
        $this->recordRepo = app(IRecordRepo::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     * @throws \Exception
     */
    public function passes($attribute, $value)
    {
        return $this->recordRepo->isRecordUnique($this->recordType, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.unique');
    }
}
