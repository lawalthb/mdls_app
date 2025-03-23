<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class StaffClasses extends Model
{


	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'staff_classes';


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
		'user_id','class_id','is_active','updated_by'
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
				staff_classes.id LIKE ?
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
			"staff_classes.id AS id",
			"staff_classes.user_id AS user_id",
			"users.name AS users_name",
			"staff_classes.class_id AS class_id",
			"classes.name AS classes_name",
			"staff_classes.is_active AS is_active",
			"staff_classes.updated_date AS updated_date"
		];
	}


    public static function staff_listFields(){
		return [
			"staff_classes.id AS id",
			"staff_classes.user_id AS user_id",
		
			"staff_classes.class_id AS class_id",
			"classes.name AS classes_name",
			"staff_classes.is_active AS is_active",
			"staff_classes.updated_date AS updated_date"
		];
	}


	/**
     * return exportList page fields of the model.
     *
     * @return array
     */
	public static function exportListFields(){
		return [
			"staff_classes.id AS id",
			"staff_classes.user_id AS user_id",
			"users.name AS users_name",
			"staff_classes.class_id AS class_id",
			"classes.name AS classes_name",
			"staff_classes.is_active AS is_active",
			"staff_classes.updated_date AS updated_date"
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
			"user_id",
			"class_id",
			"is_active",
			"updated_by",
			"updated_date"
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
			"user_id",
			"class_id",
			"is_active",
			"updated_by",
			"updated_date"
		];
	}


	/**
     * return edit page fields of the model.
     *
     * @return array
     */
	public static function editFields(){
		return [
			"user_id",
			"class_id",
			"is_active",
			"updated_by",
			"id"
		];
	}
}
