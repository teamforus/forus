<?php

namespace App\Http\Requests\Api\Records;

use App\Rules\RecordCategoryId;
use Illuminate\Foundation\Http\FormRequest;

class RecordUpdateRequest extends FormRequest
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
        $order = 'nullable|numeric|min:0';
        $record_category_id = ['nullable', new RecordCategoryId()];

        return compact('order', 'record_category_id');
    }
}
