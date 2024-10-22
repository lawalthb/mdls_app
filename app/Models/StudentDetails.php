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
		'user_id','firstname','middlemane','lastname','dob','class_id','religion','blood_group','height','weight','measurement_date','address','gender'
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
			"address",
			"gender" 
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
			"address",
			"gender" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"student_details.firstname AS firstname",
			"student_details.middlemane AS middlemane",
			"student_details.lastname AS lastname",
			"student_details.class_id AS class_id",
			"classes.name AS classes_name",
			"student_details.dob AS dob",
			"student_details.address AS address",
			"student_details.religion AS religion",
			"student_details.blood_group AS blood_group",
			"student_details.height AS height",
			"student_details.weight AS weight",
			"student_details.measurement_date AS measurement_date",
			"student_details.updated_at AS updated_at",
			"student_details.id AS id",
			"student_details.user_id AS user_id",
			"users.id AS users_id",
			"student_details.gender AS gender" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"student_details.firstname AS firstname",
			"student_details.middlemane AS middlemane",
			"student_details.lastname AS lastname",
			"student_details.class_id AS class_id",
			"classes.name AS classes_name",
			"student_details.dob AS dob",
			"student_details.address AS address",
			"student_details.religion AS religion",
			"student_details.blood_group AS blood_group",
			"student_details.height AS height",
			"student_details.weight AS weight",
			"student_details.measurement_date AS measurement_date",
			"student_details.updated_at AS updated_at",
			"student_details.id AS id",
			"student_details.user_id AS user_id",
			"users.id AS users_id",
			"student_details.gender AS gender" 
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
			"id",
			"gender" 
		];
	}
}
