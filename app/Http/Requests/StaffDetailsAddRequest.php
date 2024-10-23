<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffDetailsAddRequest extends FormRequest
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
            
				"gender" => "required",
				"class_id" => "nullable",
				"address" => "nullable|string",
				"guarantor_details" => "nullable",
				"files" => "nullable",
				"date_joined" => "nullable|date",
				"other_info" => "nullable",
            
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
