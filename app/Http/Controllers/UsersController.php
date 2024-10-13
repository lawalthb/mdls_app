<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRegisterRequest;
use App\Http\Requests\UsersAccountEditRequest;
use App\Http\Requests\UsersAddRequest;
use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\Usersadd_studentRequest;
use App\Http\Requests\Usersedit_studentRequest;
use App\Models\Users;
use Illuminate\Http\Request;
use Exception;
class UsersController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.users.list";
		$query = Users::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Users::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "users.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Users::listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Users::query();
		$record = $query->findOrFail($rec_id, Users::viewFields());
		return $this->renderView("pages.users.view", ["data" => $record]);
	}


	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.users.detail-pages", ["masterRecordId" => $rec_id]);
	}


	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.users.add");
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(UsersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());

		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
		$modeldata['password'] = bcrypt($modeldata['password']);

		//save Users record
		$record = Users::create($modeldata);
		$record->assignRole("User"); //set default role for user
		$rec_id = $record->id;
		return $this->redirect("users", "Record added successfully");
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(UsersEditRequest $request, $rec_id = null){
		$query = Users::query();
		$record = $query->findOrFail($rec_id, Users::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());

		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("users", "Record updated successfully");
		}
		return $this->renderView("pages.users.edit", ["data" => $record, "rec_id" => $rec_id]);
	}


	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Users::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}


	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add_student(){
		return $this->renderView("pages.users.add_student");
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add_student_store(Usersadd_studentRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());

		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}

		//Validate StudentDetails form data
		$studentdetailsPostData = $request->studentdetails;
		$studentdetailsValidator = validator()->make($studentdetailsPostData, ["firstname" => "required|string",
				"middlemane" => "nullable|string",
				"lastname" => "required|string",
				"dob" => "nullable|date",
				"class_id" => "required",
				"religion" => "nullable",
				"blood_group" => "nullable",
				"height" => "nullable|numeric",
				"weight" => "nullable|numeric",
				"measurement_date" => "nullable|date",
				"address" => "nullable|string"]);
		if ($studentdetailsValidator->fails()) {
			return $studentdetailsValidator->errors();
		}
		$studentdetailsModeldata = $this->normalizeFormData($studentdetailsValidator->valid());

		//save Users record
		$record = Users::create($modeldata);
		$record->assignRole("User"); //set default role for user
		$rec_id = $record->id;

        // set studentdetails.user_id to users.id
		$studentdetailsModeldata['user_id'] = $rec_id;
		//save StudentDetails record
		$studentdetailsRecord = \App\Models\StudentDetails::create($studentdetailsModeldata);
		return $this->redirect("users/list_students", "Record added successfully");
	}


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function list_students(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.users.list_students";
		$query = Users::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Users::search($query, $search); // search table records
		}
		$query->join("student_details", "users.id", "=", "student_details.user_id");
		$query->join("classes", "student_details.class_id", "=", "classes.id");
		$orderby = $request->orderby ?? "users.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("user_role_id", "=" , 2);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Users::listStudentsFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view_student($rec_id = null){
		$query = Users::query();
		$record = $query->findOrFail($rec_id, Users::viewStudentFields());
		return $this->renderView("pages.users.view_student", ["data" => $record]);
	}



	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit_student(Usersedit_studentRequest $request, $rec_id = null){
		$query = Users::query();
		$record = $query->findOrFail($rec_id, Users::editStudentFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());

		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("users", "Record updated successfully");
		}
		return $this->renderView("pages.users.edit_student", ["data" => $record, "rec_id" => $rec_id]);
	}
}
