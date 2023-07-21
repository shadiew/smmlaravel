@extends($theme.'layouts.app')
@section('title',trans('Login'))

@section('content')

<!-- LOGIN-SIGNUP -->
<section class="login-section">
    <div class="container">
        <div class="row g-lg-0 gy-5 align-items-center">
            @if(isset($templates['login'][0]) && $content = $templates['login'][0])
            <div class="col-lg-6">
                <div class="text-box no-wrap">
                    <h4>@lang(@$content->description->title)</h4>
                    <p>{!! __($content->description->description) !!}</p>
                </div>
            </div>
            @endif

            <div class="col-lg-6">
                <form method="POST" action="{{ route('login') }}" class="form-content w-100">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <h4>@lang('Login here')</h4>
                        </div>
                        <div class="input-box col-12">
                            <input class="form-control" type="text" name="username" value="{{old('username')}}" placeholder="@lang('Email Or Username')">
                            @error('username')<p class="text-danger mt-1">@lang($message)</p>@enderror
                            @error('email')<p class="text-danger mt-1">@lang($message)</p>@enderror
                        </div>

                        <div class="input-box col-12">
                            <input class="form-control " type="password" name="password" placeholder="@lang('Password')">
                            @error('password')
                                <p class="text-danger mt-1">@lang($message)</p>
                            @enderror
                        </div>


                        @if(basicControl()->reCaptcha_status_login)
                            <div class="col-12 mb-2 input-box">
                                {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                {!! NoCaptcha::display($basic->theme == 'deepblue' || $basic->theme == 'darkmode' ? ['data-theme' => 'dark'] : []) !!}
                                @error('g-recaptcha-response')
                                    <span class="text-danger mt-1">@lang($message)</span>
                                @enderror
                            </div>
                        @endif


                        <div class="col-12">
                            <div class="links">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="flexCheckDefault">@lang('Remember me')</label>
                                </div>
                                <a href="{{ route('password.request') }}">@lang("Forgot Password?")</a>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-smm">@lang('sign in')</button>
                    <div class="bottom">@lang('Don\'t have an account?') <br />
                        <a href="{{ route('register') }}">@lang('Create account')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /LOGIN-SIGNUP -->


@endsection
