<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("examsheets/add");
    $can_edit = $user->canAccess("examsheets/edit");
    $can_view = $user->canAccess("examsheets/view");
    $can_delete = $user->canAccess("examsheets/delete");
    $pageTitle = "Exam Sheet Details"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Exam Sheet Details</div>
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
                            <div class="row gutter-lg ">
                                <div class="col">
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
                                                            <small class="text-muted">Session Id</small>
                                                            <div class="fw-bold">
                                                                <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("sessions/view/$data[session_id]?subpage=1") ?>">
                                                                <?php echo $data['sessions_name'] ?>
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
                                                        <small class="text-muted">Term Id</small>
                                                        <div class="fw-bold">
                                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("terms/view/$data[term_id]?subpage=1") ?>">
                                                            <i class="material-icons">visibility</i> <?php echo "Terms Detail" ?>
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
                                                    <small class="text-muted">Student</small>
                                                    <div class="fw-bold">
                                                        <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("users/view/$data[user_id]?subpage=1") ?>">
                                                        <?php echo "Users Detail" ?>
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
                                                <small class="text-muted">Present Count</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['present_count'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light mb-1 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">Open Count</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['open_count'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light mb-1 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">Resume On</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['resume_on'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light mb-1 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">Teacher Remark</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['teacher_remark'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light mb-1 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">Director Comment</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['director_comment'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light mb-1 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">Total Score</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['total_score'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light mb-1 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">Director Approval</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['director_approval'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light mb-1 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">Updated By</small>
                                                <div class="fw-bold">
                                                    <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("users/view/$data[updated_by]?subpage=1") ?>">
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
                    </div>
                    <!--PageComponentEnd-->
                    <div class="d-flex align-items-center gap-2">
                        <div class="dropup export-btn-holder">
                            <button  class="btn  btn-sm btn-outline-primary dropdown-toggle" title="Export" type="button" data-bs-toggle="dropdown">
                            <i class="material-icons">save</i> 
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php Html :: export_menus(['pdf', 'print']); ?>
                            </div>
                        </div>
                        <?php if($can_edit){ ?>
                        <a class="btn btn-sm btn-success has-tooltip "   title="Edit" href="<?php print_link("examsheets/edit/$rec_id"); ?>" >
                        <i class="material-icons">edit</i> Edit
                    </a>
                    <?php } ?>
                    <?php if($can_delete){ ?>
                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" title="Delete" href="<?php print_link("examsheets/delete/$rec_id?redirect=examsheets"); ?>" >
                    <i class="material-icons">delete_sweep</i> Delete
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Detail Page Column -->
    <?php if(!request()->has('subpage')){ ?>
    <div class="col-12">
        <div class="my-3 p-1 ">
            @include("pages.examsheets.detail-pages", ["masterRecordId" => $rec_id])
        </div>
    </div>
    <?php } ?>
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
