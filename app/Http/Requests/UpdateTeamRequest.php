<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'linkedin_url' => 'required|string',
            'role' => 'required|in:member,adviser',
            'position' => 'required|string',
            'bio' => 'required',
        ];

        // Conditionally add validation rules if role is 'adviser'
        if ($this->input('role') == 'adviser') {
            $rules['provide'] = 'required';
        }

        return $rules;
    }
}
