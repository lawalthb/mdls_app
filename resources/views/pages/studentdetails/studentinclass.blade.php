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
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Students in Class"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Promoting Students in Class: {{ $records->first()->classes_name ?? 'N/A' }}</div>
                        <div class="mt-2">
                            <small>
                                <span class="badge bg-warning text-dark me-2"><i class="material-icons" style="font-size: 12px; vertical-align: middle;">school</i> Old</span> = Students who need promotion to next level
                                <span class="ms-2"></span>
                                <span class="badge bg-success"><i class="material-icons" style="font-size: 12px; vertical-align: middle;">fiber_new</i> New</span> = Recently promoted students
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-auto  " >

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
                    <div id="studentdetails-studentinclass-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/studentinclass", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <table class="table table-hover table-striped table-sm text-left">
                                <thead class="table-header ">
                                    <tr>
                                        <th class="td-checkbox">
                                            <label class="form-check-label">
                                                <input class="toggle-check-all form-check-input" type="checkbox" />
                                            </label>
                                        </th>
                                        <th class="td-user_id" > Adm No</th>
                                        <th class="td-firstname" > Firstname</th>
                                        <th class="td-middlemane" > Middlename</th>
                                        <th class="td-lastname" > Lastname</th>
                                        <th class="td-class_id" > Class</th>
                                        <th class="td-gender" > Gender</th>
                                        <th class="td-status" > Status</th>
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
                                    <tr data-promotion-flag="<?php echo $data['promotion_flag'] ?? 'old'; ?>">
                                        <!--PageComponentStart-->
                                        <td class="td-checkbox">
                                            <label class="form-check-label">
                                                <input class="optioncheck form-check-input" type="checkbox" value="<?php echo $data['id'] ?>" data-promotion-flag="<?php echo $data['promotion_flag'] ?? 'old'; ?>" />
                                            </label>
                                        </td>
                                        <td class="td-user_id">
                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("users/view/$data[user_id]?subpage=1") ?>">
                                            <?php echo $data['users_id'] ?>
                                        </a>
                                    </td>
                                    <td class="td-firstname">
                                        <?php echo  $data['firstname'] ; ?>
                                    </td>
                                    <td class="td-middlemane">
                                        <?php echo  $data['middlemane'] ; ?>
                                    </td>
                                    <td class="td-lastname">
                                        <?php echo  $data['lastname'] ; ?>
                                    </td>
                                    <td class="td-class_id">
                                        <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("classes/view/$data[class_id]?subpage=1") ?>">
                                        <?php echo $data['classes_name'] ?>
                                    </a>
                                </td>
                                <td class="td-gender">
                                    <?php echo  $data['gender'] ; ?>
                                </td>
                                <td class="td-status">
                                    <?php
                                        $promotion_flag = $data['promotion_flag'] ?? 'old';
                                        if($promotion_flag == 'new') {
                                            echo '<span class="badge bg-success" title="Recently promoted"><i class="material-icons" style="font-size: 14px; vertical-align: middle;">fiber_new</i> New</span>';
                                        } else {
                                            echo '<span class="badge bg-warning text-dark" title="Needs promotion to next level"><i class="material-icons" style="font-size: 14px; vertical-align: middle;">school</i> Old</span>';
                                        }
                                    ?>
                                </td>
                                <!--PageComponentEnd-->
                                <td class="td-btn">


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
                        <div class="col-md-auto d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-secondary btn-select-old-students" title="Select all old students">
                                <i class="material-icons">checklist</i> Select Old Students
                            </button>
                            <button type="button" class="btn btn-sm btn-success btn-promote-students d-none" data-bs-toggle="modal" data-bs-target="#promoteStudentsModal">
                                <i class="material-icons">arrow_upward</i> Promote Selected Students
                            </button>
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
        </div>
    </div>
</div>
    </div>
</div>
</section>

<!-- Promote Students Modal -->
<div class="modal fade" id="promoteStudentsModal" tabindex="-1" aria-labelledby="promoteStudentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="promoteStudentsModalLabel">Promote Students</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="promoteStudentsForm" method="POST" action="<?php print_link('studentdetails/promote'); ?>">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="student_ids" id="student_ids" value="">

                    <div class="alert alert-info">
                        <i class="material-icons">info</i>
                        You have selected <strong><span id="selected_student_count">0</span> student(s)</strong> for promotion.
                    </div>

                    <div class="form-group mb-3">
                        <label for="new_class_id" class="form-label">Promote To Class <span class="text-danger">*</span></label>
                        <select name="new_class_id" id="new_class_id" class="form-select" required>
                            <option value="">-- Select Destination Class --</option>
                            <?php
                                $class_options = $comp_model->class_id_option_list();
                                if(!empty($class_options)){
                                    foreach($class_options as $option){
                                        $value = $option->value;
                                        $label = $option->label;
                                        echo "<option value='$value'>$label</option>";
                                    }
                                }
                            ?>
                        </select>
                        <small class="form-text text-muted">Select the class to promote students to</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="material-icons">arrow_upward</i> Promote Students
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('pagecss')
<style>
    .gap-2 {
        gap: 0.5rem;
    }
    tr[data-promotion-flag="old"] {
        background-color: #fff3cd !important;
    }
    tr[data-promotion-flag="new"] {
        background-color: #d1e7dd !important;
    }
</style>
@endsection

@section('pagejs')
<script>
$(document).ready(function(){
    // Show/hide promote button based on selection
    $('.optioncheck').on('change', function(){
        var checkedCount = $('.optioncheck:checked').length;
        if(checkedCount > 0){
            $('.btn-promote-students').removeClass('d-none');
        } else {
            $('.btn-promote-students').addClass('d-none');
        }
    });

    // Select all old students button
    $('.btn-select-old-students').on('click', function(){
        // Uncheck all first
        $('.optioncheck').prop('checked', false);
        // Check only old students
        $('.optioncheck[data-promotion-flag="old"]').prop('checked', true);
        // Update button visibility
        var checkedCount = $('.optioncheck:checked').length;
        if(checkedCount > 0){
            $('.btn-promote-students').removeClass('d-none');
        } else {
            $('.btn-promote-students').addClass('d-none');
        }
    });

    // Toggle all checkboxes
    $('.toggle-check-all').on('change', function(){
        var isChecked = $(this).is(':checked');
        $('.optioncheck').prop('checked', isChecked);

        var checkedCount = $('.optioncheck:checked').length;
        if(checkedCount > 0){
            $('.btn-promote-students').removeClass('d-none');
        } else {
            $('.btn-promote-students').addClass('d-none');
        }
    });

    // When promote modal is opened, collect selected student IDs
    $('#promoteStudentsModal').on('show.bs.modal', function(){
        var selectedIds = [];
        $('.optioncheck:checked').each(function(){
            selectedIds.push($(this).val());
        });
        $('#student_ids').val(selectedIds.join(','));
        $('#selected_student_count').text(selectedIds.length);
    });

    // Handle form submission
    $('#promoteStudentsForm').on('submit', function(e){
        e.preventDefault();

        var formData = $(this).serialize();
        var url = $(this).attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            beforeSend: function(){
                $('#promoteStudentsForm button[type="submit"]').prop('disabled', true)
                    .html('<span class="spinner-border spinner-border-sm"></span> Processing...');
            },
            success: function(response){
                $('#promoteStudentsModal').modal('hide');
                // Show success message
                var message = response.message || 'Students promoted successfully!';
                $('body').append('<div class="alert alert-success alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
                // Reload page after 1.5 seconds
                setTimeout(function(){
                    location.reload();
                }, 1500);
            },
            error: function(xhr){
                var errorMsg = 'An error occurred while promoting students.';
                if(xhr.responseJSON && xhr.responseJSON.message){
                    errorMsg = xhr.responseJSON.message;
                }
                $('body').append('<div class="alert alert-danger alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">' + errorMsg + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
                $('#promoteStudentsForm button[type="submit"]').prop('disabled', false)
                    .html('<i class="material-icons">arrow_upward</i> Promote Students');
            }
        });
    });
});
</script>
@endsection
