<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsEditRequest extends FormRequest
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
            
				"user_id" => "filled",
				"price_settings_id" => "filled",
				"email" => "filled|email",
				"amount" => "filled|numeric",
				"fullname" => "nullable|string",
				"phone_number" => "nullable|string",
				"reference" => "nullable",
				"status" => "filled",
				"authorization_url" => "nullable|string",
				"callback_url" => "nullable|string",
				"gateway_response" => "nullable|string",
				"paid_at" => "nullable|string",
				"channel" => "nullable|string",
				"message" => "nullable|string",
				"orderid" => "nullable|string",
				"other_info" => "nullable",
				"purpose_name" => "nullable|string",
				"purpose_id" => "filled|numeric",
            
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
