<div class="modal custom-modal fade" id="form_{{ $type }}_leave" tabindex="-1" role="dialog" aria-labelledby="form_{{ $type }}_leave" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/admin/attendance/leave" method="POST">
            @csrf
            <input type="hidden" name="leave_type" value="{{ strtolower($type) === 'urgent' ? 0 : 1 }}">
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h2 class="modal-title font-weight-bold text-truncate text-capitalize">{{ $type }} Leave</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Remaining Leave Days : {{ Auth::user()->annual_leave }}</label>
                    <div class="row">
                        <div class="col-md-{{ strtolower($type) === 'plan' ? '4' : '6' }}">
                            <div class="form-group">
                                <input type="date" class="form-control" id="{{ $type }}_request_date" name="request_date" data-toggle="tooltip" data-placement="bottom" title="Leave date"{{ !empty($attendance) ? " value=$attendance->request_date" : '' }}>
                            </div>
                        </div>
                        <div class="col-md-{{ strtolower($type) === 'plan' ? '4' : '6' }}">
                            <div class="form-group">
                                <select name="leave_time" id="leave_time" class="form-control">
                                    <option value="">Leave time</option>
                                    <option value="0"{{ !empty($attendance) && $attendance->leave_time == 0 ? ' selected' : '' }}>Full</option>
                                    <option value="1"{{ !empty($attendance) && $attendance->leave_time == 1 ? ' selected' : '' }}>AM</option>
                                    <option value="2"{{ !empty($attendance) && $attendance->leave_time == 2 ? ' selected' : '' }}>PM</option>
                                </select>
                            </div>
                        </div>
                        @if (strtolower($type) === 'plan')
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="{{ $type }}_back_date" name="back_date" data-toggle="tooltip" data-placement="bottom" title="Back date"{{ !empty($attendance) ? " value=$attendance->back_date" : '' }}>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea name="reason" class="form-control" id="reason" cols="5" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
