<div class="modal custom-modal fade" id="form_{{ $type }}_user" tabindex="-1" role="dialog" aria-labelledby="form_{{ $type }}_user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <form action="{{ $type == 'edit' && !empty($user) ? '/admin/user/update/' . $user->id : '/admin/user/create' }}" method="POST" enctype="multipart/form-data">
            @if ($type == 'edit' && !empty($user))
                @method('PUT')
            @endif
            @csrf
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h2 class="modal-title font-weight-bold text-truncate text-capitalize">{{ $type }} Staff</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="profile-upload text-center mb-4">
                        <div class="profile-overlay">
                            <div class="profile-pic" id="profile_bg_image_{{ $type }}" style="background-image: url('{{ asset(!empty($user) && $user->profile ? $user->profile : 'images/avatar_profile_user_music_headphones_shirt_cool-512.png') }}');"></div>
                            <button type="button" class="btn btn-primary btn-profile-upload btn_profile_{{ $type }}" id="btn_profile_{{ $type }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-4 h-4">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </button>
                            <input type="file" name="profile" id="profile_{{ $type }}" class="d-none profile_{{ $type }}"{{ !empty($user) ? " value=$user->profile" : '' }}>
                        </div>
                    </div>
                    <div class="border rounded p-3 mb-3">
                        <h3 class="text-white text-truncate mb-4 font-weight-bold">Personal Information</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="{{ $type }}_name_khmer">Name Khmer</label>
                                <input type="text" class="form-control" id="{{ $type }}_name_khmer" name="name_khmer"{{ !empty($user) ? " value=$user->name_khmer" : '' }}>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="{{ $type }}_name">Name</label>
                                <input type="text" class="form-control" id="{{ $type }}_name" name="name"{{ !empty($user) ? " value=$user->name" : '' }}>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_gender">Gender</label>
                                <select name="gender" class="form-control" id="{{ $type }}_gender">
                                    <option value="male"{{ !empty($user) && $user->gender == 'male' ? ' selected' : '' }}>Male</option>
                                    <option value="female"{{ !empty($user) && $user->gender == 'female' ? ' selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_dob">Date of Birth</label>
                                <input type="date" name="dob" id="{{ $type }}_dob" class="form-control"{{ !empty($user) ? " value=$user->dob" : '' }}>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_status">Status</label>
                                <select name="status" class="form-control" id="{{ $type }}_status">
                                    <option value="0"{{ !empty($user) && $user->status == 0 ? ' selected' : '' }}>Quit</option>
                                    <option value="1"{{ !empty($user) && $user->status == 1 ? ' selected' : '' }}>Working</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_id_card">ID Card</label>
                                <div class="custom-file d-block">
                                    <input type="file" class="custom-file-input form-control" name="id_card" id="{{ $type }}_id_card" aria-describedby="{{ $type }}_id_card"{{ !empty($user) ? " value=$user->id_card" : '' }}>
                                    <label class="custom-file-label" for="{{ $type }}_id_card" style="background-color: #262c49; color: #fff; border-color: #262c49; border-radius: 6px;">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border rounded p-3 mb-3">
                        <h3 class="text-white text-truncate mb-4 font-weight-bold">Work Information</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="{{ $type }}_department">Department</label>
                                <select name="department" id="{{ $type }}_department" class="form-control department">
                                    <option value="0">Please select a department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" class="text-capitalize"{{ !empty($user) && $user->department_id == $department->id ? ' selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="{{ $type }}_unit">Unit</label>
                                <select name="unit" id="{{ $type }}_unit" class="form-control unit"{{ empty($user) ? ' disabled' : '' }}>
                                    @if (empty($user))
                                        <option value=""></option>
                                    @else
                                        <option value="0">Please select a unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" class="text-capitalize"{{ !empty($user) && $user->unit_id == $unit->id ? ' selected' : '' }}>
                                                {{ $unit->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_group">Group</label>
                                <select name="group" id="{{ $type }}_group" class="form-control group"{{ empty($user) ? ' disabled' : '' }}>
                                    @if (empty($user))
                                        <option value=""></option>
                                    @else
                                        <option value="0">Please select a group</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}" class="text-capitalize"{{ !empty($user) && $user->group_id == $group->id ? ' selected' : '' }}>
                                                {{ $group->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_supervisor">Supervisor</label>
                                <select name="supervisor" id="{{ $type }}_supervisor" class="form-control supervisor">
                                    <option value="0">Please select a supervisor</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}" class="text-capitalize"{{ !empty($user) && $user->supervisor_id == $supervisor->id ? ' selected' : '' }}>
                                            {{ $supervisor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_position">Position</label>
                                <select name="position" class="form-control position" id="{{ $type }}_position">
                                    <option value="0">Please select a position</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}" class="text-capitalize"{{ !empty($user) && $user->position_id == $position->id ? ' selected' : '' }}>
                                            {{ $position->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_annual_leave">Annual Leave</label>
                                <input type="number" class="form-control" name="annual_leave" id="{{ $type }}_annual_leave"{{ !empty($user) ? " value=$user->annual_leave" : '' }}>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_salary">Salary</label>
                                <input type="number" name="salary" id="{{ $type }}_salary" class="form-control"{{ !empty($user) ? " value=$user->salary" : '' }}>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_bank_account">Bank Account</label>
                                <input type="number" name="bank_account" id="{{ $type }}_bank_account" class="form-control"{{ !empty($user) ? " value=$user->back_account" : '' }}>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="{{ $type }}_start_date"{{ !empty($user) ? " value=$user->start_date" : '' }}>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="{{ $type }}_end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="{{ $type }}_end_date"{{ !empty($user) ? " value=$user->end_date" : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="border rounded p-3 mb-3">
                        <h3 class="text-white text-truncate mb-4 font-weight-bold">Contact Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="{{ $type }}_phone">Tel</label>
                                        <input type="number" name="phone" id="{{ $type }}_phone" class="form-control"{{ !empty($user) ? " value=$user->phone" : '' }}>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="{{ $type }}_email">Email</label>
                                        <input type="email" name="email" id="{{ $type }}_email" class="form-control"{{ !empty($user) ? " value=$user->email" : '' }}>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="{{ $type }}_address">Address</label>
                                        <input type="text" name="address" id="{{ $type }}_address" class="form-control"{{ !empty($user) ? " value=$user->address" : '' }}>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="{{ $type }}_contact">Contact</label>
                                        <div class="custom-file d-block">
                                            <input type="file" class="custom-file-input form-control" name="contact" id="{{ $type }}_contact" aria-describedby="{{ $type }}_contact"{{ !empty($user) ? " value=$user->contact" : '' }}>
                                            <label class="custom-file-label" for="{{ $type }}_contact" style="background-color: #262c49; color: #fff; border-color: #262c49; border-radius: 6px;">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-white text-truncate">Emergency Contact</h4>
                                <div class="border rounded p-3">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="{{ $type }}_contact_name">Contact Name</label>
                                            <input type="text" name="contact_name" id="{{ $type }}_contact_name" class="form-control"{{ !empty($user) ? " value=$user->emer_contact_name" : '' }}>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="{{ $type }}_relationship">Relationship</label>
                                            <input type="text" name="relationship" id="{{ $type }}_relationship" class="form-control"{{ !empty($user) ? " value=$user->emer_contact_relation" : '' }}>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="{{ $type }}_contact_tel">Tel</label>
                                            <input type="text" name="contact_tel" id="{{ $type }}_contact_tel" class="form-control"{{ !empty($user) ? " value=$user->emer_contact_phone" : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $type == 'edit' ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
