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
                            use Illuminate\Support\Facades\DB;
                            $class_id = $data['id'];
                            // Get students' details, exam scores, and ca scores
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
                            $totalScores = [];
                            foreach ($students as $record) {
                            if (!isset($studentsData[$record->id])) {
                            $studentsData[$record->id] = [
                            'id' => $record->id,
                            'firstname' => $record->firstname,
                            'lastname' => $record->lastname,
                            'scores' => [],
                            'total_score' => 0,
                            'percentage' => 0
                            ];
                            }
                            if ($record->subject_id) {
                            $studentsData[$record->id]['scores'][$record->subject_id] = [
                            'exam_score' => $record->exam_score,
                            'ca_score' => $record->ca_score,
                            'total_score' => $record->total
                            ];
                            $studentsData[$record->id]['total_score'] += $record->total;
                            }
                            }
                            // Calculate percentage and store total scores for ranking
                            foreach ($studentsData as $studentId => $studentData) {
                            $totalSubjects = count($studentData['scores']);
                            if ($totalSubjects > 0) {
                            $studentsData[$studentId]['percentage'] = ($studentData['total_score'] / ($totalSubjects * 100)) * 100;
                            }
                            $totalScores[$studentId] = $studentData['total_score'];
                            }
                            // Sort total scores in descending order and assign positions with ordinal suffixes
                            arsort($totalScores);
                            $position = 0;
                            $lastScore = null;
                            foreach ($totalScores as $studentId => $score) {
                            if ($score !== $lastScore) {
                            $position++;
                            }
                            $studentsData[$studentId]['position'] = ordinal($position);
                            $lastScore = $score;
                            }
                            $subjects = DB::table('class_subjects')
                            ->join('subjects', 'class_subjects.subject_id', '=', 'subjects.id')
                            ->where('class_subjects.class_id', $class_id)
                            ->select('subjects.id', 'subjects.name')
                            ->get();
                            // Function to add ordinal suffix to the position
                            function ordinal($number)
                            {
                            $suffix = ['th', 'st', 'nd', 'rd'];
                            $value = $number % 100;
                            return $number . ($suffix[($value - 20) % 10] ?? $suffix[$value] ?? $suffix[0]);
                            }
                        ?>
                        <!-- HTML Table -->
                        <table class="table table-hover table-striped table-sm text-left">
                            <thead class="table-header">
                                <tr>
                                    <th>SN</th>
                                    <th>Students Name</th>
                                    @foreach($subjects as $subject)
                                    <th>{{ $subject->name }}</th>
                                    @endforeach
                                    <th>Total</th>
                                    <th>Percentage</th>
                                    <th>Position</th>
                                </tr>
                            </thead>
                            <tbody class="page-data">
                                @forelse($studentsData as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $student['firstname'] }} {{ $student['lastname'] }}</td>
                                    @foreach($subjects as $subject)
                                    <td>
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
                                    <td>{{ number_format($student['total_score'], 2) }}</td>
                                    <td>{{ number_format($student['percentage'], 2) }}%</td>
                                    <td>{{ $student['position'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{ count($subjects) + 3 }}" class="bg-light text-center text-muted animated bounce p-3">
                                        <i class="material-icons">block</i> No record found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


@endsection
