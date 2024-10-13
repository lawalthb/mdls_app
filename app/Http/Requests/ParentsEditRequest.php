<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParentsEditRequest extends FormRequest
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
            
				"id" => "filled|numeric",
				"fullname" => "filled|string",
				"phone" => "filled|string",
				"occupation" => "filled|string",
				"address" => "filled|string",
				"state" => "filled|numeric",
				"lga" => "filled|numeric",
				"parent_type" => "filled",
				"is_active" => "filled",
            
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
