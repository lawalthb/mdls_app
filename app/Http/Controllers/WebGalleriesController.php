<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebGalleriesAddRequest;
use App\Http\Requests\WebGalleriesEditRequest;
use App\Models\WebGalleries;
use Illuminate\Http\Request;
use Exception;
class WebGalleriesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.webgalleries.list";
		$query = WebGalleries::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			WebGalleries::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web_galleries.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, WebGalleries::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = WebGalleries::query();
		$record = $query->findOrFail($rec_id, WebGalleries::viewFields());
		return $this->renderView("pages.webgalleries.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.webgalleries.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebGalleriesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("images", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['images'], "images");
			$modeldata['images'] = $fileInfo['filepath'];
		}
		
		//save WebGalleries record
		$record = WebGalleries::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("webgalleries", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebGalleriesEditRequest $request, $rec_id = null){
		$query = WebGalleries::query();
		$record = $query->findOrFail($rec_id, WebGalleries::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("images", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['images'], "images");
			$modeldata['images'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("webgalleries", "Record updated successfully");
		}
		return $this->renderView("pages.webgalleries.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = WebGalleries::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
