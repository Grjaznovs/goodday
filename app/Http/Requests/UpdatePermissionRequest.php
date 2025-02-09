<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
            'sections.*.permissions.*.name' => ['required', 'exists:App\Models\Permission,name', 'string', 'max:255'],
            'sections.*.permissions.*.checked' => ['boolean', 'nullable']
        ];
    }
}
