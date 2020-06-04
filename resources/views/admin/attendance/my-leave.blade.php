@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header text-nowrap mr-4 ml-4" style="overflow-x: scroll;">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="p-2 w-100 bd-highlight text-truncate">User Information</h2>
                <div class="border p-3 mr-4" style="border-radius: 0.5rem; min-width: 435px;">
                    <div class="d-flex mb-3">
                        <div class="font-weight-bold col-name col-att">
                            #
                        </div>
                        <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                        <div class="font-weight-bold">{{ Auth::user()->id }}</div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="font-weight-bold col-name col-att">
                            Name
                        </div>
                        <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                        <div class="font-weight-bold text-capitalize">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="font-weight-bold col-name col-att">
                            First Approver
                        </div>
                        <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                        <div class="font-weight-bold text-capitalize">{{ !empty($supervisor) ? $supervisor->name : '' }}</div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="font-weight-bold col-name col-att">
                            Second Approver
                        </div>
                        <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                        <div class="font-weight-bold text-capitalize">{{ !empty($admin) ? $admin->name : '' }}</div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="font-weight-bold col-name col-att">
                            Remaining Leave
                        </div>
                        <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                        <div class="font-weight-bold text-capitalize">{{ Auth::user()->annual_leave }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="w-100 text-right mb-2">
                    <a class="btn btn-primary m-2" type="button" data-type="urgent" id="leave_urgent">
                        <i class="fas fa-plus mr-1"></i>
                        Urgent
                    </a>
                    <a class="btn btn-primary m-2" type="button" data-type="plan" id="leave_plan">
                        <i class="fas fa-plus mr-1"></i>
                        Plan
                    </a>
                </div>
                <div id="leave_dialog"></div>
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
