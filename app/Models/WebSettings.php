<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class WebSettings extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'web_settings';
	

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
		'top_bar','header','slider','vission','cta','about','count','benefit','resources','registration','event','testimonial','excos','gallery','pricing','faq','contact','footer','user_id','maintenance','maintenance_text'
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
				top_bar LIKE ?  OR 
				header LIKE ?  OR 
				slider LIKE ?  OR 
				vission LIKE ?  OR 
				cta LIKE ?  OR 
				about LIKE ?  OR 
				count LIKE ?  OR 
				benefit LIKE ?  OR 
				resources LIKE ?  OR 
				registration LIKE ?  OR 
				event LIKE ?  OR 
				testimonial LIKE ?  OR 
				excos LIKE ?  OR 
				gallery LIKE ?  OR 
				pricing LIKE ?  OR 
				faq LIKE ?  OR 
				contact LIKE ?  OR 
				footer LIKE ?  OR 
				maintenance LIKE ?  OR 
				maintenance_text LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"top_bar",
			"header",
			"slider",
			"vission",
			"cta",
			"about",
			"count",
			"benefit",
			"resources",
			"registration",
			"event",
			"testimonial",
			"excos",
			"gallery",
			"pricing",
			"faq",
			"contact",
			"footer",
			"updated_at",
			"user_id",
			"maintenance",
			"maintenance_text" 
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
			"top_bar",
			"header",
			"slider",
			"vission",
			"cta",
			"about",
			"count",
			"benefit",
			"resources",
			"registration",
			"event",
			"testimonial",
			"excos",
			"gallery",
			"pricing",
			"faq",
			"contact",
			"footer",
			"updated_at",
			"user_id",
			"maintenance",
			"maintenance_text" 
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
			"top_bar",
			"header",
			"slider",
			"vission",
			"cta",
			"about",
			"count",
			"benefit",
			"resources",
			"registration",
			"event",
			"testimonial",
			"excos",
			"gallery",
			"pricing",
			"faq",
			"contact",
			"footer",
			"updated_at",
			"user_id",
			"maintenance",
			"maintenance_text" 
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
			"top_bar",
			"header",
			"slider",
			"vission",
			"cta",
			"about",
			"count",
			"benefit",
			"resources",
			"registration",
			"event",
			"testimonial",
			"excos",
			"gallery",
			"pricing",
			"faq",
			"contact",
			"footer",
			"updated_at",
			"user_id",
			"maintenance",
			"maintenance_text" 
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
			"top_bar",
			"header",
			"slider",
			"vission",
			"cta",
			"about",
			"count",
			"benefit",
			"resources",
			"registration",
			"event",
			"testimonial",
			"excos",
			"gallery",
			"pricing",
			"faq",
			"contact",
			"footer",
			"user_id",
			"maintenance",
			"maintenance_text" 
		];
	}
}
