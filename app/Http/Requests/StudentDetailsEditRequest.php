<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentDetailsEditRequest extends FormRequest
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
            
				"firstname" => "filled|string",
				"middlemane" => "nullable|string",
				"lastname" => "filled|string",
				"dob" => "nullable|date",
				"class_id" => "filled",
				"religion" => "nullable",
				"blood_group" => "nullable",
				"height" => "nullable|numeric",
				"weight" => "nullable|numeric",
				"measurement_date" => "nullable|date",
				"address" => "nullable|string",
            
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
