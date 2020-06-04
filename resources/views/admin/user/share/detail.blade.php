<div class="modal custom-modal fade" id="form_user_detail" tabindex="-1" role="dialog" aria-labelledby="form_user_detail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content text-white">
            <div class="modal-header">
                <h2 class="modal-title font-weight-bold text-truncate text-capitalize">Staff Information</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="profile-upload text-center mb-4">
                    <div class="profile-overlay">
                        <div class="profile-pic" id="profile_bg_image_detail" style="background-image: url('{{ asset($user->profile ? $user->profile : 'images/avatar_profile_user_music_headphones_shirt_cool-512.png') }}');"></div>
                    </div>
                </div>
                <div class="card card-custom bg-color mb-3">
                    <div class="card-header">
                        <h3 class="text-truncate font-weight-bold">Personal Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Name Khmer
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->name_khmer }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Gender
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->gender }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Status
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->status === 1 ? 'Working' : 'Quit' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Name
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->name }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Date of birth
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->dob }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        ID Card
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">
                                        @if (!empty($user->id_card))
                                            <a href="/admin/download/id-card/{{ $user->id }}" class="btn btn-link p-0 shadow-none">
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-custom bg-color mb-3">
                    <div class="card-header">
                        <h3 class="text-truncate font-weight-bold">Work Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Department
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->department->name }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Group
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->group->name }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Position
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->position->name }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Salary
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->salary }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Start Date
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->start_date }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Unit
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->unit->name }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Supervisor
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ !empty($supervisor) ? $supervisor->name : '' }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Annual Leave
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">
                                        {{ $user->annual_leave }}
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Bank Account
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->back_account }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        End Date
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">
                                        {{ $user->end_date }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-custom bg-color mb-3">
                    <div class="card-header">
                        <h3 class="text-truncate font-weight-bold">Contact Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Tel
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->phone }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Email
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->email }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Address
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">{{ $user->address }}</div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="font-weight-bold col-name">
                                        Contact
                                    </div>
                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                    <div class="font-weight-bold">
                                        @if (!empty($user->contact))
                                            <a href="/admin/download/contact/{{ $user->id }}" class="btn btn-link p-0 shadow-none">
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="text-truncate mb-3">Emergency Contact</h4>
                                <div class="border rounded p-3">
                                    <div class="d-flex mb-3">
                                        <div class="font-weight-bold col-name">
                                            Contact Name
                                        </div>
                                        <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                        <div class="font-weight-bold">{{ $user->emer_contact_name }}</div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="font-weight-bold col-name">
                                            Relationship
                                        </div>
                                        <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                        <div class="font-weight-bold">{{ $user->emer_contact_relation }}</div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="font-weight-bold col-name">
                                            Tel
                                        </div>
                                        <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                        <div class="font-weight-bold">
                                            {{ $user->emer_contact_phone }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
