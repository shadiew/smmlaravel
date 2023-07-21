@extends($theme.'layouts.app')
@section('title',trans('Reset Password'))

@section('content')
<!-- Reset -->
<section class="login-section">
    <div class="container">
        <div class="row g-lg-0 gy-5 align-items-center justify-content-center">
            <div class="col-lg-6">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                        {{ trans(session('status')) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{route('password.update')}}" class="form-content w-100">
                    @csrf
                    @error('token')
                        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                            {{ trans($message) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    <div class="row g-3">
                        <div class="col-12">
                            <h4>@lang('Reset Password')</h4>
                        </div>

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="input-box col-12">
                            <input class="form-control" type="password" name="password" placeholder="@lang('New Password')">
                            @error('password')
                                <p class="text-danger mt-1">@lang($message)</p>
                            @enderror
                        </div>
                        <div class="input-box col-12">
                            <input class="form-control" type="password" name="password_confirmation" placeholder="@lang('Confirm Password')">
                        </div>
                    </div>

                    <button type="submit" class="btn-smm mt-4">@lang('Reset Password')</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /Reset -->
@endsection
