@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header text-nowrap">
        <div class="row">
            <div class="col-md-6">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Staff Leave List</h2>
            </div>
            <div class="col-md-6">
                <select name="status_filter" id="status_filter" class="form-control">
                    <option value="*">Filter by status</option>
                    <option value="0">Waiting</option>
                    <option value="1">1st Approved</option>
                    <option value="2">2nd Approved</option>
                    <option value="-1">Disapproved</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="leave_table">
            @include('admin.attendance.share.table')
        </div>
    </div>
</div>
@endsection
