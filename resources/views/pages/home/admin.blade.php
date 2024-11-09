<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "Admin"; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class="">
                        <div class="h5 font-weight-bold">Admin Dashboard</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-3 comp-grid " >
                    <?php $rec_count = $comp_model->getcount_students();  ?>
                    <a class="animated zoomIn record-count alert alert-secondary"  href='<?php print_link("users") ?>' >
                    <div class="row gutter-sm align-items-center">
                        <div class="col-auto" style="opacity: 1;">
                            <i class="material-icons ">people</i>
                        </div>
                        <div class="col">
                            <div class="flex-column justify-content align-center">
                                <div class="title">Students</div>
                                <small class="">Total Students</small>
                            </div>
                            <h2 class="value"><?php echo $rec_count; ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 comp-grid " >
                <?php $rec_count = $comp_model->getcount_teachers();  ?>
                <a class="animated zoomIn record-count alert alert-info"  href='<?php print_link("users") ?>' >
                <div class="row gutter-sm align-items-center">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons ">people_outline</i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">Teachers</div>
                            <small class="">Total Teachers</small>
                        </div>
                        <h2 class="value"><?php echo $rec_count; ?></h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 comp-grid " >
            <?php $rec_count = $comp_model->getcount_admin();  ?>
            <a class="animated zoomIn record-count alert alert-warning"  href='<?php print_link("users") ?>' >
            <div class="row gutter-sm align-items-center">
                <div class="col-auto" style="opacity: 1;">
                    <i class="material-icons ">person_add</i>
                </div>
                <div class="col">
                    <div class="flex-column justify-content align-center">
                        <div class="title">Admin</div>
                        <small class="">Total Admin</small>
                    </div>
                    <h2 class="value"><?php echo $rec_count; ?></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 comp-grid " >
        <?php $rec_count = $comp_model->getcount_director();  ?>
        <a class="animated zoomIn record-count alert alert-dark"  href='<?php print_link("users") ?>' >
        <div class="row gutter-sm align-items-center">
            <div class="col-auto" style="opacity: 1;">
                <i class="material-icons ">nature_people</i>
            </div>
            <div class="col">
                <div class="flex-column justify-content align-center">
                    <div class="title">Director</div>
                    <small class="">Total Users</small>
                </div>
                <h2 class="value"><?php echo $rec_count; ?></h2>
            </div>
        </div>
    </a>
</div>
</div>
</div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-3 comp-grid " >
                <?php $rec_count = $comp_model->getcount_subjects();  ?>
                <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("subjects") ?>' >
                <div class="row gutter-sm align-items-center">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons ">subject</i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">Subjects</div>
                            <small class="">Total Subjects</small>
                        </div>
                        <h2 class="value"><?php echo $rec_count; ?></h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 comp-grid " >
            <?php $rec_count = $comp_model->getcount_classes();  ?>
            <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("classes") ?>' >
            <div class="row gutter-sm align-items-center">
                <div class="col-auto" style="opacity: 1;">
                    <i class="material-icons ">class</i>
                </div>
                <div class="col">
                    <div class="flex-column justify-content align-center">
                        <div class="title">Classes</div>
                        <small class="">Total Classes</small>
                    </div>
                    <h2 class="value"><?php echo $rec_count; ?></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 comp-grid " >
        <?php $rec_count = $comp_model->getcount_classsubjects();  ?>
        <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("classsubjects") ?>' >
        <div class="row gutter-sm align-items-center">
            <div class="col-auto" style="opacity: 1;">
                <i class="material-icons ">add_to_photos</i>
            </div>
            <div class="col">
                <div class="flex-column justify-content align-center">
                    <div class="title">Class Subjects</div>
                    <small class="">Total Class Subjects</small>
                </div>
                <h2 class="value"><?php echo $rec_count; ?></h2>
            </div>
        </div>
    </a>
</div>
<div class="col-md-3 comp-grid " >
    <?php $rec_count = $comp_model->getcount_staffclasses();  ?>
    <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("staffclasses") ?>' >
    <div class="row gutter-sm align-items-center">
        <div class="col-auto" style="opacity: 1;">
            <i class="material-icons ">local_library</i>
        </div>
        <div class="col">
            <div class="flex-column justify-content align-center">
                <div class="title">Staff Classes</div>
                <small class="">Total Staff Classes</small>
            </div>
            <h2 class="value"><?php echo $rec_count; ?></h2>
        </div>
    </div>
</a>
</div>
</div>
</div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-6 comp-grid " >
                <!--Include chart component-->
                @include("pages.admin-student-gender-chart")
            </div>
            <div class="col-md-6 comp-grid " >
                <div class=" ">
                    <?php
                        $params = ['show_header' => false, 'show_footer' => false, 'show_pagination' => false, 'limit' => 10]; //new query param
                        $query = array_merge(request()->query(), $params);
                        $queryParams = http_build_query($query);
                        $url = url("studentdetails/home_list?$queryParams");
                    ?>
                    <div class="ajax-inline-page" data-url="{{ $url }}" >
                        <div class="ajax-page-load-indicator">
                            <div class="text-center d-flex justify-content-center load-indicator">
                                <span class="loader mr-3"></span>
                                <span class="fw-bold">Loading...</span>
                            </div>
                        </div>
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
    $(document).ready(function(){
    // custom javascript | jquery codes
    });
</script>
@endsection
