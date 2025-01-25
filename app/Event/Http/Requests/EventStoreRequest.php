<?php

namespace App\Event\Http\Requests;

use Dingo\Api\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
            'contact_data' => ['required', 'string'],
            'comment' => ['required', 'string'],
            'date_from' => ['required', 'date', 'after:yesterday'],
            'date_to' => ['required', 'date', 'after:date_from']
        ];
    }
}
