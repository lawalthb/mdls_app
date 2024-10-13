<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Parent"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Edit Parent</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("parents/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="id">Id <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-id-holder" class=" ">
                                            <input id="ctrl-id" data-field="id"  value="<?php  echo $data['id']; ?>" type="number" placeholder="Enter Id" step="any"  required="" name="id"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="fullname">Fullname <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-fullname-holder" class=" ">
                                            <input id="ctrl-fullname" data-field="fullname"  value="<?php  echo $data['fullname']; ?>" type="text" placeholder="Enter Fullname"  required="" name="fullname"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="phone">Phone <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-phone-holder" class=" ">
                                            <input id="ctrl-phone" data-field="phone"  value="<?php  echo $data['phone']; ?>" type="text" placeholder="Enter Phone"  required="" name="phone"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="occupation">Occupation <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-occupation-holder" class=" ">
                                            <input id="ctrl-occupation" data-field="occupation"  value="<?php  echo $data['occupation']; ?>" type="text" placeholder="Enter Occupation"  required="" name="occupation"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="address">Address <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-address-holder" class=" ">
                                            <input id="ctrl-address" data-field="address"  value="<?php  echo $data['address']; ?>" type="text" placeholder="Enter Address"  required="" name="address"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="state">State <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-state-holder" class=" ">
                                            <input id="ctrl-state" data-field="state"  value="<?php  echo $data['state']; ?>" type="number" placeholder="Enter State" step="any"  required="" name="state"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="lga">Lga <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-lga-holder" class=" ">
                                            <input id="ctrl-lga" data-field="lga"  value="<?php  echo $data['lga']; ?>" type="number" placeholder="Enter Lga" step="any"  required="" name="lga"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="parent_type">Parent Type <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-parent_type-holder" class=" ">
                                            <select required=""  id="ctrl-parent_type" data-field="parent_type" name="parent_type"  placeholder="Select a value ..."    class="form-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                                $options = Menu::parentType();
                                                $field_value = $data['parent_type'];
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
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="is_active">Is Active <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-is_active-holder" class=" ">
                                            <select required=""  id="ctrl-is_active" data-field="is_active" name="is_active"  placeholder="Select a value ..."    class="form-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                                $options = Menu::isActive();
                                                $field_value = $data['is_active'];
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
