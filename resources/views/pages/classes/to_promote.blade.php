@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("classes/add");
    $can_edit = $user->canAccess("classes/edit");
    $can_view = $user->canAccess("classes/view");
    $can_delete = $user->canAccess("classes/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Promote Students - Select Classes"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Promote Students - Select Classes</div>
                        <small class="text-muted">Select classes to promote students to the next level</small>
                    </div>
                </div>
                <div class="col-auto  " >


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
                    <div id="classes-list-records">
                        <div class="row gutter-lg ">
                            <div class="col">
                                <div id="page-main-content" class="table-responsive">

                                    <?php Html::display_page_errors($errors); ?>
                                    <div class="filter-tags mb-2">
                                        <?php Html::filter_tag('search', __('Search')); ?>
                                    </div>
                                    <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header ">
                                            <tr>


                                                <th class="td-" > </th><th class="td-id" > Id</th>
                                                <th class="td-name" > Name</th>
                                                <th class="td-is_active" > Is Active</th>
                                                <th class="td-students_count" > Total Students</th>

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

<td></td>
                                            <td class="td-id">
                                                <a href="<?php print_link("/classes/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                            </td>
                                            <td class="td-name">
                                                <?php echo  $data['name'] ; ?>
                                            </td>
                                            <td class="td-is_active">
                                                <?php echo  $data['is_active'] ; ?>
                                            </td>
                                            <td class="td-students_count text-center">
                                                <span class="badge bg-info text-dark">
                                                    <i class="material-icons" style="font-size: 14px; vertical-align: middle;">people</i>
                                                    <?php echo $data['students_count'] ?? 0; ?>
                                                </span>
                                            </td>


                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                         <a href="{{ url("/studentinclass?id=$data[id]") }}">View</a>
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
                        <button type="button" class="btn btn-sm btn-success btn-promote-to-class d-none" data-bs-toggle="modal" data-bs-target="#promoteToClassModal">
                            <i class="material-icons">arrow_upward</i> Promote to Selected Class
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
        <!-- Detail Page Column -->
        <?php if(!request()->has('subpage')){ ?>
        <div class="col-12">
            <div class=" ">
                <div id="classes-detail-page" class="master-detail-page"></div>
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

<!-- Promote to Class Modal -->
<div class="modal fade" id="promoteToClassModal" tabindex="-1" aria-labelledby="promoteToClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="promoteToClassModalLabel">Promote Students</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="promoteToClassForm" method="POST" action="<?php print_link('classes/promote_students'); ?>">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="class_ids" id="class_ids" value="">

                    <div class="alert alert-info">
                        <i class="material-icons">info</i>
                        You have selected <strong><span id="selected_class_count">0</span> class(es)</strong>.
                        All students in the selected class(es) will be promoted.
                    </div>

                    <div class="form-group mb-3">
                        <label for="promote_to_class_id" class="form-label">Promote To Class <span class="text-danger">*</span></label>
                        <select name="promote_to_class_id" id="promote_to_class_id" class="form-select" required>
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
</style>
@endsection

@section('pagejs')
<script>
$(document).ready(function(){
    // Show/hide promote button based on selection
    $('.optioncheck').on('change', function(){
        var checkedCount = $('.optioncheck:checked').length;
        if(checkedCount > 0){
            $('.btn-promote-to-class').removeClass('d-none');
        } else {
            $('.btn-promote-to-class').addClass('d-none');
        }
    });

    // Toggle all checkboxes
    $('.toggle-check-all').on('change', function(){
        var checkedCount = $('.optioncheck:checked').length;
        if(checkedCount > 0){
            $('.btn-promote-to-class').removeClass('d-none');
        } else {
            $('.btn-promote-to-class').addClass('d-none');
        }
    });

    // When promote modal is opened, collect selected class IDs
    $('#promoteToClassModal').on('show.bs.modal', function(){
        var selectedIds = [];
        $('.optioncheck:checked').each(function(){
            selectedIds.push($(this).val());
        });
        $('#class_ids').val(selectedIds.join(','));
        $('#selected_class_count').text(selectedIds.length);
    });

    // Handle form submission
    $('#promoteToClassForm').on('submit', function(e){
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
                $('#promoteToClassForm button[type="submit"]').prop('disabled', true)
                    .html('<span class="spinner-border spinner-border-sm"></span> Processing...');
            },
            success: function(response){
                $('#promoteToClassModal').modal('hide');
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
                $('#promoteToClassForm button[type="submit"]').prop('disabled', false)
                    .html('<i class="material-icons">arrow_upward</i> Promote Students');
            }
        });
    });
});
</script>
@endsection
