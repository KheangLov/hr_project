<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user_id" content="{{ Auth::check() ? Auth::user()->id : '' }}">

    <title>{{ config('app.name', 'Laravel Admin') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div id="loading_page">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
            </div>
        </div>
    </div>
    <div id="admin" class="d-none">

        <aside id="sidebar" class="sidebar">
            <a href="{{ route('admin_dashboard') }}" class="sidebar-header">
                <span id="side-header" class="header-title font-weight-bolder">{{ config('app.name', 'Laravel Admin') }}</span>
            </a>
            <a href="{{ route('admin_dashboard') }}" class="sidebar-link">
                <div class="inner-link{{ (request()->is('admin')) ? ' active' : '' }}">
                    <span class="link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                    <span class="link-text">Dashboard</span>
                </div>
            </a>
            <a href="{{ route(Auth::user()->role_id == 1 ? 'user_list' : 'staff_list') }}" class="sidebar-link">
                <div class="inner-link{{ (request()->is('admin/user') || request()->is('admin/user/*') || request()->is('admin/staff') || request()->is('admin/staff/*'))  ? ' active' : '' }}">
                    <span class="link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user ">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <span class="link-text">Staff</span>
                </div>
            </a>
            <a href="{{ route('staff_my_leave') }}" class="sidebar-link">
                <div class="inner-link{{ (request()->is('admin/attendance') || request()->is('admin/attendance/*')) ? ' active' : '' }}">
                    <span class="link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar "><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </span>
                    <span class="link-text">Attendance</span>
                </div>
            </a>
        </aside>
        <div class="main-wrapper">
            <div class="modal custom-modal fade" id="user_info_dialog" tabindex="-1" role="dialog" aria-labelledby="user_info_dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content text-white">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold text-truncate text-capitalize">User Information</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="profile-upload text-center mb-4">
                                <div class="profile-overlay">
                                    <div class="profile-pic" id="profile_bg_image_detail" style="background-image: url('{{ asset(Auth::user()->profile ? Auth::user()->profile : 'images/avatar_profile_user_music_headphones_shirt_cool-512.png') }}');"></div>
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
                                                <div class="font-weight-bold">{{ Auth::user()->name_khmer }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Gender
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->gender }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Status
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->status === 1 ? 'Working' : 'Quit' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Name
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->name }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Date of birth
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->dob }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    ID Card
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">
                                                    @if (!empty(Auth::user()->id_card))
                                                        <a href="/admin/download/id-card/{{ Auth::user()->id }}" class="btn btn-link p-0 shadow-none">
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
                                                <div class="font-weight-bold">{{ Auth::user()->department->name }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Group
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->group->name }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Position
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->position->name }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Salary
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->salary }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Start Date
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->start_date }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Unit
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->unit->name }}</div>
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
                                                    {{ Auth::user()->annual_leave }}
                                                </div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Bank Account
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->back_account }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    End Date
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">
                                                    {{ Auth::user()->end_date }}
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
                                                <div class="font-weight-bold">{{ Auth::user()->phone }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Email
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->email }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Address
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">{{ Auth::user()->address }}</div>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <div class="font-weight-bold col-name">
                                                    Contact
                                                </div>
                                                <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                <div class="font-weight-bold">
                                                    @if (!empty(Auth::user()->contact))
                                                        <a href="/admin/download/contact/{{ Auth::user()->id }}" class="btn btn-link p-0 shadow-none">
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
                                                    <div class="font-weight-bold">{{ Auth::user()->emer_contact_name }}</div>
                                                </div>
                                                <div class="d-flex mb-3">
                                                    <div class="font-weight-bold col-name">
                                                        Relationship
                                                    </div>
                                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                    <div class="font-weight-bold">{{ Auth::user()->emer_contact_relation }}</div>
                                                </div>
                                                <div class="d-flex mb-3">
                                                    <div class="font-weight-bold col-name">
                                                        Tel
                                                    </div>
                                                    <div class="font-weight-bold mr-5 ml-5 mb-2">:</div>
                                                    <div class="font-weight-bold">
                                                        {{ Auth::user()->emer_contact_phone }}
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
            <nav class="navbar navbar-expand navbar-custom bg-custom text-nowrap">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item mr-3">
                            <a class="nav-link" id="btn_side_collapse" href="#" style="padding: 0 0 0 10px; font-size: 24px;">
                                <i id="btn_side_collapse_icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu "><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                </i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <h2 class="text-white d-none d-md-block">
                                @if (request()->is('admin/user') || request()->is('admin/user/*') || request()->is('admin/staff') || request()->is('admin/staff/*'))
                                    Staff
                                @elseif (request()->is('admin/attendance') || request()->is('admin/attendance/*'))
                                    Attendance
                                @elseif (request()->is('admin'))
                                    Dashboard
                                @endif
                            </h2>
                        </li>
                    </ul>
                    <ul class="navbar-nav" id="app">
                        <li class="nav-item">
                            <div class="current-user text-right">
                                <span class="user-name d-block">
                                    {{ Auth::user()->name }}
                                    <small class="user-status {{ (Auth::user()->status === 1) ? 'text-success' : ((Auth::user()->status === 0) ? 'text-danger' : 'text-warning') }}">
                                        {{ Auth::user()->status === 1 ? 'Working' : 'Quit' }}
                                    </small>
                                </span>
                            </div>
                        </li>
                        <li class="nav-item dropdown custom-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="overlay-profile">
                                    <div class="profile" style="background-image: url('{{ asset(Auth::user()->profile ? Auth::user()->profile : 'images/avatar_profile_user_music_headphones_shirt_cool-512.png') }}');"></div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right custom-dropdown-menu" aria-labelledby="userDropDown">
                                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#user_info_dialog">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-4 h-4">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="ml-1">Profile</span>
                                </a>
                                <a type="button" class="dropdown-item" data-toggle="modal" data-target="#form_password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    <span class="ml-1">Change Password</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out w-4 h-4">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ml-1">{{ __('Logout') }}</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            @include('admin.user.share.password')
            @if (Auth::user()->role_id == 1 && !request()->is('admin') && !request()->is('admin/attendance') && !request()->is('admin/attendance/*'))
                <nav class="menu-tabs">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a href="{{ route('user_list') }}" class="nav-item nav-link{{ request()->is('admin/user') || request()->is('admin/user/*') ? ' active' : '' }}">Staff Board</a>
                        <a href="{{ route('department_list') }}" class="nav-item nav-link{{ request()->is('admin/department') || request()->is('admin/department/*') ? ' active' : '' }}">Department</a>
                        <a href="{{ route('unit_list') }}" class="nav-item nav-link{{ request()->is('admin/unit') || request()->is('admin/unit/*') ? ' active' : '' }}">Unit</a>
                        <a href="{{ route('group_list') }}" class="nav-item nav-link{{ request()->is('admin/group') || request()->is('admin/group/*') ? ' active' : '' }}">Group</a>
                        <a href="{{ route('position_list') }}" class="nav-item nav-link{{ request()->is('admin/position') || request()->is('admin/position/*') ? ' active' : '' }}">Position</a>
                    </div>
                </nav>
            @elseif ((request()->is('admin/attendance') || request()->is('admin/attendance/*')) && Auth::user()->role_id != 1)
                <nav class="menu-tabs">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a href="{{ route('staff_my_leave') }}" class="nav-item nav-link{{ request()->is('admin/attendance') || request()->is('admin/attendance/my-leave') ? ' active' : '' }}">My Leave</a>
                        @if (!Auth::user()->supervisor_id)
                            <a href="{{ route('staff_leave_team') }}" class="nav-item nav-link{{ request()->is('admin/attendance') || request()->is('admin/attendance/team/*') ? ' active' : '' }}">Team Leave List</a>
                        @endif
                    </div>
                </nav>
            @elseif ((request()->is('admin/attendance') || request()->is('admin/attendance/*')) && Auth::user()->role_id == 1)
                <nav class="menu-tabs">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a href="{{ route('staff_leave_list') }}" class="nav-item nav-link{{ request()->is('admin/attendance') || request()->is('admin/attendance/*') ? ' active' : '' }}">Staff Leave List</a>
                    </div>
                </nav>
            @endif
            @yield('content')
            <footer id="footer">
                <div class="text-white-50 mt-4 text-nowrap">
                    © <span id="cpyr_year"></span>, Made with
                    <div class="d-inline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart stroke-current text-danger w-6 h-6" style="vertical-align: top;">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </div>
                    by KHEANG
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('sweet::alert')
</body>
</html>
