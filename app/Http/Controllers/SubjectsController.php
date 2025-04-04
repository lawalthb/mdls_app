<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectsAddRequest;
use App\Http\Requests\SubjectsEditRequest;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Exception;
class SubjectsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.subjects.list";
		$query = Subjects::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			Subjects::search($query, $search); // search table records
		}
		$query->join("users", "subjects.updated_by", "=", "users.id");
		$orderby = $request->orderby ?? "subjects.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Subjects::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Subjects::query();
		$record = $query->findOrFail($rec_id, Subjects::viewFields());
		return $this->renderView("pages.subjects.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.subjects.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.subjects.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(SubjectsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Subjects record
		$record = Subjects::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("subjects", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(SubjectsEditRequest $request, $rec_id = null){
		$query = Subjects::query();
		$record = $query->findOrFail($rec_id, Subjects::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("subjects", "Record updated successfully");
		}
		return $this->renderView("pages.subjects.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Subjects::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
