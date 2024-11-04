<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebTopbarsAddRequest;
use App\Http\Requests\WebTopbarsEditRequest;
use App\Models\WebTopbars;
use Illuminate\Http\Request;
use Exception;
class WebTopbarsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.webtopbars.list";
		$query = WebTopbars::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			WebTopbars::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web_topbars.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, WebTopbars::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = WebTopbars::query();
		$record = $query->findOrFail($rec_id, WebTopbars::viewFields());
		return $this->renderView("pages.webtopbars.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.webtopbars.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebTopbarsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save WebTopbars record
		$record = WebTopbars::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("webtopbars", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebTopbarsEditRequest $request, $rec_id = null){
		$query = WebTopbars::query();
		$record = $query->findOrFail($rec_id, WebTopbars::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("webtopbars", "Record updated successfully");
		}
		return $this->renderView("pages.webtopbars.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = WebTopbars::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
