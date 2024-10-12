<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsAddRequest extends FormRequest
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
            
				"user_id" => "required",
				"price_settings_id" => "required",
				"email" => "required|email",
				"amount" => "required|numeric",
				"fullname" => "nullable|string",
				"phone_number" => "nullable|string",
				"reference" => "nullable",
				"status" => "required",
				"authorization_url" => "nullable|string",
				"callback_url" => "nullable|string",
				"gateway_response" => "nullable|string",
				"paid_at" => "nullable|string",
				"channel" => "nullable|string",
				"message" => "nullable|string",
				"orderid" => "nullable|string",
				"other_info" => "nullable",
				"purpose_name" => "nullable|string",
				"purpose_id" => "required|numeric",
            
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
