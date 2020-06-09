@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header text-nowrap">
        <div class="row">
            <div class="col-md-6">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Attendance Clicked</h2>
            </div>
            <div class="col-md-6">
                <select name="status_filter" id="status_filter_click" class="form-control">
                    <option value="*">Filter by status</option>
                    <option value="0">Late</option>
                    <option value="1">Early</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="leave_table">
            <table class="table custom-table text-nowrap text-truncate">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Real Time In</th>
                        <th scope="col">Real Time Out</th>
                        <th scope="col">Total Time</th>
                        <th scope="col">Staff Note</th>
                        <th scope="col">HR Note</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="width: 5%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($clicked) > 0)
                        @php($i = 0)
                        @foreach ($clicked as $click)
                            <tr>
                                @php($i++)
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $click->name }}</td>
                                <td>{{ $click->date }}</td>
                                <td>{{ $click->real_time_in }}</td>
                                <td>{{ $click->real_time_out }}</td>
                                <td>{{ $click->total_time }}</td>
                                <td>{{ $click->staff_note }}</td>
                                <td>{{ $click->hr_note }}</td>
                                <td>{!! $click->status == 0 ? '<span class="text-warning">Late</span>' : ($leave_list->status < 0 ? '<span class="text-danger">Not Come</span>' : ($leave_list->status == 1 ? '<span class="text-info">Early</span>' : '')) !!}</td>
                                <td>
                                    @if (Auth::user()->role_id == 1 && $click->hr_note == null)
                                        <a type="button" class="btn btn-primary btn_hr_note">
                                            HR Note
                                        </a>
                                        <div class="modal custom-modal fade" id="form_hr_note" tabindex="-1" role="dialog" aria-labelledby="form_hr_note" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form action="{{ route('hr_note', ['id' => $click->id]) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-content text-white">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title font-weight-bold text-truncate text-capitalize">HR Note</h2>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="hr_note">Comment:</label>
                                                            <textarea class="form-control" name="hr_note" id="hr_note" cols="3" rows="5"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">
                                <span>No data!</span>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
