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
		'session_id','ca_mark','exam_mark','is_active','pratical_mark','updated_by'
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
				id LIKE ? 
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
			"id",
			"session_id",
			"ca_mark",
			"exam_mark",
			"is_active",
			"created_at",
			"update_at",
			"pratical_mark",
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
			"session_id",
			"ca_mark",
			"exam_mark",
			"is_active",
			"created_at",
			"update_at",
			"pratical_mark",
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
			"session_id",
			"ca_mark",
			"exam_mark",
			"is_active",
			"created_at",
			"update_at",
			"pratical_mark",
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
			"session_id",
			"ca_mark",
			"exam_mark",
			"is_active",
			"created_at",
			"update_at",
			"pratical_mark",
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
			"session_id",
			"ca_mark",
			"exam_mark",
			"is_active",
			"pratical_mark",
			"updated_by" 
		];
	}
}
