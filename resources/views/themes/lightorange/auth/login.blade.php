@extends($theme.'layouts.app')
@section('title',trans('Login'))

@section('content')

    <!-- login_signup_area_start -->
    <section class="login_signup_page">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    @if(isset($templates['login'][0]) && $content = $templates['login'][0])
                        <div class="contact_area">
                            <div class="section_header mb-0">
                                <h4>@lang(@$content->description->title)</h4>
                            </div>
                            <p class="mt-30">{!! __($content->description->description) !!}</p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="login_signup_form p-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form_title pb-2">
                                <h4>@lang('Login Here')</h4>
                            </div>
                            <div class="mb-4">
                                <input class="form-control" type="text" name="username" value="{{old('username')}}" placeholder="@lang('Email Or Username')">
                                @error('username')<p class="text-danger mt-1">@lang($message)</p>@enderror
                                @error('email')<p class="text-danger mt-1">@lang($message)</p>@enderror
                            </div>

                            <div class="mb-3">
                                <input class="form-control " type="password" name="password" placeholder="@lang('Password')">
                                @error('password')
                                <p class="text-danger mt-1">@lang($message)</p>
                                @enderror
                            </div>

                            @if(basicControl()->reCaptcha_status_login)
                                <div class="col-12 mb-2 input-box">
                                    {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                    {!! NoCaptcha::display($basic->theme == 'lightorange' ? ['data-theme' => 'dark'] : []) !!}
                                    @error('g-recaptcha-response')
                                    <span class="text-danger mt-1">@lang($message)</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3 form-check d-flex justify-content-between">
                                <div class="check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1" {{ old('remember') ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="exampleCheck1">@lang('Remember me')</label>
                                </div>
                                <div class="forgot highlight">
                                    <a href="{{ route('password.request') }}">@lang("Forgot Password?")</a>
                                </div>
                            </div>

                            <button type="submit" class="btn custom_btn mt-30 w-100">@lang('Log In')</button>
                            <div class="pt-20 text-center">
                                @lang("Don't have an account?")
                                <p class="mb-0 highlight"><a href="{{ route('register') }}">@lang('Create an account')</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login_signup_area_start -->
@endsection
