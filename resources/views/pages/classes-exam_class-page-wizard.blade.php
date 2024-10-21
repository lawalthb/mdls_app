    <div class="form-wizard-container card " >
        <div class="text-left">
            <h4></h4>
            <p class="text-muted"></p>
        </div>
        <div class="smartwizard" data-theme="dots">
            <ul class="nav">
                <li>
                    <a class="nav-link" href="#FormWizard747Page1">
                        Step 1
                        <br /><small></small>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="#FormWizard747Page2">
                        Step 5
                        <br /><small></small>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="card tab-pane" id="FormWizard747Page1">
                    <?php $menu_id = "menu-" . random_str(); ?>
                    <div class="card mb-3 ">
                        <nav class="navbar navbar-expand-lg navbar-light">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $menu_id ?>" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        </nav>  
                        <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
                        <?php 
                            $arr_menu = [];
                            $menus = $comp_model->_list(); // Get menu items from database
                            if(!empty($menus)){
                            //build menu items into arrays
                            foreach($menus as $menu){
                            $count = $menu->num ?? null;
                            $arr_menu[] = array(
                            "path"=>"classes/exam_class//{$menu->value}?label={$menu->label}&tag=", 
                            "label"=>$menu->label, 
                            "count"=>$count, 
                            "icon"=>' '
                            );
                            }
                            //call menu render helper.
                            Html :: render_menu($arr_menu , "nav nav-tabs flex-column");
                            }
                        ?>
                    </div>
                </div>
                <div class="p-3 animated fadeIn page-content">
                </div>
                <div class="text-center p-3">
                    <button type="submit" class="btn btn-primary sw-btn-next">Getting Started</button>
                </div>
            </div>
            <div class="card tab-pane" id="FormWizard747Page2">
                <div class=" ">
                    <div class="text-center">
                        form here<h4>Form Wizard Completed</h4>
                        <hr />
                        <p class="text-muted">Thank you for your support</p>
                    </div>
                </div>
                <div class="p-3 animated fadeIn page-content">
                </div>
                <div class=" p-3">
                </div>
            </div>
        </div>
    </div>
</div>
