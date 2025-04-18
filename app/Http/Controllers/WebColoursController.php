<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebColoursAddRequest;
use App\Http\Requests\WebColoursEditRequest;
use App\Models\WebColours;
use Illuminate\Http\Request;
use Exception;
class WebColoursController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.webcolours.list";
		$query = WebColours::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			WebColours::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web_colours.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, WebColours::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = WebColours::query();
		$record = $query->findOrFail($rec_id, WebColours::viewFields());
		return $this->renderView("pages.webcolours.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.webcolours.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebColoursAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save WebColours record
		$record = WebColours::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("webcolours", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebColoursEditRequest $request, $rec_id = null){
		$query = WebColours::query();
		$record = $query->findOrFail($rec_id, WebColours::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("webcolours", "Record updated successfully");
		}
		return $this->renderView("pages.webcolours.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = WebColours::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
