<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * session_id_option_list Model Action
     * @return array
     */
	function session_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM sessions";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * updated_by_option_list Model Action
     * @return array
     */
	function updated_by_option_list(){
		$sqltext = "SELECT id as value, name as label FROM users";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * exam_sheet_id_option_list Model Action
     * @return array
     */
	function exam_sheet_id_option_list(){
		$sqltext = "SELECT id as value, id as label FROM exam_sheets";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * subject_id_option_list Model Action
     * @return array
     */
	function subject_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM subjects";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * grade_id_option_list Model Action
     * @return array
     */
	function grade_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM grades";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * term_id_option_list Model Action
     * @return array
     */
	function term_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM terms";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * role_id_option_list Model Action
     * @return array
     */
	function role_id_option_list(){
		$sqltext = "SELECT role_id as value, role_name as label FROM roles";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * plans_updated_by_option_list Model Action
     * @return array
     */
	function plans_updated_by_option_list(){
		$sqltext = "SELECT id as value, firstname as label FROM admins";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * class_id_option_list Model Action
     * @return array
     */
	function class_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM classes";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * price_settings_id_option_list Model Action
     * @return array
     */
	function price_settings_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM plans";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_name_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('name', $value)->value('name');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_phone_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('phone', $value)->value('phone');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * category_id_option_list Model Action
     * @return array
     */
	function category_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM web_blog_categories";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * name_option_list Model Action
     * @return array
     */
	function name_option_list(){
		$sqltext = "SELECT  DISTINCT name AS value,name AS label FROM classes ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
}
