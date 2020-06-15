<div class="modal custom-modal fade" id="form{{ !empty($type) ? '_' . $type : '' }}_password" tabindex="-1" role="dialog" aria-labelledby="form{{ !empty($type) ? '_' . $type : '' }}_password" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="{{ route('user_password', ['id' => Auth::user()->id]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="modal-content text-white">
                <div class="modal-header">
                    <h2 class="modal-title font-weight-bold text-truncate text-capitalize">Change Password</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        @if (empty($type) || $type != 'user')
                            <div class="form-group col-md-12">
                                <label for="old_password">{{ __('Old Password') }}</label>
                                <input id="old_password" type="password" class="form-control @error('old-password') is-invalid @enderror" name="old_password" required autocomplete="old-password">

                                @error('old-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
                        @if (!empty($type) && $type == 'user')

                        @endif
                        <div class="form-group col-md-12">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
            </div>
        </form>
    </div>
</div>
