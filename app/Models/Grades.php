<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Grades extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'grades';
	

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
		'name','remarks','score_range','is_active','updated_by'
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
				grades.id LIKE ?  OR 
				grades.name LIKE ?  OR 
				grades.remarks LIKE ?  OR 
				grades.score_range LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%"
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
			"grades.id AS id",
			"grades.name AS name",
			"grades.remarks AS remarks",
			"grades.score_range AS score_range",
			"grades.is_active AS is_active",
			"grades.updated_at AS updated_at",
			"grades.updated_by AS updated_by",
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
			"grades.id AS id",
			"grades.name AS name",
			"grades.remarks AS remarks",
			"grades.score_range AS score_range",
			"grades.is_active AS is_active",
			"grades.updated_at AS updated_at",
			"grades.updated_by AS updated_by",
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
			"remarks",
			"score_range",
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
			"remarks",
			"score_range",
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
			"remarks",
			"score_range",
			"is_active",
			"updated_by",
			"id" 
		];
	}
}
