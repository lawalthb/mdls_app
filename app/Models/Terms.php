<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Terms extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'terms';
	

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
		'session_id','name','term_start','term_end','is_active','updated_by'
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
				terms.id LIKE ?  OR 
				terms.name LIKE ? 
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
			"terms.id AS id",
			"terms.name AS name",
			"terms.session_id AS session_id",
			"sessions.name AS sessions_name",
			"terms.term_start AS term_start",
			"terms.term_end AS term_end",
			"terms.is_active AS is_active",
			"terms.updated_at AS updated_at",
			"terms.updated_by AS updated_by",
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
			"terms.id AS id",
			"terms.name AS name",
			"terms.session_id AS session_id",
			"sessions.name AS sessions_name",
			"terms.term_start AS term_start",
			"terms.term_end AS term_end",
			"terms.is_active AS is_active",
			"terms.updated_at AS updated_at",
			"terms.updated_by AS updated_by",
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
			"session_id",
			"name",
			"term_start",
			"term_end",
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
			"session_id",
			"name",
			"term_start",
			"term_end",
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
			"session_id",
			"name",
			"term_start",
			"term_end",
			"is_active",
			"updated_by",
			"id" 
		];
	}
}
