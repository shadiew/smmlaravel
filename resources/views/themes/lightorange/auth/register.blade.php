@extends($theme.'layouts.app')
@section('title',trans('Register'))
@section('content')

    <!-- login_signup_area_start -->
    <section class="login_signup_page">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    @if(isset($templates['register'][0]) && $content = $templates['register'][0])
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
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="form_title pb-2">
                                    <h4>@lang('Create Account')</h4>
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

                                <div class="col-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}"
                                               placeholder="@lang('First Name')">
                                        @error('firstname')
                                        <p class="text-danger mt-1">@lang($message)</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="lastname" value="{{old('lastname')}}" placeholder="@lang('Last Name')">
                                        @error('lastname')
                                        <p class="text-danger mt-1">@lang($message)</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="username" value="{{old('username')}}" placeholder="@lang('Username')">
                                        @error('username')
                                        <p class="text-danger mt-1">@lang($message)</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-4">
                                        <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="@lang('Email Address')">
                                        @error('email')
                                        <p class="text-danger  mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-4">
                                        <select class="form-select country_code" aria-label="Default select example" name="phone_code">
                                            @foreach($countries as $value)
                                                <option value="{{$value['phone_code']}}"
                                                        data-name="{{$value['name']}}"
                                                        data-code="{{$value['code']}}"
                                                    {{$country_code == $value['code'] ? 'selected' : ''}}>{{$value['phone_code']}} <strong>({{$value['name']}})</strong></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-4">
                                        <input type="text" name="phone" class="form-control ps-3 phoneField" value="{{old('phone')}}" placeholder="@lang('Your Phone Number')">
                                        @error('phone')
                                        <p class="text-danger mt-1">@lang($message)</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="password" class="form-control" name="password"
                                               placeholder="@lang('Password')">
                                        @error('password')
                                        <p class="text-danger mt-1">@lang($message)</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="password" class="form-control" name="password_confirmation"
                                               placeholder="@lang('Confirm Password')">
                                    </div>
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

                                <div class="col">
                                    <div class="mb-3 form-check d-flex justify-content-between">
                                        <div class="check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">@lang('I Agree with the Terms & conditions')</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn custom_btn mt-30 w-100">@lang('Register')</button>
                                    <div class="pt-20 text-center">
                                        @lang('Already have an account?')
                                        <p class="mb-0 highlight"><a href="{{ route('login') }}">@lang('Login Here')</a></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact_area_end -->
@endsection
