<div class="modal custom-modal fade" id="form_{{ $type }}_position" tabindex="-1" role="dialog" aria-labelledby="form_{{ $type }}_position" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="{{ $type == 'edit' && !empty($position) ? '/admin/position/update/' . $position->id : '/admin/position/create' }}" method="POST">
            @if ($type == 'edit' && !empty($position))
                @method('PUT')
            @endif
            @csrf
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h2 class="modal-title font-weight-bold text-truncate text-capitalize">{{ $type }} position</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="{{ $type }}_name">Name</label>
                    <input type="text" class="form-control mb-3" id="{{ $type }}_name" name="name"{{ !empty($position) ? " value=$position->name" : '' }}>
                    @if ($type == 'edit')
                        <label for="{{ $type }}_role">Role</label>
                        <select class="form-control mb-3" id="{{ $type }}_role" name="role">
                            <option value="0">Please select a unit</option>
                            @for ($i = 1; $i <= $count_position; $i++)
                                <option value="{{ $i }}"{{ $i == $position->role ? ' selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $type == 'edit' ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
