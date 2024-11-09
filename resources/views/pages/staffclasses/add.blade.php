<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Staff Class"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Staff Class</div>
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
                        <form id="staffclasses-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('staffclasses.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="user_id">Teacher <span class="text-danger">*</span></label>
                                    <div id="ctrl-user_id-holder" class=" "> 
                                        <select required=""  id="ctrl-user_id" data-field="user_id" name="user_id"  placeholder="Select a value ..."    class="form-select" >
                                        <option value="">Select a value ...</option>
                                        <?php 
                                            $options = $comp_model->staffclasses_user_id_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = Html::get_field_selected('user_id', $value, "");
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                        <?php echo $label; ?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="class_id">Class <span class="text-danger">*</span></label>
                                    <div id="ctrl-class_id-holder" class=" "> 
                                        <select required=""  id="ctrl-class_id" data-field="class_id" name="class_id"  placeholder="Select a value ..."    class="form-select" >
                                        <option value="">Select a value ...</option>
                                        <?php 
                                            $options = $comp_model->class_id_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = Html::get_field_selected('class_id', $value, "");
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                        <?php echo $label; ?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="is_active">Is Active <span class="text-danger">*</span></label>
                                    <div id="ctrl-is_active-holder" class=" "> 
                                        <select required=""  id="ctrl-is_active" data-field="is_active" name="is_active"  placeholder="Select a value ..."    class="form-select" >
                                        <option value="">Select a value ...</option>
                                        <?php
                                            $options = Menu::isActive();
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = Html::get_field_selected('is_active', $value, "Yes");
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
                                </div>
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
