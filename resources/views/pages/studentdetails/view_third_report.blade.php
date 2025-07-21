<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
//check if current user role is allowed access to the pages
$can_add = $user->canAccess("studentdetails/add");
$can_edit = $user->canAccess("studentdetails/edit");
$can_view = $user->canAccess("studentdetails/view");
$can_delete = $user->canAccess("studentdetails/delete");
$pageTitle = "Student Report Card"; //set dynamic page title
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Student Report Card</title>
    <style>
        #student-report-card {
            width: 21cm;
            /* A4 width */
            min-height: 29.7cm;
            /* A4 height */
            margin: 0 auto;
            background: white;
            padding: 2cm;
        }

        #student-report-card table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        #student-report-card th,
        #student-report-card td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 12px;
        }

        #student-report-card .school-header {
            text-align: center;
            margin-bottom: 20px;
        }

        #student-report-card .school-logo {
            width: 100px;
            height: auto;
        }

        #student-report-card .student-info {
            margin-bottom: 20px;
        }

        #student-report-card .grades-table th {
            background-color: #f5f5f5;
        }

        #student-report-card .remarks-section {
            margin-top: 20px;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #student-report-card,
            #student-report-card * {
                visibility: visible;
            }

            #student-report-card {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 0;
            }
        }
    </style>
</head>

<body>

    <!-- <a href="#" class="btn btn-primary">Download PDF</a> -->

    <!-- start of report card -->
    <div class="mb-3" id="student-report-card">


        <table>
            <tr>
                <th>
                    <image src="{{asset('images/logo.png')}}" width="150px" height="200px" />
                </th>
                <th colspan="3">

                    @if($data['classes_type'] == 'Secondary')
                    <h2>MERIT DATALIGHT COLLEGE</h2>
                    @elseif($data['classes_type'] == 'Primary')
                    <h2>Merit Datalight Nursery/Primary School</h2>
                    @endif
                    <h5>Motto: Creating and evious legacy <br />
                        Address: Cadid Estate Phase II Opposite Origan 2nd Bus Stop Badagry Exp-way, Lagos<br />
                        Email: datalight444@gmail.com<br />
                        Tel: 07041112438, 07033056074, 08179531056
                    </h5>
                </th>
                <th>Pupil's Photo <br>
                    Will be here later</th>
            </tr>
            <tbody>
                <tr>
                    <td colspan="5"><b>TERMINAL SHEET</b></td>
                </tr>
                <tr>
                    <td>END OF: THIRD TERM</td>
                    <td>REPORT FOR: 2024/2025</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>NAME OF STUDENT:</td>
                    <td colspan="3"> <?php echo  $data['firstname']; ?>
                        <?php echo  $data['middlemane']; ?>
                        <?php $data['lastname']; ?>
                    </td>
                    <td>  </td>
                </tr>
                <tr>
                    <td>Gender: <?php echo  $data['gender']; ?></td>
                    <td>AGE: <?php
                                $birth_date = $data['dob'];
                                $current_date = date('Y-m-d');
                                $birth_date_obj = new DateTime($birth_date);
                                $current_date_obj = new DateTime($current_date);
                                $diff = $current_date_obj->diff($birth_date_obj);
                                $age_years = $diff->y;
                                echo " $age_years years";
                                ?></td>
                    <td colspan="2">ADMISSION NO: MSDL00<?php echo  $data['id']; ?></td>

                 <td>CLASS: <?php echo get_class_name($data['class_id']); ?></td>

                </tr>
                <tr>
                    <td>NO. OF TIMES SCHOOL OPENED: Nill</td>
                    <td colspan="2">NO. OF TIMES PRESENT: Nill</td>
                    <td colspan="2">SCHOOL RE-OPEN ON: 04- May-2025: </td>


                </tr>
                <tr>
                    <td colspan="5"><B>PERFORMANCE IN SUBJECTS</B></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <table>
                            <tr>
                                <th>SUBJECT</th>
                                <th>CONTINUOS<BR /> ASSESSMENT(30%)</th>
                                <th>END OF TERM<BR /> EXAM SCORE (70%)</th>

                                <th>3RD TERM <BR /> 100% </th>
                                  <th>1ST TERM <BR /> 100%</th>
                                <th>2ND TERM <BR /> 100% </th>
                                <th>WEIGHT <BR />AVERAGE</th>
                                <th>GRADE</th>
                                <th>REMARKS</th>
                            </tr>
                            <tbody>
                                @php
                                $totalCA =0;
                                $totalEX = 0;
                                $total1Ex =0;
                                 $total2Ex =0;
                                  $totalCur =0;
                                $classSubjects = App\Models\ClassSubjects::where('class_id', $data['class_id'])
                                ->join('subjects', 'class_subjects.subject_id', '=', 'subjects.id')
                                ->select('subjects.name','subjects.id')
                                ->get();
                                $sn = 0;
                                // dd( $classSubjects);
                                @endphp
                                @foreach ($classSubjects as $subject)
                                @php
                                $examSheet = App\Models\ExamSheets::where('session_id', 1)
                                    ->where('class_id', $data['class_id'])
                                    ->where('term_id', 5)
                                    ->where('user_id', $data['id'])
                                    ->first();

                                     $examSheet_second = App\Models\ExamSheets::where('session_id', 1)
                                    ->where('class_id', $data['class_id'])
                                    ->where('term_id', 4)
                                    ->where('user_id', $data['id'])
                                    ->first();


                                $examSheet_first = App\Models\ExamSheets::where('session_id', 1)
                                    ->where('class_id', $data['class_id'])
                                    ->where('term_id', 2)
                                    ->where('user_id', $data['id'])
                                    ->first();

                                $caScore = 0;
                                $examScore = 0;
                                $caScore_first = 0;
                                $examScore_first = 0;

                                 $caScore_second = 0;
                                $examScore_second = 0;

                                // Check if exam sheet exists before trying to get performance
                                if ($examSheet) {
                                    $examSheetPerformance = App\Models\ExamSheetPerformances::where('exam_sheet_id', $examSheet->id)
                                        ->where('subject_id', $subject->id)
                                        ->first();

                                    // Check if performance exists before accessing properties
                                    if ($examSheetPerformance) {
                                        $caScore = $examSheetPerformance->ca_score;
                                        $examScore = $examSheetPerformance->exam_score;
                                    }
                                }

                                // Check if first term exam sheet exists
                                if ($examSheet_first) {
                                    $examSheetPerformance_first = App\Models\ExamSheetPerformances::where('exam_sheet_id', $examSheet_first->id)
                                        ->where('subject_id', $subject->id)
                                        ->first();

                                    // Check if first term performance exists before accessing properties
                                    if (isset($examSheetPerformance_first) && $examSheetPerformance_first) {
                                        $caScore_first = $examSheetPerformance_first->ca_score;
                                        $examScore_first = $examSheetPerformance_first->exam_score;
                                    }
                                }

                                // Check if second term exam sheet exists
                                if ($examSheet_second) {
                                    $examSheetPerformance_second = App\Models\ExamSheetPerformances::where('exam_sheet_id', $examSheet_second->id)
                                        ->where('subject_id', $subject->id)
                                        ->first();

                                    // Check if second term performance exists before accessing properties
                                    if (isset($examSheetPerformance_second) && $examSheetPerformance_second) {
                                        $caScore_second = $examSheetPerformance_second->ca_score;
                                        $examScore_second = $examSheetPerformance_second->exam_score;
                                    }
                                }

                                $total_score = $caScore + $examScore;
                                $firstTermTotal = $caScore_first + $examScore_first;
                                  $secondTermTotal = $caScore_second + $examScore_second;

                                // Only show the row if either term has scores
                                $hasScores = ($caScore > 0 || $examScore > 0 || $caScore_first > 0 || $examScore_first > 0 || $caScore_second > 0 || $examScore_second > 0);
                                @endphp

                                @if($hasScores)
                                <tr>
                                    <td>{{ ++$sn }}. {{ $subject->name }}</td>
                                    <td>{{ $caScore }}</td>
                                    <td>{{ $examScore }}</td>
                                      <td>{{ $total_score }}</td>
                                    <td>{{ $firstTermTotal }}</td>
                                    <td>{{ $secondTermTotal }}</td>
                                    <td>
                                        @php
                                        // Initialize grade and remark variables
                                        $grade = '';
                                        $remark = '';

                                        // Determine grade and remark based on the total score
                                        if ($total_score >= 90 && $total_score <= 100) {
                                            $grade = 'AA';
                                            $remark = 'DISTINCTION';
                                        } elseif ($total_score >= 75 && $total_score <= 89) {
                                            $grade = 'A';
                                            $remark = 'Excellent';
                                        } elseif ($total_score >= 65 && $total_score <= 74) {
                                            $grade = 'B1';
                                            $remark = 'Very Good';
                                        } elseif ($total_score >= 60 && $total_score <= 64) {
                                            $grade = 'B2';
                                            $remark = 'Good';
                                        } elseif ($total_score >= 50 && $total_score <= 59) {
                                            $grade = 'C';
                                            $remark = 'Credit';
                                        } elseif ($total_score >= 40 && $total_score <= 49) {
                                            $grade = 'P';
                                            $remark = 'Pass';
                                        } elseif ($total_score >= 0 && $total_score <= 39) {
                                            $grade = 'F';
                                            $remark = 'Fail';
                                        }
                                        @endphp
                                        {{ $total_score }}
                                    </td>
                                    <td>{{ $grade }}</td>
                                    <td>{{ $remark }}</td>
                                </tr>
                                @php
                                // Only add to totals if the row is displayed
                                $totalCA += $caScore;
                                $totalEX += $examScore;
                                 $totalCur+= $total_score;
                                  $total1Ex += $firstTermTotal;
                              $total2Ex += $secondTermTotal;
                                @endphp
                                @else
                                @php
                                // Don't increment sn if row is not displayed
                                $sn = $sn;
                                @endphp
                                @endif
                                @endforeach
                                <tr>
                                    <td>TOTAL</td>
                                    <td>{{ $totalCA }}</td>
                                    <td>{{ $totalEX }}</td>
                                    <td> {{ $totalCur }}</td>
                                     <td> {{ $total1Ex }}</td>
                                    <td>{{ $total2Ex }}</td>
                                    <td>--</td>

                                     <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>GRAND TOTAL: {{ $total1Ex+$total2Ex+$totalCur }}</td>
                                    <td colspan="2">WEIGHTED AVG:
                                        @php
                                            if ($sn > 0) {
                                                echo number_format((($total1Ex+$total2Ex+$totalCur )/($sn*100))*100, 2);
                                            } else {
                                                echo "0.00";
                                            }
                                        @endphp%
                                    </td>
                                    <td colspan="2">TERM POSITION: -- </td>
                                    <td colspan="2">OVERALL POSITION: --</td>
                                    <td>NUMBER IN CLASS: --</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table>
                            <tr>
                                <th colspan="2">GRADING SCALE</th>
                            </tr>
                            <tr>
                                <td>DISTINCTION - 100-90 =AA</td>
                                <td>EXCELLENT - 89-75 =A</td>
                            </tr>
                            <tr>
                                <td>V.GOOD - 74-65 =B1</td>
                                <td>GOOD - 64-60 =B2</td>
                            </tr>
                            <tr>
                                <td>CREDIT - 59-50 =C</td>
                                <td>PASS -49-40 =P</td>
                            </tr>
                            <tr>
                                <td>FAIL- 39-0 =F</td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="4">
                        <table>
                            <tr>
                                <th colspan="2">CLASS TEACHER'S REMARK </th>
                            </tr>
                            <tr>
                                <td>(i ) average performance
                                </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td>( ii) Very good results, keep it up</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td>(iii ) Bellow average performance, improve on your studies next term
                                <td> </td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <!-- <tr>
                    <td>CLASS TEACHER'S REMARK:</td>
                    <td colspan="4"></td>
                </tr> -->
                <tr>
                    <td>PRINCIPAL'S COMMENT</td>
                    <td colspan="2"><input type="checkbox"> Satisfactory   <input type="checkbox"> Not Satisfactory</td>
                    <td>SIGNATURE:</td>
                    <td>@if($data['classes_type'] == 'Secondary')
                        <img src="{{asset('images/sec_sign.jpg')}}" width="100px" height="50px" />
                        @else
                        <img src="{{asset('images/pry_sign.jpg')}}" width="100px" height="50px" />
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- end of report card -->

</body>

</html>
