<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StaffDetailsAddRequest;
use App\Http\Requests\StaffDetailsEditRequest;
use App\Models\StaffDetails;
use Illuminate\Http\Request;
use Exception;
class StaffDetailsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.staffdetails.list";
		$query = StaffDetails::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			StaffDetails::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "staff_details.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, StaffDetails::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = StaffDetails::query();
		$record = $query->findOrFail($rec_id, StaffDetails::viewFields());
		return $this->renderView("pages.staffdetails.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.staffdetails.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(StaffDetailsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("files", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['files'], "files");
			$modeldata['files'] = $fileInfo['filepath'];
		}
		
		//save StaffDetails record
		$record = StaffDetails::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("staffdetails", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(StaffDetailsEditRequest $request, $rec_id = null){
		$query = StaffDetails::query();
		$record = $query->findOrFail($rec_id, StaffDetails::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("files", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['files'], "files");
			$modeldata['files'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("staffdetails", "Record updated successfully");
		}
		return $this->renderView("pages.staffdetails.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = StaffDetails::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
