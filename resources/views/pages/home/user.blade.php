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


                            <a href="card/view_first_report" target="_blank">Click here to view first term report card</a>
                            <br />
                            <a href="card/view_second_report" target="_blank">Click here to view second term report card</a>
                            <br />
                            <a href="card/view_third_report" target="_blank">Click here to view third term report card</a>
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
