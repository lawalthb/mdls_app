<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\SessionsAddRequest;
use App\Http\Requests\SessionsEditRequest;
use App\Models\Sessions;
use Illuminate\Http\Request;
use Exception;
class SessionsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.sessions.list";
		$query = Sessions::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			Sessions::search($query, $search); // search table records
		}
		$query->join("users", "sessions.updated_by", "=", "users.id");
		$orderby = $request->orderby ?? "sessions.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Sessions::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Sessions::query();
		$record = $query->findOrFail($rec_id, Sessions::viewFields());
		return $this->renderView("pages.sessions.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.sessions.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.sessions.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(SessionsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['updated_by'] = auth()->user()->id;
		
		//save Sessions record
		$record = Sessions::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("sessions", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(SessionsEditRequest $request, $rec_id = null){
		$query = Sessions::query();
		$record = $query->findOrFail($rec_id, Sessions::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("sessions", "Record updated successfully");
		}
		return $this->renderView("pages.sessions.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Sessions::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
