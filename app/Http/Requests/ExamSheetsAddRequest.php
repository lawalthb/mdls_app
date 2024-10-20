<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamSheetsAddRequest extends FormRequest
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
            
				"session_id" => "required",
				"term_id" => "required",
				"class_id" => "required",
				"user_id" => "required",
				"present_count" => "nullable|string",
				"open_count" => "nullable|string",
				"resume_on" => "nullable|date",
				"teacher_remark" => "required|string",
				"total_score" => "required|numeric",
				"director_approval" => "required",
				"director_comment" => "nullable|string",
				"updated_by" => "required",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
