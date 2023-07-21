@extends($theme.'layouts.app')
@section('title','Login')


@section('content')

    <!-- LOGIN-SIGNUP -->
    <section id="login-signup">
        <div class="container">
            <div class="row">
                @if(isset($templates['login'][0]) && $content = $templates['login'][0])
                    <div class="col-lg-5">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="wrapper">
                                <div class="login-info-wrapper">
                                    <h5 class="h5 mb-30">@lang(@$content->description->title)</h5>
                                    <p>@lang(@$content->description->description)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="col-lg-7">
                    <div
                        class="form-wrapper w-100 h-100 d-flex flex-column align-items-start justify-content-center pl-65">
                        <h4 class="h4 text-uppercase mb-30">@lang('Login')</h4>


                        <form method="POST" action="{{ route('login') }}" class="form-content w-100">
                            @csrf
                            <div class="login">

                                <div class="form-group">
                                    <input class="form-control" type="text" name="username" value="{{old('username')}}"
                                           placeholder="@lang('Email Or Username')">

                                    @error('username')<p class="text-danger  mt-1">{{ $message }}</p>@enderror
                                    @error('email')<p class="text-danger  mt-1">{{ $message }}</p>@enderror
                                </div>


                                <div class="form-group">
                                    <input class="form-control " type="password" name="password"
                                           placeholder="@lang('Password')">
                                    @error('password')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>



                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember"
                                               name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">@lang('Remember me')</label>
                                    </div>
                                    <div>
                                        <a class="btn-forgetpass"
                                           href="{{ route('password.request') }}">@lang("Forgot Your Password?")</a>
                                    </div>

                                </div>





                                @if(basicControl()->reCaptcha_status_login)
                                    <div class="form-group mt-4">
                                        {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                        {!! NoCaptcha::display([]) !!}
                                        @error('g-recaptcha-response')
                                        <span class="text-danger mt-1">@lang($message)</span>
                                        @enderror
                                    </div>
                                @endif



                                <button class="btn mt-20" type="submit">@lang('Login')</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /LOGIN-SIGNUP -->


@endsection
