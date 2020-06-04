<table class="table custom-table text-nowrap text-truncate">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Department</th>
            <th scope="col" style="width: 5%;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @php($i = 0)
        @php($no = $units->currentPage() - 1 !== 0 ? strval($units->currentPage() - 1) : '')
        @foreach ($units as $unit)
            <tr>
                @php($i++)
                @if ($i === 10)
                    @php($i = 0)
                    @php($no = $units->currentPage())
                @endif
                <th scope="row">{{ $no . $i }}</th>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->department->name }}</td>
                <td>
                    <div class="d-flex">
                        <a type="button" class="btn-action btn-edit unit_edit" data-id="{{ $unit->id }}" data-toggle="tooltip" data-placement="bottom" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 h-5 w-5 mr-3 hover:text-primary cursor-pointer">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </a>
                        <div id="unit_edit_modal"></div>
                        <div class="d-inline" data-toggle="tooltip" data-placement="bottom" title="Delete">
                            <button type="button" class="btn-action btn-del p-0" data-toggle="modal" data-target="#btn_delete_unit_{{ $unit->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 h-5 w-5 hover:text-danger cursor-pointer">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="modal fade custom-modal" id="btn_delete_unit_{{ $unit->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Confirm dialog</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this unit?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">{{ __('Cancel') }}</button>
                                        <a href="{{ route('unit_delete', ['id' => $unit->id]) }}" class="btn btn-primary btn-reg">
                                            Yes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
