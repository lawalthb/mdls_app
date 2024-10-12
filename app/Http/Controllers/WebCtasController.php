<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebCtasAddRequest;
use App\Http\Requests\WebCtasEditRequest;
use App\Models\WebCtas;
use Illuminate\Http\Request;
use Exception;
class WebCtasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.webctas.list";
		$query = WebCtas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			WebCtas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web_ctas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, WebCtas::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = WebCtas::query();
		$record = $query->findOrFail($rec_id, WebCtas::viewFields());
		return $this->renderView("pages.webctas.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.webctas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebCtasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save WebCtas record
		$record = WebCtas::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("webctas", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebCtasEditRequest $request, $rec_id = null){
		$query = WebCtas::query();
		$record = $query->findOrFail($rec_id, WebCtas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("webctas", "Record updated successfully");
		}
		return $this->renderView("pages.webctas.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = WebCtas::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
