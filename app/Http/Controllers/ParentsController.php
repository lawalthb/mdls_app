<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParentsAddRequest;
use App\Http\Requests\ParentsEditRequest;
use App\Models\Parents;
use Illuminate\Http\Request;
use Exception;
class ParentsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.parents.list";
		$query = Parents::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			Parents::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "parents.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Parents::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Parents::query();
		$record = $query->findOrFail($rec_id, Parents::viewFields());
		return $this->renderView("pages.parents.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.parents.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ParentsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Parents record
		$record = Parents::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("parents", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ParentsEditRequest $request, $rec_id = null){
		$query = Parents::query();
		$record = $query->findOrFail($rec_id, Parents::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("parents", "Record updated successfully");
		}
		return $this->renderView("pages.parents.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Parents::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
