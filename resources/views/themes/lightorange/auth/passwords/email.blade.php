@extends($theme.'layouts.app')
@section('title',trans('Reset Password'))

@section('content')
    <!-- login_signup_area_start -->
    <section class="login_signup_page reset_image">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    @if(isset($templates['forget-password'][0]) && $content = $templates['forget-password'][0])
                        <div class="contact_area">
                            <div class="section_header mb-0">
                                <h4>@lang(@$content->description->title)</h4>
                            </div>
                            <p class="mt-30">{!! __(@$content->description->description) !!}</p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="login_signup_form p-4">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form_title pb-2">
                                <h4>@lang('Reset Password')</h4>
                            </div>
                            <div class="mb-4">
                                <input class="form-control" type="email" name="email" value="{{old('email')}}"
                                       placeholder="@lang('Enter Your Email Address')">
                                @error('email')
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


                            <button type="submit" class="btn custom_btn mt-30 w-100">@lang('Send Password Reset Link')</button>
                            <div class="pt-20 text-center">
                                @lang("Don't have an account?")
                                <p class="mb-0 highlight"><a href="{{ route('register') }}">@lang('Register here')</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login_signup_area_start -->
@endsection
