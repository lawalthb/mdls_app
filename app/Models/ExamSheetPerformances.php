<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ExamSheetPerformances extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'exam_sheet_performances';
	

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
		'exam_sheet_id','user_id','subject_id','ca_score','exam_score','pratical_score','total','grade_id','remark','updated_by'
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
				remark LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
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
			"exam_sheet_id",
			"user_id",
			"subject_id",
			"ca_score",
			"exam_score",
			"pratical_score",
			"total",
			"grade_id",
			"remark",
			"created_at",
			"updated_at",
			"updated_by" 
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
			"exam_sheet_id",
			"user_id",
			"subject_id",
			"ca_score",
			"exam_score",
			"pratical_score",
			"total",
			"grade_id",
			"remark",
			"created_at",
			"updated_at",
			"updated_by" 
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
			"exam_sheet_id",
			"user_id",
			"subject_id",
			"ca_score",
			"exam_score",
			"pratical_score",
			"total",
			"grade_id",
			"remark",
			"created_at",
			"updated_at",
			"updated_by" 
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
			"exam_sheet_id",
			"user_id",
			"subject_id",
			"ca_score",
			"exam_score",
			"pratical_score",
			"total",
			"grade_id",
			"remark",
			"created_at",
			"updated_at",
			"updated_by" 
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
			"exam_sheet_id",
			"user_id",
			"subject_id",
			"ca_score",
			"exam_score",
			"pratical_score",
			"total",
			"grade_id",
			"remark",
			"updated_by" 
		];
	}
}
