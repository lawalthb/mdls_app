<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("classes/add");
    $can_edit = $user->canAccess("classes/edit");
    $can_view = $user->canAccess("classes/view");
    $can_delete = $user->canAccess("classes/delete");
    $pageTitle = "Class Details"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                    </a>
                </div>
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">First Term BroadSheet</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col comp-grid " >
                    <div  class=" page-content" >
                        <?php
                            if($data){
                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                        ?>
                        <div id="page-main-content" class=" px-3 mb-3">
                            <div class="page-data">
                                <!--PageComponentStart-->
                                <div class="mb-3 row row justify-content-start g-0">
                                    <div class="col-12">
                                        <div class="bg-light mb-1 card-1 p-2 border rounded">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <small class="text-muted">Name</small>
                                                    <div class="fw-bold">
                                                        <?php echo  $data['name'] ; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--PageComponentEnd-->
                                <div class="d-flex align-items-center gap-2">
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                            else{
                        ?>
                        <!-- Empty Record Message -->
                        <div class="text-muted p-3">
                            <i class="material-icons">block</i> No Record Found
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="col-12 comp-grid " >
                    <div class=" "><div>
                        <!-- custom code start here -->
                        <?php
                            $class_id = $data['id'];
                            $students_ = DB::table('student_details')->where('class_id', $class_id)->get();
                            $class_subjects = DB::table('class_subjects')
                            ->join('subjects', 'class_subjects.subject_id', '=', 'subjects.id')
                            ->where('class_subjects.class_id', $class_id)
                            ->select('class_subjects.*', 'subjects.name')
                            ->get();
                            //dd($class_subjects);
                            $students = DB::table('student_details')
                            ->where('student_details.class_id', $class_id)
                            ->leftJoin('exam_sheets', function ($join) {
                            $join->on('student_details.id', '=', 'exam_sheets.user_id')
                            ->where('exam_sheets.session_id', 1)
                            ->where('exam_sheets.term_id', 2)
                            ->where('exam_sheets.class_id', 16);
                            })
                            ->leftJoin('exam_sheet_performances', 'exam_sheets.id', '=', 'exam_sheet_performances.exam_sheet_id')
                            ->leftJoin('subjects', 'exam_sheet_performances.subject_id', '=', 'subjects.id')
                            ->select(
                            'student_details.*',
                            'exam_sheets.id as exam_sheet_id',
                            'subjects.id as subject_id',
                            'subjects.name',
                            'exam_sheet_performances.exam_score',
                            'exam_sheet_performances.ca_score',
                            'exam_sheet_performances.total'
                            )
                            ->get();
                            $studentsData = [];
                            foreach ($students as $record) {
                            if (!isset($studentsData[$record->id])) {
                            $studentsData[$record->id] = [
                            'id' => $record->id,
                            'firstname' => $record->firstname,
                            'lastname' => $record->lastname,
                            'scores' => []
                            ];
                            }
                            if ($record->subject_id) {
                            $studentsData[$record->id]['scores'][$record->subject_id] = [
                            'exam_score' => $record->exam_score,
                            'ca_score' => $record->ca_score,
                            'total_score' => $record->total
                            ];
                            }
                            }
                            $subjects = DB::table('class_subjects')
                            ->join('subjects', 'class_subjects.subject_id', '=', 'subjects.id')
                            ->where('class_subjects.class_id', $class_id)
                            ->select('subjects.id', 'subjects.name')
                            ->get();
                        ?>
                        <!-- table start here -->
                        <table class="table table-hover table-striped table-sm text-left">
                            <thead class="table-header">
                                <tr>
                                    <th>SN</th>
                                    <th class="td-">Students Name</th>
                                    @foreach($subjects as $subject)
                                    <th class="td-id">{{ $subject->name }}</th>
                                    @endforeach
                                    <th class="td-btn"></th>
                                </tr>
                            </thead>
                            <tbody class="page-data">
                                @forelse($studentsData as $index => $student)
                                <tr>
                                    <td class="td-checkbox">{{ $index + 1 }}</td>
                                    <td class="">
                                        {{ $student['firstname'] }} {{ $student['lastname'] }}
                                    </td>
                                    @foreach($subjects as $subject)
                                    <td class="">
                                        @if(isset($student['scores'][$subject->id]))
                                        <table>
                                            <tr>
                                                <td>CA: {{ $student['scores'][$subject->id]['ca_score'] ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Exam: {{ $student['scores'][$subject->id]['exam_score'] ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total: {{ $student['scores'][$subject->id]['total_score'] ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    @endforeach
                                    <td class="">
                                        View
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="bg-light text-center text-muted animated bounce p-3" colspan="{{ count($subjects) + 3 }}">
                                        <i class="material-icons">block</i> No record found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- end of table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


@endsection
