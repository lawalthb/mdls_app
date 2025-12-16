<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentDetailsAddRequest;
use App\Http\Requests\StudentDetailsEditRequest;
use App\Models\Classes;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Exception;

class StudentDetailsController extends Controller
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
        $view = "pages.studentdetails.list";
        $query = StudentDetails::query();
        $limit = $request->limit ?? 50;
        if ($request->search) {
            $search = trim($request->search);
            StudentDetails::search($query, $search); // search table records
        }
        $orderby = $request->orderby ?? "student_details.id";
        $ordertype = $request->ordertype ?? "desc";
        $query->orderBy($orderby, $ordertype);
        if ($fieldname) {
            $query->where($fieldname, $fieldvalue); //filter by a table field
        }
        $records = $query->paginate($limit, StudentDetails::listFields());
        return $this->renderView($view, compact("records"));
    }


    /**
     * Select table record by ID
     * @param string $rec_id
     * @return \Illuminate\View\View
     */
    function view($rec_id = null)
    {
        $query = StudentDetails::query();
        $query->join("classes", "student_details.class_id", "=", "classes.id");
        $query->join("users", "student_details.user_id", "=", "users.id");
        $record = $query->findOrFail($rec_id, StudentDetails::viewFields());
        return $this->renderView("pages.studentdetails.view", ["data" => $record]);
    }


    /**
     * Display form page
     * @return \Illuminate\View\View
     */
    function add()
    {
        return $this->renderView("pages.studentdetails.add");
    }


    /**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
    function store(StudentDetailsAddRequest $request)
    {
        $modeldata = $this->normalizeFormData($request->validated());

        //save StudentDetails record
        $record = StudentDetails::create($modeldata);
        $rec_id = $record->id;
        return $this->redirect("studentdetails", "Record added successfully");
    }


    /**
     * Update table record with form data
     * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
    function edit(StudentDetailsEditRequest $request, $rec_id = null)
    {
        $query = StudentDetails::query();
        $record = $query->findOrFail($rec_id, StudentDetails::editFields());
        if ($request->isMethod('post')) {
            $modeldata = $this->normalizeFormData($request->validated());
            $record->update($modeldata);
            return $this->redirect("users/list_students", "Record updated successfully");
        }
        return $this->renderView("pages.studentdetails.edit", ["data" => $record, "rec_id" => $rec_id]);
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
        $query = StudentDetails::query();
        $query->whereIn("id", $arr_id);
        $query->delete();
        $redirectUrl = $request->redirect ?? url()->previous();
        return $this->redirect($redirectUrl, "Record deleted successfully");
    }


    /**
     * List table records
     * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
    function class_students(Request $request, $fieldname = null, $fieldvalue = null)
    {
        $view = "pages.studentdetails.class_students";
        $query = StudentDetails::query();
        $limit = $request->limit ?? 50;
        if ($request->search) {
            $search = trim($request->search);
            StudentDetails::search($query, $search); // search table records
        }
        $query->join("users", "student_details.user_id", "=", "users.id");
        $orderby = $request->orderby ?? "student_details.id";
        $ordertype = $request->ordertype ?? "desc";
        $query->orderBy($orderby, $ordertype);
        if ($fieldname) {
            $query->where($fieldname, $fieldvalue); //filter by a table field
        }
        $records = $query->paginate($limit, StudentDetails::classStudentsFields());
        return $this->renderView($view, compact("records"));
    }


    /**
     * Select table record by ID
     * @param string $rec_id
     * @return \Illuminate\View\View
     */
    function view_first_report($rec_id = null)
    {
        $query = StudentDetails::query();
        $query->join("classes", "student_details.class_id", "=", "classes.id");
        $record = $query->findOrFail($rec_id, StudentDetails::viewFirstReportFields());
        //dd(["data" => $record]);
        return $this->renderView("pages.studentdetails.view_first_report", ["data" => $record]);
    }

    function student_view_first_report(Request $request)
    {
        $adm_no = $request->adm_no;
        $user_id = substr($adm_no, -3);
         
        $user_class_id = StudentDetails::where("user_id", $user_id)->first()->class_id;
        $query = StudentDetails::query();
        $query->where("student_details.class_id", $user_class_id);
        $query->join("classes", "student_details.class_id", "=", "classes.id");
        $record = $query->first(StudentDetails::viewFirstReportFields());
        return $this->renderView("pages.studentdetails.view_first_report", ["data" => $record]);

    }

     function student_view_second_report()
    {

        $user_id = auth()->user()->id;
        $user_class_id = StudentDetails::where("user_id", $user_id)->first()->class_id;
        $query = StudentDetails::query();
        $query->where("student_details.class_id", $user_class_id);
        $query->join("classes", "student_details.class_id", "=", "classes.id");
        $record = $query->first(StudentDetails::viewFirstReportFields());


        return $this->renderView("pages.studentdetails.view_second_report", ["data" => $record]);

    }



     function student_view_third_report()
    {

        $user_id = auth()->user()->id;
        $user_class_id = StudentDetails::where("user_id", $user_id)->first()->class_id;
        $query = StudentDetails::query();
        $query->where("student_details.class_id", $user_class_id);
        $query->join("classes", "student_details.class_id", "=", "classes.id");
        $record = $query->first(StudentDetails::viewThirdReportFields());


        return $this->renderView("pages.studentdetails.view_third_report", ["data" => $record]);

    }


    /**
     * Select table record by ID
     * @param string $rec_id
     * @return \Illuminate\View\View
     */
    function view_second_report($rec_id = null)
    {

        $query = StudentDetails::query();
        $query->join("classes", "student_details.class_id", "=", "classes.id");
        $record = $query->findOrFail($rec_id, StudentDetails::viewSecondReportFields());
        return $this->renderView("pages.studentdetails.view_second_report", ["data" => $record]);
    }


    /**
     * Select table record by ID
     * @param string $rec_id
     * @return \Illuminate\View\View
     */
    function view_third_report($rec_id = null)
    {
        $query = StudentDetails::query();
        $record = $query->findOrFail($rec_id, StudentDetails::viewThirdReportFields());
        return $this->renderView("pages.studentdetails.view_third_report", ["data" => $record]);
    }


    /**
     * List table records
     * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
    function home_list(Request $request, $fieldname = null, $fieldvalue = null)
    {
        $view = "pages.studentdetails.home_list";
        $query = StudentDetails::query();
        $limit = $request->limit ?? 10;
        if ($request->search) {
            $search = trim($request->search);
            StudentDetails::search($query, $search); // search table records
        }
        $query->join("users", "student_details.user_id", "=", "users.id");
        $query->join("classes", "student_details.class_id", "=", "classes.id");
        $orderby = $request->orderby ?? "student_details.id";
        $ordertype = $request->ordertype ?? "desc";
        $query->orderBy($orderby, $ordertype);
        if ($fieldname) {
            $query->where($fieldname, $fieldvalue); //filter by a table field
        }
        $records = $query->paginate($limit, StudentDetails::homeListFields());
        return $this->renderView($view, compact("records"));
    }


    /**
     * Promote students to a new class
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    function promote(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|string',
            'new_class_id' => 'required|exists:classes,id'
        ]);

        $student_ids = explode(',', $request->student_ids);
        $new_class_id = $request->new_class_id;

        try {
            // First, mark existing students in destination class as 'old' (if not already)
            StudentDetails::where('class_id', $new_class_id)
                ->where('promotion_flag', '!=', 'old')
                ->update(['promotion_flag' => 'old']);

            // Update all selected students' class_id and mark them as newly promoted
            $updated = StudentDetails::whereIn('id', $student_ids)
                ->update([
                    'class_id' => $new_class_id,
                    'last_promoted_at' => now(),
                    'promotion_flag' => 'new'
                ]);

            if ($updated > 0) {
                return $this->redirect("studentdetails/class_students", "$updated student(s) promoted successfully");
            } else {
                return response()->json([
                    'message' => 'No students were promoted. Please try again.'
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error promoting students: ' . $e->getMessage()
            ], 500);
        }
    }

    function listClasses(Request $request, $fieldname = null , $fieldvalue = null){
		$view = 'pages.classes.to_promote';
		$query = Classes::query();
		$limit = $request->limit ?? 50;
		if($request->search){
			$search = trim($request->search);
			Classes::search($query, $search); // search table records
		}
        $query->join("users", "classes.updated_by", "=", "users.id");

        // Add student count as a subquery
        $query->leftJoin('student_details', 'classes.id', '=', 'student_details.class_id')
              ->selectRaw('classes.*, users.id as users_id, COUNT(student_details.id) as students_count')
              ->groupBy('classes.id', 'classes.name',  'classes.is_active', 'classes.created_at', 'classes.updated_at', 'classes.updated_by', 'users.id');

        // only show active classes
        $query->where('classes.is_active', 'Yes');
		$orderby = $request->orderby ?? "classes.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit);
		return $this->renderView($view, compact("records"));
	}


    function studentinclass(Request $request, $fieldname = null , $fieldvalue = null){
        $class_id =$request->id;
         $view = "pages.studentdetails.studentinclass";
        $query = StudentDetails::query();
        $limit = $request->limit ?? 100;
        if ($request->search) {
            $search = trim($request->search);
            StudentDetails::search($query, $search); // search table records
        }
        $query->join("users", "student_details.user_id", "=", "users.id");
        $query->join("classes", "student_details.class_id", "=", "classes.id");
        $orderby = $request->orderby ?? "student_details.id";
        $ordertype = $request->ordertype ?? "desc";
        $query->orderBy($orderby, $ordertype);

            $query->where('class_id', $class_id); //filter by a table field

        $records = $query->paginate($limit, StudentDetails::homeListFields());
        return $this->renderView($view, compact("records"));
    }

    /**
     * Reset all students' promotion flags to 'old' at the start of new academic year
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    function resetPromotionFlags(Request $request)
    {
        try {
            // Mark all students as 'old' (ready for promotion)
            $updated = StudentDetails::where('promotion_flag', 'new')
                ->update(['promotion_flag' => 'old']);

            return response()->json([
                'success' => true,
                'message' => "$updated student(s) marked as ready for promotion (new academic year)"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error resetting promotion flags: ' . $e->getMessage()
            ], 500);
        }
    }


}
