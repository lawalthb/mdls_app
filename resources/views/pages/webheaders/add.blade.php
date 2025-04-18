<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Web Header"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Web Header</div>
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
                        <form id="webheaders-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('webheaders.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="logo">Logo </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-logo-holder" class=" ">
                                                <input id="ctrl-logo" data-field="logo"  value="<?php echo get_value('logo') ?>" type="text" placeholder="Enter Logo"  name="logo"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="favicon">Favicon </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-favicon-holder" class=" ">
                                                <input id="ctrl-favicon" data-field="favicon"  value="<?php echo get_value('favicon') ?>" type="text" placeholder="Enter Favicon"  name="favicon"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="site_name">Site Name </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-site_name-holder" class=" ">
                                                <input id="ctrl-site_name" data-field="site_name"  value="<?php echo get_value('site_name') ?>" type="text" placeholder="Enter Site Name"  name="site_name"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="menus">Menus </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-menus-holder" class=" ">
                                                <textarea placeholder="Enter Menus" id="ctrl-menus" data-field="menus"  rows="5" name="menus" class=" form-control"><?php echo get_value('menus') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="updated_by">Updated By <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-updated_by-holder" class=" ">
                                                <input id="ctrl-updated_by" data-field="updated_by"  value="<?php echo get_value('updated_by') ?>" type="number" placeholder="Enter Updated By" step="any"  required="" name="updated_by"  class="form-control " />
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
