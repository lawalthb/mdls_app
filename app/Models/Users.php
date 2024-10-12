<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Users extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'users';
	

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
		'email','name','phone','password','image','address','state','lga','balance','refer_by','referral_code','is_active'
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
				name LIKE ?  OR 
				phone LIKE ?  OR 
				password LIKE ?  OR 
				address LIKE ?  OR 
				refer_by LIKE ?  OR 
				referral_code LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"email",
			"name",
			"phone",
			"image",
			"address",
			"state",
			"lga",
			"balance",
			"refer_by",
			"referral_code",
			"is_active",
			"created_at",
			"updated_at" 
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
			"email",
			"name",
			"phone",
			"image",
			"address",
			"state",
			"lga",
			"balance",
			"refer_by",
			"referral_code",
			"is_active",
			"created_at",
			"updated_at" 
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
			"email",
			"name",
			"phone",
			"image",
			"address",
			"state",
			"lga",
			"balance",
			"refer_by",
			"referral_code",
			"is_active",
			"created_at",
			"updated_at" 
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
			"email",
			"name",
			"phone",
			"image",
			"address",
			"state",
			"lga",
			"balance",
			"refer_by",
			"referral_code",
			"is_active",
			"created_at",
			"updated_at" 
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
			"email",
			"name",
			"phone",
			"image",
			"address",
			"state",
			"lga",
			"balance",
			"refer_by",
			"referral_code",
			"is_active" 
		];
	}
}
