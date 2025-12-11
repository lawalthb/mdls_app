<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassesAddRequest;
use App\Http\Requests\ClassesEditRequest;
use App\Models\Classes;
use App\Models\StaffClasses;
use Illuminate\Http\Request;
use Exception;
class ClassesController extends Controller
{


	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.classes.list";
		$query = Classes::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			Classes::search($query, $search); // search table records
		}
		$query->join("users", "classes.updated_by", "=", "users.id");
		$orderby = $request->orderby ?? "classes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Classes::listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Classes::query();
		$record = $query->findOrFail($rec_id, Classes::viewFields());
		return $this->renderView("pages.classes.view", ["data" => $record]);
	}


	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.classes.detail-pages", ["masterRecordId" => $rec_id]);
	}


	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return view("pages.classes.add");
	}


	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function store(ClassesAddRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		$modeldata['updated_by'] = auth()->user()->id;
		Classes::insert($modeldata);
		return $this->redirect("classes", "Record added successfully");
	}


	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ClassesEditRequest $request, $rec_id = null){
		$query = Classes::query();
		$record = $query->findOrFail($rec_id, Classes::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("classes", "Record updated successfully");
		}
		return $this->renderView("pages.classes.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Classes::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function exam_class($rec_id = null){
		$query = Classes::query();
		$record = $query->findOrFail($rec_id, Classes::examClassFields());
		return $this->renderView("pages.classes.exam_class", ["data" => $record]);
	}






	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function exam(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.classes.exam";
		$query = Classes::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			Classes::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "classes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Classes::examFields());
		return $this->renderView($view, compact("records"));
	}

// for logged in staff
    function staff_exam(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.classes.staff_exam";
		$query = StaffClasses::query();
		$limit = $request->limit ?? 50;
   	$query->where("user_id", auth()->user()->id);

$query->join("classes", "staff_classes.class_id", "=", "classes.id");
		$orderby = $request->orderby ?? "classes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, StaffClasses::staff_listFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function students($rec_id = null){
		$query = Classes::query();
		$record = $query->findOrFail($rec_id, Classes::studentsFields());
		return $this->renderView("pages.classes.students", ["data" => $record]);
	}





	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function broadlist(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.classes.broadlist";
		$query = Classes::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			Classes::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "classes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Classes::broadlistFields());
		return $this->renderView($view, compact("records"));
	}


	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function broadview($rec_id = null){
		$query = Classes::query();
		$record = $query->findOrFail($rec_id, Classes::broadviewFields());
		return $this->renderView("pages.classes.broadview", ["data" => $record]);
	}

	/**
     * Promote all students from selected classes to a new class
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
	function promote_students(Request $request)
	{
		$request->validate([
			'class_ids' => 'required|string',
			'promote_to_class_id' => 'required|exists:classes,id'
		]);

		$class_ids = explode(',', $request->class_ids);
		$promote_to_class_id = $request->promote_to_class_id;

		try {
			// First, mark existing students in destination class as 'old' (if not already)
			\App\Models\StudentDetails::where('class_id', $promote_to_class_id)
				->where('promotion_flag', '!=', 'old')
				->update(['promotion_flag' => 'old']);

			// Get all students from the selected classes and promote them
			$updated = \App\Models\StudentDetails::whereIn('class_id', $class_ids)
				->update([
					'class_id' => $promote_to_class_id,
					'last_promoted_at' => now(),
					'promotion_flag' => 'new'
				]);

			if ($updated > 0) {
				return response()->json([
					'success' => true,
					'message' => "$updated student(s) promoted successfully to the new class"
				]);
			} else {
				return response()->json([
					'success' => false,
					'message' => 'No students found in the selected class(es).'
				], 400);
			}
		} catch (Exception $e) {
			return response()->json([
				'success' => false,
				'message' => 'Error promoting students: ' . $e->getMessage()
			], 500);
		}
	}

}
