<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Student Detail"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
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
                        <div class="h5 font-weight-bold text-primary">Edit Student Detail</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("studentdetails/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="firstname">Firstname <span class="text-danger">*</span></label>
                                    <div id="ctrl-firstname-holder" class=" "> 
                                        <input id="ctrl-firstname" data-field="firstname"  value="<?php  echo $data['firstname']; ?>" type="text" placeholder="Enter Firstname"  required="" name="firstname"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="middlemane">Middlemane </label>
                                    <div id="ctrl-middlemane-holder" class=" "> 
                                        <input id="ctrl-middlemane" data-field="middlemane"  value="<?php  echo $data['middlemane']; ?>" type="text" placeholder="Enter Middlemane"  name="middlemane"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="lastname">Lastname <span class="text-danger">*</span></label>
                                    <div id="ctrl-lastname-holder" class=" "> 
                                        <input id="ctrl-lastname" data-field="lastname"  value="<?php  echo $data['lastname']; ?>" type="text" placeholder="Enter Lastname"  required="" name="lastname"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="dob">Date of Birth </label>
                                    <div id="ctrl-dob-holder" class="input-group "> 
                                        <input id="ctrl-dob" data-field="dob" class="form-control datepicker  datepicker"  value="<?php  echo $data['dob']; ?>" type="datetime" name="dob" placeholder="Enter Date of Birth" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="class_id">Class <span class="text-danger">*</span></label>
                                    <div id="ctrl-class_id-holder" class=" "> 
                                        <select required=""  id="ctrl-class_id" data-field="class_id" name="class_id"  placeholder="Select a value ..."    class="form-select" >
                                        <option value="">Select a value ...</option>
                                        <?php
                                            $options = $comp_model->class_id_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = ( $value == $data['class_id'] ? 'selected' : null );
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
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="religion">Religion </label>
                                    <div id="ctrl-religion-holder" class=" "> 
                                        <select  id="ctrl-religion" data-field="religion" name="religion"  placeholder="Select a value ..."    class="form-select" >
                                        <option value="">Select a value ...</option>
                                        <?php
                                            $options = Menu::religion();
                                            $field_value = $data['religion'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = Html::get_record_selected($field_value, $value);
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
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="blood_group">Blood Group </label>
                                    <div id="ctrl-blood_group-holder" class=" "> 
                                        <select  id="ctrl-blood_group" data-field="blood_group" name="blood_group"  placeholder="Select a value ..."    class="form-select" >
                                        <option value="">Select a value ...</option>
                                        <?php
                                            $options = Menu::bloodGroup();
                                            $field_value = $data['blood_group'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = Html::get_record_selected($field_value, $value);
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
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="height">Height </label>
                                    <div id="ctrl-height-holder" class=" "> 
                                        <input id="ctrl-height" data-field="height"  value="<?php  echo $data['height']; ?>" type="number" placeholder="Enter Height" step="any"  name="height"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="weight">Weight </label>
                                    <div id="ctrl-weight-holder" class=" "> 
                                        <input id="ctrl-weight" data-field="weight"  value="<?php  echo $data['weight']; ?>" type="number" placeholder="Enter Weight" step="any"  name="weight"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="measurement_date">Measurement Date </label>
                                    <div id="ctrl-measurement_date-holder" class="input-group "> 
                                        <input id="ctrl-measurement_date" data-field="measurement_date" class="form-control datepicker  datepicker"  value="<?php  echo $data['measurement_date']; ?>" type="datetime" name="measurement_date" placeholder="Enter Measurement Date" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="address">Address </label>
                                <div id="ctrl-address-holder" class=" "> 
                                    <input id="ctrl-address" data-field="address"  value="<?php  echo $data['address']; ?>" type="text" placeholder="Enter Address"  name="address"  class="form-control " />
                                </div>
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            Update
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
