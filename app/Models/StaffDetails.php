<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class StaffDetails extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'staff_details';
	

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
		'gender','class_id','address','guarantor_details','files','date_joined','other_info','user_id'
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
				class_id LIKE ?  OR 
				address LIKE ?  OR 
				guarantor_details LIKE ?  OR 
				other_info LIKE ?  OR 
				id LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"class_id",
			"gender",
			"address",
			"guarantor_details",
			"files",
			"date_joined",
			"other_info",
			"id",
			"user_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"class_id",
			"gender",
			"address",
			"guarantor_details",
			"files",
			"date_joined",
			"other_info",
			"id",
			"user_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"class_id",
			"gender",
			"address",
			"guarantor_details",
			"files",
			"date_joined",
			"other_info",
			"id",
			"user_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"class_id",
			"gender",
			"address",
			"guarantor_details",
			"files",
			"date_joined",
			"other_info",
			"id",
			"user_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"gender",
			"class_id",
			"address",
			"guarantor_details",
			"files",
			"date_joined",
			"other_info",
			"user_id",
			"id" 
		];
	}
}
