<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebCountersAddRequest;
use App\Http\Requests\WebCountersEditRequest;
use App\Models\WebCounters;
use Illuminate\Http\Request;
use Exception;
class WebCountersController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.webcounters.list";
		$query = WebCounters::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			WebCounters::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web_counters.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, WebCounters::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = WebCounters::query();
		$record = $query->findOrFail($rec_id, WebCounters::viewFields());
		return $this->renderView("pages.webcounters.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.webcounters.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebCountersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save WebCounters record
		$record = WebCounters::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("webcounters", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebCountersEditRequest $request, $rec_id = null){
		$query = WebCounters::query();
		$record = $query->findOrFail($rec_id, WebCounters::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("webcounters", "Record updated successfully");
		}
		return $this->renderView("pages.webcounters.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = WebCounters::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
