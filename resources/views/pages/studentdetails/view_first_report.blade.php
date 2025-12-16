<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')


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
                    @else
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
                    <td>END OF: FIRST TERM</td>
                    <td>REPORT FOR: 2025/2026</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>NAME OF STUDENT:</td>
                    <td colspan="3"> <?php echo  $data['firstname']; ?>
                        <?php echo  $data['middlemane']; ?>
                        <?php $data['lastname']; ?>
                    </td>
                    <td> &nbsp;</td>
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

                    <td>CLASS: <?php echo $data['classes_name'] ?></td>
                </tr>
                <tr>
                    <td>NO. OF TIMES SCHOOL OPENED: Nill</td>
                    <td colspan="2">NO. OF TIMES PRESENT: Nill</td>
                    <td colspan="2">SCHOOL RE-OPEN ON: 12th January, 2026: </td>


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
                                <th>1ST TERM <BR /> 100%</th>
                                <th>2ND TERM <BR /> 100% </th>
                                <th>3RD TERM <BR /> 100% </th>
                                <th>WEIGHT <BR />AVERAGE</th>
                                <th>GRADE</th>
                                <th>REMARKS</th>
                            </tr>
                            <tbody>
                                @php
                                $totalCA =0;
                                $totalEX = 0;
                                $total1st =0;
                                $classSubjects = App\Models\ClassSubjects::where('class_id', $data['class_id'])
                                ->join('subjects', 'class_subjects.subject_id', '=', 'subjects.id')
                                ->select('subjects.name','subjects.id')
                                ->get();
                                $sn = 0;
                                 //dd( $classSubjects);
                                @endphp
                                @foreach ($classSubjects as $subject)
                                @php
                                    // Step 1: Get the exam sheet ID where session_id is 1, class_id is 16, and user_id is 170
                                    $examSheet = App\Models\ExamSheets::where('session_id', 2)
                                    ->where('class_id', $data['class_id'])
                                    ->where('term_id', 3)
                                    ->where('user_id', $data['id'])
                                    ->first();
                                   // dd($examSheet );
                                    $caScore = 0;
                                    $examScore = 0;
                                    // Step 2: Check if an exam sheet was found and then fetch ca_score and exam_score based on subject_id and exam_sheet_id
                                    if ($examSheet) {
                                     $examSheetPerformance = App\Models\ExamSheetPerformances::where('exam_sheet_id', $examSheet->id)
                                    ->where('subject_id', $subject->id)
                                    ->first();
                                    //dd($examSheetPerformance);
                                    if ($examSheetPerformance) {
                                    $caScore = $examSheetPerformance->ca_score;
                                    $examScore = $examSheetPerformance->exam_score;
                                    }
                                    }
                                    // Calculate total score early to check if we should display this row
                                    $total_score = $examScore + $caScore;
                                @endphp
                                @if($total_score > 0)
                                <tr>
                                    <td>{{ ++$sn }}. {{ $subject->name }}</td>
                                    <td>@php
                                        echo $caScore;
                                        @endphp</td>
                                    <td>{{ $examScore}}
                                    </td>
                                    <td>{{ $examScore + $caScore}}</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>
                                        @php
                                        // Display total score (already calculated earlier)
                                        echo $total_score;
                                        // Initialize grade and remark variables
                                        $grade = '';
                                        $remark = '';
                                        // Determine grade and remark based on the total score
                                        if ($total_score >= 90 && $total_score <= 100) {
                                            $grade='AA' ;
                                            $remark='DISTINCTION' ;
                                            } elseif ($total_score>= 75 && $total_score <= 89) {
                                                $grade='A' ;
                                                $remark='Excellent' ;
                                                } elseif ($total_score>= 65 && $total_score <= 74) {
                                                    $grade='B1' ;
                                                    $remark='Very Grade' ;
                                                    } elseif ($total_score>= 60 && $total_score <= 64) {
                                                        $grade='B2' ;
                                                        $remark='Good' ;
                                                        } elseif ($total_score>= 50 && $total_score <= 59) {
                                                            $grade='C' ;
                                                            $remark='Credit' ;
                                                            } elseif ($total_score>= 40 && $total_score <= 49) {
                                                                $grade='P' ;
                                                                $remark='Pass' ;
                                                                } elseif ($total_score>= 0 && $total_score <= 39) {
                                                                    $grade='F' ;
                                                                    $remark='Fail' ;
                                                                    }
                                                                    @endphp</td>
                                    <td>{{ $grade }}</td>
                                    <td>{{ $remark }}
                                    </td>
                                </tr>
                                @php
                                $totalCA += $caScore;
                                $totalEX += $examScore;
                                $total1st += $total_score;
                                @endphp
                                @endif
                                @endforeach
                                <tr>
                                    <td>TOTAL</td>
                                    <td>{{$totalCA }}</td>
                                    <td>{{$totalEX }}</td>
                                    <td>{{$total1st }}</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>{{$total1st }}</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>GRAND TOTAL: {{$total1st }}</td>
                                    <td colspan="2">WEIGHTED AVG: {{($total1st/($sn*100))*100}}%</td>
                                    <td colspan="2">TERM POSITION: -- </td>
                                    <td colspan="2">OVERALL POSITION: --</td>
                                    <td>NUMBR IN CLASS: --</td>
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
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>( ii) Very good results, keep it up</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>(iii ) Bellow average performance, improve on your studies next term
                                <td>&nbsp;</td>
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
                    <td colspan="2"><input type="checkbox"> Satisfactory&nbsp;&nbsp;&nbsp;<input type="checkbox"> Not Satisfactory</td>
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
