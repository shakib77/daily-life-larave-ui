<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $validation = [
                'gender' => 'required|in:male,female,other',
                'profession_type' => 'required|in:1,2,3',
            ] + $this->specificValidationRules();
        //dd($validation);
        return $validation;
    }

    private function specificValidationRules(): array
    {

        switch ($this->input('profession_type')) {
            case 1: // Student
                return [
                    'institute_name' => 'required|string',
                    'daily_cost' => 'nullable|numeric|min:0',
                    'monthly_cost' => 'nullable|numeric|min:0',
                    'pocket_money' => 'nullable|numeric|min:0',
                    'monthly_edu_expenses' => 'nullable|numeric|min:0',
                    'monthly_income' => 'nullable|numeric|min:0',
                ];
            case 2: // Businessman
                return [
                    'company_name' => 'required|string',
                    'daily_cost' => 'nullable|numeric|min:0',
                    'monthly_cost' => 'nullable|numeric|min:0',
                    'monthly_income' => 'nullable|numeric|min:0',
                    'employee_count' => 'nullable|integer|min:0',
                ];
            case 3: // Service Holder
                return [
                    'company_name' => 'required|string',
                    'daily_cost' => 'nullable|numeric|min:0',
                    'monthly_cost' => 'nullable|numeric|min:0',
                    'monthly_income' => 'nullable|numeric|min:0',
                ];
            default:
                return [];
        }
    }

}
