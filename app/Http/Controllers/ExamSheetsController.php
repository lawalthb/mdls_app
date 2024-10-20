<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamSheetsAddRequest;
use App\Http\Requests\ExamSheetsEditRequest;
use App\Models\ExamSheets;
use Illuminate\Http\Request;
use Exception;

class ExamSheetsController extends Controller
{


	/**
	 * List table records
	 * @param  \Illuminate\Http\Request
	 * @param string $fieldname //filter records by a table field
	 * @param string $fieldvalue //filter value
	 * @return \Illuminate\View\View
	 */
	function index(Request $request, $fieldname = null, $fieldvalue = null)
	{
		$view = "pages.examsheets.list";
		$query = ExamSheets::query();
		$limit = $request->limit ?? 10;
		if ($request->search) {
			$search = trim($request->search);
			ExamSheets::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "exam_sheets.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if ($fieldname) {
			$query->where($fieldname, $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, ExamSheets::listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
	 * Select table record by ID
	 * @param string $rec_id
	 * @return \Illuminate\View\View
	 */
	function view($rec_id = null)
	{
		$query = ExamSheets::query();
		$record = $query->findOrFail($rec_id, ExamSheets::viewFields());
		return $this->renderView("pages.examsheets.view", ["data" => $record]);
	}


	/**
	 * Display Master Detail Pages
	 * @param string $rec_id //master record id
	 * @return \Illuminate\View\View
	 */
	function masterDetail($rec_id = null)
	{
		return View("pages.examsheets.detail-pages", ["masterRecordId" => $rec_id]);
	}


	/**
	 * Display form page
	 * @return \Illuminate\View\View
	 */
	function add()
	{
		return $this->renderView("pages.examsheets.add");
	}


	/**
	 * Save form record to the table
	 * @return \Illuminate\Http\Response
	 */
	function store(ExamSheetsAddRequest $request)
	{
		$modeldata = $this->normalizeFormData($request->validated());

		//Validate ExamSheetPerformances form data
		$examsheetperformancesPostData = $request->examsheetperformances;
		$examsheetperformancesValidator = validator()->make($examsheetperformancesPostData, [
			"*.subject_id" => "required",
			"*.ca_score" => "required|numeric|max:40|min:0",
			"*.exam_score" => "required|numeric|max:60|min:0",
			"*.total" => "required|numeric|max:100|min:0",
			"*.remark" => "nullable|string"
		]);
		if ($examsheetperformancesValidator->fails()) {
			return $examsheetperformancesValidator->errors();
		}
		$examsheetperformancesValidData = $examsheetperformancesValidator->valid();
		$examsheetperformancesModeldata = array_values($examsheetperformancesValidData);

		//save ExamSheets record
		$record = ExamSheets::create($modeldata);
		$rec_id = $record->id;

		// set examsheetperformances.exam_sheet_id to exam_sheets $rec_id
		foreach ($examsheetperformancesModeldata as &$data) {
			$data['exam_sheet_id'] = $rec_id;
			$data['updated_by'] = 2;
		}

		//Save ExamSheetPerformances record
		\App\Models\ExamSheetPerformances::insert($examsheetperformancesModeldata);
		return $this->redirect("examsheets", "Record added successfully");
	}


	/**
	 * Update table record with form data
	 * @param string $rec_id //select record by table primary key
	 * @return \Illuminate\View\View;
	 */
	function edit(ExamSheetsEditRequest $request, $rec_id = null)
	{
		$query = ExamSheets::query();
		$record = $query->findOrFail($rec_id, ExamSheets::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("examsheets", "Record updated successfully");
		}
		return $this->renderView("pages.examsheets.edit", ["data" => $record, "rec_id" => $rec_id]);
	}


	/**
	 * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma
	 * @return \Illuminate\Http\Response
	 */
	function delete(Request $request, $rec_id = null)
	{
		$arr_id = explode(",", $rec_id);
		$query = ExamSheets::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
