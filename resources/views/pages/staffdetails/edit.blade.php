<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Staff Detail"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Edit Staff Detail</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("staffdetails/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="gender">Gender <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-gender-holder" class=" ">
                                                <select required=""  id="ctrl-gender" data-field="gender" name="gender"  placeholder="Select a value ..."    class="form-select" >
                                                <option value="">Select a value ...</option>
                                                <?php
                                                    $options = Menu::gender();
                                                    $field_value = $data['gender'];
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
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="class_id">Class </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-class_id-holder" class=" ">
                                                <select  id="ctrl-class_id" data-field="class_id" name="class_id"  placeholder="Select a value ..."    class="form-select" >
                                                <option value="">Select a value ...</option>
                                                <?php
                                                    $options = $comp_model->staffdetails_class_id_option_list() ?? [];
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
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="address">Address </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-address-holder" class=" ">
                                            <input id="ctrl-address" data-field="address"  value="<?php  echo $data['address']; ?>" type="text" placeholder="Enter Address"  name="address"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="guarantor_details">Guarantor Details </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-guarantor_details-holder" class=" ">
                                            <textarea placeholder="Enter Guarantor Details" id="ctrl-guarantor_details" data-field="guarantor_details"  rows="3" name="guarantor_details" class=" form-control"><?php  echo $data['guarantor_details']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="files">CV (if any) </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-files-holder" class=" ">
                                                <div class="dropzone " input="#ctrl-files" fieldname="files" uploadurl="{{ url('fileuploader/upload/files') }}"    data-multiple="false" dropmsg="Choose files or drop files here"    btntext="Browse" extensions=".docx,.doc,.xls,.xlsx,.xml,.csv,.pdf,.xps" filesize="10" maximum="1">
                                                    <input name="files" id="ctrl-files" data-field="files" class="dropzone-input form-control" value="<?php  echo $data['files']; ?>" type="text"  />
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                </div>
                                            </div>
                                            <?php Html :: uploaded_files_list($data['files'], '#ctrl-files'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="date_joined">Date Joined </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-date_joined-holder" class="input-group ">
                                                <input id="ctrl-date_joined" data-field="date_joined" class="form-control datepicker  datepicker"  value="<?php  echo $data['date_joined']; ?>" type="datetime" name="date_joined" placeholder="Enter Date Joined" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="other_info">Other Info </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-other_info-holder" class=" ">
                                                <textarea placeholder="Enter Other Info" id="ctrl-other_info" data-field="other_info"  rows="3" name="other_info" class=" form-control"><?php  echo $data['other_info']; ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                            </div>
                                        </div>
                                    </div>
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
