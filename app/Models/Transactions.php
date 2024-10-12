<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Transactions extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'transactions';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'user_id','price_settings_id','email','amount','fullname','phone_number','reference','status','authorization_url','callback_url','gateway_response','paid_at','channel','message','orderid','other_info','purpose_name','purpose_id'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				id LIKE ?  OR 
				email LIKE ?  OR 
				fullname LIKE ?  OR 
				phone_number LIKE ?  OR 
				reference LIKE ?  OR 
				authorization_url LIKE ?  OR 
				callback_url LIKE ?  OR 
				gateway_response LIKE ?  OR 
				paid_at LIKE ?  OR 
				channel LIKE ?  OR 
				message LIKE ?  OR 
				orderId LIKE ?  OR 
				other_info LIKE ?  OR 
				purpose_name LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id",
			"user_id",
			"price_settings_id",
			"email",
			"amount",
			"fullname",
			"phone_number",
			"reference",
			"created_at",
			"status",
			"updated_at",
			"authorization_url",
			"callback_url",
			"gateway_response",
			"paid_at",
			"channel",
			"message",
			"orderId AS orderid",
			"other_info",
			"purpose_name",
			"purpose_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id",
			"user_id",
			"price_settings_id",
			"email",
			"amount",
			"fullname",
			"phone_number",
			"reference",
			"created_at",
			"status",
			"updated_at",
			"authorization_url",
			"callback_url",
			"gateway_response",
			"paid_at",
			"channel",
			"message",
			"orderId AS orderid",
			"other_info",
			"purpose_name",
			"purpose_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"user_id",
			"price_settings_id",
			"email",
			"amount",
			"fullname",
			"phone_number",
			"reference",
			"created_at",
			"status",
			"updated_at",
			"authorization_url",
			"callback_url",
			"gateway_response",
			"paid_at",
			"channel",
			"message",
			"orderId AS orderid",
			"other_info",
			"purpose_name",
			"purpose_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"user_id",
			"price_settings_id",
			"email",
			"amount",
			"fullname",
			"phone_number",
			"reference",
			"created_at",
			"status",
			"updated_at",
			"authorization_url",
			"callback_url",
			"gateway_response",
			"paid_at",
			"channel",
			"message",
			"orderId AS orderid",
			"other_info",
			"purpose_name",
			"purpose_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id",
			"user_id",
			"price_settings_id",
			"email",
			"amount",
			"fullname",
			"phone_number",
			"reference",
			"status",
			"authorization_url",
			"callback_url",
			"gateway_response",
			"paid_at",
			"channel",
			"message",
			"orderId AS orderid",
			"other_info",
			"purpose_name",
			"purpose_id" 
		];
	}
}
