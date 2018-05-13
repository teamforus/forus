<?php

namespace App\Rules;

use App\Repositories\Interfaces\IRecordRepo;
use App\Repositories\RecordRepo;
use Illuminate\Contracts\Validation\Rule;

class RecordCategoryId implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** @var RecordRepo $recordRepo */
        $recordRepo = app(IRecordRepo::class);

        return !empty($recordRepo->categoryGet(
            request()->get('identity'), $value
        ));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid record category id.';
    }
}
