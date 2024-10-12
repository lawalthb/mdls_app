<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebVissionsAddRequest;
use App\Http\Requests\WebVissionsEditRequest;
use App\Models\WebVissions;
use Illuminate\Http\Request;
use Exception;
class WebVissionsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.webvissions.list";
		$query = WebVissions::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			WebVissions::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web_vissions.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, WebVissions::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = WebVissions::query();
		$record = $query->findOrFail($rec_id, WebVissions::viewFields());
		return $this->renderView("pages.webvissions.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.webvissions.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebVissionsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save WebVissions record
		$record = WebVissions::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("webvissions", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebVissionsEditRequest $request, $rec_id = null){
		$query = WebVissions::query();
		$record = $query->findOrFail($rec_id, WebVissions::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("webvissions", "Record updated successfully");
		}
		return $this->renderView("pages.webvissions.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = WebVissions::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
