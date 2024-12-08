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
    if ($show_header == true) {
    ?>
        <div class="bg-light p-3 mb-3">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto  back-btn-col">
                        <a class="back-btn btn " href="{{ url()->previous() }}">
                            <i class="material-icons">arrow_back</i>
                        </a>
                    </div>
                    <div class="col  ">
                        <div class="">
                            <div class="h5 font-weight-bold text-primary">Set Exam by Class</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="">
        <div class="container">
            <div class="row ">
                <div class="col comp-grid ">
                    <div class=" page-content">
                        <?php
                        if ($data) {
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
                                                        <small class="text-muted">Class</small>
                                                        <div class="fw-bold">
                                                            <?php echo  $data['name']; ?>
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
                        } else {
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
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid ">
                    <div class=" ">
                        <div>
                            <div class="container">
                                <div class="row ">
                                    <div class="col comp-grid ">
                                        <div class=" page-content">
                                            <?php
                                            if ($data) {
                                                $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                            ?>
                                                <div id="page-main-content" class=" px-3 mb-3">
                                                    <div class="page-data">
                                                        <!--PageComponentStart-->
                                                        @php
                                                        $cur_session = get_value('session_id', examsettings('session_id'));
                                                        $session_name = App\Models\Sessions::where('id', $cur_session)->first();
                                                        $cur_term = get_value('term_id', examsettings('term_id'));
                                                        $term_name = App\Models\Terms::where('id', $cur_term)->first();
                                                        @endphp
                                                        <div class="mb-3 row row justify-content-start g-0">
                                                            <div class="col-12">
                                                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                                    <div class="row align-items-center">
                                                                        <div class="col">
                                                                            <small class="text-muted">Current Session</small>
                                                                            <div class="fw-bold">
                                                                                <?php echo  $session_name['name']; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row row justify-content-start g-0">
                                                                <div class="col-12">
                                                                    <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                                        <div class="row align-items-center">
                                                                            <div class="col">
                                                                                <small class="text-muted">Current Term</small>
                                                                                <div class="fw-bold">
                                                                                    <?php echo  $term_name['name']; ?>
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
                                            } else {
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 comp-grid ">
                    <div class=" ">
                        <div>
                            <div class="mb-3">
                                <div class="container-fluid">
                                    <div class="row ">
                                        <div class="col comp-grid ">
                                            <div class=" ">
                                                <div>
                                                    <!-- form is here -->
                                                    <div class="card card-1 border rounded page-content">
                                                        <!--[form-start]-->
                                                        <div class="bg-light p-2 subform">
                                                            <h4 class="record-title">Subject:
                                                                @php
                                                                // Assuming the table names are class_subjects and subjects, adjust as per your database structure
                                                                $class_subjects = DB::table('class_subjects')
                                                                ->join('subjects', 'class_subjects.subject_id', '=', 'subjects.id')
                                                                ->where('class_subjects.class_id', $rec_id)
                                                                ->select('class_subjects.*', 'subjects.name as subject_name')
                                                                ->get();
                                                                if(isset($_GET['subject_id'])){
                                                                $sub_id = $_GET['subject_id'];
                                                                $sub_name = App\Models\Subjects::where('id', $sub_id)->value('name');
                                                                echo $sub_name;
                                                                }
                                                                @endphp
                                                                <select id="subject_id" required name="subject" class="form-control" style="width: 150px;" onchange="reloadWithSubjectId()">
                                                                    <option value="">Change Subject ...</option>
                                                                    @foreach ($class_subjects as $class_subject)
                                                                    <option value="{{ $class_subject->subject_id }}">
                                                                        {{ $class_subject->subject_name }} {{-- Fetching the subject name from the subjects table --}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </h4>
                                                            <hr />
                                                            @csrf
                                                            <div>
                                                                @php
                                                                $students = App\Models\StudentDetails::where('class_id', $rec_id)->get();
                                                                $sn = 0;
                                                                // dd( $students);
                                                                @endphp
                                                                <section>
                                                                    @if(isset($_GET['subject_id']) && !empty($_GET['subject_id']))
                                                                    <table style="border: 1px solid; overflow-x:auto; display:flex" id="score_table">
                                                                        @foreach ($students as $student)
                                                                        <form id="my-form<?= ++$sn; ?>" action="/examsheets/byclass" method="POST">
                                                                            <tr style="border: 1px solid;">
                                                                                <td style="border: 1px solid;">
                                                                                    {{$sn;}}
                                                                                    <input type="hidden" value="<?php if (isset($_GET['subject_id'])) {
                                                                                                                    echo $_GET['subject_id'];
                                                                                                                } else {
                                                                                                                    echo "NULL";
                                                                                                                } ?>" name="subject_id" class="subject_id" />
                                                                                    <input type="hidden" value="{{$rec_id}}" name="class_id" class="class_id" />
                                                                                    @php
                                                                                    //echo $student->user_id;
                                                                                    //echo $cur_term;
                                                                                    // echo $cur_session;
                                                                                    $existingExamSheet = DB::table('exam_sheets')
                                                                                    ->where('user_id', $student->user_id)
                                                                                    ->where('session_id', $cur_session)
                                                                                    ->where('term_id', $cur_term)
                                                                                    ->where('class_id', $rec_id)
                                                                                    ->first();
                                                                                    if( $existingExamSheet){
                                                                                    $exam_sheet_id = $existingExamSheet->id;
                                                                                    }else{
                                                                                    $exam_sheet_id = null;
                                                                                    }
                                                                                    @endphp
                                                                                    <input type="hidden" value="{{$student->id}}" name="user_id" />
                                                                                    <input type="hidden" name="session_id" value="<?php echo get_value('session_id', examsettings('session_id')) ?>" />
                                                                                    <input type="hidden" name="term_id" value="<?php echo get_value('term_id', examsettings('term_id')) ?>" />
                                                                                </td>
                                                                                <td style="border: 1px solid;">
                                                                                    <div class=" ">
                                                                                        {{ $student->firstname }} {{ $student->middlemane }}
                                                                                    </div>
                                                                                </td>
                                                                                <td style="border: 1px solid;">
                                                                                    @php
                                                                                    if (isset($_GET['subject_id'])) {
                                                                                    $subject = $_GET['subject_id'];
                                                                                    } else {
                                                                                    $subject = 1;
                                                                                    }
                                                                                    $score = DB::table('exam_sheets')
                                                                                    ->join('exam_sheet_performances', 'exam_sheet_performances.exam_sheet_id', '=', 'exam_sheets.id')
                                                                                    ->where('exam_sheet_performances.exam_sheet_id',$exam_sheet_id)
                                                                                    ->where('exam_sheets.user_id', $student->user_id )
                                                                                    ->where('exam_sheet_performances.subject_id', $subject )
                                                                                    ->select('exam_sheet_performances.*')
                                                                                    ->first();
                                                                                    if($score){
                                                                                    $ca_score = $score->ca_score ?? 0;
                                                                                    $exam_score = $score->exam_score ?? 0;
                                                                                    $total = $score->total ?? 0;
                                                                                    }
                                                                                    @endphp
                                                                                    CA <input id="" value="<?php if (isset($score->ca_score)) {
                                                                                                                echo
                                                                                                                $ca_score;
                                                                                                            } else {
                                                                                                                echo 0;
                                                                                                            } ?>" type="number" placeholder="Enter CA Score" name="ca_score" style="width: 80px;" class="form-control ca_score" oninput="calculateTotal(this)" min="0" max="40" step="0.1" />
                                                                                </td>
                                                                                <td>
                                                                                    Exam <input id="" value="<?php if (isset($score->exam_score)) {
                                                                                                                    echo
                                                                                                                    $exam_score;
                                                                                                                } else {
                                                                                                                    echo 0;
                                                                                                                } ?>" type="number" placeholder="Enter Exam Score" style="width: 80px;" name="exam_score" class="form-control exam_score" oninput="calculateTotal(this)" min="0" max="60" step="0.1" />
                                                                                </td>
                                                                                <td style="border: 1px solid;">
                                                                                    Total <input id="" value="<?php if (isset($score->total)) {
                                                                                                                    echo
                                                                                                                    $total;
                                                                                                                } else {
                                                                                                                    echo 0;
                                                                                                                } ?>" type="number" name="total" style="width: 80px;" class="form-control total_score " readonly />
                                                                                </td>
                                                                                <td style="border: 1px solid;">
                                                                                    <button class="btn btn-primary" type="submit" id="save<?= $sn ?>">
                                                                                        Save
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </form>
                                                                        <script>
                                                                            $(document).ready(function() {
                                                                                // Intercept the form submission
                                                                                $('#my-form<?= $sn ?>').submit(function(event) {
                                                                                    event.preventDefault(); // Prevent the default form submission
                                                                                    // Capture form data
                                                                                    var formData = $(this).serialize(); // Serialize form data
                                                                                    // Perform AJAX request
                                                                                    $.ajax({
                                                                                        url: $(this).attr('action'), // Use the form's action URL
                                                                                        type: 'POST', // Send the request as POST
                                                                                        data: formData, // Send the form data
                                                                                        success: function(response) {
                                                                                            // Handle the success response
                                                                                            //alert('Data submitted successfully!');
                                                                                            // Change button background color and text
                                                                                            $('#save<?= $sn ?>').css('background-color', 'green');
                                                                                            $('#save<?= $sn ?>').text('Saved');
                                                                                            console.log(response); // Optional: Debug response
                                                                                        },
                                                                                        error: function(xhr, status, error) {
                                                                                            // Handle errors
                                                                                            alert(xhr.responseText['message']);
                                                                                            console.log(xhr.responseText);
                                                                                        }
                                                                                    });
                                                                                });
                                                                            });
                                                                        </script>

                                                                        <script>
                                                                            function calculateTotal(element) {
                                                                                // Get the current row (tr) that the input is part of
                                                                                let row = element.closest('tr');
                                                                                // Get CA and Exam inputs within the same row
                                                                                let caScore = row.querySelector('.ca_score').value || 0; // Use 0 if empty
                                                                                let examScore = row.querySelector('.exam_score').value || 0; // Use 0 if empty
                                                                                // Calculate the total
                                                                                let totalScore = parseFloat(caScore) + parseFloat(examScore);
                                                                                // Set the calculated total to the total input field
                                                                                row.querySelector('.total_score').value = totalScore;
                                                                            }
                                                                        </script>
                                                                        @endforeach
                                                                    </table>
                                                                    @else
                                                                    <div class="alert alert-info">
                                                                        Please select a subject to view and enter scores
                                                                    </div>
                                                                    @endif
                                                                </section>
                                                            </div>
                                                            <div class="form-ajax-status"></div>
                                                        </div>
                                                        <!--[form-button-start]-->
                                                        <div class="form-group form-submit-btn-holder text-center mt-3">
                                                        </div>
                                                        <!--[form-button-end]-->
                                                        </form>
                                                        <!--[form-end]-->
                                                    </div>
                                                    <!-- form end here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function reloadWithSubjectId() {
            var selectedSubjectId = document.getElementById('subject_id').value;
            if (selectedSubjectId) {
                // Get the current URL without query parameters
                var currentUrl = window.location.href.split('?')[0];
                // Append the selected subject_id to the URL
                window.location.href = currentUrl + '?subject_id=' + selectedSubjectId;
            }
        }
    </script>
</section>


@endsection
