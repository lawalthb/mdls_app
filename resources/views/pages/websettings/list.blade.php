<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("websettings/add");
    $can_edit = $user->canAccess("websettings/edit");
    $can_view = $user->canAccess("websettings/view");
    $can_delete = $user->canAccess("websettings/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Web Settings"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center gap-3">
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Web Settings</div>
                    </div>
                </div>
                <div class="col-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("websettings/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    Add New Web Setting 
                </a>
                <?php } ?>
            </div>
            <div class="col-md-3  " >
                <!-- Page drop down search component -->
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Search" />
                        <button class="btn btn-primary"><i class="material-icons">search</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <div id="websettings-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/websettings/", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <table class="table table-hover table-striped table-sm text-left">
                                <thead class="table-header ">
                                    <tr>
                                        <?php if($can_delete){ ?>
                                        <th class="td-checkbox">
                                        <label class="form-check-label">
                                        <input class="toggle-check-all form-check-input" type="checkbox" />
                                        </label>
                                        </th>
                                        <?php } ?>
                                        <th class="td-id" > Id</th>
                                        <th class="td-top_bar" > Top Bar</th>
                                        <th class="td-header" > Header</th>
                                        <th class="td-slider" > Slider</th>
                                        <th class="td-vission" > Vission</th>
                                        <th class="td-cta" > Cta</th>
                                        <th class="td-about" > About</th>
                                        <th class="td-count" > Count</th>
                                        <th class="td-benefit" > Benefit</th>
                                        <th class="td-resources" > Resources</th>
                                        <th class="td-registration" > Registration</th>
                                        <th class="td-event" > Event</th>
                                        <th class="td-testimonial" > Testimonial</th>
                                        <th class="td-excos" > Excos</th>
                                        <th class="td-gallery" > Gallery</th>
                                        <th class="td-pricing" > Pricing</th>
                                        <th class="td-faq" > Faq</th>
                                        <th class="td-contact" > Contact</th>
                                        <th class="td-footer" > Footer</th>
                                        <th class="td-updated_at" > Updated At</th>
                                        <th class="td-user_id" > User Id</th>
                                        <th class="td-maintenance" > Maintenance</th>
                                        <th class="td-maintenance_text" > Maintenance Text</th>
                                        <th class="td-btn"></th>
                                    </tr>
                                </thead>
                                <?php
                                    if($total_records){
                                ?>
                                <tbody class="page-data">
                                    <!--record-->
                                    <?php
                                        $counter = 0;
                                        foreach($records as $data){
                                        $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                        $counter++;
                                    ?>
                                    <tr>
                                        <?php if($can_delete){ ?>
                                        <td class=" td-checkbox">
                                            <label class="form-check-label">
                                            <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                            </label>
                                        </td>
                                        <?php } ?>
                                        <!--PageComponentStart-->
                                        <td class="td-id">
                                            <a href="<?php print_link("/websettings/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                        </td>
                                        <td class="td-top_bar">
                                            <?php echo  $data['top_bar'] ; ?>
                                        </td>
                                        <td class="td-header">
                                            <?php echo  $data['header'] ; ?>
                                        </td>
                                        <td class="td-slider">
                                            <?php echo  $data['slider'] ; ?>
                                        </td>
                                        <td class="td-vission">
                                            <?php echo  $data['vission'] ; ?>
                                        </td>
                                        <td class="td-cta">
                                            <?php echo  $data['cta'] ; ?>
                                        </td>
                                        <td class="td-about">
                                            <?php echo  $data['about'] ; ?>
                                        </td>
                                        <td class="td-count">
                                            <?php echo  $data['count'] ; ?>
                                        </td>
                                        <td class="td-benefit">
                                            <?php echo  $data['benefit'] ; ?>
                                        </td>
                                        <td class="td-resources">
                                            <?php echo  $data['resources'] ; ?>
                                        </td>
                                        <td class="td-registration">
                                            <?php echo  $data['registration'] ; ?>
                                        </td>
                                        <td class="td-event">
                                            <?php echo  $data['event'] ; ?>
                                        </td>
                                        <td class="td-testimonial">
                                            <?php echo  $data['testimonial'] ; ?>
                                        </td>
                                        <td class="td-excos">
                                            <?php echo  $data['excos'] ; ?>
                                        </td>
                                        <td class="td-gallery">
                                            <?php echo  $data['gallery'] ; ?>
                                        </td>
                                        <td class="td-pricing">
                                            <?php echo  $data['pricing'] ; ?>
                                        </td>
                                        <td class="td-faq">
                                            <?php echo  $data['faq'] ; ?>
                                        </td>
                                        <td class="td-contact">
                                            <?php echo  $data['contact'] ; ?>
                                        </td>
                                        <td class="td-footer">
                                            <?php echo  $data['footer'] ; ?>
                                        </td>
                                        <td class="td-updated_at">
                                            <?php echo  $data['updated_at'] ; ?>
                                        </td>
                                        <td class="td-user_id">
                                            <?php echo  $data['user_id'] ; ?>
                                        </td>
                                        <td class="td-maintenance">
                                            <?php echo  $data['maintenance'] ; ?>
                                        </td>
                                        <td class="td-maintenance_text">
                                            <?php echo  $data['maintenance_text'] ; ?>
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <div class="dropdown" >
                                                <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                <i class="material-icons">menu</i> 
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if($can_view){ ?>
                                                    <a class="dropdown-item "   href="<?php print_link("websettings/view/$rec_id"); ?>" >
                                                    <i class="material-icons">visibility</i> View
                                                </a>
                                                <?php } ?>
                                                <?php if($can_edit){ ?>
                                                <a class="dropdown-item "   href="<?php print_link("websettings/edit/$rec_id"); ?>" >
                                                <i class="material-icons">edit</i> Edit
                                            </a>
                                            <?php } ?>
                                            <?php if($can_delete){ ?>
                                            <a class="dropdown-item record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" href="<?php print_link("websettings/delete/$rec_id"); ?>" >
                                            <i class="material-icons">delete_sweep</i> Delete
                                        </a>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                        <!--endrecord-->
                    </tbody>
                    <tbody class="search-data"></tbody>
                    <?php
                        }
                        else{
                    ?>
                    <tbody class="page-data">
                        <tr>
                            <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                                <i class="material-icons">block</i> No record found
                            </td>
                        </tr>
                    </tbody>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <?php
                if($show_footer){
            ?>
            <div class=" mt-3">
                <div class="row align-items-center justify-content-between">    
                    <div class="col-md-auto d-flex">    
                        <?php if($can_delete){ ?>
                        <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("websettings/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                        <i class="material-icons">delete_sweep</i> Delete Selected
                        </button>
                        <?php } ?>
                    </div>
                    <div class="col">   
                        <?php
                            if($show_pagination == true){
                            $pager = new Pagination($total_records, $record_count);
                            $pager->show_page_count = false;
                            $pager->show_record_count = true;
                            $pager->show_page_limit =false;
                            $pager->limit = $limit;
                            $pager->show_page_number_list = true;
                            $pager->pager_link_range=5;
                            $pager->render();
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
</section>


@endsection
