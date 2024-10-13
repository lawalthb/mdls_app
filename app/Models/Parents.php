<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Parents extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'parents';
	

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
		'id','fullname','phone','occupation','address','state','lga','parent_type','is_active'
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
				fullname LIKE ?  OR 
				phone LIKE ?  OR 
				occupation LIKE ?  OR 
				address LIKE ? 
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
			"id",
			"fullname",
			"phone",
			"occupation",
			"address",
			"state",
			"lga",
			"parent_type",
			"created_at",
			"updated_at",
			"is_active" 
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
			"fullname",
			"phone",
			"occupation",
			"address",
			"state",
			"lga",
			"parent_type",
			"created_at",
			"updated_at",
			"is_active" 
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
			"fullname",
			"phone",
			"occupation",
			"address",
			"state",
			"lga",
			"parent_type",
			"created_at",
			"updated_at",
			"is_active" 
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
			"fullname",
			"phone",
			"occupation",
			"address",
			"state",
			"lga",
			"parent_type",
			"created_at",
			"updated_at",
			"is_active" 
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
			"fullname",
			"phone",
			"occupation",
			"address",
			"state",
			"lga",
			"parent_type",
			"is_active" 
		];
	}
}
