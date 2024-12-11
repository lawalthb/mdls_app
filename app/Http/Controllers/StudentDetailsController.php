<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentDetailsAddRequest;
use App\Http\Requests\StudentDetailsEditRequest;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Exception;
class StudentDetailsController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.studentdetails.list";
		$query = StudentDetails::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			StudentDetails::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "student_details.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, StudentDetails::listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = StudentDetails::query();
		$query->join("classes", "student_details.class_id", "=", "classes.id");
		$query->join("users", "student_details.user_id", "=", "users.id");
		$record = $query->findOrFail($rec_id, StudentDetails::viewFields());
		return $this->renderView("pages.studentdetails.view", ["data" => $record]);
	}


	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.studentdetails.add");
	}


	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(StudentDetailsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());

		//save StudentDetails record
		$record = StudentDetails::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("studentdetails", "Record added successfully");
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(StudentDetailsEditRequest $request, $rec_id = null){
		$query = StudentDetails::query();
		$record = $query->findOrFail($rec_id, StudentDetails::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("users/list_students", "Record updated successfully");
		}
		return $this->renderView("pages.studentdetails.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = StudentDetails::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function class_students(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.studentdetails.class_students";
		$query = StudentDetails::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			StudentDetails::search($query, $search); // search table records
		}
		$query->join("users", "student_details.user_id", "=", "users.id");
		$orderby = $request->orderby ?? "student_details.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, StudentDetails::classStudentsFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view_first_report($rec_id = null){
		$query = StudentDetails::query();
		$query->join("classes", "student_details.class_id", "=", "classes.id");
		$record = $query->findOrFail($rec_id, StudentDetails::viewFirstReportFields());
       //dd(["data" => $record]);
		return $this->renderView("pages.studentdetails.view_first_report", ["data" => $record]);

	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view_second_report($rec_id = null){
		$query = StudentDetails::query();
		$record = $query->findOrFail($rec_id, StudentDetails::viewSecondReportFields());
		return $this->renderView("pages.studentdetails.view_second_report", ["data" => $record]);
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view_third_report($rec_id = null){
		$query = StudentDetails::query();
		$record = $query->findOrFail($rec_id, StudentDetails::viewThirdReportFields());
		return $this->renderView("pages.studentdetails.view_third_report", ["data" => $record]);
	}


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function home_list(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.studentdetails.home_list";
		$query = StudentDetails::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			StudentDetails::search($query, $search); // search table records
		}
		$query->join("users", "student_details.user_id", "=", "users.id");
		$query->join("classes", "student_details.class_id", "=", "classes.id");
		$orderby = $request->orderby ?? "student_details.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, StudentDetails::homeListFields());
		return $this->renderView($view, compact("records"));
	}
}
