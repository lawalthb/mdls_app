<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebBlogCategoriesAddRequest;
use App\Http\Requests\WebBlogCategoriesEditRequest;
use App\Models\WebBlogCategories;
use Illuminate\Http\Request;
use Exception;
class WebBlogCategoriesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.webblogcategories.list";
		$query = WebBlogCategories::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			WebBlogCategories::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web_blog_categories.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, WebBlogCategories::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = WebBlogCategories::query();
		$record = $query->findOrFail($rec_id, WebBlogCategories::viewFields());
		return $this->renderView("pages.webblogcategories.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.webblogcategories.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.webblogcategories.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebBlogCategoriesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save WebBlogCategories record
		$record = WebBlogCategories::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("webblogcategories", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebBlogCategoriesEditRequest $request, $rec_id = null){
		$query = WebBlogCategories::query();
		$record = $query->findOrFail($rec_id, WebBlogCategories::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("webblogcategories", "Record updated successfully");
		}
		return $this->renderView("pages.webblogcategories.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = WebBlogCategories::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
