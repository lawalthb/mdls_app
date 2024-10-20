<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Exam Sheet Performance"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Exam Sheet Performance</div>
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
                        <form id="examsheetperformances-add-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="{{ route('examsheetperformances.store') }}" method="post" >
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
                                    <select required=""  id="ctrl-subject_id-row<?php echo $row; ?>" data-field="subject_id" name="row[<?php echo $row ?>][subject_id]"  placeholder="Select a value ..."    class="form-select" >
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
                                <input id="ctrl-ca_score-row<?php echo $row; ?>" data-field="ca_score"  value="<?php echo get_value('ca_score', "0") ?>" type="number" placeholder="Enter Ca Score" min="0" max="40" step="0.1"  required="" name="row[<?php echo $row ?>][ca_score]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-exam_score-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-exam_score-row<?php echo $row; ?>" data-field="exam_score"  value="<?php echo get_value('exam_score', "0") ?>" type="number" placeholder="Enter Exam Score" min="0" max="60" step="0.1"  required="" name="row[<?php echo $row ?>][exam_score]"  class="form-control " />
                        </div>
                    </td>
                    <td>
                        <div id="ctrl-total-row<?php echo $row; ?>-holder" class=" ">
                        <input id="ctrl-total-row<?php echo $row; ?>" data-field="total"  value="<?php echo get_value('total') ?>" type="number" placeholder="Enter Total" min="0" max="100" step="0.1"  required="" name="row[<?php echo $row ?>][total]"  class="form-control " />
                    </div>
                </td>
                <td>
                    <div id="ctrl-remark-row<?php echo $row; ?>-holder" class=" ">
                    <input id="ctrl-remark-row<?php echo $row; ?>" data-field="remark"  value="<?php echo get_value('remark') ?>" type="text" placeholder="Enter Remark"  name="row[<?php echo $row ?>][remark]"  class="form-control " />
                </div>
            </td>
            <input id="ctrl-updated_by-row<?php echo $row; ?>" data-field="updated_by"  value="<?php echo get_value('updated_by', auth()->user()->id) ?>" type="hidden" placeholder="Enter Updated By" list="updated_by_list"  required="" name="row[<?php echo $row ?>][updated_by]"  class="form-control " />
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
