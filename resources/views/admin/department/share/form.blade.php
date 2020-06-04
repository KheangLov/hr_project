<div class="modal custom-modal fade" id="form_{{ $type }}_department" tabindex="-1" role="dialog" aria-labelledby="form_{{ $type }}_department" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ $type == 'edit' && !empty($department) ? '/admin/department/update/' . $department->id : '/admin/department/create' }}" method="POST">
            @if ($type == 'edit' && !empty($department))
                @method('PUT')
            @endif
            @csrf
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h2 class="modal-title font-weight-bold text-truncate text-capitalize">{{ $type }} Department</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="{{ $type }}_name">Name</label>
                    <input type="text" class="form-control" id="{{ $type }}_name" name="name"{{ !empty($department) ? " value=$department->name" : '' }}>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $type == 'edit' ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
