<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentDetailsAddRequest extends FormRequest
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
            
				"firstname" => "required|string",
				"middlemane" => "nullable|string",
				"lastname" => "required|string",
				"dob" => "nullable|date",
				"class_id" => "required",
				"religion" => "nullable",
				"phone" => "nullable|string",
				"blood_group" => "nullable",
				"height" => "nullable|numeric",
				"weight" => "nullable|numeric",
				"measurement_date" => "nullable|date",
            
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
