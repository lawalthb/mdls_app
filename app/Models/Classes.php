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
			"id",
			"name",
			"is_active",
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
			"name",
			"is_active",
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
			"id",
			"name" 
		];
	}
	

	/**
     * return exportExamClass page fields of the model.
     * 
     * @return array
     */
	public static function exportExamClassFields(){
		return [ 
			"id",
			"name" 
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
}
