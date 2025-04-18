<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class WebBlogs extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'web_blogs';
	

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
		'title','category_id','short_text','long_text','image','is_publish'
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
				title LIKE ?  OR 
				short_text LIKE ?  OR 
				long_text LIKE ? 
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
			"id",
			"title",
			"category_id",
			"short_text",
			"long_text",
			"image",
			"is_publish",
			"created_at",
			"updated_at" 
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
			"title",
			"category_id",
			"short_text",
			"long_text",
			"image",
			"is_publish",
			"created_at",
			"updated_at" 
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
			"title",
			"category_id",
			"short_text",
			"long_text",
			"image",
			"is_publish",
			"created_at",
			"updated_at" 
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
			"title",
			"category_id",
			"short_text",
			"long_text",
			"image",
			"is_publish",
			"created_at",
			"updated_at" 
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
			"title",
			"category_id",
			"short_text",
			"long_text",
			"image",
			"is_publish" 
		];
	}
}
