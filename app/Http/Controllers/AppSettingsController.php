<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppSettingsAddRequest;
use App\Http\Requests\AppSettingsEditRequest;
use App\Models\AppSettings;
use Illuminate\Http\Request;
use Exception;
class AppSettingsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.appsettings.list";
		$query = AppSettings::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			AppSettings::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "app_settings.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, AppSettings::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = AppSettings::query();
		$record = $query->findOrFail($rec_id, AppSettings::viewFields());
		return $this->renderView("pages.appsettings.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.appsettings.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(AppSettingsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save AppSettings record
		$record = AppSettings::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("appsettings", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(AppSettingsEditRequest $request, $rec_id = null){
		$query = AppSettings::query();
		$record = $query->findOrFail($rec_id, AppSettings::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("appsettings", "Record updated successfully");
		}
		return $this->renderView("pages.appsettings.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = AppSettings::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
