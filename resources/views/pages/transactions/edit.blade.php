<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Transaction"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Edit Transaction</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("transactions/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="user_id">User Id <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-user_id-holder" class=" ">
                                            <select required=""  id="ctrl-user_id" data-field="user_id" name="user_id"  placeholder="Select a value ..."    class="form-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                                $options = $comp_model->plans_updated_by_option_list() ?? [];
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
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="price_settings_id">Price Settings Id <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-price_settings_id-holder" class=" ">
                                            <select required=""  id="ctrl-price_settings_id" data-field="price_settings_id" name="price_settings_id"  placeholder="Select a value ..."    class="form-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                                $options = $comp_model->price_settings_id_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = ( $value == $data['price_settings_id'] ? 'selected' : null );
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
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="email">Email <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-email-holder" class=" ">
                                            <input id="ctrl-email" data-field="email"  value="<?php  echo $data['email']; ?>" type="email" placeholder="Enter Email"  required="" name="email"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="amount">Amount <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-amount-holder" class=" ">
                                            <input id="ctrl-amount" data-field="amount"  value="<?php  echo $data['amount']; ?>" type="number" placeholder="Enter Amount" step="any"  required="" name="amount"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="fullname">Fullname </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-fullname-holder" class=" ">
                                            <input id="ctrl-fullname" data-field="fullname"  value="<?php  echo $data['fullname']; ?>" type="text" placeholder="Enter Fullname"  name="fullname"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="phone_number">Phone Number </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-phone_number-holder" class=" ">
                                            <input id="ctrl-phone_number" data-field="phone_number"  value="<?php  echo $data['phone_number']; ?>" type="text" placeholder="Enter Phone Number"  name="phone_number"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="reference">Reference </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-reference-holder" class=" ">
                                            <textarea placeholder="Enter Reference" id="ctrl-reference" data-field="reference"  rows="5" name="reference" class=" form-control"><?php  echo $data['reference']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="status">Status <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-status-holder" class=" ">
                                            <select required=""  id="ctrl-status" data-field="status" name="status"  placeholder="Select a value ..."    class="form-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                                $options = Menu::status();
                                                $field_value = $data['status'];
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
                                        <label class="control-label" for="authorization_url">Authorization Url </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-authorization_url-holder" class=" ">
                                            <input id="ctrl-authorization_url" data-field="authorization_url"  value="<?php  echo $data['authorization_url']; ?>" type="text" placeholder="Enter Authorization Url"  name="authorization_url"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="callback_url">Callback Url </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-callback_url-holder" class=" ">
                                            <input id="ctrl-callback_url" data-field="callback_url"  value="<?php  echo $data['callback_url']; ?>" type="text" placeholder="Enter Callback Url"  name="callback_url"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="gateway_response">Gateway Response </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-gateway_response-holder" class=" ">
                                            <input id="ctrl-gateway_response" data-field="gateway_response"  value="<?php  echo $data['gateway_response']; ?>" type="text" placeholder="Enter Gateway Response"  name="gateway_response"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="paid_at">Paid At </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-paid_at-holder" class=" ">
                                            <input id="ctrl-paid_at" data-field="paid_at"  value="<?php  echo $data['paid_at']; ?>" type="text" placeholder="Enter Paid At"  name="paid_at"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="channel">Channel </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-channel-holder" class=" ">
                                            <input id="ctrl-channel" data-field="channel"  value="<?php  echo $data['channel']; ?>" type="text" placeholder="Enter Channel"  name="channel"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="message">Message </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-message-holder" class=" ">
                                            <input id="ctrl-message" data-field="message"  value="<?php  echo $data['message']; ?>" type="text" placeholder="Enter Message"  name="message"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="orderid">Orderid </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-orderid-holder" class=" ">
                                            <input id="ctrl-orderid" data-field="orderid"  value="<?php  echo $data['orderid']; ?>" type="text" placeholder="Enter Orderid"  name="orderid"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="other_info">Other Info </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-other_info-holder" class=" ">
                                            <textarea placeholder="Enter Other Info" id="ctrl-other_info" data-field="other_info"  rows="5" name="other_info" class=" form-control"><?php  echo $data['other_info']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="purpose_name">Purpose Name </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-purpose_name-holder" class=" ">
                                            <input id="ctrl-purpose_name" data-field="purpose_name"  value="<?php  echo $data['purpose_name']; ?>" type="text" placeholder="Enter Purpose Name"  name="purpose_name"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="purpose_id">Purpose Id <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-purpose_id-holder" class=" ">
                                            <input id="ctrl-purpose_id" data-field="purpose_id"  value="<?php  echo $data['purpose_id']; ?>" type="number" placeholder="Enter Purpose Id" step="any"  required="" name="purpose_id"  class="form-control " />
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
