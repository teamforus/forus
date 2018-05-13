<?php

namespace App\Http\Requests\Api;

use App\Rules\IdentityRecords;
use App\Rules\IdentityRecordsUnique;
use Illuminate\Foundation\Http\FormRequest;

class IdentityStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pin_code'          => 'nullable|digits:6',
            'type'              => 'required|in:personal,organization',
            'records'           => ['required', 'array', new IdentityRecords()],
            'records.email'     => ['required', 'email', new IdentityRecordsUnique('email')],
        ];
    }
}
