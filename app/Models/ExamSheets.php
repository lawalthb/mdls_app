<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ExamSheets extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'exam_sheets';
	

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
		'session_id','term_id','class_id','user_id','present_count','open_count','resume_on','teacher_remark','total_score','director_approval','director_comment','updated_by'
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
				exam_sheets.id LIKE ? 
		)';
		$search_params = [
			"%$text%"
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
			"exam_sheets.id AS id",
			"exam_sheets.session_id AS session_id",
			"sessions.name AS sessions_name",
			"exam_sheets.term_id AS term_id",
			"terms.name AS terms_name",
			"exam_sheets.user_id AS user_id",
			"users.name AS users_name",
			"exam_sheets.class_id AS class_id",
			"classes.name AS classes_name",
			"exam_sheets.total_score AS total_score",
			"exam_sheets.director_approval AS director_approval" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"exam_sheets.id AS id",
			"exam_sheets.session_id AS session_id",
			"sessions.name AS sessions_name",
			"exam_sheets.term_id AS term_id",
			"terms.name AS terms_name",
			"exam_sheets.user_id AS user_id",
			"users.name AS users_name",
			"exam_sheets.class_id AS class_id",
			"classes.name AS classes_name",
			"exam_sheets.total_score AS total_score",
			"exam_sheets.director_approval AS director_approval" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"exam_sheets.id AS id",
			"exam_sheets.session_id AS session_id",
			"sessions.name AS sessions_name",
			"exam_sheets.term_id AS term_id",
			"exam_sheets.user_id AS user_id",
			"exam_sheets.present_count AS present_count",
			"exam_sheets.open_count AS open_count",
			"exam_sheets.resume_on AS resume_on",
			"exam_sheets.teacher_remark AS teacher_remark",
			"exam_sheets.director_comment AS director_comment",
			"exam_sheets.total_score AS total_score",
			"exam_sheets.director_approval AS director_approval",
			"exam_sheets.updated_by AS updated_by",
			"exam_sheets.class_id AS class_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"exam_sheets.id AS id",
			"exam_sheets.session_id AS session_id",
			"sessions.name AS sessions_name",
			"exam_sheets.term_id AS term_id",
			"exam_sheets.user_id AS user_id",
			"exam_sheets.present_count AS present_count",
			"exam_sheets.open_count AS open_count",
			"exam_sheets.resume_on AS resume_on",
			"exam_sheets.teacher_remark AS teacher_remark",
			"exam_sheets.director_comment AS director_comment",
			"exam_sheets.total_score AS total_score",
			"exam_sheets.director_approval AS director_approval",
			"exam_sheets.updated_by AS updated_by",
			"exam_sheets.class_id AS class_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"session_id",
			"term_id",
			"class_id",
			"user_id",
			"present_count",
			"open_count",
			"resume_on",
			"teacher_remark",
			"total_score",
			"director_approval",
			"director_comment",
			"updated_by",
			"id" 
		];
	}
}
