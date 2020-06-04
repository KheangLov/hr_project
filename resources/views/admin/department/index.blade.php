@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header text-nowrap">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Department List</h2>
            </div>
            <div class="col-sm-6">
                <div class="p-2">
                    <input type="text" class="form-control" id="department_search" placeholder="Search...">
                </div>
                <div class="w-100 text-right">
                    <a class="btn btn-primary m-2" type="button" data-toggle="modal" data-target="#form_add_department">
                        <i class="fas fa-plus mr-1"></i>
                        Add Department
                    </a>
                </div>
                @include('admin.department.share.form', ['type' => 'add'])
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="department_table">
            @include('admin.department.share.table')
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="d-xl-none d-lg-none d-md-none d-sm-block">
            {{ $departments->links('share.paginate') }}
        </div>
        <div class="d-none d-md-block">
            {{ $departments->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
