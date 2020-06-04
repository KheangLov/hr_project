<div class="modal custom-modal fade" id="form_{{ $type }}_unit" tabindex="-1" role="dialog" aria-labelledby="form_{{ $type }}_unit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="{{ $type == 'edit' && !empty($unit) ? '/admin/unit/update/' . $unit->id : '/admin/unit/create' }}" method="POST">
            @if ($type == 'edit' && !empty($unit))
                @method('PUT')
            @endif
            @csrf
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h2 class="modal-title font-weight-bold text-truncate text-capitalize">{{ $type }} unit</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="{{ $type }}_name">Name</label>
                    <input type="text" class="form-control mb-3" id="{{ $type }}_name" name="name"{{ !empty($unit) ? " value=$unit->name" : '' }}>
                    <label for="{{ $type }}_department">Department</label>
                    <select class="form-control mb-3" id="{{ $type }}_department" name="department">
                        <option value="0">Please select a department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" class="text-capitalize"{{ !empty($unit) && $unit->department_id == $department->id ? ' selected' : '' }}>
                                {{ $department->name }}
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
