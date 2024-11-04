<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebHeadersAddRequest;
use App\Http\Requests\WebHeadersEditRequest;
use App\Models\WebHeaders;
use Illuminate\Http\Request;
use Exception;
class WebHeadersController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.webheaders.list";
		$query = WebHeaders::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			WebHeaders::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web_headers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, WebHeaders::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = WebHeaders::query();
		$record = $query->findOrFail($rec_id, WebHeaders::viewFields());
		return $this->renderView("pages.webheaders.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.webheaders.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebHeadersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save WebHeaders record
		$record = WebHeaders::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("webheaders", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebHeadersEditRequest $request, $rec_id = null){
		$query = WebHeaders::query();
		$record = $query->findOrFail($rec_id, WebHeaders::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("webheaders", "Record updated successfully");
		}
		return $this->renderView("pages.webheaders.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = WebHeaders::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
