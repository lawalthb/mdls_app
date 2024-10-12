<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Web Setting"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Web Setting</div>
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
                        <form id="websettings-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('websettings.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="top_bar">Top Bar </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-top_bar-holder" class=" ">
                                                <input id="ctrl-top_bar" data-field="top_bar"  value="<?php echo get_value('top_bar') ?>" type="text" placeholder="Enter Top Bar"  name="top_bar"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="header">Header </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-header-holder" class=" ">
                                                <input id="ctrl-header" data-field="header"  value="<?php echo get_value('header') ?>" type="text" placeholder="Enter Header"  name="header"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="slider">Slider </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-slider-holder" class=" ">
                                                <input id="ctrl-slider" data-field="slider"  value="<?php echo get_value('slider') ?>" type="text" placeholder="Enter Slider"  name="slider"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="vission">Vission </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-vission-holder" class=" ">
                                                <input id="ctrl-vission" data-field="vission"  value="<?php echo get_value('vission') ?>" type="text" placeholder="Enter Vission"  name="vission"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="cta">Cta </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-cta-holder" class=" ">
                                                <input id="ctrl-cta" data-field="cta"  value="<?php echo get_value('cta') ?>" type="text" placeholder="Enter Cta"  name="cta"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="about">About </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-about-holder" class=" ">
                                                <input id="ctrl-about" data-field="about"  value="<?php echo get_value('about') ?>" type="text" placeholder="Enter About"  name="about"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="count">Count </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-count-holder" class=" ">
                                                <input id="ctrl-count" data-field="count"  value="<?php echo get_value('count') ?>" type="text" placeholder="Enter Count"  name="count"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="benefit">Benefit </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-benefit-holder" class=" ">
                                                <input id="ctrl-benefit" data-field="benefit"  value="<?php echo get_value('benefit') ?>" type="text" placeholder="Enter Benefit"  name="benefit"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="resources">Resources </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-resources-holder" class=" ">
                                                <input id="ctrl-resources" data-field="resources"  value="<?php echo get_value('resources') ?>" type="text" placeholder="Enter Resources"  name="resources"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="registration">Registration </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-registration-holder" class=" ">
                                                <input id="ctrl-registration" data-field="registration"  value="<?php echo get_value('registration') ?>" type="text" placeholder="Enter Registration"  name="registration"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="event">Event </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-event-holder" class=" ">
                                                <input id="ctrl-event" data-field="event"  value="<?php echo get_value('event') ?>" type="text" placeholder="Enter Event"  name="event"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="testimonial">Testimonial </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-testimonial-holder" class=" ">
                                                <input id="ctrl-testimonial" data-field="testimonial"  value="<?php echo get_value('testimonial') ?>" type="text" placeholder="Enter Testimonial"  name="testimonial"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="excos">Excos </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-excos-holder" class=" ">
                                                <input id="ctrl-excos" data-field="excos"  value="<?php echo get_value('excos') ?>" type="text" placeholder="Enter Excos"  name="excos"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="gallery">Gallery </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-gallery-holder" class=" ">
                                                <input id="ctrl-gallery" data-field="gallery"  value="<?php echo get_value('gallery') ?>" type="text" placeholder="Enter Gallery"  name="gallery"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="pricing">Pricing </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-pricing-holder" class=" ">
                                                <input id="ctrl-pricing" data-field="pricing"  value="<?php echo get_value('pricing') ?>" type="text" placeholder="Enter Pricing"  name="pricing"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="faq">Faq </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-faq-holder" class=" ">
                                                <input id="ctrl-faq" data-field="faq"  value="<?php echo get_value('faq') ?>" type="text" placeholder="Enter Faq"  name="faq"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="contact">Contact </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-contact-holder" class=" ">
                                                <input id="ctrl-contact" data-field="contact"  value="<?php echo get_value('contact') ?>" type="text" placeholder="Enter Contact"  name="contact"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="footer">Footer </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-footer-holder" class=" ">
                                                <input id="ctrl-footer" data-field="footer"  value="<?php echo get_value('footer') ?>" type="text" placeholder="Enter Footer"  name="footer"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="user_id">User Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-user_id-holder" class=" ">
                                                <input id="ctrl-user_id" data-field="user_id"  value="<?php echo get_value('user_id') ?>" type="number" placeholder="Enter User Id" step="any"  required="" name="user_id"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="maintenance">Maintenance </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-maintenance-holder" class=" ">
                                                <input id="ctrl-maintenance" data-field="maintenance"  value="<?php echo get_value('maintenance') ?>" type="text" placeholder="Enter Maintenance"  name="maintenance"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="maintenance_text">Maintenance Text </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-maintenance_text-holder" class=" ">
                                                <textarea placeholder="Enter Maintenance Text" id="ctrl-maintenance_text" data-field="maintenance_text"  rows="5" name="maintenance_text" class=" form-control"><?php echo get_value('maintenance_text') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
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
