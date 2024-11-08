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
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Exam Sheets"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center gap-3">
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Exam Sheets</div>
                    </div>
                </div>
                <div class="col-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("examsheets/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    Add New Exam Sheet 
                </a>
                <?php } ?>
            </div>
            <div class="col-md-3  " >
                <!-- Page drop down search component -->
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Search" />
                        <button class="btn btn-primary"><i class="material-icons">search</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <div id="examsheets-list-records">
                        <div class="row gutter-lg ">
                            <div class="col">
                                <div id="page-main-content" class="table-responsive">
                                    <?php Html::page_bread_crumb("/examsheets/", $field_name, $field_value); ?>
                                    <?php Html::display_page_errors($errors); ?>
                                    <div class="filter-tags mb-2">
                                        <?php Html::filter_tag('search', __('Search')); ?>
                                    </div>
                                    <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header ">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                <label class="form-check-label">
                                                <input class="toggle-check-all form-check-input" type="checkbox" />
                                                </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-" > </th><th class="td-id" > Id</th>
                                                <th class="td-session_id" > Session</th>
                                                <th class="td-term_id" > Term</th>
                                                <th class="td-user_id" > Adm No.</th>
                                                <th class="td-class_id" > Class</th>
                                                <th class="td-total_score" > Total Score</th>
                                                <th class="td-director_approval" > Director Approval</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                            if($total_records){
                                        ?>
                                        <tbody class="page-data">
                                            <!--record-->
                                            <?php
                                                $counter = 0;
                                                foreach($records as $data){
                                                $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                                $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <td class=" td-checkbox">
                                                    <label class="form-check-label">
                                                    <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                    </label>
                                                </td>
                                                <?php } ?>
                                                <!--PageComponentStart-->
                                                <td class="td-masterdetailbtn">
                                                    <a data-page-id="examsheets-detail-page" class="btn btn-sm btn-secondary open-master-detail-page" href="<?php print_link("examsheets/masterdetail/$data[id]"); ?>">
                                                    <i class="material-icons">more_vert</i> view
                                                </a>
                                            </td>
                                            <td class="td-id"><strong><?php echo $data['id']; 
                                                // Calculate the sum of total for the current exam_sheet_id
                                                $exam_sheet_id = $rec_id;
                                                $total_sum = DB::table('exam_sheet_performances')
                                                ->where('exam_sheet_id', $exam_sheet_id)
                                                ->sum('total');
                                                // Update the exam_sheets table with the new total
                                                DB::table('exam_sheets')
                                                ->where('id', $exam_sheet_id)
                                                ->update(['total_score' => $total_sum]);
                                                // Fetch the updated exam sheet data
                                                $updated_exam_sheet = DB::table('exam_sheets')
                                                ->where('id', $exam_sheet_id)
                                                ->first();
                                            ?></strong></td>
                                            <td class="td-session_id">
                                                <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("sessions/view/$data[session_id]?subpage=1") ?>">
                                                <?php echo $data['sessions_name'] ?>
                                            </a>
                                        </td>
                                        <td class="td-term_id">
                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("terms/view/$data[term_id]?subpage=1") ?>">
                                            <?php echo $data['terms_name'] ?>
                                        </a>
                                    </td>
                                    <td class="td-user_id">
                                        <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("users/view/$data[user_id]?subpage=1") ?>">
                                        <?php echo $data['users_name'] ?>
                                    </a>
                                </td>
                                <td class="td-class_id">
                                    <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("classes/view/$data[class_id]?subpage=1") ?>">
                                    <?php echo $data['classes_name'] ?>
                                </a>
                            </td>
                            <td class="td-total_score">
                                <?php echo  $data['total_score'] ; ?>
                            </td>
                            <td class="td-director_approval">
                                <?php echo  $data['director_approval'] ; ?>
                            </td>
                            <!--PageComponentEnd-->
                            <td class="td-btn">
                                <?php if($can_view){ ?>
                                <a class="btn btn-sm btn-primary has-tooltip "    href="<?php print_link("examsheets/view/$rec_id"); ?>" >
                                <i class="material-icons">visibility</i> View
                            </a>
                            <?php } ?>
                            <?php if($can_edit){ ?>
                            <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("examsheets/edit/$rec_id"); ?>" >
                            <i class="material-icons">edit</i> Edit
                        </a>
                        <?php } ?>
                        <?php if($can_delete){ ?>
                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal"  href="<?php print_link("examsheets/delete/$rec_id"); ?>" >
                        <i class="material-icons">delete_sweep</i> Delete
                    </a>
                    <?php } ?>
                </td>
            </tr>
            <?php 
                }
            ?>
            <!--endrecord-->
        </tbody>
        <tbody class="search-data"></tbody>
        <?php
            }
            else{
        ?>
        <tbody class="page-data">
            <tr>
                <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                    <i class="material-icons">block</i> No record found
                </td>
            </tr>
        </tbody>
        <?php
            }
        ?>
    </table>
</div>
<?php
    if($show_footer){
?>
<div class=" mt-3">
    <div class="row align-items-center justify-content-between">    
        <div class="col-md-auto d-flex">    
            <?php if($can_delete){ ?>
            <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("examsheets/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
            <i class="material-icons">delete_sweep</i> Delete Selected
            </button>
            <?php } ?>
        </div>
        <div class="col">   
            <?php
                if($show_pagination == true){
                $pager = new Pagination($total_records, $record_count);
                $pager->show_page_count = false;
                $pager->show_record_count = true;
                $pager->show_page_limit =false;
                $pager->limit = $limit;
                $pager->show_page_number_list = true;
                $pager->pager_link_range=5;
                $pager->render();
                }
            ?>
        </div>
    </div>
</div>
<?php
    }
?>
</div>
<!-- Detail Page Column -->
<?php if(!request()->has('subpage')){ ?>
<div class="col-12">
    <div class=" ">
        <div id="examsheets-detail-page" class="master-detail-page"></div>
    </div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


@endsection
