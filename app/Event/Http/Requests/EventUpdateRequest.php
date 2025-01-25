<?php

namespace App\Event\Http\Requests;

use Dingo\Api\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'contact_data' => ['sometimes', 'string'],
            'comment' => ['sometimes', 'string'],
            'date_from' => ['sometimes', 'date', 'after:yesterday'],
            'date_to' => ['sometimes', 'date', 'after:date_from']
        ];
    }
}
