<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradesEditRequest extends FormRequest
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
		
		$rec_id = request()->route('rec_id');

        return [
            
				"name" => "filled|string|alpha_num|unique:grades,name,$rec_id,id",
				"remarks" => "filled|string|unique:grades,remarks,$rec_id,id",
				"score_range" => "filled|string",
				"is_active" => "filled",
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
