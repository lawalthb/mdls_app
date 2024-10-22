<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamSettingsEditRequest extends FormRequest
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
				"ca_mark" => "filled|numeric",
				"exam_mark" => "filled|numeric",
				"pratical_mark" => "nullable|numeric",
				"is_active" => "filled",
				"updated_by" => "filled",
				"present_count" => "nullable|numeric",
				"resume_date" => "nullable|date",
				"director_approve" => "filled",
				"term_id" => "filled",
            
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
