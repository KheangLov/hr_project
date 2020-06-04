<div class="row">
    @foreach ($users as $user)
        <div class="col-lg-2 col-md-4">
            <div class="card card-custom text-center" style="background: transparent; border: none; box-shadow: none;">
                <div class="profile-overlay">
                    <div class="profile-pic" style="background-image: url('{{ asset($user->profile ? $user->profile : 'images/avatar_profile_user_music_headphones_shirt_cool-512.png') }}');"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-truncate text-white" data-toggle="tooltip" data-placement="bottom" title="{{ $user->name }}">
                        {{ $user->name }}
                    </h5>
                </div>
            </div>
        </div>
    @endforeach
</div>
