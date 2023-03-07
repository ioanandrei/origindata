<?php

namespace App\Api\Http\Requests\Employee;

use App\Models\Employee;
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
            'first_name' => ['required', 'string', 'min:3'],
            'last_name'  => ['required', 'string', 'min:3'],
            'email'      => ['required', 'email', Rule::unique(Employee::class, 'email')],
            'phone'      => ['required', 'string', 'min:9'],
        ];
    }
}
