<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Exam Sheet"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Edit Exam Sheet</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("examsheets/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="session_id">Session <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-session_id-holder" class=" ">
                                                <select required=""  id="ctrl-session_id" data-field="session_id" data-load-select-options="term_id" name="session_id"  placeholder="Select a value ..."    class="form-select" >
                                                <option value="">Select a value ...</option>
                                                <?php
                                                    $options = $comp_model->session_id_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['session_id'] ? 'selected' : null );
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
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="term_id">Term <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-term_id-holder" class=" ">
                                                <select required=""  id="ctrl-term_id" data-field="term_id" data-load-path="<?php print_link('componentsdata/term_id_option_list') ?>" name="term_id"  placeholder="Select a value ..."    class="form-select" >
                                                <?php
                                                    $options = $comp_model->term_id_option_list($data['session_id']) ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['term_id'] ? 'selected' : null );
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
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="class_id">Class <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-class_id-holder" class=" ">
                                                <select required=""  id="ctrl-class_id" data-field="class_id" data-load-select-options="user_id" name="class_id"  placeholder="Select a value ..."    class="form-select" >
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
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="user_id">Student <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-user_id-holder" class=" ">
                                                <select required=""  id="ctrl-user_id" data-field="user_id" data-load-path="<?php print_link('componentsdata/user_id_option_list') ?>" name="user_id"  placeholder="Select a student ..."    class="form-select" >
                                                <?php
                                                    $options = $comp_model->user_id_option_list($data['class_id']) ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = ( $value == $data['user_id'] ? 'selected' : null );
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
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="present_count">Present Count </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-present_count-holder" class=" ">
                                                <input id="ctrl-present_count" data-field="present_count"  value="<?php  echo $data['present_count']; ?>" type="text" placeholder="Enter Present Count"  name="present_count"  class="form-control " />
                                            </div>
                                            <small class="form-text">Number of times student comes to school</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="open_count">Open Count </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-open_count-holder" class=" ">
                                                <input id="ctrl-open_count" data-field="open_count"  value="<?php  echo $data['open_count']; ?>" type="text" placeholder="Enter Open Count"  name="open_count"  class="form-control " />
                                            </div>
                                            <small class="form-text">Number of times that school open</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="resume_on">Resume On </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-resume_on-holder" class="input-group ">
                                                <input id="ctrl-resume_on" data-field="resume_on" class="form-control datepicker  datepicker"  value="<?php  echo $data['resume_on']; ?>" type="datetime" name="resume_on" placeholder="Enter Resume On" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="teacher_remark">Teacher Remark <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-teacher_remark-holder" class=" ">
                                                <input id="ctrl-teacher_remark" data-field="teacher_remark"  value="<?php  echo $data['teacher_remark']; ?>" type="text" placeholder="Enter Teacher Remark"  required="" name="teacher_remark"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="total_score">Total Score <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-total_score-holder" class=" ">
                                                <input id="ctrl-total_score" data-field="total_score"  value="<?php  echo $data['total_score']; ?>" type="number" placeholder="Enter Total Score" step="any"  required="" name="total_score"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="director_approval">Director's Approval <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-director_approval-holder" class=" ">
                                                <select required=""  id="ctrl-director_approval" data-field="director_approval" name="director_approval"  placeholder="Select a value ..."    class="form-select" >
                                                <option value="">Select a value ...</option>
                                                <?php
                                                    $options = Menu::directorApproval();
                                                    $field_value = $data['director_approval'];
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
                                <div class="form-group col-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="director_comment">Director Comment </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-director_comment-holder" class=" ">
                                                <input id="ctrl-director_comment" data-field="director_comment"  value="<?php  echo $data['director_comment']; ?>" type="text" placeholder="Enter Director Comment"  name="director_comment"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input id="ctrl-updated_by" data-field="updated_by"  value="<?php  echo $data['updated_by']; ?>" type="hidden" placeholder="Enter Updated By" list="updated_by_list"  required="" name="updated_by"  class="form-control " />
                            <datalist id="updated_by_list">
                            <?php
                                $options = $comp_model->updated_by_option_list() ?? [];
                                foreach($options as $option){
                                $value = $option->value;
                                $label = $option->label ?? $value;
                            ?>
                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                            <?php
                                }
                            ?>
                            </datalist>
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
