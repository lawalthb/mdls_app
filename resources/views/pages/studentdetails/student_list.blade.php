@extends('layouts.app')
@section('content')
<section class="page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Students List</h4>
                        <div class="d-flex gap-2">
                            <select class="form-select" onchange="window.location.href='{{ url('student-list') }}?class=' + this.value">
                                <option value="">All Classes</option>
                                @php
                                    $classes = App\Models\Classes::where('is_active', 'Yes')->orderBy('name')->get();
                                @endphp
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ request('class') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <form method="GET" action="{{ url('student-list') }}" class="d-flex">
                                <input type="text" name="name" class="form-control" placeholder="Search by name" value="{{ request('name') }}">
                                <button type="submit" class="btn btn-primary ms-1">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($groupBy === 'class')
                            @foreach($records as $class_id => $students)
                                <div class="mb-4">
                                    <h5 class="bg-primary text-white p-2">{{ $students->first()->class_name }}</h5>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>ADM NO.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $index => $student)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>MDLS{{ $student->user_id }}</td>
                                                <td>{{ $student->firstname }} {{ $student->middlemane }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->phone }}</td>
                                                <td>{{ $student->gender }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>ADM NO.</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($records as $index => $student)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>MDLS{{ $student->user_id }}</td>
                                        <td>{{ $student->firstname }} {{ $student->middlemane }}</td>
                                        <td>{{ $student->class_name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->gender }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
