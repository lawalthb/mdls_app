<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Student Detail"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Student Detail</div>
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
                        <form id="studentdetails-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('studentdetails.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id">Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id-holder" class=" ">
                                                <input id="ctrl-id" data-field="id"  value="<?php echo get_value('id') ?>" type="number" placeholder="Enter Id" step="any"  required="" name="id"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="user_id">User Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-user_id-holder" class=" ">
                                                <select required=""  id="ctrl-user_id" data-field="user_id" name="user_id"  placeholder="Select a value ..."    class="form-select" >
                                                <option value="">Select a value ...</option>
                                                <?php 
                                                    $options = $comp_model->updated_by_option_list() ?? [];
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
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="firstname">Firstname <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-firstname-holder" class=" ">
                                                <input id="ctrl-firstname" data-field="firstname"  value="<?php echo get_value('firstname') ?>" type="text" placeholder="Enter Firstname"  required="" name="firstname"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="middlemane">Middlemane </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-middlemane-holder" class=" ">
                                                <input id="ctrl-middlemane" data-field="middlemane"  value="<?php echo get_value('middlemane') ?>" type="text" placeholder="Enter Middlemane"  name="middlemane"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="lastname">Lastname <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-lastname-holder" class=" ">
                                                <input id="ctrl-lastname" data-field="lastname"  value="<?php echo get_value('lastname') ?>" type="text" placeholder="Enter Lastname"  required="" name="lastname"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="dob">Dob </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-dob-holder" class="input-group ">
                                                <input id="ctrl-dob" data-field="dob" class="form-control datepicker  datepicker"  value="<?php echo get_value('dob') ?>" type="datetime" name="dob" placeholder="Enter Dob" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="class_id">Class Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
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
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="religion">Religion </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-religion-holder" class=" ">
                                                <select  id="ctrl-religion" data-field="religion" name="religion"  placeholder="Select a value ..."    class="form-select" >
                                                <option value="">Select a value ...</option>
                                                <?php
                                                    $options = Menu::religion();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('religion', $value, "");
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
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="phone">Phone </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-phone-holder" class=" ">
                                                <input id="ctrl-phone" data-field="phone"  value="<?php echo get_value('phone') ?>" type="text" placeholder="Enter Phone"  name="phone"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="blood_group">Blood Group </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-blood_group-holder" class=" ">
                                                <select  id="ctrl-blood_group" data-field="blood_group" name="blood_group"  placeholder="Select a value ..."    class="form-select" >
                                                <option value="">Select a value ...</option>
                                                <?php
                                                    $options = Menu::bloodGroup();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = Html::get_field_selected('blood_group', $value, "");
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
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="height">Height </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-height-holder" class=" ">
                                                <input id="ctrl-height" data-field="height"  value="<?php echo get_value('height') ?>" type="number" placeholder="Enter Height" step="any"  name="height"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="weight">Weight </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-weight-holder" class=" ">
                                                <input id="ctrl-weight" data-field="weight"  value="<?php echo get_value('weight') ?>" type="number" placeholder="Enter Weight" step="any"  name="weight"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="measurement_date">Measurement Date </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-measurement_date-holder" class="input-group ">
                                                <input id="ctrl-measurement_date" data-field="measurement_date" class="form-control datepicker  datepicker"  value="<?php echo get_value('measurement_date') ?>" type="datetime" name="measurement_date" placeholder="Enter Measurement Date" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
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
