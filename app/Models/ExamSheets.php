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
				id LIKE ?  OR 
				present_count LIKE ?  OR 
				open_count LIKE ?  OR 
				teacher_remark LIKE ?  OR 
				director_comment LIKE ? 
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
			"session_id",
			"term_id",
			"user_id",
			"present_count",
			"open_count",
			"resume_on",
			"teacher_remark",
			"director_comment",
			"total_score",
			"director_approval",
			"updated_by",
			"class_id" 
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
			"session_id",
			"term_id",
			"user_id",
			"present_count",
			"open_count",
			"resume_on",
			"teacher_remark",
			"director_comment",
			"total_score",
			"director_approval",
			"updated_by",
			"class_id" 
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
			"term_id",
			"user_id",
			"present_count",
			"open_count",
			"resume_on",
			"teacher_remark",
			"director_comment",
			"total_score",
			"director_approval",
			"updated_by",
			"class_id" 
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
			"term_id",
			"user_id",
			"present_count",
			"open_count",
			"resume_on",
			"teacher_remark",
			"director_comment",
			"total_score",
			"director_approval",
			"updated_by",
			"class_id" 
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
