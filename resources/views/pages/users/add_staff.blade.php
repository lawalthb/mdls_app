<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
$pageTitle = "Add New Staff"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
    if ($show_header == true) {
    ?>
        <div class="bg-light p-3 mb-3">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto  back-btn-col">
                        <a class="back-btn btn " href="{{ url()->previous() }}">
                            <i class="material-icons">arrow_back</i>
                        </a>
                    </div>
                    <div class="col  ">
                        <div class="">
                            <div class="h5 font-weight-bold text-primary">Add New Staff</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid ">
                    <div class="card card-1 border rounded page-content">
                        <!--[form-start]-->
                        <form id="users-add_staff-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('users.add_staff_store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="email">Email <span class="text-danger">*</span></label>
                                        <div id="ctrl-email-holder" class=" ">
                                            <input id="ctrl-email" data-field="email" value="<?php echo get_value('email') ?>" type="email" placeholder="Enter Email" required="" name="email" class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="name">Name <span class="text-danger">*</span></label>
                                        <div id="ctrl-name-holder" class=" ">
                                            <input id="ctrl-name" data-field="name" value="<?php echo get_value('name') ?>" type="text" placeholder="Enter Name" required="" name="name" class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="phone">Phone </label>
                                        <div id="ctrl-phone-holder" class=" ">
                                            <input id="ctrl-phone" data-field="phone" value="<?php echo get_value('phone') ?>" type="text" placeholder="Enter Phone" name="phone" class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="is_active">Is Account Active? </label>
                                        <div id="ctrl-is_active-holder" class=" ">
                                            <?php
                                            $options = Menu::isActive();
                                            if (!empty($options)) {
                                                foreach ($options as $option) {
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    //check if current option is checked option
                                                    $checked = Html::get_field_checked('is_active', $value, "Yes");
                                            ?>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" <?php echo $checked ?> value="<?php echo $value ?>" type="radio" name="is_active" />
                                                        <span class="form-check-label"><?php echo $label ?></span>
                                                    </label>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="user_role_id">Staff Role </label>
                                        <div id="ctrl-user_role_id-holder" class=" ">
                                            <select id="ctrl-user_role_id" data-field="user_role_id" name="user_role_id" placeholder="Select a role ..." class="form-select">
                                                <option value="">Select a role ...</option>
                                                <option value=1>Admin</option>
                                                <option value=3>Teacher</option>
                                                <option value=4>Director</option>

                                                

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="account_status">Account Status </label>
                                        <div id="ctrl-account_status-holder" class=" ">
                                            <?php
                                            $options = Menu::accountStatus2();
                                            if (!empty($options)) {
                                                foreach ($options as $option) {
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    //check if current option is checked option
                                                    $checked = Html::get_field_checked('account_status', $value, "active");
                                            ?>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" <?php echo $checked ?> value="<?php echo $value ?>" type="radio" name="account_status" />
                                                        <span class="form-check-label"><?php echo $label ?></span>
                                                    </label>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <div class="bg-light p-2 subform">
                                <h4 class="record-title">Add New Staff Detail</h4>
                                <hr />
                                @csrf
                                <div>
                                    <input id="ctrl-class_id" data-field="class_id" value="<?php echo get_value('class_id', "0") ?>" type="hidden" placeholder="Enter Class Id" name="staffdetails[class_id]" class="form-control " />
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label" for="gender">Gender <span class="text-danger">*</span></label>
                                            <div id="ctrl-gender-holder" class=" ">
                                                <select required="" id="ctrl-gender" data-field="gender" name="staffdetails[gender]" placeholder="Select a value ..." class="form-select">
                                                    <option value="">Select a value ...</option>
                                                    <?php
                                                    $options = Menu::gender();
                                                    if (!empty($options)) {
                                                        foreach ($options as $option) {
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
                                        <div class="form-group col-md-6">
                                            <label class="control-label" for="address">Address </label>
                                            <div id="ctrl-address-holder" class=" ">
                                                <input id="ctrl-address" data-field="address" value="<?php echo get_value('address') ?>" type="text" placeholder="Enter Address" name="staffdetails[address]" class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label" for="guarantor_details">Guarantor Details </label>
                                            <div id="ctrl-guarantor_details-holder" class=" ">
                                                <textarea placeholder="Enter Guarantor Details" id="ctrl-guarantor_details" data-field="guarantor_details" rows="3" name="staffdetails[guarantor_details]" class=" form-control"><?php echo get_value('guarantor_details') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">[html-lang-0130]</div>-->
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label" for="other_info">Other Info </label>
                                            <div id="ctrl-other_info-holder" class=" ">
                                                <textarea placeholder="Enter Other Info" id="ctrl-other_info" data-field="other_info" rows="3" name="staffdetails[other_info]" class=" form-control"><?php echo get_value('other_info') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">[html-lang-0130]</div>-->
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label" for="date_joined">Date Joined </label>
                                            <div id="ctrl-date_joined-holder" class="input-group ">
                                                <input id="ctrl-date_joined" data-field="date_joined" class="form-control datepicker  datepicker" value="<?php echo get_value('date_joined') ?>" type="datetime" name="staffdetails[date_joined]" placeholder="Enter Date Joined" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label" for="files">Files </label>
                                            <div id="ctrl-files-holder" class=" ">
                                                <div class="dropzone " input="#ctrl-files" fieldname="files" uploadurl="{{ url('fileuploader/upload/files') }}" data-multiple="false" dropmsg="Choose files or drop files here" btntext="[html-lang-0082]" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                    <input name="staffdetails[files]" id="ctrl-files" data-field="files" class="dropzone-input form-control" value="<?php echo get_value('files') ?>" type="text" />
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">[html-lang-0129]</div>-->
                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
