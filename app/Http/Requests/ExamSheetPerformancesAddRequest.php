<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamSheetPerformancesAddRequest extends FormRequest
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
            
				"exam_sheet_id" => "required",
				"user_id" => "required",
				"subject_id" => "required",
				"ca_score" => "required|numeric",
				"exam_score" => "required|numeric",
				"pratical_score" => "required|numeric",
				"total" => "required|numeric",
				"grade_id" => "required",
				"remark" => "required|string",
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
