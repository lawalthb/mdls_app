<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamSheetsAddRequest;
use App\Http\Requests\ExamSheetsEditRequest;
use App\Models\ExamSheets;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExamsheetsViewExport;
use Illuminate\Support\Facades\DB;
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
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.examsheets.list";
		$query = ExamSheets::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			ExamSheets::search($query, $search); // search table records
		}
		$query->join("sessions", "exam_sheets.session_id", "=", "sessions.id");
		$query->join("terms", "exam_sheets.term_id", "=", "terms.id");
		$query->join("users", "exam_sheets.user_id", "=", "users.id");
		$query->join("classes", "exam_sheets.class_id", "=", "classes.id");
		$orderby = $request->orderby ?? "exam_sheets.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, ExamSheets::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = ExamSheets::query();
		$query->join("sessions", "exam_sheets.session_id", "=", "sessions.id");
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, ExamSheets::viewFields());
		return $this->renderView("pages.examsheets.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.examsheets.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.examsheets.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ExamSheetsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate ExamSheetPerformances form data
		$examsheetperformancesPostData = $request->examsheetperformances;
		$examsheetperformancesValidator = validator()->make($examsheetperformancesPostData, ["*.subject_id" => "required",
				"*.ca_score" => "required|numeric|max:40|min:0",
				"*.exam_score" => "required|numeric|max:60|min:0",
				"*.total" => "required|numeric|max:100|min:0",
				"*.remark" => "nullable|string",
				"*.updated_by" => "required"]);
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
	function edit(ExamSheetsEditRequest $request, $rec_id = null){
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
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = ExamSheets::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
    /**
     * Endpoint action
     * @return \Illuminate\Http\Response
     */
    public function byclass(Request $request){
        $request->validate([
    'subject_id' => 'required|integer|exists:subjects,id', 
  'class_id' => 'required|integer|exists:classes,id', 
    'user_id' => 'required|integer|exists:users,id',         
    'session_id' => 'required|integer|exists:sessions,id',   
    'term_id' => 'required|integer|exists:terms,id',         
    'ca_score' => 'required|numeric|min:0|max:40',           
    'exam_score' => 'required|numeric|min:0|max:60',         
]);
$existingExamSheet = DB::table('exam_sheets')
    ->where('user_id', $request->input('user_id'))
    ->where('session_id', $request->input('session_id'))
    ->where('term_id', $request->input('term_id'))
    ->where('class_id', $request->input('class_id'))
    ->first();
if ($existingExamSheet) {
    $exam_sheet_id = $existingExamSheet->id;
    // Handle the case where the exam sheet already exists
    // Assuming you're receiving data via a form or request
$user_id    = $request->input('user_id');
$session_id = $request->input('session_id');
$term_id    = $request->input('term_id');
$class_id   = $request->input('class_id');
$existingPerformance = DB::table('exam_sheet_performances')
        ->where('exam_sheet_id', $exam_sheet_id)
        ->where('subject_id', $request->input('subject_id'))
        ->first();
    if ($existingPerformance) {
          $perf_id = $existingPerformance->id;
        DB::table('exam_sheet_performances')->where('id', $perf_id)->update([
        'subject_id' => $request->input('subject_id') ,
        'ca_score' => $request->input('ca_score'),
        'exam_score' => $request->input('exam_score') ,
        'total' => $request->input('total') ,
        'updated_at' => now()
    ]);
        return "Updated"; 
    }
  DB::table('exam_sheet_performances')->insert([
        'exam_sheet_id' => $exam_sheet_id, // foreign key
        'subject_id' => $request->input('subject_id') ,
        'ca_score' => $request->input('ca_score'),
        'exam_score' => $request->input('exam_score') ,
        'total' => $request->input('total') ,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    return "success";
}
// Assuming you're receiving data via a form or request
$user_id    = $request->input('user_id');
$session_id = $request->input('session_id');
$term_id    = $request->input('term_id');
$class_id   = $request->input('class_id');
// Insert data into exam_sheets table and get the exam_sheet_id
$examSheetId = DB::table('exam_sheets')->insertGetId([
    'user_id' => $user_id,
    'session_id' => $session_id,
    'term_id' => $term_id,
'class_id' => $class_id,   
 'present_count' => 20,
     'open_count' => 20,
     'updated_by' => auth()->user()->id
]);
 $existingPerformance = DB::table('exam_sheet_performances')
        ->where('exam_sheet_id', $exam_sheet_id)
        ->where('subject_id', $request->input('subject_id'))
        ->first();
    if ($existingPerformance) {
        // Handle the case where the subject performance already exists
        $perf_id = $existingPerformance->id;
        DB::table('exam_sheet_performances')->where('id', $perf_id)->update([
        'subject_id' => $request->input('subject_id') ,
        'ca_score' => $request->input('ca_score'),
        'exam_score' => $request->input('exam_score') ,
        'total' => $request->input('total') ,
        'updated_at' => now()
    ]);
        return "Updated"; 
    }
  DB::table('exam_sheet_performances')->insert([
        'exam_sheet_id' => $exam_sheet_id, // foreign key
        'subject_id' => $request->input('subject_id') ,
        'ca_score' => $request->input('ca_score'),
        'exam_score' => $request->input('exam_score') ,
        'total' => $request->input('total') ,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    return "success";
  }
	

	/**
     * Export single record to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $record
	 * @param string $rec_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportView($query, $rec_id){
		ob_end_clean();// clean any output to allow file download
		$filename ="ViewExamSheetsReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, ExamSheets::exportViewFields());
			return view("reports.examsheets-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, ExamSheets::exportViewFields());
			$pdf = PDF::loadView("reports.examsheets-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new ExamsheetsViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new ExamsheetsViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
