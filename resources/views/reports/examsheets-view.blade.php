
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Exam Sheet Details</h1></div>
<table class="table table-sm table-striped">
    <tbody>
        <tr>
            <th>Id</th>
            <td>{{ $record->id }}</td>
        </tr>
        <tr>
            <th>Session Id</th>
            <td>{{ $record->session_id }}</td>
        </tr>
        <tr>
            <th>Term Id</th>
            <td>{{ $record->term_id }}</td>
        </tr>
        <tr>
            <th>Student</th>
            <td>{{ $record->user_id }}</td>
        </tr>
        <tr>
            <th>Present Count</th>
            <td>{{ $record->present_count }}</td>
        </tr>
        <tr>
            <th>Open Count</th>
            <td>{{ $record->open_count }}</td>
        </tr>
        <tr>
            <th>Resume On</th>
            <td>{{ $record->resume_on }}</td>
        </tr>
        <tr>
            <th>Teacher Remark</th>
            <td>{{ $record->teacher_remark }}</td>
        </tr>
        <tr>
            <th>Director Comment</th>
            <td>{{ $record->director_comment }}</td>
        </tr>
        <tr>
            <th>Total Score</th>
            <td>{{ $record->total_score }}</td>
        </tr>
        <tr>
            <th>Director Approval</th>
            <td>{{ $record->director_approval }}</td>
        </tr>
        <tr>
            <th>Updated By</th>
            <td>{{ $record->updated_by }}</td>
        </tr>
        <tr>
            <th>Class Id</th>
            <td>{{ $record->class_id }}</td>
        </tr>
    </tbody>
</table>
@endsection
