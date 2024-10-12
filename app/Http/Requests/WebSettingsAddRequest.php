<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebSettingsAddRequest extends FormRequest
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
            
				"top_bar" => "nullable|string",
				"header" => "nullable|string",
				"slider" => "nullable|string",
				"vission" => "nullable|string",
				"cta" => "nullable|string",
				"about" => "nullable|string",
				"count" => "nullable|string",
				"benefit" => "nullable|string",
				"resources" => "nullable|string",
				"registration" => "nullable|string",
				"event" => "nullable|string",
				"testimonial" => "nullable|string",
				"excos" => "nullable|string",
				"gallery" => "nullable|string",
				"pricing" => "nullable|string",
				"faq" => "nullable|string",
				"contact" => "nullable|string",
				"footer" => "nullable|string",
				"user_id" => "required|numeric",
				"maintenance" => "nullable|string",
				"maintenance_text" => "nullable",
            
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
