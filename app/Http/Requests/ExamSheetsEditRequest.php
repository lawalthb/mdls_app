<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamSheetsEditRequest extends FormRequest
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
            
				"session_id" => "filled",
				"term_id" => "filled",
				"class_id" => "filled",
				"user_id" => "filled",
				"present_count" => "nullable|string",
				"open_count" => "nullable|string",
				"resume_on" => "nullable|date",
				"teacher_remark" => "filled|string",
				"total_score" => "filled|numeric",
				"director_approval" => "filled",
				"director_comment" => "nullable|string",
				"updated_by" => "filled",
            
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
