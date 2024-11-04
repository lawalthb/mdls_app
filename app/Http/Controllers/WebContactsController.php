<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebContactsAddRequest;
use App\Http\Requests\WebContactsEditRequest;
use App\Models\WebContacts;
use Illuminate\Http\Request;
use Exception;
class WebContactsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.webcontacts.list";
		$query = WebContacts::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			WebContacts::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web_contacts.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, WebContacts::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = WebContacts::query();
		$record = $query->findOrFail($rec_id, WebContacts::viewFields());
		return $this->renderView("pages.webcontacts.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.webcontacts.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebContactsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save WebContacts record
		$record = WebContacts::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("webcontacts", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebContactsEditRequest $request, $rec_id = null){
		$query = WebContacts::query();
		$record = $query->findOrFail($rec_id, WebContacts::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("webcontacts", "Record updated successfully");
		}
		return $this->renderView("pages.webcontacts.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = WebContacts::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
