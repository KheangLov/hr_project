@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header text-nowrap">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Group List</h2>
            </div>
            <div class="col-sm-6">
                <div class="p-2">
                    <input type="text" class="form-control" id="group_search" placeholder="Search...">
                </div>
                <div class="w-100 text-right">
                    <a class="btn btn-primary m-2" type="button" data-toggle="modal" data-target="#form_add_group">
                        <i class="fas fa-plus mr-1"></i>
                        Add Group
                    </a>
                </div>
                @include('admin.group.share.form', ['type' => 'add'])
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="group_table">
            @include('admin.group.share.table')
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="d-xl-none d-lg-none d-md-none d-sm-block">
            {{ $groups->links('share.paginate') }}
        </div>
        <div class="d-none d-md-block">
            {{ $groups->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
