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
	protected $fillable = ['email','name','phone','password','image','account_status','is_active','user_role_id'];
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
			"account_status",
			"user_role_id" 
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
			"account_status",
			"user_role_id" 
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
			"account_status",
			"user_role_id" 
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
			"account_status",
			"user_role_id" 
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
			"account_status",
			"user_role_id" 
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
			"account_status",
			"user_role_id" 
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
			"account_status",
			"user_role_id" 
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
			"id",
			"user_role_id" 
		];
	}
	

	/**
     * return listStudents page fields of the model.
     * 
     * @return array
     */
	public static function listStudentsFields(){
		return [ 
			"users.id AS id",
			"users.name AS name",
			"users.email AS email",
			"users.phone AS phone",
			"users.image AS image",
			"users.account_status AS account_status",
			"student_details.firstname AS studentdetails_firstname",
			"student_details.middlemane AS studentdetails_middlemane",
			"student_details.lastname AS studentdetails_lastname",
			"student_details.dob AS studentdetails_dob",
			"classes.name AS classes_name",
			"student_details.updated_at AS studentdetails_updated_at",
			"student_details.id AS studentdetails_id",
			"classes.id AS classes_id" 
		];
	}
	

	/**
     * return exportListStudents page fields of the model.
     * 
     * @return array
     */
	public static function exportListStudentsFields(){
		return [ 
			"users.id AS id",
			"users.name AS name",
			"users.email AS email",
			"users.phone AS phone",
			"users.image AS image",
			"users.account_status AS account_status",
			"student_details.firstname AS studentdetails_firstname",
			"student_details.middlemane AS studentdetails_middlemane",
			"student_details.lastname AS studentdetails_lastname",
			"student_details.dob AS studentdetails_dob",
			"classes.name AS classes_name",
			"student_details.updated_at AS studentdetails_updated_at",
			"student_details.id AS studentdetails_id",
			"classes.id AS classes_id" 
		];
	}
	

	/**
     * return viewStudent page fields of the model.
     * 
     * @return array
     */
	public static function viewStudentFields(){
		return [ 
			"id",
			"email",
			"name",
			"phone",
			"image",
			"is_active",
			"created_at",
			"updated_at",
			"account_status",
			"user_role_id" 
		];
	}
	

	/**
     * return exportViewStudent page fields of the model.
     * 
     * @return array
     */
	public static function exportViewStudentFields(){
		return [ 
			"id",
			"email",
			"name",
			"phone",
			"image",
			"is_active",
			"created_at",
			"updated_at",
			"account_status",
			"user_role_id" 
		];
	}
	

	/**
     * return editStudent page fields of the model.
     * 
     * @return array
     */
	public static function editStudentFields(){
		return [ 
			"email",
			"name",
			"phone",
			"image",
			"account_status",
			"id" 
		];
	}
	

	/**
     * return listStaff page fields of the model.
     * 
     * @return array
     */
	public static function listStaffFields(){
		return [ 
			"users.id AS id",
			"users.email AS email",
			"users.name AS name",
			"users.phone AS phone",
			"users.image AS image",
			"users.is_active AS is_active",
			"users.updated_at AS updated_at",
			"users.account_status AS account_status",
			"users.user_role_id AS user_role_id",
			"roles.role_name AS roles_role_name" 
		];
	}
	

	/**
     * return exportListStaff page fields of the model.
     * 
     * @return array
     */
	public static function exportListStaffFields(){
		return [ 
			"users.id AS id",
			"users.email AS email",
			"users.name AS name",
			"users.phone AS phone",
			"users.image AS image",
			"users.is_active AS is_active",
			"users.updated_at AS updated_at",
			"users.account_status AS account_status",
			"users.user_role_id AS user_role_id",
			"roles.role_name AS roles_role_name" 
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
	public function UserRole(){
		return $this->user_role_id;
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
	
	private $roleNames = [];
	private $userPages = [];
	
	/**
	* Get the permissions of the user.
	*/
	public function permissions(){
		return $this->hasMany(Permissions::class, 'role_id', 'user_role_id');
	}
	
	/**
	* Get the roles of the user.
	*/
	public function roles(){
		return $this->hasMany(Roles::class, 'role_id', 'user_role_id');
	}
	
	/**
	* set user role
	*/
	public function assignRole($roleName){
		$roleId = Roles::select('role_id')->where('role_name', $roleName)->value('role_id');
		$this->user_role_id = $roleId;
		$this->save();
	}
	
	/**
     * return list of pages user can access
     * @return array
     */
	public function getUserPages(){
		if(empty($this->userPages)){ // ensure we make db query once
			$this->userPages = $this->permissions()->pluck('permission')->toArray();
		}
		return $this->userPages;
	}
	
	/**
     * return user role names
     * @return array
     */
	public function getRoleNames(){
		if(empty($this->roleNames)){// ensure we make db query once
			$this->roleNames = $this->roles()->pluck('role_name')->toArray();
		}
		return $this->roleNames;
	}
	
	/**
     * check if user has a role
     * @return bool
     */
	public function hasRole($arrRoles){
		if(!is_array($arrRoles)){
			$arrRoles = [$arrRoles];
		}
		$userRoles = $this->getRoleNames();
		if(array_intersect(array_map('strtolower', $userRoles), array_map('strtolower', $arrRoles))){
			return true;
		}
		return false;
	}
	
	/**
     * check if user is the owner of the record
     * @return bool
     */
	public function isOwner($recId){
		return $this->UserId() == $recId;
	}
	
	/**
     * check if user can access page
     * @return bool
     */
	public function canAccess($path){
		$userPages = $this->getUserPages();
		$arrPaths = explode("/", strtolower($path));
		$page = $arrPaths[0] ?? "home";
		$action = $arrPaths[1] ?? "index";
		$page_path = "$page/$action";
		return in_array($page_path, $userPages);
	}
	
	/**
     * check if user is the owner of the record or has role that can edit or delete it
     * @return bool
     */
	public function canManage($path, $recId){
		return false;
	}
}
