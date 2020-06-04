@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color mb-4" style="border-radius: 0.5rem;">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search_staff" id="search_staff" class="form-control" placeholder="Search...">
            </div>
            <div class="col-md-3">
                <select id="filter_department" class="filter-fields form-control">
                    <option value="0">Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" class="text-capitalize">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="filter_unit" class="filter-fields form-control" disabled>
                    <option value="0">Unit</option>
                    {{-- @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" class="text-capitalize">{{ $unit->name }}</option>
                    @endforeach --}}
                </select>
            </div>
            <div class="col-md-3">
                <select id="filter_group" class="filter-fields form-control" disabled>
                    <option value="0">Group</option>
                    {{-- @foreach ($groups as $group)
                        <option value="{{ $group->id }}" class="text-capitalize">{{ $group->name }}</option>
                    @endforeach --}}
                </select>
            </div>
        </div>
    </div>
</div>

<div class="d-xl-none d-lg-none d-md-none d-sm-block">
    {{ $users->links('share.paginate') }}
</div>
<div class="d-none d-md-block">
    {{ $users->onEachSide(1)->links() }}
</div>

<div id="staff_wrapper">
    @include('admin.user.share.cards')
</div>
@endsection
