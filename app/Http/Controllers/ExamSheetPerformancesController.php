<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamSheetPerformancesAddRequest;
use App\Http\Requests\ExamSheetPerformancesEditRequest;
use App\Models\ExamSheetPerformances;
use Illuminate\Http\Request;
use Exception;
class ExamSheetPerformancesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.examsheetperformances.list";
		$query = ExamSheetPerformances::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			ExamSheetPerformances::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "exam_sheet_performances.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, ExamSheetPerformances::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = ExamSheetPerformances::query();
		$record = $query->findOrFail($rec_id, ExamSheetPerformances::viewFields());
		return $this->renderView("pages.examsheetperformances.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return view("pages.examsheetperformances.add");
	}
	

	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function store(ExamSheetPerformancesAddRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		ExamSheetPerformances::insert($modeldata);
		return $this->redirect("examsheetperformances", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ExamSheetPerformancesEditRequest $request, $rec_id = null){
		$query = ExamSheetPerformances::query();
		$record = $query->findOrFail($rec_id, ExamSheetPerformances::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("examsheetperformances", "Record updated successfully");
		}
		return $this->renderView("pages.examsheetperformances.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = ExamSheetPerformances::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
