<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Class"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
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
                        <div class="h5 font-weight-bold text-primary">Add New Class</div>
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
                <div class="col-md-9 comp-grid " >
                    <div  class="card card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form id="classes-add-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="{{ route('classes.store') }}" method="post" >
                            @csrf
                            <div>
                                <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                    <thead>
                                        <tr>
                                            <th class="bg-light"><label for="name">Name</label></th>
                                            <th class="bg-light"><label for="is_active">Is Active</label></th>
                                            <th class="bg-light"><label for="updated_by">Updated By</label></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="100" class="text-right">
                                        <?php $template_id = "table-row-" . random_str(); ?>
                                        <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-success btn-add-table-row"><i class="material-icons">add</i></button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!--[table row template]-->
                                <template id="<?php echo $template_id ?>">
                                <?php $row = "CURRENTROW"; // will be replaced with current row index. ?>
                                <tr data-row="<?php echo $row ?>" class="input-row">
                                <td>
                                    <div id="ctrl-name-row<?php echo $row; ?>-holder" class=" ">
                                    <input id="ctrl-name-row<?php echo $row; ?>" data-field="name"  value="<?php echo get_value('name') ?>" type="text" placeholder="Enter Name"  required="" name="row[<?php echo $row ?>][name]"  class="form-control " />
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-is_active-row<?php echo $row; ?>-holder" class=" ">
                                <select required=""  id="ctrl-is_active-row<?php echo $row; ?>" data-field="is_active" name="row[<?php echo $row ?>][is_active]"  placeholder="Select a value ..."    class="form-select" >
                                <option value="">Select a value ...</option>
                                <?php
                                    $options = Menu::isActive();
                                    if(!empty($options)){
                                    foreach($options as $option){
                                    $value = $option['value'];
                                    $label = $option['label'];
                                    $selected = Html::get_field_selected('is_active', $value, "");
                                ?>
                                <option <?php echo $selected ?> value="<?php echo $value ?>">
                                <?php echo $label ?>
                                </option>                                   
                                <?php
                                    }
                                    }
                                ?>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-updated_by-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-updated_by-row<?php echo $row; ?>" data-field="updated_by"  value="<?php echo get_value('updated_by') ?>" type="number" placeholder="Enter Updated By" step="any"  required="" name="row[<?php echo $row ?>][updated_by]"  class="form-control " />
                        </div>
                    </td>
                    <th class="text-center">
                    <button type="button" class="btn-close btn-remove-table-row"></button>
                    </th>
                </tr>
            </template>
            <!--[/table row template]-->
        </div>
        <div class="form-ajax-status"></div>
        <!--[form-button-start]-->
        <div class="form-group form-submit-btn-holder text-center mt-3">
            <button class="btn btn-primary" type="submit">
            Submit
            <i class="material-icons">send</i>
            </button>
        </div>
        <!--[form-button-end]-->
    </form>
    <!--[form-end]-->
</div>
</div>
</div>
</div>
</div>
</section>


@endsection
