<table class="table custom-table text-nowrap text-truncate">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Submit Date</th>
            <th scope="col">Request Date</th>
            <th scope="col">Back Date</th>
            <th scope="col">Leave Time</th>
            <th scope="col">Total Leave Date</th>
            <th scope="col">Leave Type</th>
            <th scope="col">Status</th>
            <th scope="col">Reason</th>
            <th scope="col" style="width: 5%;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if (count($leave_lists) > 0)
            @php($i = 0)
            @foreach ($leave_lists as $leave_list)
                <tr>
                    @php($i++)
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $leave_list->user->name }}</td>
                    <td>{{ $leave_list->created_at }}</td>
                    <td>{{ $leave_list->request_date }}</td>
                    <td>{{ $leave_list->back_date }}</td>
                    <td>{{ $leave_list->leave_time == 1 ? 'AM' : ($leave_list->leave_time == 2 ? 'PM' : 'FULL') }}</td>
                    <td>{{ $leave_list->total_leave_date }}</td>
                    <td>{{ $leave_list->leave_type == 1 ? 'Plan' : 'Urgent'  }}</td>
                    <td>{!! $leave_list->status == 0 ? '<span class="text-warning">Waiting</span>' : ($leave_list->status < 0 ? '<span class="text-danger">Disapproved</span>' : ($leave_list->status == 1 ? '<span class="text-info">First Approved</span>' : ($leave_list->status == 2 ? '<span class="text-success">Second Approved</span>' : '<span class="text-success">Approved</span>'))) !!}</td>
                    <td>{{ $leave_list->reason }}</td>
                    <td>
                        @if (Auth::user()->id != $leave_list->user_id && $leave_list->status != -1)
                            <div class="d-flex">
                                @if ((Auth::user()->role_id == 1 || $leave_list->status == 0) && $leave_list->status != 2)
                                    <a type="button" class="btn btn-primary leave_list_edit{{ Auth::user()->role_id == 1 && $leave_list->status == 0 ? ' disabled' : '' }}" data-toggle="modal" data-target="#comment_dialog_{{ $leave_list->id }}">
                                        Approved / Disapproved
                                    </a>
                                @endif
                                <div class="modal custom-modal" tabindex="-1" role="dialog" id="comment_dialog_{{ $leave_list->id }}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="/admin/attendance/approval" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Comment</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <textarea class="form-control" name="comment" cols="5" rows="5"></textarea>
                                                    <span class="text-danger" id="comment_message"></span>
                                                    <input type="hidden" value="{{ $leave_list->user_id }}" name="user_id">
                                                    <input type="hidden" value="{{ $leave_list->id }}" name="id">
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-link" value="Disapproved" name="disapprove" />
                                                    @php($lDate = date_create($leave_list->request_date))
                                                    @if (!$current_date->greaterThan($leave_list->request_date) || $current_date->format('Y-m-d') == $lDate->format('Y-m-d'))
                                                        <input type="submit" class="btn btn-primary" id="{{ Auth::user()->role_id == 1 ? 'second_app' : 'first_app' }}_comment" value="Approved" name="approve" />
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">
                    <span>No data!</span>
                </td>
            </tr>
        @endif
    </tbody>
</table>
