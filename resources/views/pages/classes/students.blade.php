<!--
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
//check if current user role is allowed access to the pages
$can_add = $user->canAccess("classes/add");
$can_edit = $user->canAccess("classes/edit");
$can_view = $user->canAccess("classes/view");
$can_delete = $user->canAccess("classes/delete");
$pageTitle = "Class Details"; //set dynamic page title
$rec_id =  request()->route('rec_id');
$students = App\Models\StudentDetails::where('class_id', $rec_id)->orderBy('lastname', 'ASC')->get();
//dd($students);
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
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
                            <div class="h5 font-weight-bold text-primary"> <?php echo  $data['name']; ?> Class</div>
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
                <div class="col comp-grid ">

                    <div class=" page-content">

                    </div>

                    <table class="table table-hover table-striped table-sm text-left">
                        <thead class="table-header ">
                            <tr>


                                <th class="td-btn">SN</th>
                                <th class="td-is_active"> Full Name</th>
                                <th class="td-is_active"> View Report</th>

                                <th class="td-updated_by"> </th>

                            </tr>
                        </thead>

                        <tbody class="page-data">
                            <!--record-->
                            <?php
                            $counter = 0;
                            foreach ($students as $student) {
                                $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                $counter++;
                            ?>
                                <tr>


                                    <td class="td-name">
                                        {{ $counter }}
                                    </td>
                                    <td class="td-is_active">
                                        {{$student->firstname}} {{$student->lastname}}
                                    </td>
                                    <td class="td-updated_at">
                                        <a
                                            href="<?php print_link("/classes/student_repport/$student[user_id]?class_id=$rec_id") ?>" target="_blank"> Print </a>
                                    </td>
                                    <td class="td-updated_by">

                                    </td>
                                    <!--PageComponentEnd-->
                                    <td class="td-btn">

                                    </td>
                                </tr>
                            <?php } ?>
                            <!--endrecord-->
                        </tbody>
                        <tbody class="search-data"></tbody>

                        <tbody class="page-data">

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection