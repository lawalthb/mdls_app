<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffDetailsEditRequest extends FormRequest
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
            
				"class_id" => "nullable",
				"gender" => "filled",
				"address" => "nullable|string",
				"guarantor_details" => "nullable",
				"other_info" => "nullable",
				"date_joined" => "nullable|date",
				"files" => "nullable",
            
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
