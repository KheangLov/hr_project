<div id="user_detail_dialog"></div>
<table class="table custom-table text-nowrap text-truncate">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Avatar</th>
            <th scope="col">Name Khmer</th>
            <th scope="col">Username</th>
            <th scope="col">Gender</th>
            <th scope="col">Position</th>
            <th scope="col">Department</th>
            <th scope="col">Status</th>
            <th scope="col">Email</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Role</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @php($i = 0)
        @php($no = $users->currentPage() - 1 !== 0 ? strval($users->currentPage() - 1) : '')
        @foreach ($users as $user)
            <tr>
                @php($i++)
                @if ($i === 10)
                    @php($i = 0)
                    @php($no = $users->currentPage())
                @endif
                <th scope="row">{{ $no . $i }}</th>
                <td>
                    <div class="list-avatar">
                        <div class="spinner-border text-light spinner-border-sm d-none" role="status" id="avatar_spinner_{{ $user->id }}" style="transition: all ease-in-out 0.2s;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <a class="avatar-link view_user_detail" data-id="{{ $user->id }}" data-toggle="tooltip" data-placement="top" title="View">
                            <div class="avatar" style="background-image: url('{{ asset($user->profile ? $user->profile : 'images/avatar_profile_user_music_headphones_shirt_cool-512.png') }}');"></div>
                        </a>
                    </div>
                </td>
                <td class="text-nowrap text-truncate">{{ $user->name_khmer }}</td>
                <td class="text-nowrap text-truncate">{{ $user->name }}</td>
                <td class="text-nowrap text-truncate">{{ $user->gender }}</td>
                <td>{{ $user->position->name }}</td>
                <td>{{ $user->department->name }}</td>
                <td>{!! $user->status == 1 ? "<span class=\"text-success\">Still Working</span>" : "<span class=\"text-danger\">Stop Working</span>" !!}</td>
                @if ($user->email_verified_at !== null)
                    <td>{{ $user->email }}</td>
                @else
                    <td class="text-warning" data-toggle="tooltip" data-placement="bottom" title="Email haven't verified!">
                        {{ $user->email }}
                    </td>
                @endif
                <td>{{ $user->start_date }}</td>
                <td>{{ $user->end_date ?? 'Still working' }}</td>
                <td>{{ $user->role->name }}</td>
                <td>
                    <div class="d-flex">
                        <div class="spinner-border text-light spinner-border-sm mr-3 d-none" role="status" id="spinner_{{ $user->id }}" style="transition: all ease-in-out 0.2s;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <a type="button" class="btn-action btn-edit user_edit" data-id="{{ $user->id }}" data-toggle="tooltip" data-placement="bottom" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 h-5 w-5 mr-3 hover:text-primary cursor-pointer">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </a>
                        <a type="button" class="btn-action btn-edit user_password" data-id="{{ $user->id }}" data-toggle="tooltip" data-placement="bottom" title="Change Password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings mr-3"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        </a>
                        <div id="user_edit_modal"></div>
                        <div id="user_password_modal"></div>
                        @if (Auth::user()->id !== $user->id)
                            <div class="d-inline" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                <button type="button" class="btn-action btn-del p-0" data-toggle="modal" data-target="#btn_delete_user_{{ $user->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 h-5 w-5 hover:text-danger cursor-pointer">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal fade custom-modal" id="btn_delete_user_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Confirm dialog</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this user?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">{{ __('Cancel') }}</button>
                                            <a href="{{ route('user_delete', ['id' => $user->id]) }}" class="btn btn-primary btn-reg">
                                                Yes
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
