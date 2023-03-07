<?php

namespace App\Api\Http\Requests\Project;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
        return [
            'name'       => ['required', 'string', 'min:5'],
            'company_id' => ['sometimes', 'int', Rule::exists(Company::class, 'id')],
        ];
    }
}
