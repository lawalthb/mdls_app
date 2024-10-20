<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ExamSettings extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'exam_settings';
	

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
		'session_id','ca_mark','exam_mark','pratical_mark','is_active','updated_by','present_count','resume_date','director_approve'
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
				exam_settings.id LIKE ? 
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
			"exam_settings.id AS id",
			"exam_settings.session_id AS session_id",
			"sessions.name AS sessions_name",
			"exam_settings.ca_mark AS ca_mark",
			"exam_settings.exam_mark AS exam_mark",
			"exam_settings.pratical_mark AS pratical_mark",
			"exam_settings.is_active AS is_active",
			"exam_settings.update_at AS update_at",
			"exam_settings.updated_by AS updated_by",
			"users.name AS users_name",
			"exam_settings.present_count AS present_count",
			"exam_settings.resume_date AS resume_date",
			"exam_settings.director_approve AS director_approve" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"exam_settings.id AS id",
			"exam_settings.session_id AS session_id",
			"sessions.name AS sessions_name",
			"exam_settings.ca_mark AS ca_mark",
			"exam_settings.exam_mark AS exam_mark",
			"exam_settings.pratical_mark AS pratical_mark",
			"exam_settings.is_active AS is_active",
			"exam_settings.update_at AS update_at",
			"exam_settings.updated_by AS updated_by",
			"users.name AS users_name",
			"exam_settings.present_count AS present_count",
			"exam_settings.resume_date AS resume_date",
			"exam_settings.director_approve AS director_approve" 
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
			"session_id",
			"ca_mark",
			"exam_mark",
			"is_active",
			"created_at",
			"update_at",
			"pratical_mark",
			"updated_by",
			"present_count",
			"resume_date",
			"director_approve" 
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
			"session_id",
			"ca_mark",
			"exam_mark",
			"is_active",
			"created_at",
			"update_at",
			"pratical_mark",
			"updated_by",
			"present_count",
			"resume_date",
			"director_approve" 
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
			"ca_mark",
			"exam_mark",
			"pratical_mark",
			"is_active",
			"updated_by",
			"present_count",
			"resume_date",
			"director_approve",
			"id" 
		];
	}
}
