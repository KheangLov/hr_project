@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header text-nowrap">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Staff List</h2>
            </div>
            <div class="col-sm-6">
                <div class="p-2">
                    <input type="text" class="form-control" id="user_search" placeholder="Search...">
                </div>
                <div class="w-100 text-right">
                    <a class="btn btn-primary m-2" type="button" data-toggle="modal" data-target="#form_add_user">
                        <i class="fas fa-plus mr-1"></i>
                        Add Staff
                    </a>
                </div>
                @include('admin.user.share.form', ['type' => 'add'])
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="user_table">
            @include('admin.user.share.table')
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="d-xl-none d-lg-none d-md-none d-sm-block">
            {{ $users->links('share.paginate') }}
        </div>
        <div class="d-none d-md-block">
            {{ $users->onEachSide(1)->links() }}
        </div>
    </div>
</div>

<div>
    <label for="phone">Price</label>
    <input type="number" pattern="[0-9]*" data-politespace data-grouplength="3" data-delimiter="," data-reverse value="1234" />
</div>
@endsection
