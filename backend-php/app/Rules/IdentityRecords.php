<?php

namespace App\Rules;

use App\Repositories\Interfaces\IRecordRepo;
use Illuminate\Contracts\Validation\Rule;

class IdentityRecords implements Rule
{
    private $recordRepo;
    private $unknownKey;
    private $message = "";

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->recordRepo = app(IRecordRepo::class);
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
        if (!is_array($value)) {
            $this->message = "Wrong records format.";
            return false;
        }

        $recordTypeKeys = $this->recordRepo->getRecordTypeKeys();
        $requestKeys = array_keys($value);

        foreach ($requestKeys as $requestKey) {
            if (!in_array($requestKey, $recordTypeKeys)) {
                $this->unknownKey = $requestKey;
                $this->message = "Unknown record key: \"$requestKey\".";
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
