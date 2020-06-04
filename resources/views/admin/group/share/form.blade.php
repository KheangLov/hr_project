<div class="modal custom-modal fade" id="form_{{ $type }}_group" tabindex="-1" role="dialog" aria-labelledby="form_{{ $type }}_group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="{{ $type == 'edit' && !empty($group) ? '/admin/group/update/' . $group->id : '/admin/group/create' }}" method="POST">
            @if ($type == 'edit' && !empty($group))
                @method('PUT')
            @endif
            @csrf
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h2 class="modal-title font-weight-bold text-truncate text-capitalize">{{ $type }} group</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="{{ $type }}_name">Name</label>
                    <input type="text" class="form-control mb-3" id="{{ $type }}_name" name="name"{{ !empty($group) ? " value=$group->name" : '' }}>
                    <label for="{{ $type }}_unit">Unit</label>
                    <select class="form-control mb-3" id="{{ $type }}_unit" name="unit">
                        <option value="0">Please select a unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" class="text-capitalize"{{ !empty($group) && $group->unit_id == $unit->id ? ' selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $type == 'edit' ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
