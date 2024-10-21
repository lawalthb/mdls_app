<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ClassSubjects extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'class_subjects';
	

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
		'class_id','subject_id','is_active'
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
				class_subjects.id LIKE ? 
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
			"class_subjects.id AS id",
			"class_subjects.class_id AS class_id",
			"classes.name AS classes_name",
			"class_subjects.subject_id AS subject_id",
			"subjects.name AS subjects_name",
			"class_subjects.is_active AS is_active" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"class_subjects.id AS id",
			"class_subjects.class_id AS class_id",
			"classes.name AS classes_name",
			"class_subjects.subject_id AS subject_id",
			"subjects.name AS subjects_name",
			"class_subjects.is_active AS is_active" 
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
			"class_id",
			"subject_id",
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
			"class_id",
			"subject_id",
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
			"class_id",
			"subject_id",
			"is_active",
			"id" 
		];
	}
}
