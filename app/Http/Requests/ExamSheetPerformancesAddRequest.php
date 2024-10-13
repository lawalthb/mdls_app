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
            
				"row.*.user_id" => "required",
				"row.*.subject_id" => "required",
				"row.*.ca_score" => "required|numeric",
				"row.*.exam_score" => "required|numeric",
				"row.*.pratical_score" => "required|numeric",
				"row.*.total" => "required|numeric",
				"row.*.grade_id" => "required",
				"row.*.remark" => "required|string",
				"row.*.updated_by" => "required",
            
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
