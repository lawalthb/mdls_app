<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassSubjectsAddRequest;
use App\Http\Requests\ClassSubjectsEditRequest;
use App\Models\ClassSubjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class ClassSubjectsController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.classsubjects.list";
		$query = ClassSubjects::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			ClassSubjects::search($query, $search); // search table records
		}
		$query->join("classes", "class_subjects.class_id", "=", "classes.id");
		$query->join("subjects", "class_subjects.subject_id", "=", "subjects.id");
		$orderby = $request->orderby ?? "class_subjects.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->class_id){
			$val = $request->class_id;
			$query->where(DB::raw("class_subjects.class_id"), "=", $val);
		}
		$records = $query->paginate($limit, ClassSubjects::listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = ClassSubjects::query();
		$record = $query->findOrFail($rec_id, ClassSubjects::viewFields());
		return $this->renderView("pages.classsubjects.view", ["data" => $record]);
	}


	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return view("pages.classsubjects.add");
	}


	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function store(ClassSubjectsAddRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		ClassSubjects::insert($modeldata);
		return $this->redirect("classsubjects", "Record added successfully");
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ClassSubjectsEditRequest $request, $rec_id = null){
		$query = ClassSubjects::query();
		$record = $query->findOrFail($rec_id, ClassSubjects::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("classsubjects", "Record updated successfully");
		}
		return $this->renderView("pages.classsubjects.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = ClassSubjects::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function report_card($rec_id = null){
		$query = ClassSubjects::query();
		$record = $query->findOrFail($rec_id, ClassSubjects::reportCardFields());
		return $this->renderView("pages.classsubjects.report_card", ["data" => $record]);
	}
}
