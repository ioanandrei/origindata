<?php

namespace App\Api\Http\Requests\Company;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string,array|string>
     */
    public function rules() : array
    {
        $employee = auth()->user();

        return [
            'name'             => ['required', 'string', 'min:3'],
            'legal_identifier' => [
                'sometimes',
                'required',
                'string',
                Rule::unique(Company::class, 'legal_identifier')->ignore($employee->company_id),
            ],
        ];
    }
}
