@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
    <!-- email verification -->
    <section class="login-section">
        <div class="container">
            <div class="row g-lg-0 gy-5 align-items-center justify-content-center">
                <div class="col-lg-6">
                    <form method="POST" action="{{route('user.mailVerify')}}" class="form-content w-100">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <h4>@lang($page_title)</h4>
                            </div>

                            <div class="input-box col-12">
                                <input class="form-control" type="text" name="code" value="{{old('code')}}" placeholder="@lang('Code')" autocomplete="off">
                                @error('code')
                                    <p class="text-danger mt-1">{{ trans($message) }}</p>
                                @enderror
                                @error('error')
                                    <p class="text-danger mt-1">{{ trans($message) }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn-smm mt-4">@lang('Submit')</button>
                        <div class="bottom">@lang('Didn\'t get Code?') <br />
                            <a href="{{route('user.resendCode')}}?type=email">@lang('Resend code')</a>
                            @error('resend')
                                <p class="text-danger mt-1">{{ trans($message) }}</p>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /email verification -->

@endsection
