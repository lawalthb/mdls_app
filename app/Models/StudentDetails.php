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
public $incrementing = false;

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
        'id',
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
				firstname LIKE ?  OR
				middlemane LIKE ?  OR
				lastname LIKE ?  OR
				address LIKE ?  OR
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
			"gender",
			"id"
		];
	}


	/**
     * return exportList page fields of the model.
     *
     * @return array
     */
	public static function exportListFields(){
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
			"updated_at",
			"address",
			"gender",
			"id"
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
			"gender",
			"id"
		];
	}


	/**
     * return classStudents page fields of the model.
     *
     * @return array
     */
	public static function classStudentsFields(){
		return [
			"student_details.id AS id",
			"student_details.user_id AS user_id",
			"users.id AS users_id",
			"student_details.firstname AS firstname",
			"student_details.middlemane AS middlemane",
			"student_details.lastname AS lastname",
			"student_details.gender AS gender"
		];
	}


	/**
     * return exportClassStudents page fields of the model.
     *
     * @return array
     */
	public static function exportClassStudentsFields(){
		return [
			"student_details.id AS id",
			"student_details.user_id AS user_id",
			"users.id AS users_id",
			"student_details.firstname AS firstname",
			"student_details.middlemane AS middlemane",
			"student_details.lastname AS lastname",
			"student_details.gender AS gender"
		];
	}


	/**
     * return viewFirstReport page fields of the model.
     *
     * @return array
     */
	public static function viewFirstReportFields(){
		return [
			"student_details.id AS id",
			"student_details.user_id AS user_id",
			"student_details.firstname AS firstname",
			"student_details.middlemane AS middlemane",
			"student_details.lastname AS lastname",
			"student_details.dob AS dob",
			"student_details.class_id AS class_id",
			"classes.name AS classes_name",
            "classes.type AS classes_type",
			"student_details.religion AS religion",
			"student_details.blood_group AS blood_group",
			"student_details.height AS height",
			"student_details.weight AS weight",
			"student_details.measurement_date AS measurement_date",
			"student_details.updated_at AS updated_at",
			"student_details.address AS address",
			"student_details.gender AS gender"
		];
	}


	/**
     * return exportViewFirstReport page fields of the model.
     *
     * @return array
     */
	public static function exportViewFirstReportFields(){
		return [
			"student_details.id AS id",
			"student_details.user_id AS user_id",
			"student_details.firstname AS firstname",
			"student_details.middlemane AS middlemane",
			"student_details.lastname AS lastname",
			"student_details.dob AS dob",
			"student_details.class_id AS class_id",
			"classes.name AS classes_name",
			"student_details.religion AS religion",
			"student_details.blood_group AS blood_group",
			"student_details.height AS height",
			"student_details.weight AS weight",
			"student_details.measurement_date AS measurement_date",
			"student_details.updated_at AS updated_at",
			"student_details.address AS address",
			"student_details.gender AS gender"
		];
	}


	/**
     * return viewSecondReport page fields of the model.
     *
     * @return array
     */
	public static function viewSecondReportFields(){
		return [
			"student_details.id AS id",
			"student_details.user_id AS user_id",
			"student_details.firstname AS firstname",
			"student_details.middlemane AS middlemane",
			"student_details.lastname AS lastname",
			"student_details.dob AS dob",
			"student_details.class_id AS class_id",
			"classes.name AS classes_name",
            "classes.type AS classes_type",
			"student_details.religion AS religion",
			"student_details.blood_group AS blood_group",
			"student_details.height AS height",
			"student_details.weight AS weight",
			"student_details.measurement_date AS measurement_date",
			"student_details.updated_at AS updated_at",
			"student_details.address AS address",
			"student_details.gender AS gender"
		];
	}


	/**
     * return exportViewSecondReport page fields of the model.
     *
     * @return array
     */
	public static function exportViewSecondReportFields(){
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
     * return viewThirdReport page fields of the model.
     *
     * @return array
     */
	public static function viewThirdReportFields(){
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
     * return exportViewThirdReport page fields of the model.
     *
     * @return array
     */
	public static function exportViewThirdReportFields(){
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
     * return homeList page fields of the model.
     *
     * @return array
     */
	public static function homeListFields(){
		return [
			"student_details.id AS id",
			"student_details.user_id AS user_id",
			"users.id AS users_id",
			"student_details.firstname AS firstname",
			"student_details.middlemane AS middlemane",
			"student_details.lastname AS lastname",
			"student_details.class_id AS class_id",
			"classes.name AS classes_name",
			"student_details.gender AS gender"
		];
	}


	/**
     * return exportHomeList page fields of the model.
     *
     * @return array
     */
	public static function exportHomeListFields(){
		return [
			"student_details.id AS id",
			"student_details.user_id AS user_id",
			"users.id AS users_id",
			"student_details.firstname AS firstname",
			"student_details.middlemane AS middlemane",
			"student_details.lastname AS lastname",
			"student_details.class_id AS class_id",
			"classes.name AS classes_name",
			"student_details.gender AS gender"
		];
	}
}
