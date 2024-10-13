<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class StudentDetails extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'student_details';
	

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
		'user_id','firstname','middlemane','lastname','dob','class_id','religion','blood_group','height','weight','measurement_date','address'
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
				firstname LIKE ?  OR 
				middlemane LIKE ?  OR 
				lastname LIKE ?  OR 
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
			"user_id",
			"firstname",
			"middlemane",
			"lastname",
			"dob",
			"class_id",
			"religion",
			"blood_group",
			"height",
			"weight",
			"measurement_date",
			"updated_at",
			"address" 
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
			"firstname",
			"middlemane",
			"lastname",
			"dob",
			"class_id",
			"religion",
			"blood_group",
			"height",
			"weight",
			"measurement_date",
			"updated_at",
			"address" 
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
			"firstname",
			"middlemane",
			"lastname",
			"dob",
			"class_id",
			"religion",
			"blood_group",
			"height",
			"weight",
			"measurement_date",
			"updated_at",
			"address" 
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
			"firstname",
			"middlemane",
			"lastname",
			"dob",
			"class_id",
			"religion",
			"blood_group",
			"height",
			"weight",
			"measurement_date",
			"updated_at",
			"address" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"user_id",
			"firstname",
			"middlemane",
			"lastname",
			"dob",
			"class_id",
			"religion",
			"blood_group",
			"height",
			"weight",
			"measurement_date",
			"address",
			"id" 
		];
	}
}
