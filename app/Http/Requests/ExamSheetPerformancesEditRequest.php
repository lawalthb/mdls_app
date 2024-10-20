<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamSheetPerformancesEditRequest extends FormRequest
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
            
				"subject_id" => "filled",
				"ca_score" => "filled|numeric",
				"exam_score" => "filled|numeric",
				"pratical_score" => "filled|numeric",
				"total" => "filled|numeric",
				"remark" => "filled|string",
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
