<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Exam Sheet"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Exam Sheet</div>
                    </div>
                </div>
                <div class="col-12 comp-grid " >
                    <div class=" "><script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
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
                    <form id="examsheets-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('examsheets.store') }}" method="post">
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="session_id">Session <span class="text-danger">*</span></label>
                                    <div id="ctrl-session_id-holder" class=" "> 
                                        <select required=""  id="ctrl-session_id" data-field="session_id" data-load-select-options="term_id" name="session_id"  placeholder="Select a value ..."    class="form-select" >
                                        <option value="">Select a value ...</option>
                                        <?php 
                                            $options = $comp_model->session_id_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = Html::get_field_selected('session_id', $value, "");
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
                                    <label class="control-label" for="term_id">Term <span class="text-danger">*</span></label>
                                    <div id="ctrl-term_id-holder" class=" "> 
                                        <select required=""  id="ctrl-term_id" data-field="term_id" data-load-path="<?php print_link('componentsdata/term_id_option_list') ?>" name="term_id"  placeholder="Select a value ..."    class="form-select" >
                                        <option value="">Select a value ...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="class_id">Class <span class="text-danger">*</span></label>
                                    <div id="ctrl-class_id-holder" class=" "> 
                                        <select required=""  id="ctrl-class_id" data-field="class_id" data-load-select-options="user_id" name="class_id"  placeholder="Select a value ..."    class="form-select" >
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
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="user_id">Student <span class="text-danger">*</span></label>
                                    <div id="ctrl-user_id-holder" class=" "> 
                                        <select required=""  id="ctrl-user_id" data-field="user_id" data-load-path="<?php print_link('componentsdata/user_id_option_list') ?>" name="user_id"  placeholder="Select a student ..."    class="form-select" >
                                        <option value="">Select a student ...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="present_count">Present Count </label>
                                    <div id="ctrl-present_count-holder" class=" "> 
                                        <input id="ctrl-present_count" data-field="present_count"  value="<?php echo get_value('present_count', examsettings('present_count')) ?>" type="text" placeholder="Enter Present Count"  name="present_count"  class="form-control " />
                                    </div>
                                    <small class="form-text">Number of times student comes to school</small>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="open_count">Open Count </label>
                                    <div id="ctrl-open_count-holder" class=" "> 
                                        <input id="ctrl-open_count" data-field="open_count"  value="<?php echo get_value('open_count', examsettings('present_count')) ?>" type="text" placeholder="Enter Open Count"  name="open_count"  class="form-control " />
                                    </div>
                                    <small class="form-text">Number of times that school open</small>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="resume_on">Resume On </label>
                                    <div id="ctrl-resume_on-holder" class="input-group "> 
                                        <input id="ctrl-resume_on" data-field="resume_on" class="form-control datepicker  datepicker"  value="<?php echo get_value('resume_on', examsettings('resume_date')) ?>" type="datetime" name="resume_on" placeholder="Enter Resume On" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="teacher_remark">Teacher Remark <span class="text-danger">*</span></label>
                                    <div id="ctrl-teacher_remark-holder" class=" "> 
                                        <input id="ctrl-teacher_remark" data-field="teacher_remark"  value="<?php echo get_value('teacher_remark', "Good") ?>" type="text" placeholder="Enter Teacher Remark"  required="" name="teacher_remark"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="total_score">Total Score <span class="text-danger">*</span></label>
                                    <div id="ctrl-total_score-holder" class=" "> 
                                        <input id="ctrl-total_score" data-field="total_score"  value="<?php echo get_value('total_score', "0") ?>" type="number" placeholder="Enter Total Score" step="any"  required="" name="total_score"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="director_approval">Director's Approval <span class="text-danger">*</span></label>
                                    <div id="ctrl-director_approval-holder" class=" "> 
                                        <select required=""  id="ctrl-director_approval" data-field="director_approval" name="director_approval"  placeholder="Select a value ..."    class="form-select" >
                                        <option value="">Select a value ...</option>
                                        <?php
                                            $options = Menu::directorApproval();
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = Html::get_field_selected('director_approval', $value, "");
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
                                <div class="form-group col-12">
                                    <label class="control-label" for="director_comment">Director Comment </label>
                                    <div id="ctrl-director_comment-holder" class=" "> 
                                        <input id="ctrl-director_comment" data-field="director_comment"  value="<?php echo get_value('director_comment') ?>" type="text" placeholder="Enter Director Comment"  name="director_comment"  class="form-control " />
                                    </div>
                                </div>
                            </div>
                            <input id="ctrl-updated_by" data-field="updated_by"  value="<?php echo get_value('updated_by', auth()->user()->id) ?>" type="hidden" placeholder="Enter Updated By" list="updated_by_list"  required="" name="updated_by"  class="form-control " />
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
                        <div class="bg-light p-2 subform">
                            <h4 class="record-title">Add New Exam Sheet Performance</h4>
                            <hr />
                            @csrf
                            <div>
                                <table class="table table-striped table-sm" data-maxrow="50" data-minrow="1">
                                    <thead>
                                        <tr>
                                            <th class="bg-light"><label for="subject_id">Subject Id</label></th>
                                            <th class="bg-light"><label for="ca_score">Ca Score</label></th>
                                            <th class="bg-light"><label for="exam_score">Exam Score</label></th>
                                            <th class="bg-light"><label for="total">Total</label></th>
                                            <th class="bg-light"><label for="remark">Remark</label></th>
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
                                    <div id="ctrl-subject_id-row<?php echo $row; ?>-holder" class=" ">
                                    <select required=""  id="ctrl-subject_id-row<?php echo $row; ?>" data-field="subject_id" name="examsheetperformances[<?php echo $row ?>][subject_id]"  placeholder="Select a value ..."    class="form-select" >
                                    <option value="">Select a value ...</option>
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
                                <div id="ctrl-ca_score-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-ca_score-row<?php echo $row; ?>" data-field="ca_score"  value="<?php echo get_value('ca_score', "0") ?>" type="number" placeholder="Enter Ca Score" min="0" max="40" step="0.1"  required="" name="examsheetperformances[<?php echo $row ?>][ca_score]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-exam_score-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-exam_score-row<?php echo $row; ?>" data-field="exam_score"  value="<?php echo get_value('exam_score', "0") ?>" type="number" placeholder="Enter Exam Score" min="0" max="60" step="0.1"  required="" name="examsheetperformances[<?php echo $row ?>][exam_score]"  class="form-control " />
                        </div>
                    </td>
                    <td>
                        <div id="ctrl-total-row<?php echo $row; ?>-holder" class=" ">
                        <input id="ctrl-total-row<?php echo $row; ?>" data-field="total"  value="<?php echo get_value('total') ?>" type="number" placeholder="Enter Total" min="0" max="100" step="0.1"  required="" name="examsheetperformances[<?php echo $row ?>][total]"  class="form-control " />
                    </div>
                </td>
                <td>
                    <div id="ctrl-remark-row<?php echo $row; ?>-holder" class=" ">
                    <input id="ctrl-remark-row<?php echo $row; ?>" data-field="remark"  value="<?php echo get_value('remark') ?>" type="text" placeholder="Enter Remark"  name="examsheetperformances[<?php echo $row ?>][remark]"  class="form-control " />
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
</div>
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
