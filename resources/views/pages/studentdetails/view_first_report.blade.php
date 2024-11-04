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
    $pageTitle = "Student Detail Details"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Student Detail Details</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class=" "><style>
                        table {
                        width: 100%;
                        height: 100%;
                        border-collapse: collapse;
                        }
                        th,
                        td {
                        border: 1px solid #000;
                        text-align: center;
                        padding: 10px;
                        }
                        </style>
                        <table>
                            <thead>
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
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5"><b>TERMINAL SHEET</b></td>
                                </tr>
                                <tr>
                                    <td>END OF: FIRST TERM</td>
                                    <td>REPORT FOR: 2023/2024</td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td>NAME OF STUDENT:</td>
                                    <td colspan="3"> <?php echo  $data['firstname'] ; ?> 
                                    <?php echo  $data['middlemane'] ; ?>
                                    <?php echo  $data['lastname'] ; ?>
                                </td>
                                <td> &nbsp;</td>
                            </tr>
                            <tr>
                                <td>Gender:   <?php echo  $data['gender'] ; ?></td>
                                <td>AGE: <?php
                                    $birth_date =$data['dob'];
                                    $current_date = date('Y-m-d');
                                    $birth_date_obj = new DateTime($birth_date);
                                    $current_date_obj = new DateTime($current_date);
                                    $diff = $current_date_obj->diff($birth_date_obj);
                                    $age_years = $diff->y;
                                    echo " $age_years years";
                                ?></td>
                                <td>ADMISSION NO: MSDL00<?php echo  $data['id'] ; ?></td>
                                <td>CLASS: $data[class_id]</td>
                                <td>HEIGHT:  <?php echo  $data['height'] ; ?> </td>
                            </tr>
                            <tr>
                                <td>NO. OF TIMES SCHOOL OPENED: 116</td>
                                <td>NO. OF TIMES PRESENT: 116</td>
                                <td>SCHOOL RE-OPEN ON: 16- Sep-2024: </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3"><B>PERFORMANCE IN SUBJECTS</B></td>
                                <td>Row 6 - Column 2</td>
                                <td>Row 6 - Column 3</td>
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
                                            <tr>
                                                <td>ENGLISH</td>
                                                <td>30</td>
                                                <td>70</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td>AA</td>
                                                <td>EXCELLENT</td>
                                            </tr>
                                            <tr>
                                                <td>ENGLISH</td>
                                                <td>30</td>
                                                <td>70</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td>AA</td>
                                                <td>EXCELLENT</td>
                                            </tr>
                                            <tr>
                                                <td>TOTAL</td>
                                                <td>30</td>
                                                <td>70</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td>--</td>
                                                <td>--</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>GRAND TOTAL: 24,000</td>
                                                <td colspan="2">WEIGHTEDAVG: 79.21%</td>
                                                <td colspan="2">TERM POSITION: 1ST </td>
                                                <td colspan="2">OVERALL POSITION: 2RD</td>
                                                <td>NUMBR IN CLASS</td>
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
                                <td>Row 9 - Column 1</td>
                                <td>Row 9 - Column 2</td>
                                <td>Row 9 - Column 3</td>
                                <td>Row 9 - Column 4</td>
                                <td>Row 9 - Column 5</td>
                            </tr>
                            <tr>
                                <td>Row 10 - Column 1</td>
                                <td>Row 10 - Column 2</td>
                                <td>Row 10 - Column 3</td>
                                <td>Row 10 - Column 4</td>
                                <td>Row 10 - Column 5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                                <small class="text-muted">Id</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['id'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light mb-1 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">User Id</small>
                                                <div class="fw-bold">
                                                    <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("users/view/$data[user_id]?subpage=1") ?>">
                                                    <i class="material-icons">visibility</i> <?php echo "Users Detail" ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Firstname</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['firstname'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Middlemane</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['middlemane'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Lastname</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['lastname'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Dob</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['dob'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-light mb-1 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Class Id</small>
                                            <div class="fw-bold">
                                                <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("classes/view/$data[class_id]?subpage=1") ?>">
                                                <i class="material-icons">visibility</i> <?php echo "Classes Detail" ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light mb-1 card-1 p-2 border rounded">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-muted">Religion</small>
                                        <div class="fw-bold">
                                            <?php echo  $data['religion'] ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light mb-1 card-1 p-2 border rounded">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-muted">Blood Group</small>
                                        <div class="fw-bold">
                                            <?php echo  $data['blood_group'] ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light mb-1 card-1 p-2 border rounded">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-muted">Height</small>
                                        <div class="fw-bold">
                                            <?php echo  $data['height'] ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light mb-1 card-1 p-2 border rounded">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-muted">Weight</small>
                                        <div class="fw-bold">
                                            <?php echo  $data['weight'] ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light mb-1 card-1 p-2 border rounded">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-muted">Measurement Date</small>
                                        <div class="fw-bold">
                                            <?php echo  $data['measurement_date'] ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light mb-1 card-1 p-2 border rounded">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-muted">Updated At</small>
                                        <div class="fw-bold">
                                            <?php echo  $data['updated_at'] ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light mb-1 card-1 p-2 border rounded">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-muted">Address</small>
                                        <div class="fw-bold">
                                            <?php echo  $data['address'] ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light mb-1 card-1 p-2 border rounded">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <small class="text-muted">Gender</small>
                                        <div class="fw-bold">
                                            <?php echo  $data['gender'] ; ?>
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
</div>
</div>
</div>
</section>


@endsection
