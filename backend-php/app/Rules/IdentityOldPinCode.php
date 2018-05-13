<?php

namespace App\Rules;

use App\Repositories\Interfaces\IIdentityRepo;
use Illuminate\Contracts\Validation\Rule;

class IdentityOldPinCode implements Rule
{
    protected $proxyIdentity;
    protected $message;

    /**
     * Create a new rule instance.
     * @param mixed $proxyIdentity
     * @return void
     */
    public function __construct(
        $proxyIdentity
    ) {
        $this->proxyIdentity = $proxyIdentity;
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
        $identityRepo = app(IIdentityRepo::class);

        $hasPinCode = $identityRepo->hasPinCode($this->proxyIdentity);

        if ($hasPinCode) {
            if (empty($value)) {
                $this->message = trans('validation.required');
                return false;
            }

            if (!$identityRepo->cmpPinCode($this->proxyIdentity, $value)) {
                $this->message = "Old pin code don't match";
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
