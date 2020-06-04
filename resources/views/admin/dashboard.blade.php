@extends('layouts.admin')

@section('content')
@if ($message = Session::get('logged_user'))
    <div class="card card-custom bg-color text-center">
        <div class="card-header">
            <span class="icon-congrate">
                <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award h-8 w-8">
                    <circle cx="12" cy="8" r="7"></circle>
                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                </svg>
            </span>
        </div>
        <div class="card-body">
            <h2 class="card-title">Welcome user {{ $message->name }}!</strong></h2>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
    </div>
@endif
<div class="row">
    <div class="col mb-4">
        <div class="card card-custom bg-color" style="border-radius: 0.25rem;">
            <div class="card-header">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Summary data</h2>
            </div>
            <div class="card-body">
                <div class="d-flex mb-2">
                    <span>All members</span>
                    <span class="ml-auto">{{ $count_all }}</span>
                </div>
                <div class="d-flex mb-2">
                    <span>Male</span>
                    <span class="ml-auto">{{ $count_male }}</span>
                </div>
                <div class="d-flex mb-2">
                    <span>Female</span>
                    <span class="ml-auto">{{ $count_female }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <a href="{{ route(Auth::user()->role->name == 'admin' ? 'user_list' : 'staff_list') }}" class="card card-custom bg-color" style="border-radius: 0.25rem;">
            <div class="card-header">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Staff Board</h2>
            </div>
            <div class="card-body">
                <notification-component :userid="{{ Auth::user()->id }}" :notifications="{{ Auth::user()->notifications }}" :unreads="{{ Auth::user()->unreadNotifications }}"></notification-component>
            </div>
        </a>
    </div>
    {{-- <div class="col mb-4">
        <a href="{{ route('user_list') }}"  class="card card-custom bg-color" style="border-radius: 0.25rem;">
            <div class="card-header">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Attendance</h2>
            </div>
            <div class="card-body">
            </div>
        </a>
    </div> --}}
    {{-- <div class="col mb-4">
        <div class="card card-custom bg-color" style="border-radius: 0.25rem;">
            <div class="card-header">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Carreer Log</h2>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div> --}}
    {{-- @if (Auth::user()->role->name != 'admin')
        <div class="col mb-4">
            <div class="card card-custom bg-color" style="border-radius: 0.25rem;">
                <div class="card-header">
                    <h2 class="p-2 w-100 bd-highlight text-truncate">Click Attendance</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary">Start work</button>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-danger">Exit work</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}
</div>
@endsection
