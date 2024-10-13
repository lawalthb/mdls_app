<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Subjects extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'subjects';
	

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
		'name','code','type','is_active','updated_by'
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
				subjects.id LIKE ?  OR 
				subjects.name LIKE ?  OR 
				subjects.code LIKE ?  OR 
				subjects.type LIKE ?  OR 
				subjects.is_active LIKE ? 
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
			"subjects.id AS id",
			"subjects.name AS name",
			"subjects.code AS code",
			"subjects.type AS type",
			"subjects.is_active AS is_active",
			"subjects.created_at AS created_at",
			"subjects.updated_at AS updated_at",
			"subjects.updated_by AS updated_by",
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
			"subjects.id AS id",
			"subjects.name AS name",
			"subjects.code AS code",
			"subjects.type AS type",
			"subjects.is_active AS is_active",
			"subjects.created_at AS created_at",
			"subjects.updated_at AS updated_at",
			"subjects.updated_by AS updated_by",
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
			"code",
			"type",
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
			"code",
			"type",
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
			"name",
			"code",
			"type",
			"is_active",
			"updated_by",
			"id" 
		];
	}
}
