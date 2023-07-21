@extends($theme.'layouts.app')
@section('title',trans('Register'))
@section('content')

<!-- Register-SIGNUP -->
<section class="login-section">
    <div class="container">
        <div class="row g-lg-0 gy-5 align-items-center">
            @if(isset($templates['register'][0]) && $content = $templates['register'][0])
                <div class="col-lg-6">
                    <div class="text-box">
                        <h4>@lang(@$content->description->title)</h4>
                        <p>{!! __($content->description->description) !!}</p>
                    </div>
                </div>
            @endif
            <div class="col-lg-6">
                <form method="POST" action="{{ route('register') }}" class="form-content w-100">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <h4>@lang('create account')</h4>
                        </div>

                        @if(session()->get('sponsor') != null)
                            <div class="col-md-12">
                                <div class="input-box mb-3">
                                    <label>@lang('Sponsor Name')</label>
                                    <input type="text" name="sponsor" class="form-control" id="sponsor"
                                            placeholder="{{trans('Sponsor By') }}"
                                            value="{{session()->get('sponsor')}}" readonly>
                                </div>
                            </div>
                        @endif

                        <div class="input-box col-md-6">
                            <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="@lang('First Name')"/>
                            @error('firstname')
                                <p class="text-danger mt-1">@lang($message)</p>
                            @enderror
                        </div>
                        <div class="input-box col-md-6">
                            <input type="text" class="form-control" name="lastname" value="{{old('lastname')}}" placeholder="@lang('Last Name')"/>
                            @error('lastname')
                                <p class="text-danger mt-1">@lang($message)</p>
                            @enderror
                        </div>
                        <div class="input-box col-md-6">
                            <input type="text" class="form-control" name="username" value="{{old('username')}}" placeholder="@lang('Username')"/>
                            @error('username')
                                <p class="text-danger mt-1">@lang($message)</p>
                            @enderror
                        </div>

                        <div class="input-box col-md-6">
                            <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="@lang('Email Address')"/>
                            @error('email')
                                <p class="text-danger  mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-box col-12">
                            <div class="input-group">
                                <div class="input-group-prepend w-50">
                                    <select name="phone_code" class="form-control country_code">
                                        @foreach($countries as $value)
                                            <option value="{{$value['phone_code']}}"
                                                    data-name="{{$value['name']}}"
                                                    data-code="{{$value['code']}}"
                                                    {{$country_code == $value['code'] ? 'selected' : ''}}
                                            > {{$value['phone_code']}} <strong>({{$value['name']}})</strong>
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <input type="text" name="phone" class="form-control ps-3 phoneField" value="{{old('phone')}}" placeholder="@lang('Your Phone Number')">
                            </div>

                            @error('phone')
                                <p class="text-danger mt-1">@lang($message)</p>
                            @enderror
                        </div>

                        <div class="input-box col-md-6">
                            <input type="password" class="form-control" name="password"
                            placeholder="@lang('Password')"/>
                            @error('password')
                                <p class="text-danger mt-1">@lang($message)</p>
                            @enderror
                        </div>
                        <div class="input-box col-md-6">
                            <input type="password" class="form-control" name="password_confirmation"
                            placeholder="@lang('Confirm Password')"/>
                        </div>

                        @if(basicControl()->reCaptcha_status_registration)
                            <div class="col-12 box mb-2 input-box">
                                {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                {!! NoCaptcha::display($basic->theme == 'deepblue' ? ['data-theme' => 'dark'] : []) !!}
                                @error('g-recaptcha-response')
                                    <span class="text-danger mt-1">@lang($message)</span>
                                @enderror
                            </div>
                        @endif

                        <div class="col-12">
                            <div class="links">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        @lang('I Agree with the Terms & conditions')
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-smm">@lang('sign up')</button>

                    <div class="bottom">
                       @lang('Already have an account?') <br />
                        <a href="{{ route('login') }}">@lang('Login here')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /Register-SIGNUP -->

@endsection
