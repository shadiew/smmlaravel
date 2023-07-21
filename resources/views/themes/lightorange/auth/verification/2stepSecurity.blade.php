@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')

    <style>
        .login_signup_page{
            background: none !important;
        }
    </style>

    <!-- 2fa verification -->
    <section class="login_signup_page">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 offset-3">
                    <div class="login_signup_form p-4">
                        <form action="{{route('user.twoFA-Verify')}}"  method="post">
                            @csrf
                            <div class="form_title pb-2">
                                <h4>@lang($page_title)</h4>
                            </div>
                            <div class="mb-4">
                                <input class="form-control" type="text" name="code" value="{{old('code')}}" placeholder="@lang('Code')" autocomplete="off">
                                @error('code')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                @error('error')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                            </div>

                            <button type="submit" class="btn custom_btn mt-30 w-100">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /2fa verification -->

@endsection
