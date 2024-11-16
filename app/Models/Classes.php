<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Classes extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'classes';
	

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
		'id','name','is_active','updated_by'
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
				classes.id LIKE ?  OR 
				classes.name LIKE ? 
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
			"classes.id AS id",
			"classes.name AS name",
			"classes.is_active AS is_active",
			"classes.updated_at AS updated_at",
			"classes.updated_by AS updated_by",
			"users.name AS users_name" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"classes.id AS id",
			"classes.name AS name",
			"classes.is_active AS is_active",
			"classes.updated_at AS updated_at",
			"classes.updated_by AS updated_by",
			"users.name AS users_name" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"name",
			"id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"name",
			"id" 
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
			"name",
			"is_active",
			"updated_by" 
		];
	}
	

	/**
     * return examClass page fields of the model.
     * 
     * @return array
     */
	public static function examClassFields(){
		return [ 
			"name",
			"id" 
		];
	}
	

	/**
     * return exportExamClass page fields of the model.
     * 
     * @return array
     */
	public static function exportExamClassFields(){
		return [ 
			"name",
			"id" 
		];
	}
	

	/**
     * return exam page fields of the model.
     * 
     * @return array
     */
	public static function examFields(){
		return [ 
			"id",
			"name" 
		];
	}
	

	/**
     * return exportExam page fields of the model.
     * 
     * @return array
     */
	public static function exportExamFields(){
		return [ 
			"id",
			"name" 
		];
	}
	

	/**
     * return students page fields of the model.
     * 
     * @return array
     */
	public static function studentsFields(){
		return [ 
			"id",
			"name" 
		];
	}
	

	/**
     * return exportStudents page fields of the model.
     * 
     * @return array
     */
	public static function exportStudentsFields(){
		return [ 
			"id",
			"name" 
		];
	}
	

	/**
     * return broadlist page fields of the model.
     * 
     * @return array
     */
	public static function broadlistFields(){
		return [ 
			"id",
			"name" 
		];
	}
	

	/**
     * return exportBroadlist page fields of the model.
     * 
     * @return array
     */
	public static function exportBroadlistFields(){
		return [ 
			"id",
			"name" 
		];
	}
	

	/**
     * return broadview page fields of the model.
     * 
     * @return array
     */
	public static function broadviewFields(){
		return [ 
			"id",
			"name" 
		];
	}
	

	/**
     * return exportBroadview page fields of the model.
     * 
     * @return array
     */
	public static function exportBroadviewFields(){
		return [ 
			"id",
			"name" 
		];
	}
}
