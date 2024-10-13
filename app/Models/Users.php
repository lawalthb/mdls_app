<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Users extends Authenticatable 
{
	use Notifiable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'users';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	protected $fillable = ['email','name','phone','password','image','account_status','is_active'];
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
				email LIKE ?  OR 
				name LIKE ?  OR 
				phone LIKE ?  OR 
				account_status LIKE ? 
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
			"id",
			"email",
			"name",
			"phone",
			"image",
			"is_active",
			"created_at",
			"updated_at",
			"account_status" 
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
			"email",
			"name",
			"phone",
			"image",
			"is_active",
			"created_at",
			"updated_at",
			"account_status" 
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
			"email",
			"name",
			"phone",
			"is_active",
			"created_at",
			"updated_at",
			"account_status" 
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
			"email",
			"name",
			"phone",
			"is_active",
			"created_at",
			"updated_at",
			"account_status" 
		];
	}
	

	/**
     * return accountedit page fields of the model.
     * 
     * @return array
     */
	public static function accounteditFields(){
		return [ 
			"id",
			"name",
			"phone",
			"image",
			"is_active",
			"account_status" 
		];
	}
	

	/**
     * return accountview page fields of the model.
     * 
     * @return array
     */
	public static function accountviewFields(){
		return [ 
			"id",
			"email",
			"name",
			"phone",
			"is_active",
			"created_at",
			"updated_at",
			"account_status" 
		];
	}
	

	/**
     * return exportAccountview page fields of the model.
     * 
     * @return array
     */
	public static function exportAccountviewFields(){
		return [ 
			"id",
			"email",
			"name",
			"phone",
			"is_active",
			"created_at",
			"updated_at",
			"account_status" 
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
			"phone",
			"image",
			"is_active",
			"account_status",
			"id" 
		];
	}
	

	/**
     * return listStudents page fields of the model.
     * 
     * @return array
     */
	public static function listStudentsFields(){
		return [ 
			"id",
			"email",
			"name",
			"phone",
			"image",
			"is_active",
			"created_at",
			"updated_at",
			"account_status" 
		];
	}
	

	/**
     * return exportListStudents page fields of the model.
     * 
     * @return array
     */
	public static function exportListStudentsFields(){
		return [ 
			"id",
			"email",
			"name",
			"phone",
			"image",
			"is_active",
			"created_at",
			"updated_at",
			"account_status" 
		];
	}
	

	/**
     * Get current user name
     * @return string
     */
	public function UserName(){
		return $this->name;
	}
	

	/**
     * Get current user id
     * @return string
     */
	public function UserId(){
		return $this->id;
	}
	public function UserEmail(){
		return $this->email;
	}
	public function UserPhoto(){
		return $this->image;
	}
	

	/**
     * Send Password reset link to user email 
	 * @param string $token
     * @return string
     */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new \App\Notifications\ResetPassword($token));
	}
}
