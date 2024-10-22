<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Class Subject"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Class Subject</div>
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
                <div class="col-md-3 comp-grid " >
                    <?php $menu_id = "menu-" . random_str(); ?>
                    <div class="card mb-3 ">
                        <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="p-3">
                            <div class="fw-bold">Filter by Name</div>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $menu_id ?>" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        </nav>  
                        <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
                        <?php 
                            $arr_menu = [];
                            $menus = $comp_model->classesid_list(); // Get menu items from database
                            if(!empty($menus)){
                            //build menu items into arrays
                            foreach($menus as $menu){
                            $count = $menu->num ?? null;
                            $arr_menu[] = array(
                            "path"=>"classsubjects/add/id/{$menu->value}?label={$menu->label}&tag=Name", 
                            "label"=>$menu->label, 
                            "count"=>$count, 
                            "icon"=>''
                            );
                            }
                            //call menu render helper.
                            Html :: render_menu($arr_menu , "nav nav-tabs flex-column");
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 comp-grid " >
                <div  class="card card-1 border rounded page-content" >
                    <!--[form-start]-->
                    <form id="classsubjects-add-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="{{ route('classsubjects.store') }}" method="post" >
                        @csrf
                        <div>
                            <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                <thead>
                                    <tr>
                                        <th class="bg-light"><label for="subject_id">Subject</label></th>
                                        <th class="bg-light"><label for="is_active">Is Active</label></th>
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
                            <input id="ctrl-class_id-row<?php echo $row; ?>" data-field="class_id"  value="<?php echo get_value('class_id') ?>" type="hidden" placeholder="Enter Class" list="class_id_list"  required="" name="row[<?php echo $row ?>][class_id]"  class="form-control " />
                            <datalist id="class_id_list">
                            <?php 
                                $options = $comp_model->class_id_option_list() ?? [];
                                foreach($options as $option){
                                $value = $option->value;
                                $label = $option->label ?? $value;
                            ?>
                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                            <?php
                                }
                            ?>
                            </datalist>
                            <td>
                                <div id="ctrl-subject_id-row<?php echo $row; ?>-holder" class=" ">
                                <select required=""  id="ctrl-subject_id-row<?php echo $row; ?>" data-field="subject_id" name="row[<?php echo $row ?>][subject_id]"  placeholder="Select a subject ..."    class="form-select" >
                                <option value="">Select a subject ...</option>
                                <?php 
                                    $options = $comp_model->subject_id_option_list() ?? [];
                                    foreach($options as $option){
                                    $value = $option->value;
                                    $label = $option->label ?? $value;
                                    $selected = Html::get_field_selected('subject_id', $value, "");
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                <?php echo $label; ?>
                                </option>
                                <?php
                                    }
                                ?>
                                </select>
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
