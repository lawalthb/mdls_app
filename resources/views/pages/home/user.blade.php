<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
$pageTitle = "User"; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')

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
<div>
    <div class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid ">
                    <div class="">
                        <div class="h5 font-weight-bold">Student</div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<div>
    <div class="bg-white p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid ">
                    <div class="">
                        <div class="mb-3" id="student-report-card">


                            <table>
                                <tr>
                                    <th>
                                        <image src="{{asset('images/logo.png')}}" width="150px" height="200px" />
                                    </th>
                                    <th colspan="3">
                                        <h2>MERIT DATALIGHT COLLEGE</h2>
                                        <h5>Motto: Creating and evious legacy <br />
                                            Address: Cadid Estate Phase II Opposite Origan 2nd Bus Stop Badagry Exp-way, Lagos<br />
                                            Email: datalight444@gmail.com<br />
                                            Tel: 07041112438, 07033056074, 08179531056
                                        </h5>
                                    </th>
                                    <th> &nbsp;</th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td colspan="5"><b>TERMINAL SHEET</b></td>
                                    </tr>
                                    <tr>
                                        <td>END OF: FIRST TERM</td>
                                        <td>REPORT FOR: 2023/2024</td>
                                        <td colspan="3"></td>
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
                                            <th colspan="2">RATING SCALE </th>
                                        </tr>
                                        <tr>
                                            <td>i. Hand Writting</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>i. Hand Writting</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>i. Hand Writting</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>i. Hand Writting</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>CLASS TEACHER'S REMARK:</td>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td>PRINCIPAL'S COMMENT</td>
                                <td colspan="2"></td>
                                <td>SIGNATURE:</td>
                                <td>________________</td>
                            </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
<!-- Page custom css -->
@section('pagecss')
<style>
</style>
@endsection
<!-- Page custom js -->
@section('pagejs')
<script>
    $(document).ready(function() {
        // custom javascript | jquery codes
    });
</script>
@endsection