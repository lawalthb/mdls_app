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
     * examsheets_term_id_option_list Model Action
     * @return array
     */
	function examsheets_term_id_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM terms WHERE session_id=:lookup_session_id ORDER BY id ASC" ;
		$query_params = [];
		$query_params['lookup_session_id'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}


	/**
     * user_id_option_list Model Action
     * @return array
     */
	function user_id_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT id AS value,firstname AS label FROM student_details WHERE class_id=:lookup_class_id " ;
		$query_params = [];
		$query_params['lookup_class_id'] = $lookup_value;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}


	/**
     * Check if value already exist in Grades table
	 * @param string $value
     * @return bool
     */
	function grades_name_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('grades')->where('name', $value)->value('name');
		if($exist){
			return true;
		}
		return false;
	}


	/**
     * Check if value already exist in Grades table
	 * @param string $value
     * @return bool
     */
	function grades_remarks_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('grades')->where('remarks', $value)->value('remarks');
		if($exist){
			return true;
		}
		return false;
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
     * staffclasses_user_id_option_list Model Action
     * @return array
     */
	function staffclasses_user_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM users WHERE user_role_id !=:roleid" ;
		$query_params = [];
$query_params['roleid'] = 2;
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}


	/**
     * Check if value already exist in Subjects table
	 * @param string $value
     * @return bool
     */
	function subjects_name_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('subjects')->where('name', $value)->value('name');
		if($exist){
			return true;
		}
		return false;
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
     * class_id_option_list_2 Model Action
     * @return array
     */
	function class_id_option_list_2(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM classes ORDER BY name ASC";
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


	/**
     * getcount_students Model Action
     * @return int
     */
	function getcount_students(){
		$sqltext = "SELECT COUNT(*) AS num FROM users WHERE user_role_id=:roleid" ;
		$query_params = [];
		$query_params['roleid'] = 2 ;
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}


	/**
     * getcount_teachers Model Action
     * @return int
     */
	function getcount_teachers(){
		$sqltext = "SELECT COUNT(*) AS num FROM users WHERE user_role_id=:roleid" ;
		$query_params = [];
$query_params['roleid'] = 3;
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}


	/**
     * getcount_admin Model Action
     * @return int
     */
	function getcount_admin(){
		$sqltext = "SELECT COUNT(*) AS num FROM users WHERE user_role_id=:roleid" ;
		$query_params = [];
$query_params['roleid'] = 1;
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}


	/**
     * getcount_director Model Action
     * @return int
     */
	function getcount_director(){
		$sqltext = "SELECT COUNT(*) AS num FROM users WHERE user_role_id=:roleid" ;
		$query_params = [];
$query_params['roleid'] = 4;
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}


	/**
     * getcount_subjects Model Action
     * @return int
     */
	function getcount_subjects(){
		$sqltext = "SELECT COUNT(*) AS num FROM subjects";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}


	/**
     * getcount_classes Model Action
     * @return int
     */
	function getcount_classes(){
		$sqltext = "SELECT COUNT(*) AS num FROM classes";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}


	/**
     * getcount_classsubjects Model Action
     * @return int
     */
	function getcount_classsubjects(){
		$sqltext = "SELECT COUNT(*) AS num FROM class_subjects";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}


	/**
     * getcount_staffclasses Model Action
     * @return int
     */
	function getcount_staffclasses(){
		$sqltext = "SELECT COUNT(*) AS num FROM staff_classes";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}


	/**
	* barchart_studentgenderchart Model Action
	* @return array
	*/
	function barchart_studentgenderchart(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT
    COUNT(CASE WHEN gender = 'male' THEN 1 END) AS male,
    COUNT(CASE WHEN gender = 'female' THEN 1 END) AS female
FROM
    student_details;";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'male');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'male'),
			'label' => "Male",
	'backgroundColor' =>  random_color(),
	'borderColor' =>  random_color(),
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$dataset2 = [
			'data' =>  array_column($records, 'female'),
			'label' => "Female",
	'backgroundColor' =>  random_color(),
	'borderColor' =>  random_color(),
	'borderWidth' => '2',
		];
		$datasets[] = $dataset2;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
}
