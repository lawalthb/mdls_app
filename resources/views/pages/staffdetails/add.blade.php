<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Staff Detail"; //set dynamic page title
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
                        <form id="staffdetails-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('staffdetails.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="gender">Gender <span class="text-danger">*</span></label>
                                        <div id="ctrl-gender-holder" class=" "> 
                                            <select required=""  id="ctrl-gender" data-field="gender" name="gender"  placeholder="Select a value ..."    class="form-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                                $options = Menu::gender();
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                $selected = Html::get_field_selected('gender', $value, "");
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
                                        <label class="control-label" for="class_id">Class </label>
                                        <div id="ctrl-class_id-holder" class=" "> 
                                            <select  id="ctrl-class_id" data-field="class_id" name="class_id"  placeholder="Select a value ..."    class="form-select" >
                                            <option value="">Select a value ...</option>
                                            <?php 
                                                $options = $comp_model->staffdetails_class_id_option_list() ?? [];
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
                                <div class="form-group ">
                                    <label class="control-label" for="address">Address </label>
                                    <div id="ctrl-address-holder" class=" "> 
                                        <input id="ctrl-address" data-field="address"  value="<?php echo get_value('address') ?>" type="text" placeholder="Enter Address"  name="address"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="guarantor_details">Guarantor Details </label>
                                    <div id="ctrl-guarantor_details-holder" class=" "> 
                                        <textarea placeholder="Enter Guarantor Details" id="ctrl-guarantor_details" data-field="guarantor_details"  rows="3" name="guarantor_details" class=" form-control"><?php echo get_value('guarantor_details') ?></textarea>
                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="files">CV (if any) </label>
                                        <div id="ctrl-files-holder" class=" "> 
                                            <div class="dropzone " input="#ctrl-files" fieldname="files" uploadurl="{{ url('fileuploader/upload/files') }}"    data-multiple="false" dropmsg="Choose files or drop files here"    btntext="Browse" extensions=".docx,.doc,.xls,.xlsx,.xml,.csv,.pdf,.xps" filesize="10" maximum="1">
                                                <input name="files" id="ctrl-files" data-field="files" class="dropzone-input form-control" value="<?php echo get_value('files') ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="date_joined">Date Joined </label>
                                        <div id="ctrl-date_joined-holder" class="input-group "> 
                                            <input id="ctrl-date_joined" data-field="date_joined" class="form-control datepicker  datepicker"  value="<?php echo get_value('date_joined') ?>" type="datetime" name="date_joined" placeholder="Enter Date Joined" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                            <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label class="control-label" for="other_info">Other Info </label>
                                        <div id="ctrl-other_info-holder" class=" "> 
                                            <textarea placeholder="Enter Other Info" id="ctrl-other_info" data-field="other_info"  rows="3" name="other_info" class=" form-control"><?php echo get_value('other_info') ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
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
