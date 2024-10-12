<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Web Contact"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Edit Web Contact</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("webcontacts/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="email1">Email1 </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-email1-holder" class=" ">
                                            <input id="ctrl-email1" data-field="email1"  value="<?php  echo $data['email1']; ?>" type="email" placeholder="Enter Email1"  name="email1"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="email2">Email2 </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-email2-holder" class=" ">
                                            <input id="ctrl-email2" data-field="email2"  value="<?php  echo $data['email2']; ?>" type="email" placeholder="Enter Email2"  name="email2"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="phone1">Phone1 </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-phone1-holder" class=" ">
                                            <input id="ctrl-phone1" data-field="phone1"  value="<?php  echo $data['phone1']; ?>" type="text" placeholder="Enter Phone1"  name="phone1"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="phone2">Phone2 </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-phone2-holder" class=" ">
                                            <input id="ctrl-phone2" data-field="phone2"  value="<?php  echo $data['phone2']; ?>" type="text" placeholder="Enter Phone2"  name="phone2"  class="form-control " />
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
                                        <label class="control-label" for="text">Text </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-text-holder" class=" ">
                                            <textarea placeholder="Enter Text" id="ctrl-text" data-field="text"  rows="5" name="text" class=" form-control"><?php  echo $data['text']; ?></textarea>
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
                                            <select required=""  id="ctrl-updated_by" data-field="updated_by" name="updated_by"  placeholder="Select a value ..."    class="form-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                                $options = $comp_model->plans_updated_by_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = ( $value == $data['updated_by'] ? 'selected' : null );
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
